<?php
require_once '../src/util/config.php';

require_once server_root . 'src/util/database.php';

$tblName = 'cliente';

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
            $create = $con->prepare("INSERT INTO $tblName (`codigo`,`nombre`,`ruc`,`link`) VALUES (?,?,?,?)");
            $create->execute([$codigo, $nombre, $ruc, $link]);
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
                    $search_where .= " OR nombre LIKE '%{$search['value']}%' ";
                    $search_where .= " OR ruc LIKE '%{$search['value']}%' ";
                    $search_where .= " OR link LIKE '%{$search['value']}%' ";
                }
                // NOMBRES DE COLUMNAS
                $columns_arr = array(
                    "idCliente",
                    "codigo",
                    "nombre",
                    "ruc",
                    "link"
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
            $update = $con->prepare("UPDATE $tblName SET `codigo` = ?, `nombre` = ?, `ruc` = ?,`link` = ? WHERE idCliente = ?");
            $update->execute([$codigo, $nombre, $ruc, $link, $idCliente]);
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
            $delete = $con->prepare("DELETE FROM $tblName WHERE idCliente = ?");
            $delete->execute([$idCliente]);
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
                $query = $con->prepare("SELECT * FROM $tblName WHERE idCliente = ?");
                $query->execute([$idCliente]);
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
                $rowData .= '<option value="' . $row['idCliente'] . '">' . $row['idCliente'] . ' - ' . $row['codigo'] . '</option>';
            }
            echo $rowData;
            break;
        }
}
