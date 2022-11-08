// VARIABLES CONSTANTES
const URL = "../../controllers/s_facturaController.php";
const TYPE = "POST";

let tblData = '';
let mensaje_error_single_data = 'Ocurrió un error al obtener datos únicos';
let mensaje_error = 'Ocurrió un error. Comprueba el código fuente e inténtalo de nuevo';
$(function () {
    // draw function [called if the database updates]
    function draw_data() {
        if ($.fn.dataTable.isDataTable('#tblData') && tblData != '') {
            tblData.draw(true)
        } else {
            load_data();
        }
    }

    // FUNCION PARA CARGAR DATA
    function load_data() {
        tblData = $('#tblData').DataTable({
            responsive: true,
            dom: 'Bflr<"py-2 my-2"t>ip',
            // dom: 'Bflrtip',
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: URL,
                type: TYPE,
                data: {
                    op: '2'
                },
            },
            // COLUMNAS
            columns: [
                {
                    data: 'idFactura',
                    className: 'py-0 px-1'
                },
                {
                    data: 'numero',
                    className: 'py-0 px-1'
                },
                {
                    data: null,
                    orderable: true,
                    className: 'py-0 px-1',
                    render: function (data, type, row, meta) {
                        console.log()
                        let format_moneda = '';
                        if (row.moneda == 'S') {
                            format_moneda += 'S/ ';
                        }
                        else if (row.moneda == 'D') {
                            format_moneda += '$ ';
                        }
                        else {
                            format_moneda += 'ND ';
                        }
                        return format_moneda;
                    }
                },
                {
                    data: 'monto',
                    className: 'py-0 px-1'
                },
                {
                    data: 'fec_emision',
                    className: 'py-0 px-1'
                },
                {
                    data: 'detraccion',
                    className: 'py-0 px-1'
                },
                {
                    data: 'fec_detraccion',
                    className: 'py-0 px-1'
                },
                {
                    data: null,
                    orderable: false,
                    className: 'text-center py-0 px-1',
                    render: function (data, type, row, meta) {
                        console.log()
                        let link_btn = '';
                        if (row.link == '') {
                            link_btn += '<a class="me-2 btn btn-sm py-0 btn-secondary disabled" href="#">No</a>';
                        }
                        else {
                            link_btn += '<a class="me-2 btn btn-sm py-0 btn-secondary" href="' + (row.link) + '" target="_blank">Sí</a>';
                        }
                        return link_btn;
                    }
                },
                {
                    data: 'idConformidad',
                    className: 'py-0 px-1'
                },
                {
                    data: null,
                    orderable: false,
                    className: 'text-center py-0 px-1',
                    render: function (data, type, row, meta) {
                        console.log()
                        let extra_btns = '';
                        extra_btns += '<a class="me-2 btn btn-sm py-0 edit_data btn-primary" href="javascript:void(0)" data-id="' + (row.idFactura) + '">Editar</a>';
                        extra_btns += '<a class="btn btn-sm py-0 delete_data btn-danger" href="javascript:void(0)" data-id="' + (row.idFactura) + '">Eliminar</a>';
                        return extra_btns;
                    }
                }
            ],
            // FUNCIONES
            drawCallback: function (settings) {
                $('.edit_data').click(function () {
                    $.ajax({
                        url: URL,
                        type: TYPE,
                        data: {
                            op: '5',
                            idFactura: $(this).attr('data-id')
                        },
                        dataType: 'json',
                        error: err => {
                            alertify.error('Error, revisar consola');
                            console.log(err);
                        },
                        success: function (resp) {
                            if (!!resp.status) {
                                Object.keys(resp.data).map(k => {
                                    if ($('#edit_modal').find('input[name="' + k + '"]').length > 0) {
                                        $('#edit_modal').find('input[name="' + k + '"]').val(resp.data[k])
                                    }
                                    else if ($('#edit_modal').find('select[name="' + k + '"]').length > 0) {
                                        $('#edit_modal').find('select[name="' + k + '"]').val(resp.data[k])
                                    }
                                })
                                $('#edit_modal').modal('show')
                            } else {
                                alertify.error(mensaje_error_single_data);
                            }
                        }
                    })
                })
                $('.delete_data').click(function () {
                    $.ajax({
                        url: URL,
                        type: TYPE,
                        data: {
                            op: '5',
                            idFactura: $(this).attr('data-id')
                        },
                        dataType: 'json',
                        error: err => {
                            alertify.error('Error, revisar consola');
                            console.log(err);
                        },
                        success: function (resp) {
                            if (!!resp.status) {
                                $('#delete_modal').find('input[name="idFactura"]').val(resp.data['idFactura'])
                                $('#delete_modal').find('span[name="numero"]').text(resp.data['numero'])
                                $('#delete_modal').modal('show')
                            } else {
                                alertify.error(mensaje_error_single_data);
                            }
                        }
                    })
                })
            },
            // BOTONES EXTRA
            buttons:
                [
                    {
                        text: "Agregar Nuevo",
                        className: "buttons-create buttons-html5",
                        action: function (e, dt, node, config) {
                            $('#add_modal').modal('show')
                        }
                    },
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
            // MODO DE ORDENAMIENTO
            "order":
                [
                    [0, "asc"]
                ],
            initComplete: function (settings) {
                $('.paginate_button').addClass('p-1')
            }
        });
    }

    // READ DATA
    load_data()



    // CREATE DATA
    $('#new-frm').submit(function (e) {
        e.preventDefault()
        $('#add_modal button').attr('disabled', true)
        $('#add_modal button[form="new-frm"]').text("Creando ...")
        $.ajax({
            url: URL,
            type: TYPE,
            data: $(this).serialize() + '&op=' + 1,
            dataType: "json",
            // HANDLING ERROR
            error: err => {
                alertify.error('Error, revisar consola');
                console.log(err);
                // RESET
                $('#new-frm').get(0).reset()
                $('.modal').modal('hide')
                draw_data();
                $('#add_modal button').attr('disabled', false)
                $('#add_modal button[form="new-frm"]').text("Crear")
            },
            success: function (resp) {
                if (!!resp.status) {
                    if (resp.status == 'success') {
                        alertify.success('Registro creado correctamente');
                        $('#new-frm').get(0).reset()
                        $('.modal').modal('hide')
                        draw_data();
                    } else if (resp.status == 'success' && !!resp.msg) {
                        alertify.warning(resp.msg);
                    } else {
                        alertify.error(mensaje_error_single_data);
                    }
                } else {
                    alertify.error(mensaje_error_single_data);
                }

                $('#add_modal button').attr('disabled', false)
                $('#add_modal button[form="new-frm"]').text("Crear")
            }
        })
    })
    // UPDATE DATA
    $('#edit-frm').submit(function (e) {
        e.preventDefault()
        $('#edit_modal button').attr('disabled', true)
        $('#edit_modal button[form="edit-frm"]').text("Actualizando ...")
        $.ajax({
            url: URL,
            type: TYPE,
            data: $(this).serialize() + '&op=' + 3,
            method: 'POST',
            dataType: "json",
            // HANDLING ERROR
            error: err => {
                alertify.error('Error, revisar consola');
                console.log(err.responseText);
                // RESET
                $('#edit-frm').get(0).reset()
                $('.modal').modal('hide')
                draw_data();
                $('#edit_modal button').attr('disabled', false)
                $('#edit_modal button[form="edit-frm"]').text("Actualizar")
            },
            success: function (resp) {
                if (!!resp.status) {
                    if (resp.status == 'success') {
                        alertify.success('Registro actualizado correctamente');
                        $('#edit-frm').get(0).reset()
                        $('.modal').modal('hide')
                        draw_data();
                    } else if (resp.status == 'success' && !!resp.msg) {
                        alertify.warning(resp.msg);
                    } else {
                        alertify.error(mensaje_error_single_data);
                    }
                } else {
                    alertify.error(mensaje_error_single_data);
                }

                $('#edit_modal button').attr('disabled', false)
                $('#edit_modal button[form="edit-frm"]').text("Actualizar")
            }
        })
    })
    // DELETE DATA
    $('#delete-frm').submit(function (e) {
        e.preventDefault()
        $('#delete_modal button').attr('disabled', true)
        $('#delete_modal button[form="delete-frm"]').text("Eliminando ...")
        $.ajax({
            url: URL,
            type: TYPE,
            data: $(this).serialize() + '&op=' + 4,
            dataType: "json",
            error: err => {
                alertify.error('Error, revisar consola');
                console.log(err);
            },
            success: function (resp) {
                if (!!resp.status) {
                    if (resp.status == 'success') {
                        alertify.success('Registro eliminado correctamente');
                        $('#delete-frm').get(0).reset()
                        $('.modal').modal('hide')
                        draw_data();
                    } else if (resp.status == 'success' && !!resp.msg) {
                        alertify.warning(resp.msg);
                    } else {
                        alertify.error(mensaje_error_single_data);
                    }
                } else {
                    alertify.error(mensaje_error_single_data);
                }

                $('#delete_modal button').attr('disabled', false)
                $('#delete_modal button[form="delete-frm"]').text("Sí")
            }
        })
    })
});