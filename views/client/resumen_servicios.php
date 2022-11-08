<!DOCTYPE html>
<html lang="en">
<?php $titleTable = 'Servicios' ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once '../../src/util/config.php'; ?>
    <?php require_once server_root . 'src/dependencies/dependencias.php'; ?>

    <!-- JS - jQuery - AJAX -->
    <script src="<?php echo web_root; ?>public/javascripts/resumen_servicios.js"></script>

    <title><?php echo $titleTable ?></title>
    <!-- <style>
        button.dt-button.btn-primary {
            background: var(--bs-primary) !important;
            color: white;
        }
    </style> -->
    <?php require_once server_root . 'src/util/database.php'; ?>
    <?php
    $sql = "SELECT
-- servicio
s.idServicio AS 's.idServicio',
s.codigo AS 's.codigo',
s.descripcion AS 's.descripcion',
s.bases AS 's.bases',
s.moneda AS 's.moneda',
s.monto AS 's.monto',
s.fecha AS 's.fecha',
s.link AS 's.link',
-- s_registro
sr.fecha AS 'sr.fecha',
sr.fec_buena_pro AS 'sr.fec_buena_pro',
sr.fec_perfeccionamiento AS 'sr.fec_perfeccionamiento',
sr.link AS 'sr.link',
-- s_orden
so.numero AS 'so.numero',
so.fec_emision AS 'so.fec_emision',
so.numero_siaf AS 'so.numero_siaf',
so.link AS 'so.link',
so.idServicio AS 'so.idServicio',
-- s_contrato
sc.numero AS 'sc.numero',
sc.fec_ejecucion AS 'sc.fec_ejecucion',
sc.link AS 'sc.link'
FROM
servicio s
INNER JOIN s_registro sr ON sr.idServicio = s.idServicio
INNER JOIN s_orden so ON so.idServicio = s.idServicio
INNER JOIN s_contrato sc ON sc.idServicio = s.idServicio;";
    $db = new Database();
    $con = $db->conectar();
    $query = $con->prepare($sql);
    $query->execute();
    ?>
</head>

<body>

    <center>
        <h1><?php echo $titleTable ?></h1>
        <input type="button" value="Atras" onclick="historyBack()">
        <input type="button" value="Home - Admin" onclick="irHomeAdmin()">

        <br><br>

        <table id="tblData" class="display nowrap table table-bordered" style="width:100%">
            <thead>
                <tr class="bg-primary text-light bg-gradient bg-opacity-150">
                    <th class="text-center" colspan="7">Servicio</th>
                    <th class="text-center" colspan="4">Registro</th>
                    <th class="text-center" colspan="4">Orden</th>
                    <th class="text-center" colspan="3">Contrato</th>
                </tr>
                <tr class="bg-secondary text-light bg-gradient bg-opacity-150">
                    <!-- Servicio -->
                    <th width="2%">id</th>
                    <th>codigo</th>
                    <th>descripcion</th>
                    <th>bases</th>
                    <th>monto</th>
                    <th>fecha</th>
                    <th>link</th>
                    <!-- Registro -->
                    <th>fecha</th>
                    <th>fec_buena_pro</th>
                    <th>fec_perfeccionamiento</th>
                    <th>link</th>
                    <!-- Orden -->
                    <th>numero</th>
                    <th>fec_emision</th>
                    <th>numero_siaf</th>
                    <th>link</th>
                    <!-- Contrato -->
                    <th>numero</th>
                    <th>fec_ejecucion</th>
                    <th>link</th>
                </tr>
            </thead>
            <tbody>
                <?php
                function echoMoney($cur, $num)
                {
                    $num = number_format($num, 2);
                    if ($cur == 'S') {
                        return "<td> S/ " . $num . "</td>";
                    } else if ($cur == 'D') {
                        return "<td> $ " . $num . "</td>";
                    } else {
                        return "<td>" . $num . "</td>";
                    }
                }
                function echoLink($url)
                {
                    if ($url == '') {
                        return '<td><a class="me-2 btn btn-sm py-0 btn-info disabled" href="#">No</a></td>';
                    } else {
                        return '<td><a class="me-2 btn btn-sm py-0 btn-info" href="' . $url . '" target="_blank">Sí</a></td>';
                    }
                }
                function echoNormal($val)
                {
                    return '<td>' . $val . '</td>';
                }
                ?>
                <?php while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $rowData = "";
                    $rowData .= "<tr>";
                    // servicio
                    $rowData .= echoNormal($row['s.idServicio']);
                    $rowData .= echoNormal($row['s.codigo']);
                    $rowData .= echoNormal($row['s.descripcion']);
                    $rowData .= echoLink($row['s.bases']);
                    $rowData .= echoMoney($row['s.moneda'], $row['s.monto']);
                    $rowData .= echoNormal($row['s.fecha']);
                    $rowData .= echoLink($row['s.link']);
                    // registro
                    $rowData .= echoNormal($row['sr.fecha']);
                    $rowData .= echoNormal($row['sr.fec_buena_pro']);
                    $rowData .= echoNormal($row['sr.fec_perfeccionamiento']);
                    $rowData .= echoLink($row['sr.link']);
                    // orden
                    $rowData .= echoNormal($row['so.numero']);
                    $rowData .= echoNormal($row['so.fec_emision']);
                    $rowData .= echoNormal($row['so.numero_siaf']);
                    $rowData .= echoLink($row['so.link']);
                    // contrato
                    $rowData .= echoNormal($row['sc.numero']);
                    $rowData .= echoNormal($row['sc.fec_ejecucion']);
                    $rowData .= echoLink($row['sc.link']);


                    $rowData .= "</tr>";
                    echo $rowData;
                } ?>
            </tbody>
            <tfoot>
                <tr class="">
                    <!-- Servicio -->
                    <th width="2%">idServicio</th>
                    <th>codigo</th>
                    <th>descripcion</th>
                    <th>bases</th>
                    <th>monto</th>
                    <th>fecha</th>
                    <th>link</th>
                    <!-- Registro -->
                    <th>fecha</th>
                    <th>fec_buena_pro</th>
                    <th>fec_perfeccionamiento</th>
                    <th>link</th>
                    <!-- Orden -->
                    <th>numero</th>
                    <th>fec_emision</th>
                    <th>numero_siaf</th>
                    <th>link</th>
                    <!-- Contrato -->
                    <th>numero</th>
                    <th>fec_ejecucion</th>
                    <th>link</th>
                </tr>
            </tfoot>
        </table>
    </center>

</body>


</html>