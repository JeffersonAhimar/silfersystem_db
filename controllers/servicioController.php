<?php
require_once '../src/util/config.php';

require_once server_root . 'src/util/database.php';

$tblName = 'servicio';

extract($_POST);
if (!empty($_POST['op'])) {
    $op = $_POST['op'];
} else {
    echo 'No hay op';
}


switch ($op) {

        // CREATE
    case 1: {
            $db = new Database();
            $con = $db->conectar();
            $create = $con->prepare("INSERT INTO $tblName (`codigo`,`descripcion`,`bases`,`moneda`,`monto`,`fecha`,`link`,`idCliente`) VALUES (?,?,?,?,?,?,?,?)");
            $create->execute([$codigo, $descripcion, $bases, $moneda, $monto, $fecha, $link, $idCliente]);
            if ($create) {
                $resp['status'] = 'success';
            } else {
                $resp['status'] = 'failed';
                $resp['msg'] = 'Error: ' . $con->error;
            }
            echo json_encode($resp);
            break;
        }

        // READ
    case 2: {
            try {
                $db = new Database();
                $con = $db->conectar();
                // OBTENER CANTIDAD TOTAL
                $totalCount = $con->prepare("SELECT * FROM $tblName ");
                $totalCount->execute();
                $totalCount = $totalCount->rowCount();
                // CONDICIONALES
                $search_where = "";
                if (!empty($search)) {
                    $search_where = " WHERE ";
                    $search_where .= " codigo LIKE '%{$search['value']}%' ";
                    $search_where .= " OR descripcion LIKE '%{$search['value']}%' ";
                    $search_where .= " OR bases LIKE '%{$search['value']}%' ";
                    $search_where .= " OR moneda LIKE '%{$search['value']}%' ";
                    $search_where .= " OR monto LIKE '%{$search['value']}%' ";
                    $search_where .= " OR date_format(fecha,'%M %d, %Y') LIKE '%{$search['value']}%' ";
                    $search_where .= " OR link LIKE '%{$search['value']}%' ";
                    $search_where .= " OR idCliente LIKE '%{$search['value']}%' ";
                }
                // NOMBRES DE COLUMNAS
                $columns_arr = array(
                    "idServicio",
                    "codigo",
                    "descripcion",
                    "bases",
                    "moneda",
                    "monto",
                    "unix_timestamp(fecha)",
                    "link",
                    "idCliente"
                );
                // OBTENER TODOS 
                $query = $con->prepare("SELECT * FROM $tblName {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start} ");
                $query->execute();
                // OBTENER CANTIDAD FILTRADOS
                $recordsFilterCount = $con->prepare("SELECT * FROM $tblName {$search_where} ");
                $recordsFilterCount->execute();
                $recordsFilterCount = $recordsFilterCount->rowCount();
                // CANTIDAD DE REGISTROS
                $recordsTotal = $totalCount;
                $recordsFiltered = $recordsFilterCount;
                // GUARDANDO DATA
                $data = array();
                $i = 1 + $start;
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $row['no'] = $i++;
                    $row['fecha'] = date("F d, Y", strtotime($row['fecha']));
                    // 
                    $n = strlen($row['descripcion']);
                    if ($n > 40) {
                        $half = $n / 2;
                        while (substr($row['descripcion'], $half, 1) != ' ') {
                            $half += 1;
                        }
                        $row['descripcion'] = substr($row['descripcion'], 0, $half) . '<br>' . substr($row['descripcion'], $half);
                    } else {
                        $row['descripcion'] = $row['descripcion'];
                    }
                    // 
                    $data[] = $row;
                }
                // DEVOLVIENDO DATA
                echo json_encode(
                    array(
                        'draw' => $draw,
                        'recordsTotal' => $recordsTotal,
                        'recordsFiltered' => $recordsFiltered,
                        'data' => $data
                    )
                );
            } catch (Exception $ex) {
                //throw $th;
            }

            break;
        }
        // UPDATE
    case 3: {
            $db = new Database();
            $con = $db->conectar();
            $update = $con->prepare("UPDATE $tblName SET `codigo` = ?, `descripcion` = ?, `bases` = ?, `moneda` = ?, `monto` = ?, `fecha` = ?, `link` = ?, `idCliente` = ? WHERE idServicio = ?");
            $update->execute([$codigo, $descripcion, $bases, $moneda, $monto, $fecha, $link, $idCliente, $idServicio]);
            if ($update) {
                $resp['status'] = 'success';
            } else {
                $resp['status'] = 'failed';
                $resp['msg'] = 'Error: ' . $con->error;
            }
            echo json_encode($resp);
            break;
        }

        // DELETE
    case 4: {
            $db = new Database();
            $con = $db->conectar();
            $delete = $con->prepare("DELETE FROM $tblName WHERE idServicio = ?");
            $delete->execute([$idServicio]);
            if ($delete) {
                $resp['status'] = 'success';
            } else {
                $resp['status'] = 'failed';
                $resp['msg'] = 'Error: ' . $con->error;
            }
            echo json_encode($resp);
            break;
        }

        // GET_SINGLE
    case 5: {
            try {
                $db = new Database();
                $con = $db->conectar();
                $query = $con->prepare("SELECT * FROM $tblName WHERE idServicio = ?");
                $query->execute([$idServicio]);
                if ($query) {
                    $resp['status'] = 'success';
                    $resp['data'] = $query->fetch(PDO::FETCH_ASSOC);
                } else {
                    $resp['status'] = 'success';
                    $resp['error'] = 'Error: ' . $con->error;
                }
                echo json_encode($resp);
            } catch (Exception $ex) {
                // error
            }
            break;
        }

        // GET_ALL
    case 6: {
            $db = new Database();
            $con = $db->conectar();
            $query = $con->prepare("SELECT * FROM $tblName");
            $query->execute();
            $rowData = '';
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $rowData .= '<option value="' . $row['idServicio'] . '">' . $row['idServicio'] . ' - ' . $row['codigo'] . '</option>';
            }
            echo $rowData;
            break;
        }
}
