// /*=============================================
// CARGAR LA TABLA DINÁMICA DE COVID RESULTADOS
// =============================================*/

// var perfilOculto = $("#perfilOculto").val();

// var actionCovidResultados = $("#actionCovidResultados").val();

// $('#tablaCovidResultados').DataTable({

// 	"ajax": "ajax/datatable-covid_resultados.ajax.php?perfilOculto="+perfilOculto+"&actionCovidResultados="+actionCovidResultados,

// 	"deferRender": true,

// 	"retrieve" : true,

// 	"processing" : true,

// 	"rowCallback": function(row, data, index) {
// 		if ( data[22] == "0" ) {
//            $('td', row).addClass('bg-lightblue color-palette');
//            $('tr.child', row).addClass('bg-lightblue color-palette');
// 		}
// 	},

// 	"language": {

// 		"sProcessing":     "Procesando...",
// 		"sLengthMenu":     "Mostrar _MENU_ registros",
// 		"sZeroRecords":    "No se encontraron resultados",
// 		"sEmptyTable":     "Ningún dato disponible en esta tabla",
// 		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
// 		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
// 		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
// 		"sInfoPostFix":    "",
// 		"sSearch":         "Buscar:",
// 		"searchPlaceholder": "Escribe aquí para buscar...",
// 		"sUrl":            "",
// 		"sInfoThousands":  ",",
// 		"sLoadingRecords": "Cargando...",
// 		"oPaginate": {
// 		"sFirst":    "Primero",
// 		"sLast":     "Último",
// 		"sNext":     "Siguiente",
// 		"sPrevious": "Anterior"
// 		},
// 		"oAria": {
// 			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
// 			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
// 		}
		
// 	},

// 	"responsive": true,

// 	"lengthChange": false,

// 	"ordering": false

// }); 

/*=============================================
CARGAR LA TABLA DINÁMICA DE COVID RESULTADOS
=============================================*/

var perfilOculto = $("#perfilOculto").val();

var actionCovidResultados = $("#actionCovidResultados").val();

