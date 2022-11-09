<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        td {
            vertical-align: middle;
        }
    </style>

    <?php require_once '../../src/util/config.php'; ?>
    <?php require_once server_root . 'src/dependencies/dependencias.php'; ?>

    <!-- JS - jQuery - AJAX -->
    <script src="<?php echo web_root; ?>public/javascripts/resumen_entregables.js"></script>

    <?php require_once server_root . 'src/util/database.php'; ?>
    <?php

    ?>
    <?php
    if (!empty($_GET['idServicio'])) {
        $getIdServicio = $_GET['idServicio'];
    }; ?>
    <?php
    $db = new Database();
    $con = $db->conectar();
    // GET SERVICES
    $sql = "SELECT
    s.idServicio AS 's.idServicio',
    s.codigo AS 's.codigo',
    s.descripcion AS 's.descripcion',
    s.bases AS 's.bases',
    s.moneda AS 's.moneda',
    s.monto AS 's.monto',
    s.link AS 's.link',
    s.idCliente AS 's.idCliente',
    c.codigo AS 'c.codigo',
    c.nombre AS 'c.nombre',
    c.ruc AS 'c.ruc',
    c.link AS 'c.link'
FROM
    servicio s
    INNER JOIN cliente c ON c.idCliente = s.idCliente
WHERE
    idServicio = $getIdServicio;";
    $query = $con->prepare($sql);
    $query->execute();
    $rowServicio = $query->fetch(PDO::FETCH_ASSOC);
    ?>
    <?php
    function getEntregables($con, $idServicio)
    {
        $sql = "SELECT
        se.idEntregable AS 'se.idEntregable',
        se.numero AS 'se.numero',
        se.fec_maxima AS 'se.fec_maxima',
        se.fec_entrega AS 'se.fec_entrega',
        se.forma_pago AS 'se.forma_pago',
        se.plazo_entregable AS 'se.plazo_entregable',
        se.link AS 'se.link'
    FROM
        s_entregable se
    WHERE
        se.idServicio =$idServicio;";
        $query = $con->prepare($sql);
        $query->execute();
        return $query;
    }
    function getConformidades($con, $idEntregable)
    {
        $sql = "SELECT
        sc.idConformidad AS 'sc.idConformidad',
        sc.fecha AS 'sc.fecha',
        sc.link AS 'sc.link'
    FROM
        s_conformidad sc
    WHERE
        sc.idEntregable =$idEntregable;";
        $query = $con->prepare($sql);
        $query->execute();
        return $query;
    }
    function getFacturas($con, $idConformidad)
    {
        $sql = "SELECT
        sf.idFactura AS 'sf.idFactura',
        sf.numero AS 'sf.numero',
        sf.moneda AS 'sf.moneda',
        sf.monto AS 'sf.monto',
        sf.fec_emision AS 'sf.fec_emision',
        sf.detraccion AS 'sf.detraccion',
        sf.fec_detraccion AS 'sf.fec_detraccion',
        sf.link AS 'sf.link'
    FROM
        s_factura sf
    WHERE
        sf.idConformidad =$idConformidad;";
        $query = $con->prepare($sql);
        $query->execute();
        return $query;
    }
    function getDepositos($con, $idFactura)
    {
        $sql = "SELECT
        sd.idDeposito AS 'sd.idDeposito',
        sd.moneda AS 'sd.moneda',
        sd.monto AS 'sd.monto',
        sd.fecha AS 'sd.fecha',
        sd.link AS 'sd.link'
    FROM
        s_deposito sd
    WHERE
        sd.idFactura = $idFactura
    LIMIT 1;";
        $query = $con->prepare($sql);
        $query->execute();
        return $query;
    }

    ?>

    <?php $titleTable = 'Entregables del ' . $rowServicio['s.codigo']; ?>
    <title><?php echo $titleTable; ?></title>
</head>

