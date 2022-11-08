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
    function goResumen() {
        window.open('resumen_servicios.php', '_self');
    }
</script>


<body>
    <center>
        <br>
        <input type="button" value="Resumen" onclick="goResumen()">
        <br><br>
    </center>



</body>

</html>