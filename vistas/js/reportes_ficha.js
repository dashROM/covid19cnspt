/*=============================================
BOTON QUE GENERA LOS REPORTES DE DATOS FICHA EPIDEMIOLÓGICA POR FECHAS DE RESULTADO
=============================================*/

$(document).on("click", ".btnFichaEpidemiologicaReporte", function() {

	$('#tablaDatosFichaReporte').remove();
	$('#tablaDatosFichaReporte_wrapper').remove();

	var fechaInicio = $("#reporteFechaInicio").val();
	console.log("fechaInicio", fechaInicio);
	var fechaFin = $("#reporteFechaFin").val();
	console.log("fechaFin", fechaFin);

	var datos = new FormData();
	// datos.append("reporte", 'reporte');
	datos.append("reporteDatosFicha", 'reporteDatosFicha');
	datos.append("fechaInicio", fechaInicio);
	datos.append("fechaFin", fechaFin);

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

		url: "ajax/reportes_ficha.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {
			console.log("respuesta", respuesta);

			// $("#reporteFicha").append(

	  // 	'<table class="table table-bordered" id="tablaFichaEpidemiologicaReporte" width="30%">'+
              
			// 	'<tr>'+
			// 		'<th colspan="2">Caso identificado por búsqueda activa</th>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<th>SI</th>'+
			// 		'<th>NO</th>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<td>'+respuesta["data"][0]+'</td>'+
			// 		'<td>'+respuesta["data"][1]+'</td>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<th colspan="2">Sexo paciente</th>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<th>F</th>'+
			// 		'<th>M</th>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<td>'+respuesta["data"][2]+'</td>'+
			// 		'<td>'+respuesta["data"][3]+'</td>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<th colspan="6">Ocupación</th>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<th>PERSONAL DE SALUD</th>'+
			// 		'<th>PERSONAL DE LABORATORIO</th>'+
			// 		'<th>TRABAJADOR PRENSA</th>'+
			// 		'<th>FF.AA.</th>'+
			// 		'<th>POLICIA</th>'+
			// 		'<th>OTROS</th>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<td>'+respuesta["data"][4]+'</td>'+
			// 		'<td>'+respuesta["data"][5]+'</td>'+
			// 		'<td>'+respuesta["data"][6]+'</td>'+
			// 		'<td>'+respuesta["data"][7]+'</td>'+
			// 		'<td>'+respuesta["data"][8]+'</td>'+
			// 		'<td>'+respuesta["data"][9]+'</td>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<th colspan="2">Antecedentes de vacunación para influenza</th>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<th>SI</th>'+
			// 		'<th>NO</th>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<td>'+respuesta["data"][10]+'</td>'+
			// 		'<td>'+respuesta["data"][11]+'</td>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<th colspan="2">¿Tuvo un viaje a un lugar de riesgo dentro o fuera del país?</th>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<th>SI</th>'+
			// 		'<th>NO</th>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<td>'+respuesta["data"][12]+'</td>'+
			// 		'<td>'+respuesta["data"][13]+'</td>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<th colspan="2">¿Tuvo contacto con un caso confirmado de COVID-19 en los 14 días previos al inicio de síntomas, en domicilio o establecimiento de salud?</th>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<th>SI</th>'+
			// 		'<th>NO</th>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<td>'+respuesta["data"][14]+'</td>'+
			// 		'<td>'+respuesta["data"][15]+'</td>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<th colspan="11">Sintomas</th>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<th>TOS SECA</th>'+
			// 		'<th>FIEBRE</th>'+
			// 		'<th>MALESTAR GENERAL</th>'+
			// 		'<th>CEFALEA</th>'+
			// 		'<th>DIFICULTAD RESPIRATORIA</th>'+
			// 		'<th>MIALGIAS</th>'+
			// 		'<th>DOLOR DE GARGANTA</th>'+
			// 		'<th>PÉRDIDA Y/O DISMINUCIÓN DEL SENTIDO DEL OLFATO</th>'+
			// 		'<th>PÉRDIDA Y/O DISMINUCIÓN DEL SENTIDO DEL GUSTO</th>'+
			// 		'<th>ASINTOMÁTICO</th>'+
			// 		'<th>OTROS</th>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<td>'+respuesta["data"][16]+'</td>'+
			// 		'<td>'+respuesta["data"][17]+'</td>'+
			// 		'<td>'+respuesta["data"][18]+'</td>'+
			// 		'<td>'+respuesta["data"][19]+'</td>'+
			// 		'<td>'+respuesta["data"][20]+'</td>'+
			// 		'<td>'+respuesta["data"][21]+'</td>'+
			// 		'<td>'+respuesta["data"][22]+'</td>'+
			// 		'<td>'+respuesta["data"][23]+'</td>'+
			// 		'<td>'+respuesta["data"][24]+'</td>'+
			// 		'<td>'+respuesta["data"][25]+'</td>'+
			// 		'<td>'+respuesta["data"][26]+'</td>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<th colspan="3">Estado actual del paciente (al momento del reporte)</th>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<th>LEVE</th>'+
			// 		'<th>GRAVE</th>'+
			// 		'<th>FALLECIDO</th>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<td>'+respuesta["data"][27]+'</td>'+
			// 		'<td>'+respuesta["data"][28]+'</td>'+
			// 		'<td>'+respuesta["data"][29]+'</td>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<th colspan="4">Diagnostico clínico</th>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<th>IRA</th>'+
			// 		'<th>IRAG</th>'+
			// 		'<th>NEUMONIA</th>'+
			// 		'<th>OTROS</th>'+
			// 	'</tr>'+
			// 	'<tr>'+
			// 		'<td>'+respuesta["data"][30]+'</td>'+
			// 		'<td>'+respuesta["data"][31]+'</td>'+
			// 		'<td>'+respuesta["data"][32]+'</td>'+
			// 		'<td>'+respuesta["data"][33]+'</td>'+
			// 	'</tr>'+
            
   //    '</table>'  

   //    );

   		//Para cerrar la alerta personalizada de loading
			swal.close();	

   		$("#reporteFicha").append(

		  '<table class="table table-bordered table-striped dt-responsive table-hover" id="tablaDatosFichaReporte" width="100%">'+
              
        '<thead>'+
          
          '<tr>'+
            '<th>ID FICHA</th>'+
            '<th>TIPO FICHA</th>'+
            '<th>FECHA CREACION</th>'+
            '<th>FECHA NOTIFICACION</th>'+
            '<th>SEMANA EPIDEMIOLOGICA</th>'+
            '<th>BUSQUEDA ACTIVA</th>'+
            '<th>NRO CONTROL</th>'+
            '<th>ID ESTABLECIMIENTO</th>'+
            '<th>RED SALUD</th>'+
            '<th>ID DEPARTAMENTO</th>'+
            '<th>ID LOCALIDAD</th>'+
            '<th>NOMBRE ASEGURADO</th>'+
            '<th>COD ASEGURADO</th>'+
            '<th>COD EMPLEADOR</th>'+
            '<th>NOMBRE EMPLEADOR</th>'+
            '<th>NRO DOCUMENTO</th>'+
            '<th>SEXO</th>'+
            '<th>FECHA NACIMIENTO</th>'+
            '<th>EDAD</th>'+
            '<th>ID DEPARTAMENTO PACIENTE</th>'+
            '<th>ID LOCALIDAD PACIENTE</th>'+
            '<th>ID PAIS PACIENTE</th>'+
            '<th>ZONA</th>'+
            '<th>DIRECCION</th>'+
            '<th>TELEFONO</th>'+
            '<th>NOMBRE APODERADO</th>'+
            '<th>TELEFONO APODERADO</th>'+
            '<th>OCUPACION</th>'+
            '<th>ANT VACUNA INFLUENZA</th>'+
            '<th>CONTACTO COVID</th>'+
            '<th>FECHA CONTACTO COVID</th>'+
            '<th>ANT VACUNA</th>'+
            '<th>FECHA DOSIS VACUNA</th>'+
            '<th>DOSIS VACUNA</th>'+
            '<th>PROVEEDOR VACUNA</th>'+
            '<th>DIAGNOSTICO COVID</th>'+
            '<th>FECHA DIAGNOSTICO COVID</th>'+
            '<th>TIPO PACIENTE</th>'+
            '<th>FECHA INICIO SINTOMAS</th>'+
            '<th>MALESTARES</th>'+
            '<th>MALESTARES OTROS</th>'+
            '<th>ESTADO PACIENTE</th>'+
            '<th>FECHA DEFUNCION</th>'+
            '<th>DIAGNOSTICO CLINICO</th>'+
            '<th>TIPO AISLAMIENTO</th>'+
            '<th>DIAS NOTIFICACION</th>'+
            '<th>DIAS SIN SINTOMAS</th>'+
            '<th>FECHA AISLAMIENTO</th>'+
            '<th>LUGAR AISLAMIENTO</th>'+
            '<th>FECHA INTERNACION</th>'+
            '<th>ESTABLECIMIENTO INTERNACION</th>'+
            '<th>VENTILACION MECANICA</th>'+
            '<th>TERAPIA INTENSIVA</th>'+
            '<th>FECHA INGRESO UTI</th>'+
            '<th>LUGAR INGRESO UTI</th>'+
            '<th>TRATAMIENTO</th>'+
            '<th>TRATAMIENTO OTROS</th>'+
            '<th>ENF ESTADO</th>'+
            '<th>ENF RIESGO</th>'+
            '<th>ENF RIESGO OTROS</th>'+
            '<th>ESTADO MUESTRA</th>'+
            '<th>NO TOMA MUESTRA</th>'+
            '<th>ID ESTABLECIMIENTO2</th>'+
            '<th>TIPO NUESTRA</th>'+
            '<th>NOMBRE LABORATORIO</th>'+
            '<th>COD LABORATORIO</th>'+
            '<th>FECHA MUESTRA</th>'+
            '<th>FECHA ENVIO</th>'+
            '<th>RESPONSABLE MUESTRA</th>'+
            '<th>OBSERVACIONES MUESTRA</th>'+
            '<th>METODO DIAGNOSTICO</th>'+
            '<th>RESULTADO LABORATORIO</th>'+
            '<th>FECHA RESULTADO</th>'+
            '<th>NOMBRE NOTIFICADOR</th>'+
            '<th>CARGO NOTIFICADOR</th>'+
            '<th>TELEFONO NOTIFICADOR</th>'+
          '</tr>'+

        '</thead>'+
        
      '</table>'  

      ); 			

			var t = $('#tablaDatosFichaReporte').DataTable({

				"data": respuesta,

				"columns": [
					{ data: "id_ficha" },
          { data: "tipo_ficha" },
          { render: function (data, type, row) {
						var date = new Date(row.fecha_creacion);
						date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
						return (moment(date).format("DD/MM/YYYY"));
					}},
					{ render: function (data, type, row) {
						var date = new Date(row.fecha_notificacion);
						date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
						return (moment(date).format("DD/MM/YYYY"));
					}},
          { data: "semana_epidemiologica" },
          { data: "busqueda_activa" },
          { data: "nro_control" },
          { data: "id_establecimiento" },
          { data: "red_salud" },
          { data: "id_departamento" },
          { data: "id_localidad" },
          { data: "nombre_asegurado" },
          { data: "cod_asegurado" },
          { data: "cod_empleador" },
          { data: "nombre_empleador" },
          { data: "nro_documento" },
          { data: "sexo" },
          { render: function (data, type, row) {
						var date = new Date(row.fecha_nacimiento);
						date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
						return (moment(date).format("DD/MM/YYYY"));
					}},
          { data: "edad" },
          { data: "id_departamento_paciente" },
          { data: "id_localidad_paciente" },
          { data: "id_pais_paciente" },
          { data: "zona" },
          { data: "direccion" },
          { data: "telefono" },
          { data: "nombre_apoderado" },
          { data: "telefono_apoderado" },
          { data: "ocupacion" },
          { data: "ant_vacuna_influenza" },
          { data: "contacto_covid" },
          { data: "fecha_contacto_covid" },
          { data: "ant_vacuna" },
          { render: function (data, type, row) {
						var date = new Date(row.fecha_dosis_vacuna);
						date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
						return (moment(date).format("DD/MM/YYYY"));
					}},
          { data: "dosis_vacuna" },
          { data: "proveedor_vacuna" },
          { data: "diagnosticado_covid" },
          { render: function (data, type, row) {
						var date = new Date(row.fecha_diagnosticado_covid);
						date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
						return (moment(date).format("DD/MM/YYYY"));
					}},
					{ data: "tipo_paciente" },
					{ render: function (data, type, row) {
						var date = new Date(row.fecha_inicio_sintomas);
						date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
						return (moment(date).format("DD/MM/YYYY"));
					}},
          { data: "malestares" },
          { data: "malestares_otros" },
          { data: "estado_paciente" },
          { render: function (data, type, row) {
						var date = new Date(row.fecha_defuncion);
						date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
						return (moment(date).format("DD/MM/YYYY"));
					}},
          { data: "diagnostico_clinico" },
          { data: "tipo_aislamiento" },
          { data: "dias_notificacion" },
          { data: "dias_sin_sintomas" },
          { render: function (data, type, row) {
						var date = new Date(row.fecha_aislamiento);
						date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
						return (moment(date).format("DD/MM/YYYY"));
					}},
          { data: "lugar_aislamiento" },
          { render: function (data, type, row) {
						var date = new Date(row.fecha_internacion);
						date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
						return (moment(date).format("DD/MM/YYYY"));
					}},
          { data: "establecimiento_internacion" },
          { data: "ventilacion_mecanica" },
          { data: "terapia_intensiva" },
          { render: function (data, type, row) {
						var date = new Date(row.fecha_ingreso_UTI);
						date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
						return (moment(date).format("DD/MM/YYYY"));
					}},
          { data: "lugar_ingreso_UTI" },
          { data: "tratamiento" },
          { data: "tratamiento_otros" },
          { data: "enf_estado" },
          { data: "enf_riesgo" },
          { data: "enf_riesgo_otros" },
          { data: "estado_muestra" },
          { data: "no_toma_muestra" },
          { data: "id_establecimiento2" },
          { data: "tipo_muestra" },
          { data: "nombre_laboratorio" },
          { data: "cod_laboratorio" },
          { render: function (data, type, row) {
						var date = new Date(row.fecha_muestra);
						date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
						return (moment(date).format("DD/MM/YYYY"));
					}},
					{ render: function (data, type, row) {
						var date = new Date(row.fecha_envio);
						date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
						return (moment(date).format("DD/MM/YYYY"));
					}},
          { data: "responsable_muestra" },
          { data: "observaciones_muestra" },
          { data: "metodo_diagnostico" },
          { data: "resultado_laboratorio" },
          { render: function (data, type, row) {
						var date = new Date(row.fecha_resultado);
						date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
						return (moment(date).format("DD/MM/YYYY"));
					}},
          { data: "nombre_notificador" },
          { data: "cargo_notificador" },
          { data: "telefono_notificador" }          
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
						title: 	   'Reporte '+fechaInicio+' '+fechaFin,
						text:      '<i class="fas fa-file-excel"></i> Generar EXCEL',
						titleAttr: 'Exportar a Excel',
						className: 'btn btn-success'
					},
				]	        

			});

		},
    error: function(error){

      console.log("No funciona");
        
    }

	});

});


