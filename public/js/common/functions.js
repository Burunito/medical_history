$(document).ready(function(){
    Parsley.setLocale('es');
    moment.locale('es');

    $("[data-toggle='tooltip']").tooltip();

    $('.date-input').daterangepicker({
      locale: config.daterangepicker.locale.es,
      singleDatePicker: true,
      showDropdowns: true,
      minYear: 1901
    });

    $('.date-input').val('');

    $('.clear-filters').click(function(){
      clearFilters();
    });

    $('.dataTable-filters').click(function(){
      dataTableFilter();
    });
    //$(".select-input").select2();

    if($('#form-method').val() == 'show') {
        $('form input, form select, form textarea').prop('disabled', true);
    };
});

// Eliminar registro
function eliminar(recordId, source){
    swal({
        title: '¿Estás seguro?',
        text:  'Si lo eliminas ya no podrás utilizarlo',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Confirmar',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
    }).then(function(result){
        if(result.value){
            removeRegistry(source + '/' + recordId);
        }
    });
}

function removeRegistry(url){
    var request = this;
    $.ajax({
        type: 'DELETE',
        url,
        data: {_token: getToken(), _method: 'DELETE'},
        success: function(response){
            if(response.status == 200){
                deletedRegistry(response.data);
            }else{
                $.notify({ message: response.data.msg },{ type: 'danger' });
            }
        },
        error: function(response){
            $.notify({ message: 'Ha ocurrido un error inesperado' },{ type: 'danger' });
        } 
    });
}

function recuperar(recordId, source){
    swal({
        title: '¿Estás seguro?',
        text:  'Si lo recuperas volverá a estar activo',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Confirmar',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
    }).then(function(result){
        if(result.value){
            restoreRegistry(source + '/' + recordId + '/restore');
        }
    });
}

function restoreRegistry(url){
    var request = this;
    $.ajax({
        type: 'PUT',
        url,
        data: {_token: getToken(), _method: 'PUT'},
        success: function(response){
            if(response.status == 200){
                deletedRegistry(response.data);
            }else{
                $.notify({ message: response.data.msg },{ type: 'danger' });
            }
        },
        error: function(response){
            $.notify({ message: 'Ha ocurrido un error inesperado' },{ type: 'danger' });
        } 
    });
}


function ajaxRequest(url, data, type, callback){
    var request = this;
    data._token = getToken();
    $.ajax({
        type: type ? type : 'GET',
        url,
        data: data,
        success: function(response){
            if(response.status == 200){
                callback(response.data);
            }else{
                $.notify({ message: response.data.msg },{ type: 'danger' });
            }
        },
        error: function(response){
            $.notify({ message: 'Ha ocurrido un error inesperado' },{ type: 'danger' });
        } 
    });
}

function getToken(){
    return $("meta[name=csrf-token]").attr("content");
}

function formatErrors(arrayErrors){
    return _.reduce(arrayErrors, function(e1, e2){
        return e1 + e2 + '<br>';
    }, '');
}

function deletedRegistry(data){
    $.notify({ message: data.msg ? data.msg : 'Eliminado con éxito' },{ type: 'success' });
    $('.datatable').DataTable().draw();
}

function restoreedRegistry($data){
    $.notify({ message: data.msg ? data.msg : 'Recuperado con éxito' },{ type: 'success' });
    $('.datatable').DataTable().draw();
}

function ajaxResponse($data){
    $.notify({ message: data.msg ? data.msg : 'Operación completada con éxito' },{ type: 'success' });
    $('.datatable').DataTable().draw();
}

function clearFilters(){
  $('form input, form select').val('');
  $("input[type='checkbox']").prop("checked", false);
  $('.datatable').DataTable().draw();
}

function dataTableFilter(){
  $('.datatable').DataTable().draw();
}