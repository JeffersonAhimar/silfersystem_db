<?php
require_once '../../src/util/config.php';

require_once server_root . 'models/bean/clienteBean.php';
require_once server_root . 'src/util/database.php';

extract($_POST);
try {
    $db = new Database();
    $con = $db->conectar();
    // $query = $con->query("SELECT * FROM `cliente` where idCliente = '{$id}'");
    $query = $con->prepare("SELECT * FROM `cliente` where idCliente = '{$idCliente}'");
    $query->execute();
    if ($query) {
        $resp['status'] = 'success';
        $resp['data'] = $query->fetch(PDO::FETCH_ASSOC);
    } else {
        $resp['status'] = 'success';
        $resp['error'] = 'An error occured while fetching the data. Error: ' . $con->error;
    }
    echo json_encode($resp);
} catch (Exception $ex) {
    // error
}