/*=============================================
BOTON QUE GENERA LOS RESULTADOS COVID POR FILTRADO DE FECHAS Y RESULTADO
=============================================*/

$(document).on("click", ".btnDatosFichaReporte", function() {

	$('#tablaDatosFichaReporte').remove();
	$('#tablaDatosFichaReporte_wrapper').remove();

	var fechaInicio = $("#reporteFechaInicio").val();
	var fechaFin = $("#reporteFechaFin").val();
	// var resultado = $('input:radio[name=reporteResultado]:checked').val();

	var datos = new FormData();
	datos.append("reporteDatosFicha", 'reporteDatosFicha');
	datos.append("fechaInicio", fechaInicio);
	datos.append("fechaFin", fechaFin);
	// datos.append("resultado", resultado);

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

		url: "ajax/reportes_covid.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {

			//Para cerrar la alerta personalizada de loading
			swal.close();	

			$("#reporteDatosFicha").append(

		  '<table class="table table-bordered table-striped dt-responsive table-hover" id="tablaDatosFichaReporte" width="100%">'+
	            
        '<thead>'+
          
          '<tr>'+
            '<th>#</th>'+
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
            '<th>MÉTODO DE DIAGNÓSTICO</th>'+
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
		            { data: "metodo_diagnostico" },
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
					
				]	        

			});

		},
	    error: function(error){

	      console.log("No funciona");
	        
	    }

	});

});


