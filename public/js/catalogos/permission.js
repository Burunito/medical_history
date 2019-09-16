var dataTable = null;

$(document).ready(function () {
  all();

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
    bFilter: false,
    serverSide: true,
    searchDelay: 1000,
    ajax: {
      url: "/permission/grid",
      data: function (d) {
        d.rol = $('#filtro-rol').val();
        d.descripcion = $('#filtro-descripcion').val();
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