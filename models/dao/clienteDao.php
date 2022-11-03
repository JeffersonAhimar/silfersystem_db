<?php
require_once '../../src/util/config.php';

require_once server_root . 'models/bean/clienteBean.php';
require_once server_root . 'src/util/database.php';

extract($_POST);
try {
    $db = new Database();
    $con = $db->conectar();
    // OBTENER CANTIDAD TOTAL
    $totalCount = $con->prepare("SELECT * FROM `cliente` ");
    $totalCount->execute();
    $totalCount = $totalCount->rowCount();

    $search_where = "";
    if (!empty($search)) {
        $search_where = " where ";
        $search_where .= " codigo LIKE '%{$search['value']}%' ";
        $search_where .= " OR nombre LIKE '%{$search['value']}%' ";
        $search_where .= " OR ruc LIKE '%{$search['value']}%' ";
        $search_where .= " OR link LIKE '%{$search['value']}%' ";
    }
    $columns_arr = array(
        "idCliente",
        "codigo",
        "nombre",
        "ruc",
        "link"
    );
    // OBTENER TODOS 
    $query = $con->prepare("SELECT * FROM `cliente` {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start} ");
    $query->execute();
    // OBTENER CANTIDAD FILTRADOS
    $recordsFilterCount = $con->prepare("SELECT * FROM `cliente` {$search_where} ");
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