/*=============================================
BOTON QUE GENERA DATOS FICHA EPIDEMIOLÓGICA POR FECHAS DE RESULTADO PARA EXPORTAR AL SIVE
=============================================*/

$(document).on("click", ".btnDatosFichaExportarSive", function() {

	$('#tablaDatosFichaExportarSive').remove();
	$('#tablaDatosFichaExportarSive_wrapper').remove();

	var fechaInicio = $("#reporteFechaInicio").val();
	console.log("fechaInicio", fechaInicio);
	var fechaFin = $("#reporteFechaFin").val();
	console.log("fechaFin", fechaFin);

	var datos = new FormData();
	// datos.append("reporte", 'reporte');
	datos.append("exportarDatosFichaSive", 'exportarDatosFichaSive');
	datos.append("fechaInicio", fechaInicio);
	datos.append("fechaFin", fechaFin);

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

		url: "ajax/reportes_ficha.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {
			console.log("respuesta", respuesta);

   		//Para cerrar la alerta personalizada de loading
			swal.close();	

   		$("#reporteFichaSIVE").append(

		  '<table class="table table-bordered table-striped dt-responsive table-hover" id="tablaDatosFichaExportarSive" width="100%">'+
              
        '<thead>'+
          
          '<tr>'+
          	'<th>1.Código Municipio</th>'+
            '<th>2.Código Establecimiento de Salud</th>'+
            '<th>3.Fecha Notificación </th>'+
            '<th>4.Semana Epidemiologica</th>'+
            '<th>5.Busqueda Activa</th>'+
            '<th>6.Codigo tipo de documento</th>'+
            '<th>7.Documento de identidad</th>'+
            '<th>8.Complemento</th>'+
            '<th>9.Fecha Nacimiento</th>'+
            '<th>10.Edad</th>'+
            '<th>11.Nombres</th>'+
            '<th>12.Primer apellido</th>'+
            '<th>13.Segundo apellido</th>'+
            '<th>14.Apellido de casada</th>'+
            '<th>15.Código genero</th>'+
            '<th>16.Código identificación étnica</th>'+
            '<th>17.Código pais</th>'+
            '<th>18.Telefono</th>'+
            '<th>19.Código Municipio Direccion</th>'+
            '<th>20.Calle</th>'+
            '<th>21.Zona</th>'+
            '<th>22.Nro. Calle</th>'+
            '<th>23.Menor de edad</th>'+
            '<th>24.Nombre Apoderado</th>'+
            '<th>25.Telefono Apoderado</th>'+
            '<th>26.Asegurado</th>'+
            '<th>27.Código caja o seguro</th>'+
            '<th>28.Nombre de la empresa</th>'+
            '<th>29.Matricula asegurado</th>'+
            '<th>30.Código Tipo asegurado</th>'+
            '<th>31.Código ocupación</th>'+
            '<th>32.Otra ocupación</th>'+
            '<th>33.Contacto Covid</th>'+
            '<th>34.Fecha Contacto Covid</th>'+
            '<th>35.Codigo pais probable de infección</th>'+
            '<th>36.Codigo municipio probable de infección</th>'+
            '<th>37.Ciudad / Localidad probable de infección</th>'+
            '<th>38.¿Fue vacunado contra COVID-19?</th>'+
            '<th>39.1ra dosis</th>'+
            '<th>40.2da dosis</th>'+
            '<th>41.Dosis única</th>'+
            '<th>42.1ra dosis refuerzo</th>'+
            '<th>43.2da dosis refuerzo</th>'+
            '<th>44.Código proveedor 1ra dosis</th>'+
            '<th>45.Código proveedor 2da dosis</th>'+
            '<th>46.Código proveedor Dosis única</th>'+
            '<th>47.Código proveedor 1ra dosis refuerzo</th>'+
            '<th>48.Código proveedor 2da dosis refuerzo</th>'+
            '<th>49.Fecha última dosis</th>'+
            '<th>50.ASINTOMÁTICO</th>'+
            '<th>51.TOS SECA</th>'+
            '<th>52.DOLOR DE GARGANTA</th>'+
            '<th>53.FIEBRE</th>'+
            '<th>54.DIFICULTAD RESPIRATORIA</th>'+
            '<th>55.MIALGUIAS</th>'+
            '<th>56.MALESTAR GENERAL</th>'+
            '<th>57.CEFALEA</th>'+
            '<th>58.PÉRDIDA Y/O DISMINUCIÓN DEL OLFATO</th>'+
            '<th>59.PÉRDIDA Y/O DISMINUCIÓN DEL GUSTO</th>'+
            '<th>60.OTRO SINTOMA</th>'+
            '<th>61.Otro Sintoma</th>'+
            '<th>62.Código estado al momento del reporte</th>'+
            '<th>63.Fecha defunción</th>'+
            '<th>64.Código diagnostico clinico</th>'+
            '<th>65.Otro Diagnostico</th>'+
            '<th>66.Fecha Inicio de Sintomas</th>'+
            '<th>67.Semana Epidemiologica</th>'+
            '<th>68.Código ambulatorio o internado</th>'+
            '<th>69.Fecha Internacion</th>'+
            '<th>70.Código establecimiento de salud de internacion</th>'+
            '<th>71.Lugar de Aislamiento</th>'+
            '<th>72.fecha Aislamiento</th>'+
            '<th>73.Terapia Intensiva</th>'+
            '<th>74.Fecha Ingreso U.T.I.</th>'+
            '<th>75.Ventilación Mecanica</th>'+
            '<th>76.Presenta enfermedades de base</th>'+
            '<th>77.DIABETES</th>'+
            '<th>78.OBESIDAD</th>'+
            '<th>79.ENFERMEDAD RENAL CRONICA</th>'+
            '<th>80.EMBARAZO</th>'+
            '<th>81.HIPERTENSION ARTERIAL</th>'+
            '<th>82.ENFERMEDAD CARDÍACA</th>'+
            '<th>83.ENFERMEDAD ONCOLOGICA</th>'+
            '<th>84.ENFERMEDAD RESPIRATORIA</th>'+
            '<th>85.OTROS</th>'+
            '<th>86.Otra Enfermedad</th>'+
            '<th>87.Tomo Muestra</th>'+
            '<th>88.Código tipo de muestra tomada</th>'+
            '<th>89.Código de Laboratorio</th>'+
            '<th>90.Fecha toma muestra</th>'+
            '<th>91.Fecha envió muestra</th>'+
            '<th>92.Observaciones</th>'+
            '<th>93.Código método de Diagnostico</th>'+
            '<th>94.fecha Recepcion de la muestra</th>'+
            '<th>95.Codigo Interno Laboratorio</th>'+
            '<th>96.Fecha Resultado</th>'+
            '<th>97.Código resultado</th>'+
            '<th>98.Observaciones del Resultado</th>'+
            '<th>99.Nombre del Notificador</th>'+
            '<th>100.Telefono del Notificador</th>'+
          '</tr>'+

        '</thead>'+
        
      '</table>'  

      ); 			

			var t = $('#tablaDatosFichaExportarSive').DataTable({

				"data": respuesta.data,

				// "columns": [
				// 	{ render: function (data, type, row) {
				// 		var date = new Date(row.fecha_notificacion);
				// 		date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
				// 		return (moment(date).format("DD/MM/YYYY"));
				// 	}},
				// 	{ data: "semana_epidemiologica" },
    //       { data: "busqueda_activa" },
    //       { data: "nro_documento" }
     //      { render: function (data, type, row) {
					// 	var date = new Date(row.fecha_nacimiento);
					// 	date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
					// 	return (moment(date).format("DD/MM/YYYY"));
					// }},
					// { data: "edad" },
					// { data: "nombre" },
					// { data: "paterno" },
					// { data: "materno" },
					// { data: "sexo" },
					// { data: "telefono" },
					// { data: "calle" },
					// { data: "zona" },
					// { data: "nro_calle" },
					// { data: "nombre_apoderado" },
					// { data: "telefono_apoderado" },
					// { data: "nombre_empleador" },
					// { data: "cod_asegurado" },
					// { data: "contacto_covid" },
					// { render: function (data, type, row) {
					// 	var date = new Date(row.fecha_contacto_covid);
					// 	date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
					// 	return (moment(date).format("DD/MM/YYYY"));
					// }},
     //      { data: "localidad_contacto_covid" },
     //      { data: "ant_vacuna" },
     //      { data: "malestares_otros" },
     //      { render: function (data, type, row) {
					// 	var date = new Date(row.fecha_internacion);
					// 	date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
					// 	return (moment(date).format("DD/MM/YYYY"));
					// }},
     //      { data: "lugar_aislamiento" },
     //      { render: function (data, type, row) {
					// 	var date = new Date(row.fecha_aislamiento);
					// 	date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
					// 	return (moment(date).format("DD/MM/YYYY"));
					// }},
     //      { data: "terapia_intensiva" },
     //      { render: function (data, type, row) {
					// 	var date = new Date(row.fecha_ingreso_UTI);
					// 	date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
					// 	return (moment(date).format("DD/MM/YYYY"));
					// }},
     //      { data: "ventilacion_mecanica" },
     //      { data: "enf_estado" },
     //      { data: "enf_riesgo_otros" },
     //      { data: "estado_muestra" },
     //      { render: function (data, type, row) {
					// 	var date = new Date(row.fecha_muestra);
					// 	date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
					// 	return (moment(date).format("DD/MM/YYYY"));
					// }},
					// { render: function (data, type, row) {
					// 	var date = new Date(row.fecha_envio);
					// 	date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
					// 	return (moment(date).format("DD/MM/YYYY"));
					// }},
     //      { data: "observaciones_muestra" },
     //      { render: function (data, type, row) {
					// 	var date = new Date(row.fecha_envio);
					// 	date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
					// 	return (moment(date).format("DD/MM/YYYY"));
					// }},
     //      { data: "cod_laboratorio" },
     //      { render: function (data, type, row) {
					// 	var date = new Date(row.fecha_resultado);
					// 	date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
					// 	return (moment(date).format("DD/MM/YYYY"));
					// }},
     //      { data: "nombre_notificador" },
     //      { data: "telefono_notificador" }          
	      // ],

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
						title: 	   'Reporte '+fechaInicio+' '+fechaFin,
						text:      '<i class="fas fa-file-excel"></i> Generar EXCEL',
						titleAttr: 'Exportar a Excel',
						className: 'btn btn-success'
					},
				]	        

			});

		},
    error: function(error){

      console.log("No funciona");
        
    }

	});

});
