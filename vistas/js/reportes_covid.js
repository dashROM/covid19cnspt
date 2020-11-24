/*=============================================
BOTON QUE GENERA LOS RESULTADOS COVID POR FILTRADO DE FECHAS Y RESULTADO
=============================================*/

$(document).on("click", ".btnCovidResultadosReporte", function() {

	$('#tablaCovidResultadosReporte').remove();
	$('#tablaCovidResultadosReporte_wrapper').remove();

	var fechaInicio = $("#reporteFechaInicio").val();
	var fechaFin = $("#reporteFechaFin").val();
	var resultado = $('input:radio[name=reporteResultado]:checked').val();

	var datos = new FormData();
	datos.append("reporte", 'reporte');
	datos.append("fechaInicio", fechaInicio);
	datos.append("fechaFin", fechaFin);
	datos.append("resultado", resultado);

	$.ajax({

		url: "ajax/reportes_covid.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {

			$("#reporteCovid").append(

			  '<table class="table table-bordered table-striped dt-responsive table-hover" id="tablaCovidResultadosReporte" width="100%">'+
                
                '<thead>'+
                  
                  '<tr>'+
                    '<th>COD. LAB.</th>'+
                    '<th>COD. ASEGURADO</th>'+
                    '<th>APELLIDOS Y NOMBRES</th>'+
                    '<th>CI</th>'+
                    '<th>NOMBRE EMPLEADOR</th>'+
                    '<th>FECHA MUESTRA</th>'+
                    '<th>FECHA RECEPCIÓN</th>'+
                    '<th>MUESTRA CONTROL</th>'+
                    '<th>DEPARTAMENTO</th>'+
                    '<th>ESTABLECIMIENTO</th>'+
                    '<th>SEXO</th>'+
                    '<th>EDAD</th>'+
                    '<th>TEL/CEL</th>'+
                    '<th>FECHA RESULTADO</th>'+
                    '<th>RESULTADO</th>'+
                    '<th>OBSERVACIONES</th>'+
                    '<th>ACCIONES</th>'+
                  '</tr>'+

                '</thead>'+
                
              '</table>'  

            ); 			

			var t = $('#tablaCovidResultadosReporte').DataTable({

				"data": respuesta,

				"columns": [
					{ data: "cod_laboratorio" },
		            { data: "cod_asegurado" },
		            { data: "nombre_completo" },
		            { data: "documento_ci" },
		            { data: "nombre_empleador" },
		            { render: function (data, type, row) {
							var date = new Date(row.fecha_muestra);
							date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
							return (moment(date).format("DD/MM/YYYY"));
					}},
					{ render: function (data, type, row) {
							var date = new Date(row.fecha_recepcion);
							date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
							return (moment(date).format("DD/MM/YYYY"));
					}},
		            { data: "muestra_control" },
		            { data: "nombre_depto" },
		            { data: "abreviatura_establecimiento" },
		            { data: "sexo" },
		            { data: "edad" },
		            { data: "telefono" },
		            { render: function (data, type, row) {
							var date = new Date(row.fecha_resultado);
							date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
							return (moment(date).format("DD/MM/YYYY"));
					}},
		            { data: "resultado" },
		            { data: "observaciones" },
		            { render: function(data, type, row) {
			            	return "<div class='btn-group'><button class='btn btn-danger btnReportePersonalPDF' idCovidResultado='"+row.id+"' data-toggle='tooltip' title='Generar PDF'><i class='fas fa-file-pdf'></i></button></div>"
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

				"ordering": false, 
        		
        		"info":     true,

        		//para usar los botones   
		        "responsive": true,

		        "dom": 'Bfrtilp',       
		        
		        "buttons":[ 
					{
						extend:    'excelHtml5',
						title: 	   'Reporte '+fechaInicio+' '+fechaFin+' '+resultado,
						text:      '<i class="fas fa-file-excel"></i> Generar EXCEL',
						titleAttr: 'Exportar a Excel',
						className: 'btn btn-success'
					},
					// {
					// 	extend:    'pdfHtml5',
					// 	text:      '<i class="fas fa-file-pdf"></i> ',
					// 	titleAttr: 'Exportar a PDF',
					// 	className: 'btn btn-danger'
					// },
					// {
					// 	extend:    'print',
					// 	text:      '<i class="fa fa-print"></i> Imprimir',
					// 	titleAttr: 'Imprimir',
					// 	className: 'btn btn-info'
					// },
				]	        

			});

		},
	    error: function(error){

	      console.log("No funciona");
	        
	    }

	});

});


/*=============================================
BOTON QUE GENERA EL PDF DE LOS RESULTADOS COVID POR FILTRADO DE FECHAS Y RESULTADO
=============================================*/

$(document).on("click", ".btnCovidResultadosPDF", function() {

	var fechaInicio = $("#reporteFechaInicio").val();
	console.log("fechaInicio", fechaInicio);
	var fechaFin = $("#reporteFechaFin").val();
	console.log("fechaFin", fechaFin);
	var resultado = $('input:radio[name=reporteResultado]:checked').val();

	var nombre_usuario = $("#nombreUsuarioOculto").val();

	var datos = new FormData();

	datos.append("reportePDF", "reportePDF");
	datos.append("fechaInicio", fechaInicio);
	datos.append("fechaFin", fechaFin);
	datos.append("resultado", resultado);
	datos.append("nombre_usuario", nombre_usuario);

	$('.cargando').removeClass('hide');

	$.ajax({

		url: "ajax/reportes_covid.ajax.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta) {

			$('.cargando').addClass('hide');

			$('#ver-pdf').modal({

				show:true,
				backdrop:'static'

			});	

			PDFObject.embed("temp/reporte-"+fechaInicio+"-"+fechaFin+"-"+resultado+".pdf", "#view_pdf");

		}

	});

});


/*=============================================
BOTON QUE PARA CERRAR LA VENTANA MODAL DEL REPORTE PDF Y ELIMINA EL ARCHIVO TEMPORAL
=============================================*/

$("#ver-pdf").on("click", ".btnCerrarReporte", function() {

	var url = $(this).parent().parent().children(".modal-body").children().children().attr("src");

	var datos = new FormData();

	datos.append("eliminarPDF", "eliminarPDF");
	datos.append("url", url);

	$.ajax({

		url: "ajax/reportes_covid.ajax.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta) {
		
		}

	});

});

/*=============================================
BOTON QUE GENERA EL PDF DE LOS RESULTADOS COVID PERSONAL
=============================================*/

$(document).on("click", ".btnReportePersonalPDF", function() {

	var idCovidResultado = $(this).attr("idCovidResultado");

	var nombre_usuario = $("#nombreUsuarioOculto").val();
	
	var datos = new FormData();

	datos.append("reportePersonalPDF", "reportePersonalPDF");
	datos.append("idCovidResultado", idCovidResultado);
	datos.append("nombre_usuario", nombre_usuario);

	$('.cargando').removeClass('hide');

	$.ajax({

		url: "ajax/reportes_covid.ajax.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta) {

			$('.cargando').addClass('hide');

			$('#ver-pdf').modal({

				show:true,
				backdrop:'static'

			});	

			PDFObject.embed("temp/reporte-"+idCovidResultado+".pdf", "#view_pdf");

		}

	});

});