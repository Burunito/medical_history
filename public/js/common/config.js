var config = {
    domain: 'http://localhost.plantilla_laravel',
    dataTable: {
        langUrl: function(){
            var currentLocale = "Spanish";
            return "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/"+currentLocale+".json";
        },
        langES: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    }
};