$('#tablaCovidResultados').DataTable({

	"ajax": "ajax/datatable-covid_resultados.ajax.php?perfilOculto="+perfilOculto+"&actionCovidResultados="+actionCovidResultados,

	"processing": true,
    "serverSide": true,

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
SUBIENDO LA FOTO DEL AFILIADO 
=============================================*/
$(".nuevaFotoAfiladoResultado").change(function() {
 	
 	var imagen = this.files[0];

 	/*=============================================
	SUBIENDO LA FOTO DEL AFILIADO
	=============================================*/

	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

		$(".nuevaFotoAfiladoResultado").val("");

		swal.fire({
			
			title: "Error al subir la imagen",
			text: "La imagen debe estar en formato JPG o PNG",
			icon: "error",
			allowOutsideClick: false,
			confirmButtonText: "¡Cerrar!"

		});

	} else if(imagen["size"] > 2000000) {

		$(".nuevaFotoAfiladoResultado").val("");

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
BOTÓN EDITAR COVID RESULTADOS
=============================================*/

$(document).on("click", "button.btnEditarCovidResultado", function() {
	
	var idCovidResultado = $(this).attr("idCovidResultado");

	window.location = "index.php?ruta=editar-covid-resultado&idCovidResultado="+idCovidResultado;


});

/*=============================================
ELIMINAR RESULTADO COVID
=============================================*/

$(document).on("click", "button.btnEliminarCovidResultado", function() {
	
	var idCovidResultado = $(this).attr("idCovidResultado");
	var codAfiliado = $(this).attr("codAfiliado");
	var foto = $(this).attr("foto");

	swal.fire({

		title: "¿Está seguro de borrar el registro?",
		text: "¡Si no lo está puede cancelar la acción!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "¡Si, borrar registro!"

	}).then((result)=> {

		if (result.value) {

			window.location = "index.php?ruta=covid-resultados-lab&eliminar&idCovidResultado="+idCovidResultado+"&foto="+foto+"&codAfiliado="+codAfiliado;

		}

	});
		
});

/*=============================================
PUBLICAR RESULTADO COVID
=============================================*/

$(document).on("click", "button.btnPublicarCovidResultado", function() {
	
	var idCovidResultado = $(this).attr("idCovidResultado");
	var estadoResultado = $(this).attr("estadoResultado");

	if (estadoResultado == 1) {

		swal.fire({

			title: "¿Está seguro de publicar el resultado?",
			text: "¡Si no lo está puede cancelar la acción!",
			icon: "question",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			cancelButtonText: "Cancelar",
			confirmButtonText: "¡Si, publicar resultado!"

		}).then((result)=> {

			if (result.value) {

				window.location = "index.php?ruta=covid-resultados-lab&publicar&idCovidResultado="+idCovidResultado+"&estadoResultado="+estadoResultado;

			}

		});

	} else {

		swal.fire({

			title: "¿Está seguro de quitar la publicación el resultado?",
			text: "¡Si no lo está puede cancelar la acción!",
			icon: "question",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			cancelButtonText: "Cancelar",
			confirmButtonText: "¡Si, quitar publicar resultado!"

		}).then((result)=> {

			if (result.value) {

				window.location = "index.php?ruta=covid-resultados-lab&publicar&idCovidResultado="+idCovidResultado+"&estadoResultado="+estadoResultado;

			}

		});

	}
		
});

/*=============================================
BOTON QUE GENERA LOS RESULTADOS COVID POR FILTRADO DE FECHA
=============================================*/

$(document).on("click", ".btnCovidResultados", function() {

	$('#tablaCovidResultados').remove();
	$('#tablaCovidResultados_wrapper').remove();

	$("#resultadosCovid").append(

	  '<table class="table table-bordered table-striped dt-responsive" id="tablaCovidResultados" width="100%">'+
        
        '<thead>'+
          
          '<tr>'+
            '<th>COD. LAB.</th>'+
            '<th>COD. ASEGURADO</th>'+
            '<th>COD. AFILIADO</th>'+
            '<th>APELLIDOS Y NOMBRES</th>'+
            '<th>CI</th>'+
            '<th>FECHA RECEPCIÓN</th>'+
            '<th>FECHA MUESTRA</th>'+
            '<th>TIPO DE MUESTRA</th>'+
            '<th>MUESTRA CONTROL</th>'+
            '<th>DEPARTAMENTO</th>'+
            '<th>ESTABLECIMIENTO</th>'+
            '<th>SEXO</th>'+
            '<th>FECHA NACIMIENTO</th>'+
            '<th>TELÉFONO</th>'+
            '<th>EMAIL</th>'+
            '<th>LOCALIDAD</th>'+
            '<th>ZONA</th>'+
            '<th>DIRECCION</th>'+
            '<th>RESULTADO</th>'+
            '<th>FECHA RESULTADO</th>'+
            '<th>OBSERVACIONES</th>'+
            '<th>ACCIONES</th>'+
          '</tr>'+

        '</thead>'+
        
      '</table>'  

    );       			

	var fecha = $("#fechaCovidResultados").val();

	/*=============================================
	CARGAR LA TABLA DINÁMICA DE COVID RESULTADOS
	=============================================*/

	var perfilOculto = $(this).attr("perfilOculto");

	var actionCovidResultados = $(this).attr("actionCovidResultados");

	$('#tablaCovidResultados').DataTable({

		"ajax": "ajax/datatable-covid_resultados.ajax.php?perfilOculto="+perfilOculto+"&actionCovidResultados="+actionCovidResultados+"&fecha="+fecha,

		"deferRender": true,

		"retrieve" : true,

		"processing" : true,

		"rowCallback": function(row, data, index) {
	       if ( data[22] == "0" )
	       {
	           $('td', row).addClass('bg-lightblue color-palette');
	           $('tr.child', row).addClass('bg-lightblue color-palette');
	       }
		},

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


});

/*=============================================
SI NUEVO TIPO DE MUESTRA ES ELISA SE HABILITAN NUEVOS CAMPOS
=============================================*/

$(document).on("blur", "#nuevoTipoMuestra", function() {
	
	var tipoMuestra = $(this).val();
	
	if (tipoMuestra == "ELISA") {

		$(".observacion").replaceWith(
			'<div class="form-group col-md-6 observacion">'+
				'<div class="form-group col-md-2">'+
	                '<label for="lgM">lgM</label>'+
	                '<input type="text" class="form-control" id="lgM" name="lgM" pattern="[0-9 ,]+" title="Solo se admiten números y ," required>'+
	            '</div>'+
	            '<div class="form-group col-md-2">'+
	                '<label for="lgG">lgG</label>'+
	                '<input type="text" class="form-control" id="lgG" name="lgG" pattern="[0-9 ,]+" title="Solo se admiten números y ," required>'+
	            '</div>'+
            '</div>');

	} else {

		$(".observacion").replaceWith(
			'<div class="form-group col-md-6 observacion">'+
	            '<label for="nuevaObservacion">Observaciones</label>'+
	            '<textarea class="form-control mayuscula" id="nuevaObservacion" name="nuevaObservacion" placeholder="Ingresar observaciones (Opcional)" rows="3" pattern="[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ .-(),/#]+" title="Caracteres no admitidos"></textarea>'+
	        '</div>');
	}

});

$(document).on("blur", "#editarTipoMuestra", function() {
	
	var tipoMuestra = $(this).val();
	
	if (tipoMuestra == "ELISA") {

		$(".observacion").replaceWith(
			'<div class="form-group col-md-6 observacion">'+
				'<div class="form-group col-md-2">'+
	                '<label for="lgM">lgM</label>'+
	                '<input type="text" class="form-control" id="lgM" name="lgM" pattern="[0-9 ,]+" title="Solo se admiten números y ," required>'+
	            '</div>'+
	            '<div class="form-group col-md-2">'+
	                '<label for="lgG">lgG</label>'+
	                '<input type="text" class="form-control" id="lgG" name="lgG" pattern="[0-9 ,]+" title="Solo se admiten números y ," required>'+
	            '</div>'+
            '</div>');

	} else {

		$(".observacion").replaceWith(
			'<div class="form-group col-md-6 observacion">'+
	            '<label for="editarObservacion">Observaciones</label>'+
	            '<textarea class="form-control mayuscula" id="editarObservacion" name="editarObservacion" placeholder="Ingresar observaciones (Opcional)" rows="3" pattern="[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ .-(),/#]+" title="Caracteres no admitidos"></textarea>'+
	        '</div>');
	}

});