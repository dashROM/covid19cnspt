/*=============================================
CARGAR LA TABLA DINÁMICA DE FORMULARIOS DE BAJA
=============================================*/

var perfilOculto = $("#perfilOculto").val();

$('#tablaFormularioBajas').DataTable({

	"ajax": "ajax/datatable-formulario_bajas.ajax.php?perfilOculto="+perfilOculto,

	"deferRender": true,

	"retrieve" : true,

	"processing" : true,

	"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"searchPlaceholder": "Escribe aquí para buscar...",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}
		
	},

	"responsive": true,

	"lengthChange": false,

	"ordering": false

}); 

/*=============================================
CARGAR DATOS DE ASEGURADO AL MODAL AL FORMULARIO DE BAJA COVID RESULTADOS 
=============================================*/

$(document).on("click", ".btnMostrarFormBaja", function() {
	
	var idCovidResultado = $(this).attr("idCovidResultado");

	var datos = new FormData();
	datos.append("mostrarFormBaja", 'mostrarFormBaja');
	datos.append("idCovidResultado", idCovidResultado);

	$.ajax({
		url: "ajax/formulario_bajas.ajax.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {

			$("#idCovidResultadoFormBaja").val(respuesta["id"]);
			$("#paternoFormBaja").html(respuesta["paterno"]);
			$("#maternoFormBaja").html(respuesta["materno"]);
			$("#nombreFormBaja").html(respuesta["nombre"]);
			$("#codAseguradoFormBaja").html(respuesta["cod_asegurado"]);
			$("#nombreEmpleadorFormBaja").html(respuesta["nombre_empleador"]);
			$("#codEmpleadorFormBaja").html(respuesta["cod_empleador"]);

		},
	    error: function(error){

	      console.log("error", error);
	        
	    }

	});

});

/*=============================================
BORRAR DATOS AL PRESIONAR EL BOTON CERRAR DEL FORMULARIO DE BAJA
=============================================*/

$(document).on("click", ".btnCerrarFormBaja", function() {

	$("#fechaIniFormBaja").val("");
	$("#fechaFinFormBaja").val("");
	$("#diasIncapacidadFormBaja").val("0 DÌAS");
	$("#lugarFormBaja").val("");
	$("#fechaFormBaja").val("");
	$("#claveFormBaja").val("");

});

/*=============================================
AGREGAR DATOS AL FORMULARIO DE BAJA
=============================================*/

$(document).on("click", ".btnAgregarFormBaja", function() {

	var idCovidResultado = $("#idCovidResultadoFormBaja").val();
	var riesgo = $("input:radio[name=riesgoFormBaja]:checked").val(); 
	var fechaIni = $("#fechaIniFormBaja").val();
	var fechaFin = $("#fechaFinFormBaja").val();
	var diasIncapacidad = $("#diasIncapacidadFormBaja").val();
	var lugar = $("#lugarFormBaja").val();
	var fecha = $("#fechaFormBaja").val();
	var clave = $("#claveFormBaja").val();

	var datos = new FormData();
	datos.append("agregarFormBaja", 'agregarFormBaja');
	datos.append("idCovidResultado", idCovidResultado);
	datos.append("riesgo", riesgo);
	datos.append("fechaIni", fechaIni);
	datos.append("fechaFin", fechaFin);
	datos.append("diasIncapacidad", diasIncapacidad);
	datos.append("lugar", lugar);
	datos.append("fecha", fecha);
	datos.append("clave", clave);

	$.ajax({
		url: "ajax/formulario_bajas.ajax.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "html",
		success: function(respuesta) {

			if (respuesta == "ok") {

				swal.fire({
					
					icon: "success",
					title: "¡El Certificado de Incapacidad ha sido guardado correctamente!",
					showConfirmButton: true,
					allowOutsideClick: false,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false

				}).then((result) => {
  					
  					if (result.value) {

						window.location = "formulario-bajas";

					}

				});

			} else {

				swal.fire({
						
					icon: "error",
					title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
					showConfirmButton: true,
					allowOutsideClick: false,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false

				});
				
			}

		},
	    error: function(error){

	      console.log("error", error);
	        
	    }

	});

});


