<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once '../../src/util/config.php'; ?>
    <?php require_once server_root . 'src/dependencies/dependencias.php'; ?>

    <!-- JS - jQuery - AJAX -->
    <script src="<?php echo web_root; ?>public/javascripts/cliente2.js"></script>

    <title>Administrar Clientes</title>
</head>

<body>
    <h1>Administrar Clientes</h1>
    <input type="button" value="Atras" onclick="historyBack()">
    <input type="button" id="btnRead" value="Listar">
    <input type="button" id="btnCreateModal" value="Añadir">

    <!-- VOLVER -->

    <input type="button" value="Home - Admin" onclick="irHomeAdmin()">
    <!-- <center>
        <div class="col-md-7" id="tabla">
        </div>
    </center> -->
    <!----------------DATOS TABLA---------------->
    <div class="table-responsive">
        <table class="table table-bordered" id="tblData">
            <thead>
                <tr>
                    <th width="4%" scope="col">idCliente</th>
                    <th scope="col">código</th>
                    <th scope="col">nombre</th>
                    <th scope="col">RUC</th>
                    <th scope="col">enlace</th>
                    <th width="10%" scope="col" colspan="2">Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</body>


<!----------------MODAL AÑADIR / MODIFICAR---------------->
<div class="modal fade" id="modalCU" tabindex="-1" aria-labelledby="modalCULabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCULabel">Modal - Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3" id="divtxt1">
                    <label class="col-form-label" for="txt1">idCliente:</label>
                    <input type="text" class="form-control" id="txt1">
                </div>
                <div class="mb-3" id="divtxt2">
                    <label class="col-form-label" for="txt2">código:</label>
                    <input type="text" class="form-control" id="txt2" placeholder="Campo obligatorio">
                </div>
                <div class="mb-3" id="divtxt3">
                    <label class="col-form-label" for="txt3">nombre:</label>
                    <input type="text" class="form-control" id="txt3" placeholder="Campo obligatorio">
                </div>
                <div class="mb-3" id="divtxt4">
                    <label class="col-form-label" for="txt4">RUC:</label>
                    <input type="text" class="form-control" id="txt4" placeholder="Campo obligatorio">
                </div>
                <div class="mb-3" id="divtxt5">
                    <label class="col-form-label" for="txt5">link:</label>
                    <input type="text" class="form-control" id="txt5" placeholder="Campo obligatorio">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <input type="button" class="btn btn-primary" id="btnCU">
            </div>
        </div>
    </div>
</div>

<!----------------MODAL ELIMINAR---------------->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Seguro que desea eliminar?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="txtdel" class="col-form-label">id:</label>
                <input type="text" class="form-control" id="txtdel" readonly>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="btnDelete">Sí</button>
            </div>
        </div>
    </div>
</div>



</html>