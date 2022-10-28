const delay = 500;
const url = "../../controllers/clienteController.php";
const type = "POST";

// 5 atributes
// idCliente;
// codigo;
// nombre;
// ruc;
// link;

let var1 = "";
let var2 = "";
let var3 = "";
let var4 = "";
let var5 = "";


$(document).ready(Read);

// READY FUNCTION
$(document).ready(function () {
    $("#btnRead").click(function () {
        Read();
    });


    // MODAL - AÑADIR
    $("#btnCreateModal").click(function () {
        document.getElementById("txt2").value = "";
        document.getElementById("txt3").value = "";
        document.getElementById("txt4").value = "";
        document.getElementById("txt5").value = "";
        //ocultar txt1
        document.getElementById("divtxt1").setAttribute('style', 'display:none')
        //changing value
        document.getElementById("btnCU").setAttribute('value', 'Insertar');
        $('#modalCU').modal('show');
    });


    // EJECUTAR BOTON DEL MODAL
    $("#btnCU").click(function () {
        valbtn = $("#btnCU").val();
        if (valbtn === 'Insertar') {
            Create();
            setTimeout(Read, delay);
        }
        if (valbtn === 'Actualizar') {
            Update();
            setTimeout(Read, delay);
        }
    });
});

// MODAL - ACTUALIZAR
$(document).on('click', '#btnUpdateModal', function () {
    var1 = $(this).attr('var1');
    var2 = $(this).attr('var2');
    var3 = $(this).attr('var3');
    var4 = $(this).attr('var4');
    var5 = $(this).attr('var5');
    //
    document.getElementById("txt1").value = var1;
    document.getElementById("txt2").value = var2;
    document.getElementById("txt3").value = var3;
    document.getElementById("txt4").value = var4;
    document.getElementById("txt5").value = var5;
    //
    //remove style
    document.getElementById("divtxt1").removeAttribute('style');
    //readonly
    document.getElementById("txt1").setAttribute('readonly', '');
    //readonly SELECT
    //changing value
    document.getElementById("btnCU").setAttribute('value', 'Actualizar');
    $('#modalCU').modal('show');
});

// MODAL - ELIMINAR
$(document).on('click', '#btnDeleteModal', function () {
    var1 = $(this).attr('var1');
    document.getElementById("txtdel").value = var1;
    $('#deleteModal').modal('show');
});
$(document).on('click', '#btnDelete', function () {
    Delete();
    setTimeout(Read, delay);
});

// AJAX - LISTAR
function Read() {
    $.ajax({
        type: type,
        url: url,
        data: {
            op: '1'
        },
        success: function (result) {
            $("#tabla").html(result);
        }
    });
}


// AJAX - INSERTAR
function Create() {
    var2 = $("#txt2").val();
    var3 = $("#txt3").val();
    var4 = $("#txt4").val();
    var5 = $("#txt5").val();
    $.ajax({
        type: type,
        url: url,
        data: {
            op: '3',
            var2: var2,
            var3: var3,
            var4: var4,
            var5: var5
        },
        success: function (result) {
            var tmp = result.split(",");
            var nro = tmp[0];
            var msg = tmp[1];
            if (nro === '1') {
                alertify.success(msg);
            } else if (nro === '2') {
                alertify.warning(msg);
            } else {
                alertify.error("Error");
                alertify.warning(msg);
            }
        }
    });
}



// AJAX - ACTUALIZAR
function Update() {
    var1 = $("#txt1").val();
    var2 = $("#txt2").val();
    var3 = $("#txt3").val();
    var4 = $("#txt4").val();
    var5 = $("#txt5").val();

    $.ajax({
        type: type,
        url: url,
        data: {
            op: '4',
            var1: var1,
            var2: var2,
            var3: var3,
            var4: var4,
            var5: var5
        },
        success: function (result) {
            var tmp = result.split(",");
            var nro = tmp[0];
            var msg = tmp[1];
            if (nro === '1') {
                alertify.success(msg);
            } else if (nro === '2') {
                alertify.warning(msg);
            } else {
                alertify.error("Error");
                alertify.warning(msg);
            }
        }
    });
}

// AJAX - ELIMINAR
function Delete() {
    var var1 = $("#txtdel").val();
    $.ajax({
        type: type,
        url: url,
        data: {
            op: '5',
            var1: var1
        },
        success: function (result) {
            var tmp = result.split(",");
            var nro = tmp[0];
            var msg = tmp[1];
            if (nro === '1') {
                alertify.success(msg);
            } else {
                alertify.error("Error");
                alertify.warning(msg);
                alertify.warning(nro);
            }
            $('#deleteModal').modal('hide');
        }
    });
}