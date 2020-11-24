/*=============================================
BOTON QUE GENERA LOS REPORTES DE FICHA EPIDEMIOLÓGICA POR FECHAS DE TOMA DE MUESTRA
=============================================*/

$(document).on("click", ".btnFichaEpidemiologicaReporte", function() {

	$('#tablaFichaEpidemiologicaReporte').remove();
	$('#tablaFichaEpidemiologicaReporte_wrapper').remove();

	var fechaInicio = $("#reporteFechaInicio").val();
	var fechaFin = $("#reporteFechaFin").val();

	var datos = new FormData();
	datos.append("reporte", 'reporte');
	datos.append("fechaInicio", fechaInicio);
	datos.append("fechaFin", fechaFin);

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

			$("#reporteFicha").append(



			  	'<table class="table table-bordered" id="tablaFichaEpidemiologicaReporte" width="30%">'+
                  
					'<tr>'+
						'<th colspan="2">Caso identificado por búsqueda activa</th>'+
					'</tr>'+
					'<tr>'+
						'<th>SI</th>'+
						'<th>NO</th>'+
					'</tr>'+
					'<tr>'+
						'<td>'+respuesta["data"][0]+'</td>'+
						'<td>'+respuesta["data"][1]+'</td>'+
					'</tr>'+
					'<tr>'+
						'<th colspan="2">Sexo paciente</th>'+
					'</tr>'+
					'<tr>'+
						'<th>F</th>'+
						'<th>M</th>'+
					'</tr>'+
					'<tr>'+
						'<td>'+respuesta["data"][2]+'</td>'+
						'<td>'+respuesta["data"][3]+'</td>'+
					'</tr>'+
					'<tr>'+
						'<th colspan="6">Ocupación</th>'+
					'</tr>'+
					'<tr>'+
						'<th>PERSONAL DE SALUD</th>'+
						'<th>PERSONAL DE LABORATORIO</th>'+
						'<th>TRABAJADOR PRENSA</th>'+
						'<th>FF.AA.</th>'+
						'<th>POLICIA</th>'+
						'<th>OTROS</th>'+
					'</tr>'+
					'<tr>'+
						'<td>'+respuesta["data"][4]+'</td>'+
						'<td>'+respuesta["data"][5]+'</td>'+
						'<td>'+respuesta["data"][6]+'</td>'+
						'<td>'+respuesta["data"][7]+'</td>'+
						'<td>'+respuesta["data"][8]+'</td>'+
						'<td>'+respuesta["data"][9]+'</td>'+
					'</tr>'+
					'<tr>'+
						'<th colspan="2">Antecedentes de vacunación para influenza</th>'+
					'</tr>'+
					'<tr>'+
						'<th>SI</th>'+
						'<th>NO</th>'+
					'</tr>'+
					'<tr>'+
						'<td>'+respuesta["data"][10]+'</td>'+
						'<td>'+respuesta["data"][11]+'</td>'+
					'</tr>'+
					'<tr>'+
						'<th colspan="2">¿Tuvo un viaje a un lugar de riesgo dentro o fuera del país?</th>'+
					'</tr>'+
					'<tr>'+
						'<th>SI</th>'+
						'<th>NO</th>'+
					'</tr>'+
					'<tr>'+
						'<td>'+respuesta["data"][12]+'</td>'+
						'<td>'+respuesta["data"][13]+'</td>'+
					'</tr>'+
					'<tr>'+
						'<th colspan="2">¿Tuvo contacto con un caso confirmado de COVID-19 en los 14 días previos al inicio de síntomas, en domicilio o establecimiento de salud?</th>'+
					'</tr>'+
					'<tr>'+
						'<th>SI</th>'+
						'<th>NO</th>'+
					'</tr>'+
					'<tr>'+
						'<td>'+respuesta["data"][14]+'</td>'+
						'<td>'+respuesta["data"][15]+'</td>'+
					'</tr>'+
					'<tr>'+
						'<th colspan="11">Sintomas</th>'+
					'</tr>'+
					'<tr>'+
						'<th>TOS SECA</th>'+
						'<th>FIEBRE</th>'+
						'<th>MALESTAR GENERAL</th>'+
						'<th>CEFALEA</th>'+
						'<th>DIFICULTAD RESPIRATORIA</th>'+
						'<th>MIALGIAS</th>'+
						'<th>DOLOR DE GARGANTA</th>'+
						'<th>PÉRDIDA Y/O DISMINUCIÓN DEL SENTIDO DEL OLFATO</th>'+
						'<th>PÉRDIDA Y/O DISMINUCIÓN DEL SENTIDO DEL GUSTO</th>'+
						'<th>ASINTOMÁTICO</th>'+
						'<th>OTROS</th>'+
					'</tr>'+
					'<tr>'+
						'<td>'+respuesta["data"][16]+'</td>'+
						'<td>'+respuesta["data"][17]+'</td>'+
						'<td>'+respuesta["data"][18]+'</td>'+
						'<td>'+respuesta["data"][19]+'</td>'+
						'<td>'+respuesta["data"][20]+'</td>'+
						'<td>'+respuesta["data"][21]+'</td>'+
						'<td>'+respuesta["data"][22]+'</td>'+
						'<td>'+respuesta["data"][23]+'</td>'+
						'<td>'+respuesta["data"][24]+'</td>'+
						'<td>'+respuesta["data"][25]+'</td>'+
						'<td>'+respuesta["data"][26]+'</td>'+
					'</tr>'+
					'<tr>'+
						'<th colspan="3">Estado actual del paciente (al momento del reporte)</th>'+
					'</tr>'+
					'<tr>'+
						'<th>LEVE</th>'+
						'<th>GRAVE</th>'+
						'<th>FALLECIDO</th>'+
					'</tr>'+
					'<tr>'+
						'<td>'+respuesta["data"][27]+'</td>'+
						'<td>'+respuesta["data"][28]+'</td>'+
						'<td>'+respuesta["data"][29]+'</td>'+
					'</tr>'+
					'<tr>'+
						'<th colspan="4">Diagnostico clínico</th>'+
					'</tr>'+
					'<tr>'+
						'<th>IRA</th>'+
						'<th>IRAG</th>'+
						'<th>NEUMONIA</th>'+
						'<th>OTROS</th>'+
					'</tr>'+
					'<tr>'+
						'<td>'+respuesta["data"][30]+'</td>'+
						'<td>'+respuesta["data"][31]+'</td>'+
						'<td>'+respuesta["data"][32]+'</td>'+
						'<td>'+respuesta["data"][33]+'</td>'+
					'</tr>'+
                
              	'</table>'  

            );

		},
	    error: function(error){

	      console.log("No funciona");
	        
	    }

	});

});

