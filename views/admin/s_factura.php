<!DOCTYPE html>
<html lang="en">
<?php $titleTable = 'Factura de Conformidad' ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once '../../src/util/config.php'; ?>
    <?php require_once server_root . 'src/dependencies/dependencias.php'; ?>

    <!-- JS - jQuery - AJAX -->
    <script src="<?php echo web_root; ?>public/javascripts/s_factura.js"></script>

    <title>Administrar <?php echo $titleTable ?></title>
    <!-- <style>
        button.dt-button.btn-primary {
            background: var(--bs-primary) !important;
            color: white;
        }
    </style> -->
</head>

<body>

    <center>
        <h1>Administrar <?php echo $titleTable ?></h1>
        <input type="button" value="Atras" onclick="historyBack()">
        <input type="button" value="Home - Admin" onclick="irHomeAdmin()">

        <br><br>

        <table id="tblData" class="display responsive nowrap table table-bordered" style="width:100%">
            <thead>
                <tr class="bg-dark text-light bg-gradient bg-opacity-150">
                    <th class="px-1 py-1 text-center" width="3%">id</th>
                    <th class="px-1 py-1 text-center">numero</th>
                    <th class="px-1 py-1 text-center" width="2%">moneda</th>
                    <th class="px-1 py-1 text-center">monto</th>
                    <th class="px-1 py-1 text-center">fec_emision</th>
                    <th class="px-1 py-1 text-center">detraccion</th>
                    <th class="px-1 py-1 text-center">fec_detraccion</th>
                    <th class="px-1 py-1 text-center" width="2%">link</th>
                    <th class="px-1 py-1 text-center" width="2%">idConformidad</th>
                    <th class="px-1 py-1 text-center" width="5%">Acciones</th>
                </tr>
            </thead>
            <tfoot>
                <tr class="bg-dark text-light bg-gradient bg-opacity-150">
                    <th class="px-1 py-1 text-center" width="3%">id</th>
                    <th class="px-1 py-1 text-center">numero</th>
                    <th class="px-1 py-1 text-center" width="2%">moneda</th>
                    <th class="px-1 py-1 text-center">monto</th>
                    <th class="px-1 py-1 text-center">fec_emision</th>
                    <th class="px-1 py-1 text-center">detraccion</th>
                    <th class="px-1 py-1 text-center">fec_detraccion</th>
                    <th class="px-1 py-1 text-center" width="2%">link</th>
                    <th class="px-1 py-1 text-center" width="2%">idConformidad</th>
                    <th class="px-1 py-1 text-center" width="5%">Acciones</th>
                </tr>
            </tfoot>
        </table>
    </center>

</body>


<!----------------MODALS---------------->

<!-- CREATE MODAL -->
<div class="modal fade" id="add_modal" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar <?php echo $titleTable ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="" id="new-frm">
                        <!-- CAMPOS -->
                        <input type="hidden" name="idFactura">
                        <div class="mb-2">
                            <label for="numero" class="control-label">numero</label>
                            <input type="text" class="form-control rounded-0" id="numero" name="numero" required>
                        </div>
                        <div class="mb-2">
                            <label for="moneda" class="control-label">moneda</label>
                            <select class="form-control rounded-0" id="moneda" name="moneda">
                                <!-- OPTIONS -->
                                <?php require server_root . 'src/dependencies/moneda.php'; ?>
                                <!-- /OPTIONS -->
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="monto" class="control-label">monto</label>
                            <input type="number" step="any" class="form-control rounded-0" id="monto" name="monto">
                        </div>
                        <div class="mb-2">
                            <label for="fec_emision" class="control-label">fec_emision</label>
                            <input type="date" class="form-control rounded-0" id="fec_emision" name="fec_emision">
                        </div>
                        <div class="mb-2">
                            <label for="detraccion" class="control-label">detraccion</label>
                            <input type="number" step="any" class="form-control rounded-0" id="detraccion" name="detraccion">
                        </div>
                        <div class="mb-2">
                            <label for="fec_detraccion" class="control-label">fec_detraccion</label>
                            <input type="date" class="form-control rounded-0" id="fec_detraccion" name="fec_detraccion">
                        </div>
                        <div class="mb-2">
                            <label for="link" class="control-label">link</label>
                            <input type="text" class="form-control rounded-0" id="link" name="link">
                        </div>
                        <div class="mb-2">
                            <label for="idConformidad" class="control-label">idConformidad</label>
                            <input type="text" class="form-control rounded-0" id="idConformidad" name="idConformidad">
                        </div>
                        <!-- /CAMPOS -->
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
<!-- /CREATE MODAL -->

<!-- UPDATE MODAL -->
<div class="modal fade" id="edit_modal" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Detalles de <?php echo $titleTable ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="" id="edit-frm">
                        <!-- CAMPOS -->
                        <input type="hidden" name="idFactura">
                        <div class="mb-2">
                            <label for="numero" class="control-label">numero</label>
                            <input type="text" class="form-control rounded-0" id="numero" name="numero" required>
                        </div>
                        <div class="mb-2">
                            <label for="moneda" class="control-label">moneda</label>
                            <select class="form-control rounded-0" id="moneda" name="moneda">
                                <!-- OPTIONS -->
                                <?php require server_root . 'src/dependencies/moneda.php'; ?>
                                <!-- /OPTIONS -->
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="monto" class="control-label">monto</label>
                            <input type="number" step="any" class="form-control rounded-0" id="monto" name="monto">
                        </div>
                        <div class="mb-2">
                            <label for="fec_emision" class="control-label">fec_emision</label>
                            <input type="date" class="form-control rounded-0" id="fec_emision" name="fec_emision">
                        </div>
                        <div class="mb-2">
                            <label for="detraccion" class="control-label">detraccion</label>
                            <input type="number" step="any" class="form-control rounded-0" id="detraccion" name="detraccion">
                        </div>
                        <div class="mb-2">
                            <label for="fec_detraccion" class="control-label">fec_detraccion</label>
                            <input type="date" class="form-control rounded-0" id="fec_detraccion" name="fec_detraccion">
                        </div>
                        <div class="mb-2">
                            <label for="link" class="control-label">link</label>
                            <input type="text" class="form-control rounded-0" id="link" name="link">
                        </div>
                        <div class="mb-2">
                            <label for="idConformidad" class="control-label">idConformidad</label>
                            <input type="text" class="form-control rounded-0" id="idConformidad" name="idConformidad">
                        </div>
                        <!-- /CAMPOS -->
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
<!-- /UPDATE MODAL -->

<!-- DELETE MODAL -->
<div class="modal fade" id="delete_modal" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="" id="delete-frm">
                        <input type="hidden" name="idFactura">
                        <p>Estás seguro de eliminar a <b><span name="numero"></span></b>?</p>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" form="delete-frm">Sí</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!-- /DELETE MODAL -->

</html>