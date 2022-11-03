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
    <!-- <style>
        button.dt-button.btn-primary {
            background: var(--bs-primary) !important;
            color: white;
        }
    </style> -->
</head>

<body>
    <h1>Administrar Clientes</h1>
    <input type="button" value="Atras" onclick="historyBack()">
    <!-- <input type="button" id="btnRead" value="Listar"> -->
    <input type="button" id="btnCreateModal" value="Añadir">

    <!-- VOLVER -->

    <input type="button" value="Home - Admin" onclick="irHomeAdmin()">
    <!-- <center>
        <div class="col-md-7" id="tabla">
        </div>
    </center> -->
    <!----------------DATOS TABLA---------------->
    <!-- <div class="table-responsive">
        <table class="table table-bordered" id="tblData">
            <thead>
                <tr class="bg-dark text-light bg-gradient bg-opacity-150">
                    <th class="px-1 py-1 text-center">idCliente</th>
                    <th class="px-1 py-1 text-center">código</th>
                    <th class="px-1 py-1 text-center">nombre</th>
                    <th class="px-1 py-1 text-center">RUC</th>
                    <th class="px-1 py-1 text-center">Acciones</th>
                </tr>
            </thead>
        </table>
    </div> -->
    <div class="container py-5 h-100">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-hover table-bordered table-striped" id="tblData">
                    <thead>
                        <tr class="bg-dark text-light bg-gradient bg-opacity-150">
                            <th class="px-1 py-1 text-center">id</th>
                            <th class="px-1 py-1 text-center">código</th>
                            <th class="px-1 py-1 text-center">nombre</th>
                            <th class="px-1 py-1 text-center">RUC</th>
                            <th class="px-1 py-1 text-center">link</th>
                            <th class="px-1 py-1 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-dark text-light bg-gradient bg-opacity-150">
                            <th class="px-1 py-1 text-center">id</th>
                            <th class="px-1 py-1 text-center">código</th>
                            <th class="px-1 py-1 text-center">nombre</th>
                            <th class="px-1 py-1 text-center">RUC</th>
                            <th class="px-1 py-1 text-center">link</th>
                            <th class="px-1 py-1 text-center">Acciones</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>


<!----------------MODAL AÑADIR / MODIFICAR---------------->
<!-- <div class="modal fade" id="modalCU" tabindex="-1" aria-labelledby="modalCULabel" aria-hidden="true">
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
</div> -->

<!----------------MODAL ELIMINAR---------------->
<!-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
</div> -->


<!-- Add Modal -->
<div class="modal fade" id="add_modal" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Persona</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="" id="new-frm">
                        <div class="form-group">
                            <label for="first_name" class="control-label">Nombre</label>
                            <input type="text" class="form-control rounded-0" id="first_name" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="control-label">Apellido</label>
                            <input type="text" class="form-control rounded-0" id="last_name" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">Correo</label>
                            <input type="text" class="form-control rounded-0" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="birthdate" class="control-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control rounded-0" id="birthdate" name="birthdate" required>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="new-frm">Guardar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- /Add Modal -->
<!-- Edit Modal -->
<div class="modal fade" id="edit_modal" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Detalles de Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- ID -->
                    <form action="" id="edit-frm">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label for="codigo" class="control-label">codigo</label>
                            <input type="text" class="form-control rounded-0" id="codigo" name="codigo" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre" class="control-label">nombre</label>
                            <input type="text" class="form-control rounded-0" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="ruc" class="control-label">RUC</label>
                            <input type="text" class="form-control rounded-0" id="ruc" name="ruc" required>
                        </div>
                        <div class="form-group">
                            <label for="link" class="control-label">link</label>
                            <input type="text" class="form-control rounded-0" id="link" name="link" required>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="edit-frm">Guardar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Modal -->
<!-- Delete Modal -->
<div class="modal fade" id="delete_modal" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="" id="delete-author-frm">
                        <input type="hidden" name="id">
                        <p>Estás segur@ de eliminar a <b><span id="name"></span></b> del listado?</p>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" form="delete-author-frm">Sí</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Modal -->


</html>