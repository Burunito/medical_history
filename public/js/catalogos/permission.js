var dataTable = null;

$(document).ready(function () {
    all();

    $("input").change(function () {
        dataTable.draw();
    });

    $('#checkAll').change(function(){
        var check = $('#'+this.id+':checked').val() == 'on' ? true : false;
        $('#'+this.id).parent().parent().find('.checkbox').attr('checked', check);
    });

    $('.checkgroup').change(function(){
        var check = $('#'+this.id+':checked').val() == 'on' ? true : false;
        $('#'+this.id).parent().parent().find('.checkbox').attr('checked', check);
    });
});

function all() {
    dataTable = $('#permission-table').DataTable({
        language: { url: config.dataTable.langUrl() },
        processing: true,
        serverSide: true,
        searchDelay: 1000,
        ajax: {
            url: "/permission/grid",
            data: function (d) {
                d.inactive = ($('#showInactive').is(':checked')) ? "1" : "0";
            }
        },
        columns: [
            { data: 'name', title: 'Rol' },
            { data: 'description', title: 'Desripción' },
            { data: 'actions', title: 'Acciones', searchable: false, sortable: false }
        ],
        drawCallback: function (settings) {
            $("[data-toggle='tooltip']").tooltip();
        }
    });
}