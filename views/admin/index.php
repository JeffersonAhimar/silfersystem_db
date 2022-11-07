<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <?php require_once '../../src/util/config.php'; ?>
    <?php require_once server_root . 'src/dependencies/dependencias.php'; ?>
    <title>Inicio Admin</title>
</head>

<script>
    function goCliente() {
        window.open('cliente.php', '_self');
    }

    function goServicio() {
        window.open('servicio.php', '_self');
    }

    function goS_Registro() {
        window.open('s_registro.php', '_self');
    }

    function goS_Orden() {
        window.open('s_orden.php', '_self');
    }

    function goS_Contrato() {
        window.open('s_contrato.php', '_self');
    }

    function goS_Entregable() {
        window.open('s_entregable.php', '_self');
    }

    function goS_Conformidad() {
        window.open('s_conformidad.php', '_self');
    }

    function goS_Factura() {
        window.open('s_factura.php', '_self');
    }

</script>

<body>
    <center>
        <br>
        <input type="button" value="Clientes" onclick="goCliente()">
        <br><br>
        <input type="button" value="Servicio" onclick="goServicio()">
        <br><br>
        <input type="button" value="S_Registro" onclick="goS_Registro()">
        <br><br>
        <input type="button" value="S_Orden" onclick="goS_Orden()">
        <br><br>
        <input type="button" value="S_Contrato" onclick="goS_Contrato()">
        <br><br>
        <input type="button" value="S_Entregable" onclick="goS_Entregable()">
        <br><br>
        <input type="button" value="S_Conformidad" onclick="goS_Conformidad()">
        <br><br>
        <input type="button" value="S_Factura" onclick="goS_Factura()">

    </center>
</body>

</html>