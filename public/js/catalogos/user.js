var dataTable = null;

$(document).ready(function () {
  all();
});

function all() {
  dataTable = $('#user-table').DataTable({
    bFilter: false,
    language: { url: config.dataTable.langUrl() },
    processing: true,
    serverSide: true,
    searchDelay: 1000,
    ajax: {
      url: "/user/grid",
      data: function (d) {
        d.nombre = $('#filtro-nombre').val();
        d.correo = $('#filtro-correo').val();
        d.rol = $('#filtro-rol').val();
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