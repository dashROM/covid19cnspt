/*=============================================
CARGAR LA TABLA DINÁMICA DE BENEFICIARIO AFIALIADO POR IDEMPLRESA DE LAS BD SIAIS
=============================================*/

var perfilOculto = $("#perfilOculto").val();

var idEmpleador = $("#idEmpleador").val();

$('#tablaAfiliadosEmpleadorSIAIS').DataTable({

	"ajax": "ajax/datatable-afiliadosSIAIS.ajax.php?perfilOculto="+perfilOculto+"&idEmpleador="+idEmpleador,

	"deferRender" : true,

	"retrieve" : true,

	"processing" : true,

	"pageLength" : 25,

	"language" : {

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

	"lengthChange": false

}); 

/*=============================================
BOTÓN SELECCIONAR BENEFICIARIO POR EL CRITERIO DE EMPRESAS
=============================================*/

$("#tablaAfiliadosEmpleadorSIAIS tbody").on("click", "button.btnRegistrarResultadosCovid", function() {
	
	var idAfiliado = $(this).attr("idAfiliado");

	window.location = "index.php?ruta=nuevo-covid-resultado&idAfiliado="+idAfiliado;

});


/*=============================================
BUSQUEDA DE AFILIADO A PARTIR DEL NOMBRE O COD ASEGURADO POR EL BOTON BUSCAR
=============================================*/

$(document).on("click", ".btnBuscarAfiliado", function() {

	var afiliado = $("#buscardorAfiliados").val();

	if (afiliado != "") {

		var datos = new FormData();
		datos.append("afiliado", afiliado);

		//Para mostrar alerta personalizada de loading
		swal.fire({
	        text: 'Procesando...',
	        allowOutsideClick: false,
	        allowEscapeKey: false,
	        allowEnterKey: false,
	        onOpen: () => {
	            swal.showLoading()
	        }
	    });

		$.ajax({

			url: "ajax/datatable-afiliadosSIAIS.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta) {

				//Para cerrar la alerta personalizada de loading
				swal.close();			

				$('#tablaAfiliadosSIAIS').remove();
				$('#tablaAfiliadosSIAIS_wrapper').remove();

				$("#tblAfiliadosSIAIS").append(

				  '<table class="table table-bordered table-striped dt-responsive" id="tablaAfiliadosSIAIS" width="100%">'+
	                
	                '<thead>'+
	                  
	                  '<tr>'+
	                    '<th>COD. ASEGURADO</th>'+
	                    '<th>COD. BENEFICIARIO</th>'+
	                    '<th>APELLIDOS Y NOMBRES</th>'+
	                    '<th>FECHA NACIMIENTO</th>'+
	                    '<th>COD. EMPLEADOR</th>'+
	                    '<th>NOMBRE EMPLEADOR</th>'+
	                    '<th>ACCIONES</th>'+
	                  '</tr>'+

	                '</thead>'+
	                
	              '</table>'  

	            );       			

				var t = $('#tablaAfiliadosSIAIS').DataTable({

					"data": respuesta,

					"columns": [
			            { data: "cod_asegurado" },
			            { data: "cod_beneficiario" },
			            { data: "nombre_completo" },
			            { render: function (data, type, row) {
							var date = new Date(row.fecha_nacimiento);
							date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
							return (moment(date).format("DD/MM/YYYY"));
						}},
			            { data: "cod_empleador" },
			            { data: "nombre_empleador" },
			            { render: function(data, type, row) {
			            	return "<div class='btn-group'><button class='btn btn-info btnAfiliadoRegistrarResultadosCovid' idAfiliado='"+row.idafiliacion+"' data-toggle='tooltip' title='Seleccionar Afiliado'><i class='fas fa-check'></i></button></div>"
			            }}
			        ],

					"deferRender": true,

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

					"lengthChange": false,

					"searching": true,

					"ordering": true, 
	        		
	        		"info": true 

				});

			},
		    error: function(error){

		      console.log("No funciona");
		        
		    }

		});

	} else {

		
		$('#tablaAfiliadosSIAIS').remove();
		$('#tablaAfiliadosSIAIS_wrapper').remove();

	}

});

/*=============================================
BUSQUEDA DE AFILIADO A PARTIR DEL NOMBRE O COD ASEGURADO POR LA TECLA ENTER
=============================================*/

$(document).on("keypress", "#buscardorAfiliados", function(e) {

	if (e.which == 13) {

		var afiliado = $("#buscardorAfiliados").val();

		if (afiliado != "") {

			var datos = new FormData();
			datos.append("afiliado", afiliado);

			//Para mostrar alerta personalizada de loading
			swal.fire({
		        text: 'Procesando...',
		        allowOutsideClick: false,
		        allowEscapeKey: false,
		        allowEnterKey: false,
		        onOpen: () => {
		            swal.showLoading()
		        }
		    });

			$.ajax({

				url: "ajax/datatable-afiliadosSIAIS.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta) {

					//Para cerrar la alerta personalizada de loading
					swal.close();				

					$('#tablaAfiliadosSIAIS').remove();
					$('#tablaAfiliadosSIAIS_wrapper').remove();

					$("#tblAfiliadosSIAIS").append(

					  '<table class="table table-bordered table-striped dt-responsive" id="tablaAfiliadosSIAIS" width="100%">'+
		                
		                '<thead>'+
		                  
		                  '<tr>'+
		                    '<th>COD. ASEGURADO</th>'+
		                    '<th>COD. BENEFICIARIO</th>'+
		                    '<th>APELLIDOS Y NOMBRES</th>'+
		                    '<th>FECHA NACIMIENTO</th>'+
		                    '<th>COD. EMPLEADOR</th>'+
		                    '<th>NOMBRE EMPLEADOR</th>'+
		                    '<th>ACCIONES</th>'+
		                  '</tr>'+

		                '</thead>'+
		                
		              '</table>'  

		            );       			

					var t = $('#tablaAfiliadosSIAIS').DataTable({

						"data": respuesta,

						"columns": [
				            { data: "cod_asegurado" },
				            { data: "cod_beneficiario" },
				            { data: "nombre_completo" },
				            { render: function (data, type, row) {
								var date = new Date(row.fecha_nacimiento);
								date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
								return (moment(date).format("DD/MM/YYYY"));
							}},
				            { data: "cod_empleador" },
				            { data: "nombre_empleador" },
				            { render: function(data, type, row) {
				            	return "<div class='btn-group'><button class='btn btn-info btnAfiliadoRegistrarResultadosCovid' idAfiliado='"+row.idafiliacion+"' data-toggle='tooltip' title='Seleccionar Afiliado'><i class='fas fa-check'></i></button></div>"
				            }}
				        ],

						"deferRender": true,

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

						"lengthChange": false,

						"searching": true,

						"ordering": true, 
		        		
		        		"info": true 

					});

				},
			    error: function(error){

			      console.log("No funciona");
			        
			    }

			});

		} else {

			
			$('#tablaAfiliadosSIAIS').remove();
			$('#tablaAfiliadosSIAIS_wrapper').remove();

		}

	}

});

/*=============================================
BOTÓN SELECCIONAR BENEFICIARIO POR EL CRITERIO DE AFILIADOS
=============================================*/

$(document).on("click", ".btnAfiliadoRegistrarResultadosCovid", function() {

	var idAfiliado = $(this).attr("idAfiliado");

	window.location = "index.php?ruta=nuevo-covid-resultado&idAfiliado="+idAfiliado;

});