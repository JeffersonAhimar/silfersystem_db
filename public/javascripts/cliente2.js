var tblData = '';
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
            dom: '<"row"B>flr<"py-2 my-2"t>ip',
            // dom: 'Bflrtip',
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "../../models/dao/clienteDao2.php",
                method: 'POST'
            },
            // COLUMNAS
            columns: [
                {
                    data: 'idCliente',
                    className: 'py-0 px-1'
                },
                {
                    data: 'codigo',
                    className: 'py-0 px-1'
                },
                {
                    data: 'nombre',
                    className: 'py-0 px-1'
                },
                {
                    data: 'ruc',
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
                            link_btn += '<a class="me-2 btn btn-sm rounded-0 py-0 btn-secondary disabled" href="#" target="_blank">No</a>';
                        }
                        else {
                            link_btn += '<a class="me-2 btn btn-sm rounded-0 py-0 btn-secondary" href="' + (row.link) + '" target="_blank">Sí</a>';
                        }
                        return link_btn;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    className: 'text-center py-0 px-1',
                    render: function (data, type, row, meta) {
                        console.log()
                        let extra_btns = '';
                        extra_btns += '<a class="me-2 btn btn-sm rounded-0 py-0 edit_data btn-primary" href="javascript:void(0)" data-id="' + (row.idCliente) + '">Editar</a>';
                        extra_btns += '<a class="btn btn-sm rounded-0 py-0 delete_data btn-danger" href="javascript:void(0)" data-id="' + (row.idCliente) + '">Eliminar</a>';
                        return extra_btns;
                    }
                }
            ],
            // FUNCIONES
            drawCallback: function (settings) {
                $('.edit_data').click(function () {
                    $.ajax({
                        url: '../../models/dao/get_single.php',
                        data: { idCliente: $(this).attr('data-id') },
                        method: 'POST',
                        dataType: 'json',
                        error: err => {
                            alert("Ocurrió un error al obtener datos únicos")
                        },
                        success: function (resp) {
                            if (!!resp.status) {
                                Object.keys(resp.data).map(k => {
                                    if ($('#edit_modal').find('input[name="' + k + '"]').length > 0)
                                        $('#edit_modal').find('input[name="' + k + '"]').val(resp.data[k])
                                })
                                $('#edit_modal').modal('show')
                            } else {
                                alert("Ocurrió un error al obtener datos únicos")
                            }
                        }
                    })
                })
                $('.delete_data').click(function () {
                    $.ajax({
                        url: '../../models/dao/get_single.php',
                        data: { id: $(this).attr('data-id') },
                        method: 'POST',
                        dataType: 'json',
                        error: err => {
                            alert("Ocurrió un error al obtener datos únicos")
                        },
                        success: function (resp) {
                            if (!!resp.status) {
                                $('#delete_modal').find('input[name="id"]').val(resp.data['id'])
                                $('#delete_modal').modal('show')
                            } else {
                                alert("Ocurrió un error al obtener datos únicos")
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
                        className: "btn btn-primary py-0",
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
    $('#new-author-frm').submit(function (e) {
        e.preventDefault()
        $('#add_modal button').attr('disabled', true)
        $('#add_modal button[form="new-author-frm"]').text("saving ...")
        $.ajax({
            url: 'save_data.php',
            data: $(this).serialize(),
            method: 'POST',
            dataType: "json",
            error: err => {
                alert("Ocurrió un error. Comprueba el código fuente e inténtalo de nuevo.")
            },
            success: function (resp) {
                if (!!resp.status) {
                    if (resp.status == 'success') {
                        var _el = $('<div>')
                        _el.hide()
                        _el.addClass('alert alert-primary alert_msg')
                        _el.text("Datos guardados con éxito");
                        $('#new-author-frm').get(0).reset()
                        $('.modal').modal('hide')
                        $('#msg').append(_el)
                        _el.show('slow')
                        draw_data();
                        setTimeout(() => {
                            _el.hide('slow')
                                .remove()
                        }, 2500)
                    } else if (resp.status == 'success' && !!resp.msg) {
                        var _el = $('<div>')
                        _el.hide()
                        _el.addClass('alert alert-danger alert_msg form-group')
                        _el.text(resp.msg);
                        $('#new-author-frm').append(_el)
                        _el.show('slow')
                    } else {
                        alert("Ocurrió un error. Comprueba el código fuente e inténtalo de nuevo.")
                    }
                } else {
                    alert("Ocurrió un error. Comprueba el código fuente e inténtalo de nuevo.")
                }

                $('#add_modal button').attr('disabled', false)
                $('#add_modal button[form="new-author-frm"]').text("Save")
            }
        })
    })
    // UPDATE DATA
    $('#edit-author-frm').submit(function (e) {
        e.preventDefault()
        $('#edit_modal button').attr('disabled', true)
        $('#edit_modal button[form="edit-author-frm"]').text("saving ...")
        $.ajax({
            url: 'update_data.php',
            data: $(this).serialize(),
            method: 'POST',
            dataType: "json",
            error: err => {
                alert("Ocurrió un error. Comprueba el código fuente e inténtalo de nuevo.")
            },
            success: function (resp) {
                if (!!resp.status) {
                    if (resp.status == 'success') {
                        var _el = $('<div>')
                        _el.hide()
                        _el.addClass('alert alert-primary alert_msg')
                        _el.text("Data successfulle updated");
                        $('#edit-author-frm').get(0).reset()
                        $('.modal').modal('hide')
                        $('#msg').append(_el)
                        _el.show('slow')
                        draw_data();
                        setTimeout(() => {
                            _el.hide('slow')
                                .remove()
                        }, 2500)
                    } else if (resp.status == 'success' && !!resp.msg) {
                        var _el = $('<div>')
                        _el.hide()
                        _el.addClass('alert alert-danger alert_msg form-group')
                        _el.text(resp.msg);
                        $('#edit-author-frm').append(_el)
                        _el.show('slow')
                    } else {
                        alert("Ocurrió un error. Comprueba el código fuente e inténtalo de nuevo.")
                    }
                } else {
                    alert("Ocurrió un error. Comprueba el código fuente e inténtalo de nuevo.")
                }

                $('#edit_modal button').attr('disabled', false)
                $('#edit_modal button[form="edit-author-frm"]').text("Save")
            }
        })
    })
    // DELETE DATA
    $('#delete-author-frm').submit(function (e) {
        e.preventDefault()
        $('#delete_modal button').attr('disabled', true)
        $('#delete_modal button[form="delete-author-frm"]').text("deleting data ...")
        $.ajax({
            url: 'delete_data.php',
            data: $(this).serialize(),
            method: 'POST',
            dataType: "json",
            error: err => {
                alert("Ocurrió un error. Comprueba el código fuente e inténtalo de nuevo.")
            },
            success: function (resp) {
                if (!!resp.status) {
                    if (resp.status == 'success') {
                        var _el = $('<div>')
                        _el.hide()
                        _el.addClass('alert alert-primary alert_msg')
                        _el.text("Datos actualizados con éxito");
                        $('#delete-author-frm').get(0).reset()
                        $('.modal').modal('hide')
                        $('#msg').append(_el)
                        _el.show('slow')
                        draw_data();
                        setTimeout(() => {
                            _el.hide('slow')
                                .remove()
                        }, 2500)
                    } else if (resp.status == 'success' && !!resp.msg) {
                        var _el = $('<div>')
                        _el.hide()
                        _el.addClass('alert alert-danger alert_msg form-group')
                        _el.text(resp.msg);
                        $('#delete-author-frm').append(_el)
                        _el.show('slow')
                    } else {
                        alert("Ocurrió un error. Comprueba el código fuente e inténtalo de nuevo.")
                    }
                } else {
                    alert("Ocurrió un error. Comprueba el código fuente e inténtalo de nuevo.")
                }

                $('#delete_modal button').attr('disabled', false)
                $('#delete_modal button[form="delete-author-frm"]').text("YEs")
            }
        })
    })
});