$(document).ready(function () {
    $('#tblData tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input style="width:100%;" type="text" placeholder="Buscar ' + title + '" />');
    });

    var table = $('#tblData').DataTable({
        // rowReorder: {
        //     selector: 'td:nth-child(2)'
        // },
        // responsive: true,
        dom: 'lrtip',
        // BOTONES EXTRA
        // buttons:
        //     [
        //         'excelHtml5',
        //         'csvHtml5',
        //         'pdfHtml5',
        //         'print',
        //     ],
    });

    table.columns().every(function () {
        var that = this;

        $('input', this.footer()).on('keyup change', function () {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });
});