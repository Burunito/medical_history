var dataTable = null;

$(document).ready(function () {
  all();
});

function all() {
  dataTable = $('#serie-table').DataTable({
    language: { url: config.dataTable.langUrl() },
    processing: true,
    bFilter: false,
    serverSide: true,
    searchDelay: 1000,
    ajax: {
      url: "/serie/grid",
      data: function (d) {
        d.fecha = $('#filtro-fecha').val();
        d.serie = $('#filtro-serie').val();
        d.lote = $('#filtro-lote').val();
        d.fecha_caducidad = $('#filtro-fecha_caducidad').val();
        //d.usuario = $('#filtro-usuario').val();
      }
    },
    columns: [
      { data: 'fecha', title: 'Fecha de captura' },
      { data: 'serie', title: 'Serie' },
      { data: 'lote', title: 'Lote' },
      { data: 'fecha_caducidad_format', title: 'Fecha de caducidad' },
      { data: 'usuario', title: 'Usuario' },
      { data: 'activo', title: 'Activo' },
      { data: 'actions', title: 'Acciones', searchable: false, sortable: false }
    ],
    drawCallback: function (settings) {
      $("[data-toggle='tooltip']").tooltip();
    }
  });
}