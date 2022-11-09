// Uso del localStorage para asignar la clase activa al modulo en que se encuentra
if (localStorage.getItem("actual") != null) {

	if (localStorage.getItem("principal") == ".menu#undefined") {
		
		$(localStorage.getItem("inicial")).removeClass("active");
		$(localStorage.getItem("actual")).addClass("active");		

	} else {

		$(localStorage.getItem("inicial")).removeClass("active");
		$(localStorage.getItem("actual")).addClass("active");
		$(localStorage.getItem("principal")).addClass("active");
		$(localStorage.getItem("principal")).parent().addClass("menu-open");

	}	

}

/*===================================================================================
INDICADOR DE POSICION EN EL MENU
===================================================================================*/

$(document).ready(function() {

	/*=============================================
	//input Mask
	=============================================*/

	$(":input").inputmask();


	/*=============================================
	//Ubicador del menu de usuario
	=============================================*/

	// elementos de la lista
	var menu = $(".menu"); 

	// manejador de click sobre todos los elementos
	menu.click(function() {

		// eliminamos active de todos los elementos
		menu.removeClass("active");

		// activamos el elemento clicado.
		$(this).addClass("active");

		$(this).parent().parent().siblings().addClass("active");

		var inicial = menu.attr('id');
		var actual = $(this).attr('id');
		var principal = $(this).parent().parent().siblings().attr('id');

		localStorage.setItem("inicial", ".menu#"+inicial);
		localStorage.setItem("actual", ".menu#"+actual);    
		localStorage.setItem("principal", ".menu#"+principal);

		});

});

/*===========================================================
TODOS LOS CAMPOS INPUT NECESARIO PARA MOSTRAR EN MAYUSCULAS
=============================================================*/

$(document).ready("onkeyup", ".mayuscula", function() {


	console.log("mayuscula", 'se presiono un boton');

	// $(this).toUpperCase();

});

/*======================================
INICIALIZANDO LOS FORMULARIOS SELECT2
========================================*/

$(function () {

	var placeholder = "<i class='fas fa-search'></i> Elegir...";
   
  //Initialize Select2 Elements
  $('.select2').select2({
  	language: {

	    noResults: function() {

	      return "No hay resultado";  

	    },
	    searching: function() {

	      return "Buscando..";
	      
	    }
		},

		placeholder: placeholder,
    width: null,
    escapeMarkup: function(m) { 
    	return m; 
    }
	});

	//Initialize Select2 Dinámico Elements
  $('.select2_dinamic').select2({
		tags: true,
		language: "es"
	});

  //Initialize Select2 Elements
  $('.select2bs4').select2({
		theme: 'bootstrap4',
		language: "es"
  });

});

/*======================================
CONVIRTIENDO EN MAYUSCULA LO INGRESADO DINAMICAMENTE
========================================*/
$(document).on("click", ".select2", function() {

	$('.select2-search__field').addClass('mayuscula');

});