/*=============================================
OBTENER LOS DIAS DE INCAPACIDAD
=============================================*/

$("#fechaFinFormBaja").change(function() {

	var fecha1 = $("#fechaIniFormBaja").val();
	var fecha2 = $(this).val();

	$("#diasIncapacidadFormBaja").val(restaFechas(fecha1,fecha2)+" Días");

});

$("#fechaIniFormBaja").change(function() {

	var fecha1 = $(this).val();
	var fecha2 = $("#fechaFinFormBaja").val();

	$("#diasIncapacidadFormBaja").val(restaFechas(fecha1,fecha2)+" DÍAS");

});


// Función para calcular los días transcurridos entre dos fechas
restaFechas = function(f1, f2) {

 var aFecha1 = f1.split('-');
 var aFecha2 = f2.split('-');
 var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]);
 var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
 var dif = fFecha2 - fFecha1;
 var dias = Math.floor(dif / (1000 * 60 * 60 * 24));

 return dias;

}

/*=============================================
BOTÓN EDITAR FORMULARIO BAJA
=============================================*/

$("#tablaFormularioBajas tbody").on("click", "button.btnEditarFormularioBaja", function() {
	
	var idFormularioBaja = $(this).attr("idFormularioBaja");
	console.log("idFormularioBaja", idFormularioBaja);

	window.location = "index.php?ruta=editar-formulario-bajas&idFormularioBaja="+idFormularioBaja;

});

/*=============================================
SUBIENDO LA IMAGEN DEL FORMULARIO 
=============================================*/
$(".imagenFormBaja").change(function() {
 	
 	var imagen = this.files[0];

 	/*=============================================
	SUBIENDO LA FOTO DEL AFILIADO
	=============================================*/

	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

		$(".imagenFormBaja").val("");

		swal.fire({
			
			title: "Error al subir la imagen",
			text: "La imagen debe estar en formato JPG o PNG",
			icon: "error",
			allowOutsideClick: false,
			confirmButtonText: "¡Cerrar!"

		});

	} else if(imagen["size"] > 2000000) {

		$(".imagenFormBaja").val("");

		swal.fire({

			title: "Error al subir la imagen",
			text: "La imagen no debe pesar mas de 2MB",
			icon: "error",
			allowOutsideClick: false,
			confirmButtonText: "¡Cerrar!"

		});

	} else {

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function(event){

			var rutaImagen = event.target.result;
			$(".previsualizar").attr("src", rutaImagen);

		});

	}

});

/*=============================================
IMPRIMIR FORMULARIO BAJA
=============================================*/

$("#tablaFormularioBajas").on("click", ".btnImprimirFormularioBaja", function() {

	var idFormularioBaja = $(this).attr("idFormularioBaja");

	var nombre_usuario = $("#nombreUsuarioOculto").val();
	
	var datos = new FormData();

	datos.append("imprimirFormBaja", "imprimirFormBaja");
	datos.append("idFormularioBaja", idFormularioBaja);
	datos.append("nombre_usuario", nombre_usuario);

	$.ajax({

		url: "ajax/formulario_bajas.ajax.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta) {

			$('#ver-pdf').modal({

				show:true,
				backdrop:'static'

			});	

			PDFObject.embed("temp/formularioIncapacidad-"+idFormularioBaja+".pdf", "#view_pdf");

		}

	});

});

/*=============================================
ELIMINAR FORMULARIO BAJA
=============================================*/

$(document).on("click", "button.btnEliminarFormularioBaja", function() {
	
	var idFormularioBaja = $(this).attr("idFormularioBaja");
	// var codAfiliado = $(this).attr("codAfiliado");
	var imagen = $(this).attr("imagen");

	swal.fire({

		title: "¿Está seguro de borrar el formulario?",
		text: "¡Si no lo está puede cancelar la acción!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "¡Si, borrar formulario!"

	}).then((result)=> {

		if (result.value) {

			window.location = "index.php?ruta=formulario-bajas&idFormularioBaja="+idFormularioBaja+"&imagen="+imagen;

		}

	});
		
});