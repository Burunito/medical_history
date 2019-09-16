var dataTable = null;

$(document).ready(function () {
  all();
});

function all() {
  dataTable = $('#lote-table').DataTable({
    language: { url: config.dataTable.langUrl() },
    processing: true,
    bFilter: false,
    serverSide: true,
    searchDelay: 1000,
    ajax: {
      url: "/lote/grid",
      data: function (d) {
        d.nombre = $('#filtro-nombre').val();
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