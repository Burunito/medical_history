var dataTable = null;

$(document).ready(function () {
    all();

    $("input").change(function () {
        dataTable.draw();
    });
});

function all() {
    dataTable = $('#user-table').DataTable({
        language: { url: config.dataTable.langUrl() },
        processing: true,
        serverSide: true,
        searchDelay: 1000,
        ajax: {
            url: "/user/grid",
            data: function (d) {
                d.inactive = ($('#showInactive').is(':checked')) ? "1" : "0";
            }
        },
        columns: [
            { data: 'name', title: 'Nombre' },
            { data: 'email', title: 'Correo' },
            { data: 'rol', title: 'Rol' },
            { data: 'actions', title: 'Acciones', searchable: false, sortable: false }
        ],
        drawCallback: function (settings) {
            $("[data-toggle='tooltip']").tooltip();
        }
    });
}