var config = {
  domain: 'http://localhost.plantilla_laravel',
  dataTable: {
      langUrl: function(){
          var currentLocale = "Spanish";
          return "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/"+currentLocale+".json";
      },
      langES: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
  },
  daterangepicker: {
    locale: {
    	es: {
	      "format": "DD/MM/YYYY",
	      "separator": "/",
	      "applyLabel": "Aplicar",
	      "cancelLabel": "Cancelar",
	      "fromLabel": "Desde",
	      "toLabel": "Hasta",
	      "customRangeLabel": "Personalizado",
	      "weekLabel": "S",
	      "daysOfWeek": [
	          "Dom",
	          "Lun",
	          "Mar",
	          "Mie",
	          "Jue",
	          "Vie",
	          "Sab"
	      ],
	      "monthNames": [
	          "Enero",
	          "Febrero",
	          "Marzo",
	          "Abril",
	          "Mayo",
	          "Junio",
	          "Julio",
	          "Agosto",
	          "Septiembre",
	          "Octobre",
	          "Noviembre",
	          "Diciembre"
	      ],
	      "firstDay": 1
    	}
    }
  }
};