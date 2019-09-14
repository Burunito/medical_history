$(document).ready(function(){
    Parsley.setLocale('es');
    moment.locale('es');

    $("[data-toggle='tooltip']").tooltip();

    $('.date-input').datetimepicker({
        format: 'DD/MM/YYYY', 
        locale: moment.locale(),
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        }
    });

    $(".select-input").select2();
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
            recoverRegistry(source + '/' + recordId);
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

function recoveredRegistry($data){
    $.notify({ message: data.msg ? data.msg : 'Recuperado con éxito' },{ type: 'success' });
    $('.datatable').DataTable().draw();
}

function ajaxResponse($data){
    $.notify({ message: data.msg ? data.msg : 'Operación completada con éxito' },{ type: 'success' });
    $('.datatable').DataTable().draw();
}