<body>
    <center>
        <h1><?php echo $titleTable ?></h1>
        <input type="button" value="Atras" onclick="historyBack()">
        <input type="button" value="Home - Admin" onclick="irHomeAdmin()">
        <br><br>
    </center>
    <h5>Datos del Servicio</h5>
    <ul>
        <li><b>Descripcion:</b> <?php echo $rowServicio['s.descripcion']; ?></li>
        <li><b>Bases:</b>
            <?php
            if ($rowServicio['s.bases'] == '') {
                echo '<a class="me-2 btn btn-sm py-0 btn-warning disabled" href="#" target="_blank">Ver</a>';
            } else {
                echo '<a class="me-2 btn btn-sm py-0 btn-warning" href="' . $rowServicio['s.bases'] . '" target="_blank">Ver</a>';
            }
            ?>
        </li>
        <li><b>Monto:</b> <?php
                            if ($rowServicio['s.moneda'] == 'S') {
                                $rowServicio['s.moneda'] = 'S/ ';
                            } else if ($rowServicio['s.moneda'] == 'D') {
                                $rowServicio['s.moneda'] = '$ ';
                            } else {
                                $rowServicio['s.moneda'] = '';
                            }
                            echo $rowServicio['s.moneda'] . number_format($rowServicio['s.monto'], 2); ?></li>
        <li><b>Carpeta del Servicio:</b>
            <?php
            if ($rowServicio['s.link'] == '') {
                echo '<a class="me-2 btn btn-sm py-0 btn-warning disabled" href="#" target="_blank">Ver</a>';
            } else {
                echo '<a class="me-2 btn btn-sm py-0 btn-warning" href="' . $rowServicio['s.link'] . '" target="_blank">Ver</a>';
            }
            ?>
        </li>
    </ul>
    <h5>Datos del Cliente</h5>
    <ul>
        <li><b>Codigo:</b> <?php echo $rowServicio['c.codigo']; ?></li>
        <li><b>Nombre:</b> <?php echo $rowServicio['c.nombre']; ?></li>
        <li><b>RUC:</b> <?php echo $rowServicio['c.ruc']; ?></li>
        <li><b>Carpeta del Cliente:</b>
            <?php
            if ($rowServicio['c.link'] == '') {
                echo '<a class="me-2 btn btn-sm py-0 btn-warning disabled" href="#" target="_blank">Ver</a>';
            } else {
                echo '<a class="me-2 btn btn-sm py-0 btn-warning" href="' . $rowServicio['c.link'] . '" target="_blank">Ver</a>';
            }
            ?>
        </li>
    </ul>
    <center>

        <table id="tblData" class="display nowrap table table-bordered" style="width:100%">
            <thead>
                <tr class="bg-primary text-light bg-gradient bg-opacity-150">
                    <th class="text-center" colspan="3">Entregable</th>
                    <th class="text-center" colspan="1">Conformidad - Factura - Deposito</th>
                </tr>
                <tr class="bg-secondary text-light bg-gradient bg-opacity-150">
                    <!-- s_entregable -->
                    <th width="2%">id</th>
                    <th width="2%">nro</th>
                    <th width="4%">datos</th>
                    <!-- s_conformidad -->
                    <th></th>

                    <!-- s_deposito -->
                </tr>
            </thead>
            <tbody>
                <?php
                $rowData = "";
                $entquery = getEntregables($con, $getIdServicio);
                while ($ent = $entquery->fetch(PDO::FETCH_ASSOC)) {
                    $rowData .= "<tr>";
                    // entregables
                    $rowData .= '<td>' . $ent['se.idEntregable'] . '</td>';
                    $rowData .= '<td>' . $ent['se.numero'] . '</td>';
                    $rowData .= '<td><ul>';
                    $rowData .= '<li><b>fec_maxima: </b>' . $ent['se.fec_maxima'] . '</li>';
                    $rowData .= '<li><b>fec_entrega: </b>' . $ent['se.fec_entrega'] . '</li>';
                    $rowData .= '<li><b>forma_pago: </b>' . $ent['se.forma_pago'] . '%</li>';
                    $rowData .= '<li><b>plazo_entregable: </b>' . $ent['se.plazo_entregable'] . '</li>';
                    if ($ent['se.link'] == '') {
                        $rowData .= '<li><b>link: </b><a class="me-2 btn btn-sm py-0 btn-warning disabled" href="#" target="_blank">Ver</a></li>';
                    } else {
                        $rowData .= '<li><b>link: </b><a class="me-2 btn btn-sm py-0 btn-warning" href="' . $ent['se.link'] . '" target="_blank">Ver</a></li>';
                    }
                    $rowData .= '</ul></td>';
                    // s_conformidad
                    $confquery = getConformidades($con, $ent['se.idEntregable']);
                    $rowData .= '<td style="padding: 0;">';
                    $rowData .= '<table class="table table-bordered" style="margin:0;">';
                    $rowData .= '
                    <thead>
                        <tr class="bg-warning text-light bg-gradient bg-opacity-150">
                            <th class="text-center" colspan="1">Conformidad</th>
                            <th class="text-center" colspan="4">Factura - Deposito</th>
                        </tr>
                    </thead>
                    <tbody>';
                    while ($conf = $confquery->fetch(PDO::FETCH_ASSOC)) {
                        $rowData .= "<tr>";
                        $rowData .= '<td><ul>';
                        $rowData .= '<li><b>fecha: </b>' . $conf['sc.fecha'] . '</li>';
                        if ($conf['sc.link'] == '') {
                            $rowData .= '<li><b>link: </b><a class="me-2 btn btn-sm py-0 btn-warning disabled" href="#" target="_blank">Ver</a></li>';
                        } else {
                            $rowData .= '<li><b>link: </b><a class="me-2 btn btn-sm py-0 btn-warning" href="' . $conf['sc.link'] . '" target="_blank">Ver</a></li>';
                        }
                        $rowData .= '</ul></td>';
                        $rowData .= '<td style="padding: 0;">';
                        $rowData .= '<table class="table table-bordered" style="margin:0;">';
                        $rowData .= '
                        <thead>
                            <tr class="bg-success text-light bg-gradient bg-opacity-150">
                                <th class="text-center" style="padding:1px;">Factura</th>
                                <th class="text-center" style="padding:1px;">Deposito</th>
                            </tr>
                        </thead>
                        <tbody>';
                        // data factura,deposito
                        $facquery = getFacturas($con, $conf['sc.idConformidad']);
                        while ($fac = $facquery->fetch(PDO::FETCH_ASSOC)) {
                            $rowData .= "<tr>";
                            $rowData .= '<td><ul>';
                            $rowData .= '<li><b>numero: </b>' . $fac['sf.numero'] . '</li>';
                            $rowData .= '<li><b>monto: </b>' . $fac['sf.monto'] . '</li>';
                            $rowData .= '<li><b>fec_emision: </b>' . $fac['sf.fec_emision'] . '</li>';
                            $rowData .= '<li><b>detraccion: </b>' . $fac['sf.detraccion'] . '</li>';
                            $rowData .= '<li><b>fec_detraccion: </b>' . $fac['sf.fec_detraccion'] . '</li>';
                            if ($fac['sf.link'] == '') {
                                $rowData .= '<li><b>link: </b><a class="me-2 btn btn-sm py-0 btn-warning disabled" href="#" target="_blank">Ver</a></li>';
                            } else {
                                $rowData .= '<li><b>link: </b><a class="me-2 btn btn-sm py-0 btn-warning" href="' . $fac['sf.link'] . '" target="_blank">Ver</a></li>';
                            }
                            $rowData .= '</ul></td>';
                            // data deposito
                            $depquery = getDepositos($con, $fac['sf.idFactura']);
                            while ($dep = $depquery->fetch(PDO::FETCH_ASSOC)) {
                                $rowData .= '<td><ul>';
                                $rowData .= '<li><b>monto: </b>' . $dep['sd.monto'] . '</li>';
                                $rowData .= '<li><b>fecha: </b>' . $dep['sd.fecha'] . '</li>';
                                if ($dep['sd.link'] == '') {
                                    $rowData .= '<li><b>link: </b><a class="me-2 btn btn-sm py-0 btn-warning disabled" href="#" target="_blank">Ver</a></li>';
                                } else {
                                    $rowData .= '<li><b>link: </b><a class="me-2 btn btn-sm py-0 btn-warning" href="' . $dep['sd.link'] . '" target="_blank">Ver</a></li>';
                                }
                                $rowData .= '</ul></td>';
                            }
                            $rowData .= '</tr>';
                        }
                        $rowData .= "</tbody>";
                        $rowData .= "</table>";
                        $rowData .= '</td>';
                        $rowData .= "</tr>";
                    }
                    $rowData .= "</tbody>";
                    $rowData .= "</table>";
                    $rowData .= "</td>";
                    // end
                    $rowData .= "</tr>";
                }

                echo $rowData;
                ?>

            </tbody>
            <tfoot>
                <tr class="">

                </tr>
            </tfoot>
        </table>
    </center>

</body>


</html>