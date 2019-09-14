var dataTable = null;

$(document).ready(function () {
    all();

    $("input").change(function () {
        dataTable.draw();
    });
});

function all() {
    dataTable = $('#lote-table').DataTable({
        language: { url: config.dataTable.langUrl() },
        processing: true,
        serverSide: true,
        searchDelay: 1000,
        ajax: {
            url: "/lote/grid",
            data: function (d) {
                d.inactive = ($('#showInactive').is(':checked')) ? "1" : "0";
            }
        },
        columns: [
            { data: 'nombre', title: 'Nombre' },
            { data: 'actions', title: 'Acciones', searchable: false, sortable: false }
        ],
        drawCallback: function (settings) {
            $("[data-toggle='tooltip']").tooltip();
        }
    });
}