/*=============================================
CARGAR LA TABLA DINÁMICA DE FICHAS
=============================================*/

var perfilOculto = $("#perfilOculto").val();

var actionBuscarFichaFecha = $("#actionBuscarFichaFecha").val();

var table = $('#tablaFichas').DataTable( {

	"ajax": "ajax/datatable-fichas.ajax.php?perfilOculto="+perfilOculto+"&actionBuscarFichaFecha="+actionBuscarFichaFecha,

	"deferRender": true,

	"retrieve" : true,

	"processing" : true,

	"rowCallback": function(row, data, index) {
		if ( data[8] == "" ) {
           $('td', row).addClass('bg-lightblue color-palette');
           $('tr.child', row).addClass('bg-lightblue color-palette');

           if ( data[11] == "0" ) {
	           $('td', row).addClass('bg-maroon color-palette');
	           $('tr.child', row).addClass('bg-maroon color-palette');

	        }
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

// actualiza el contenido de la DataTable automaticamente cada 10000 ms.
setInterval( function () {

    table.ajax.reload( null, false ); // user paging is not reset on reload

}, 30000 );


/*=============================================
CREAR UNA NUEVA FICHA EPIDEMIOLOGICA 
=============================================*/

$(document).on("click", ".btnNuevaFichaEpidemiologica", function() {

	var paterno_notificador = $("#paternoNotificador").val();
	var materno_notificador = $("#maternoNotificador").val();
	var nombre_notificador = $("#nombreNotificador").val();
	var cargo_notificador = $("#cargoNotificador").val();

	var datos = new FormData();
	datos.append("crearFichaEpidemiologica", "crearFichaEpidemiologica");
	datos.append("paterno_notificador", paterno_notificador);
	datos.append("materno_notificador", materno_notificador);
	datos.append("nombre_notificador", nombre_notificador);
	datos.append("cargo_notificador", cargo_notificador);

	$.ajax({

		url:"ajax/fichas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "html",
		success: function(respuesta) {
		
			if (respuesta != "error") {

				swal.fire({
					
					icon: "success",
					title: "¡FICHA EPIDEMIOLÓGICA generada correctamente!",
					showConfirmButton: true,
					allowOutsideClick: false,
					confirmButtonText: "Cerrar"

				}).then((result) => {
  					
  					if (result.value) {

  						window.location = "index.php?ruta=editar-ficha-epidemiologica&idFicha="+respuesta;

					}

				});

			} else {

				swal.fire({
						
					title: "¡Error en la Base de Datos, No se puede Generar la FICHA EPIDEMIOLÓGICA!",
					icon: "error",
					allowOutsideClick: false,
					confirmButtonText: "¡Cerrar!"

				});
				
			}

		},
		error: function(error) {

	        console.log("No funciona");
	        
	    }

	});

});

/*=============================================
CREAR UNA NUEVA FICHA CONTROL Y SEGUIMIENTO
=============================================*/

$(document).on("click", ".btnNuevaFichaControl", function() {

	var paterno_notificador = $("#paternoNotificador").val();
	var materno_notificador = $("#maternoNotificador").val();
	var nombre_notificador = $("#nombreNotificador").val();
	var cargo_notificador = $("#cargoNotificador").val();

	var datos = new FormData();
	datos.append("crearFichaControl", "crearFichaControl");
	datos.append("paterno_notificador", paterno_notificador);
	datos.append("materno_notificador", materno_notificador);
	datos.append("nombre_notificador", nombre_notificador);
	datos.append("cargo_notificador", cargo_notificador);

	$.ajax({

		url:"ajax/fichas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "html",
		success: function(respuesta) {
		
			if (respuesta != "error") {

				swal.fire({
					
					icon: "success",
					title: "¡FICHA DE CONTROL Y SEGUIMIENTO generada correctamente!",
					showConfirmButton: true,
					allowOutsideClick: false,
					confirmButtonText: "Cerrar"

				}).then((result) => {
  					
  					if (result.value) {

  						window.location = "index.php?ruta=editar-ficha-control&idFicha="+respuesta;

					}

				});

			} else {

				swal.fire({
						
					title: "¡Error en la Base de Datos, No se puede Generar la FICHA EPIDEMIOLÓGICA!",
					icon: "error",
					allowOutsideClick: false,
					confirmButtonText: "¡Cerrar!"

				});
				
			}

		},
		error: function(error) {

	        console.log("No funciona");
	        
	    }

	});

});

/*=============================================
BOTON QUE GENERA LOS DATOS DE FICHA EPIDEMIOLÓGICA FILTRADO POR FECHAS
=============================================*/

$(document).on("click", ".btnBuscarFichaFecha", function() {

	$('#tablaFichas').remove();
	$('#tablaFichas_wrapper').remove();

	$("#fichas").append(

	  '<table class="table table-bordered table-striped dt-responsive" id="tablaFichas" width="100%">'+
        
        '<thead>'+
          
          '<tr>'+
            '<th>COD. FICHA.</th>'+
            '<th>TIPO DE FICHA.</th>'+
            '<th>COD. ASEGURADO</th>'+
            '<th>APELLIDOS Y NOMBRES</th>'+
            '<th>CI</th>'+
            '<th>SEXO</th>'+
            '<th>FECHA NACIMIENTO</th>'+
            '<th>FECHA NOTIFICACIÓN</th>'+
            '<th>BÜSQUEDA ACTIVA</th>'+
            '<th>RESULTADO</th>'+
            '<th>FECHA RESULTADO</th>'+
            '<th>ACCIONES</th>'+
          '</tr>'+

        '</thead>'+
        
      '</table>'  

    );       			

	var fecha = $("#fechaMuestra").val();

	/*=============================================
	CARGAR LA TABLA DINÁMICA DE COVID RESULTADOS
	=============================================*/

	var perfilOculto = $(this).attr("perfilOculto");

	var actionBuscarFichaFecha = $(this).attr("actionBuscarFichaFecha");

	$('#tablaFichas').DataTable({

		"ajax": "ajax/datatable-fichas.ajax.php?perfilOculto="+perfilOculto+"&actionBuscarFichaFecha="+actionBuscarFichaFecha+"&fecha="+fecha,

		"deferRender": true,

		"retrieve" : true,

		"processing" : true,

		"rowCallback": function(row, data, index) {
	       if ( data[21] == "0" )
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
BUSQUEDA DE AFILIADO A PARTIR DEL NOMBRE O COD ASEGURADO POR EL BOTON BUSCAR
=============================================*/

$(document).on("click", ".btnBuscarAfiliadoFichas", function() {

	var afiliado = $("#buscardorAfiliadosFichas").val();

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

				$('#tablaAfiliadosSIAISFichas').remove();
				$('#tablaAfiliadosSIAISFichas_wrapper').remove();

				$("#tblAfiliadosSIAISFichas").append(

				  '<table class="table table-bordered table-striped dt-responsive" id="tablaAfiliadosSIAISFichas" width="100%">'+
	                
	                '<thead>'+
	                  
	                  '<tr>'+
	                    '<th>COD. ASEGURADO123</th>'+
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

				var t = $('#tablaAfiliadosSIAISFichas').DataTable({

					"data": respuesta,

					"columns": [
			            { data: "cod_asegurado" },
			            { data: "cod_beneficiario" },
			            { data: "nombre_completo" },
			            { render: function (data, type, row) {
							var date = new Date(row.fecha_nacimiento);
							date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
							return (moment(date).format("DD-MM-YYYY"));
						}},
			            { data: "cod_empleador" },
			            { data: "nombre_empleador" },
			            { render: function(data, type, row) {
			            	return "<div class='btn-group'><button class='btn btn-info btnSeleccionarAfiliadoFicha' idAfiliado='"+row.idafiliacion+"' data-toggle='tooltip' title='Seleccionar Afiliado'><i class='fas fa-check'></i></button></div>"
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
	        		
	        		"info":     false 

				});

			},
		    error: function(error){

		      console.log("No funciona");
		        
		    }

		});

	} else {

		
		$('#tablaAfiliadosSIAISFichas').remove();
		$('#tablaAfiliadosSIAISFichas_wrapper').remove();

	}

});

/*=============================================
BUSQUEDA DE AFILIADO A PARTIR DEL NOMBRE O COD ASEGURADO POR LA TECLA ENTER
=============================================*/

$(document).on("keypress", "#buscardorAfiliadosFichas", function(e) {

	if (e.which == 13) {
    
    	var afiliado = $("#buscardorAfiliadosFichas").val();

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

					$('#tablaAfiliadosSIAISFichas').remove();
					$('#tablaAfiliadosSIAISFichas_wrapper').remove();

					$("#tblAfiliadosSIAISFichas").append(

					  '<table class="table table-bordered table-striped dt-responsive" id="tablaAfiliadosSIAISFichas" width="100%">'+
		                
		                '<thead>'+
		                  
		                  '<tr>'+
		                    '<th>COD. ASEGURADO123</th>'+
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

					var t = $('#tablaAfiliadosSIAISFichas').DataTable({

						"data": respuesta,

						"columns": [
				            { data: "cod_asegurado" },
				            { data: "cod_beneficiario" },
				            { data: "nombre_completo" },
				            { render: function (data, type, row) {
								var date = new Date(row.fecha_nacimiento);
								date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
								return (moment(date).format("DD-MM-YYYY"));
							}},
				            { data: "cod_empleador" },
				            { data: "nombre_empleador" },
				            { render: function(data, type, row) {
				            	return "<div class='btn-group'><button class='btn btn-info btnSeleccionarAfiliadoFicha' idAfiliado='"+row.idafiliacion+"' data-toggle='tooltip' title='Seleccionar Afiliado'><i class='fas fa-check'></i></button></div>"
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
		        		
		        		"info":     false 

					});

				},
			    error: function(error){

			      console.log("No funciona");
			        
			    }

			});

		} else {

			
			$('#tablaAfiliadosSIAISFichas').remove();
			$('#tablaAfiliadosSIAISFichas_wrapper').remove();

		}

	}

});


/*=============================================
SELECCIÓN DE AFILIADO Y TRASPASO AL FORMULARIO FICHA EPIDEMIOLOGICA
=============================================*/

$(document).on("click", ".btnSeleccionarAfiliadoFicha", function() {

	var idAfiliado = $(this).attr("idAfiliado");
	console.log("idAfiliado", idAfiliado);

	var idFicha = $("#idFicha").val();
	console.log("idFicha", idFicha);

	$(this).removeClass("btn-info btnSeleccionarAfiliadoFicha");

	$(this).addClass("btn-default");

	var datos = new FormData();
	datos.append("guardarAfiliadoFicha", "guardarAfiliadoFicha");
	datos.append("idAfiliado", idAfiliado);
	datos.append("idFicha", idFicha);

	$.ajax({

		url:"ajax/afiliadosSIAIS.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta) {
			
			toastr.success('El Dato se guardó correctamente.')

			var id = respuesta["idafiliacion"];
			var codAsegurado = respuesta["pac_numero_historia"];
			var codAfiliado = respuesta["pac_codigo"];
			var codEmpleador = respuesta["emp_nro_empleador"];
			var nombreEmpleador = respuesta["emp_nombre"];
			var paterno = respuesta["pac_primer_apellido"];
			var materno = respuesta["pac_segundo_apellido"];
			var nombre = respuesta["pac_nombre"];
			var fechaNacimiento = respuesta["pac_fecha_nac"]
			var edad = calcularEdad(fechaNacimiento);

			$('#nuevoCodAsegurado').empty().prepend("<option value='"+codAsegurado+"' >"+codAsegurado+"</option>");
			$('#nuevoCodEmpleador').val(codEmpleador);
			$('#nuevoCodAfiliado').val(codAfiliado);
			$('#nuevoNombreEmpleador').val(nombreEmpleador);
			$('#nuevoPaternoPaciente').val(paterno);
			$('#nuevoMaternoPaciente').val(materno);
			$('#nuevoNombrePaciente').val(nombre);
			$('#nuevoFechaNacPaciente').val(fechaNacimiento);
			$('#nuevoEdadPaciente').val(edad);

			
			$('#modalCodAsegurado').modal('toggle');

		},
		error: function(error) {

	        toastr.warning('¡Error! Falla en la consulta a BD, no se modificaron.')
	        
	    }

	});

});

/*=============================================
FUNCION PARA CALCULAR LA EDAD DE UNA PERSONA
=============================================*/

function calcularEdad(fecha) {

    // Si la fecha es correcta, calculamos la edad
    var values=fecha.split("-");
    var dia = values[2];
    console.log("dia", dia);
    var mes = values[1];
    console.log("mes", mes);
    var ano = values[0];
    console.log("ano", ano);

    // cogemos los valores actuales
    var fecha_hoy = new Date();
    var ahora_ano = fecha_hoy.getYear();
    var ahora_mes = fecha_hoy.getMonth()+1;
    var ahora_dia = fecha_hoy.getDate();

    // realizamos el calculo
    var edad = (ahora_ano + 1900) - ano;
    if ( ahora_mes < mes ) {

        edad--;

    }

    if ((mes == ahora_mes) && (ahora_dia < dia)) {

        edad--;

    }

    if (edad > 1900) {

        edad -= 1900;

    }

    // calculamos los meses
    var meses = 0;

    if(ahora_mes > mes)

        meses = ahora_mes - mes;

    if(ahora_mes < mes)

        meses = 12 - (mes - ahora_mes);

    if(ahora_mes == mes && dia > ahora_dia)

        meses = 11;

    // calculamos los dias
    var dias = 0;

    if (ahora_dia > dia)

        dias = ahora_dia - dia;

    if (ahora_dia < dia) {

        ultimoDiaMes = new Date(ahora_ano, ahora_mes, 0);
        dias = ultimoDiaMes.getDate() - (dia - ahora_dia);

    }

    return edad;

}

/*=============================================
SI TIENE ANTECEDENTES DE VACUNA HABILITAN LOS CAMPOS CASO CONTRARIO SE MANTIENEN INABILITADOS
=============================================*/

$(document).on("change", "#nuevoAntVacunaInfluenza", function() {

	if ($(this).val() == "SI") {

		$("#nuevoFechaVacunaInfluenza").removeAttr("readonly");

	} else {

		$("#nuevoFechaVacunaInfluenza").attr("readonly","");
		$("#nuevoFechaVacunaInfluenza").val("");

	}
	
});

/*=============================================
SI SELECCIONO POLICLINICO COMO ESTABLECIMIENTO SE HABILITAN LOS CONSULTORIOS
=============================================*/

$(document).on("change", "#nuevoEstablecimiento", function() {

	if ($(this).val() == "2") {

		$("#nuevoConsultorio").removeAttr("disabled");

	} else {

		$("#nuevoConsultorio").attr("disabled","");
		$("#nuevoConsultorio").val("");

	}
	
});


/*=============================================
SI VIAJO ALGUN LUGAR DE RIESGO SE HABILITAN LOS CAMPOS CASO CONTRARIO SE MANTIENEN INABILITADOS
=============================================*/

$(document).on("change", "#nuevoViajeRiesgo", function() {

	if ($(this).val() == "SI") {

		$("#nuevoPaisCiudadRiesgo").removeAttr("readonly");
		$("#nuevoFechaRetorno").removeAttr("readonly");
		$("#nuevoEmpresaVuelo").removeAttr("readonly");
		$("#nuevoNroVuelo").removeAttr("readonly");
		$("#nuevoNroAsiento").removeAttr("readonly");

	} else {

		$("#nuevoPaisCiudadRiesgo").attr("readonly","");
		$("#nuevoPaisCiudadRiesgo").val("");
		$("#nuevoFechaRetorno").attr("readonly","");
		$("#nuevoFechaRetorno").val("");
		$("#nuevoEmpresaVuelo").attr("readonly","");
		$("#nuevoEmpresaVuelo").val("");
		$("#nuevoNroVuelo").attr("readonly","");
		$("#nuevoNroVuelo").val("");
		$("#nuevoNroAsiento").attr("readonly","");
		$("#nuevoNroAsiento").val("");

	}
	
});

/*=============================================
SI TUVO ALGUN CONTACTO CON ALGUIEN CON COVID SE HABILITAN LOS CAMPOS CASO CONTRARIO SE MANTIENEN INABILITADOS
=============================================*/

$(document).on("change", "#nuevoContactoCovid", function() {

	if ($(this).val() == "SI") {

		$("#nuevoFechaContactoCovid").removeAttr("readonly");
		$("#nuevoNombreContactoCovid").removeAttr("readonly");
		$("#nuevoNombreContactoCovid").val("");
		$("#nuevoTelefonoContactoCovid").removeAttr("readonly");
		$("#nuevoPaisContactoCovid").removeAttr("readonly");
		$("#nuevoPaisContactoCovid").val("");
		$("#nuevoDepartamentoContactoCovid").removeAttr("readonly");
		$("#nuevoDepartamentoContactoCovid").val("");
		$("#nuevoLocalidadContactoCovid").removeAttr("readonly");
		$("#nuevoLocalidadContactoCovid").val("");

	} else {

		$("#nuevoFechaContactoCovid").attr("readonly","");
		$("#nuevoFechaContactoCovid").val("");
		$("#nuevoNombreContactoCovid").attr("readonly","");
		$("#nuevoNombreContactoCovid").val("COMUNITARIO");
		$("#nuevoTelefonoContactoCovid").attr("readonly","");
		$("#nuevoTelefonoContactoCovid").val("");
		$("#nuevoPaisContactoCovid").attr("readonly","");
		$("#nuevoPaisContactoCovid").val("BOLIVIA");
		$("#nuevoDepartamentoContactoCovid").attr("readonly","");
		$("#nuevoDepartamentoContactoCovid").val("POTOSÍ");
		$("#nuevoLocalidadContactoCovid").attr("readonly","");
		$("#nuevoLocalidadContactoCovid").val("POTOSÍ");

	}
	
});

/*=============================================
SI ESTADO ACTUAL DEL PACIENTE ES FALLECIDO SE HABILITAN LOS CAMPOS CASO CONTRARIO SE MANTIENEN INABILITADOS
=============================================*/

$(document).on("change", "#nuevoEstadoPaciente", function() {

	if ($(this).val() == "FALLECIDO") {

		$("#nuevoFechaDefuncion").removeAttr("readonly");

	} else {

		$("#nuevoFechaDefuncion").attr("readonly","");
		$("#nuevoFechaDefuncion").val("");

	}
	
});

/*=============================================
SI PRESENTA ENFERMEDADES DE BASE SE HABILITAN LOS CAMPOS CASO CONTRARIO SE MANTIENEN INABILITADOS
=============================================*/

$(document).on("click", "input:radio[name=enfEstado]:checked", function() {

	console.log("PRESIONADO");

	if ($(this).val() == "PRESENTA") {

		$("#nuevoHipertensionArterial").removeAttr("disabled");
		$("#nuevoObesidad").removeAttr("disabled");
		$("#nuevoDiabetes").removeAttr("disabled");
		$("#nuevoEmbarazo").removeAttr("disabled");
		$("#nuevoEnfCardiaca").removeAttr("disabled");
		$("#nuevoEnfRespiratoria").removeAttr("disabled");
		$("#nuevoEnfRenalCronica").removeAttr("disabled");
		$("#nuevoEnfRiesgoOtros").removeAttr("readonly");

	} else {

		$("#nuevoHipertensionArterial").attr("disabled","");
		$("#nuevoHipertensionArterial").prop("checked", false);
		$("#nuevoObesidad").attr("disabled","");
		$("#nuevoObesidad").prop("checked", false);
		$("#nuevoDiabetes").attr("disabled","");
		$("#nuevoDiabetes").prop("checked", false);
		$("#nuevoEmbarazo").attr("disabled","");
		$("#nuevoEmbarazo").prop("checked", false);
		$("#nuevoEnfCardiaca").attr("disabled","");
		$("#nuevoEnfCardiaca").prop("checked", false);
		$("#nuevoEnfRespiratoria").attr("disabled","");
		$("#nuevoEnfRespiratoria").prop("checked", false);
		$("#nuevoEnfRenalCronica").attr("disabled","");
		$("#nuevoEnfRenalCronica").prop("checked", false);
		$("#nuevoEnfRiesgoOtros").attr("readonly","");
		$("#nuevoEnfRiesgoOtros").val("");

	}
	
});

$(document).ready(function() { 

	/*=============================================
	FUNCIONES PARA CAMBIAR LOS MENSAJES POR DEFECTO DEL PLUGIN DE VALIDACIÓN
	=============================================*/

	$.extend($.validator.messages, {
		required: "Este campo es obligatorio.",
		remote: "Por favor, rellena este campo.",
		email: "Por favor, escribe una dirección de correo válida",
		url: "Por favor, escribe una URL válida.",
		date: "Por favor, escribe una fecha válida.",
		dateISO: "Por favor, escribe una fecha (ISO) válida.",
		number: "Por favor, escribe un número entero válido.",
		digits: "Por favor, escribe sólo dígitos.",
		creditcard: "Por favor, escribe un número de tarjeta válido.",
		equalTo: "Por favor, escribe el mismo valor de nuevo.",
		accept: "Por favor, escribe un valor con una extensión aceptada.",
		maxlength: $.validator.format("Por favor, no escribas más de {0} caracteres."),
		minlength: $.validator.format("Por favor, no escribas menos de {0} caracteres."),
		rangelength: $.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
		range: $.validator.format("Por favor, escribe un valor entre {0} y {1}."),
		max: $.validator.format("Por favor, escribe un valor menor o igual a {0}."),
		min: $.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
	});

	/*=============================================
	FUNCIONES CON LOS DIFERENTES PATRONES CON EXPRESIONES REGULARES PARA LA VALIDACIÓN
	=============================================*/

	$.validator.addMethod("patron_letras", function (value, element) {

	    var pattern = /^[a-zA-Z]+$/;
	    return this.optional(element) || pattern.test(value);

	}, "El campo debe contener letras (azAZ)");

	$.validator.addMethod("patron_numeros", function (value, element) {

	    var pattern = /^[0-9]+$/;
	    return this.optional(element) || pattern.test(value);

	}, "El campo debe tener un valor numérico (0-9)");
    
    $.validator.addMethod("patron_numerosLetras", function (value, element) {

	    var pattern = /^[a-zA-Z0-9-]+$/;
	    return this.optional(element) || pattern.test(value);

	}, "El campo debe tener un valor Alfa Numérico (a-zA-Z0-9)");

	$.validator.addMethod("patron_numerosTexto", function (value, element) {

	    var pattern = /^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ .-]+$/;
	    return this.optional(element) || pattern.test(value);

	}, "Caracteres Especiales No Admitidos");

	$.validator.addMethod("patron_texto", function (value, element) {

	    var pattern = /^[A-Za-zñÑáéíóúÁÉÍÓÚ .]+$/;
	    return this.optional(element) || pattern.test(value);

	}, "Caracteres Especiales No Admitidos");

	$.validator.addMethod("patron_textoEspecial", function (value, element) {

	    var pattern = /^[^"'&%${}]*$/;
	    return this.optional(element) || pattern.test(value);

	}, "Caracteres Especiales No Admitidos");


	/*=============================================
	FICHA EPIDEMIOLOGICA
	=============================================*/	
    
    //VALIDANDO DATOS DE FICHA EPIDEMIOLOGICA

    $("#fichaEpidemiologicaCentro").validate({

    	rules: {
    		// 1. DATOS ESTABLECIMIENTO NOTIFICADOR
    		nuevoEstablecimiento : { required: true},
			nuevoRedSalud: { required: true, patron_letras: true},
			nuevoDepartamento : { required: true},
           	nuevoLocalidad : { required: true},
			nuevoFechaNotificacion : { required: true},
     		nuevoSemEpidemiologica: { number: true},
     		nuevoBusquedaActiva : { required: true},

     		// 2. IDENTIFICACIÓN DEL CASO PACIENTE
     		nuevoCodAsegurado : { required: true},
			nuevoSexoPaciente: { required: true},
			nuevoNroDocumentoPaciente : { required: true, patron_numerosLetras: true},
           	nuevoDepartamentoPaciente : { required: true},
			nuevoLocalidadPaciente : { required: true},
     		nuevoPaisPaciente: { required: true},
     		nuevoZonaPaciente: { patron_numerosTexto: true},
     		nuevoCallePaciente: { patron_numerosTexto: true},
     		nuevoNroCallePaciente: { number: true},
     		nuevoNombreApoderado: { patron_texto: true},

     		// 3. ANTECEDENTES EPIDEMIOLOGICOS
     		nuevoAntOcupacion : { required: true},
			nuevoAntVacunaInfluenza: { required: true},
			nuevoViajeRiesgo : { required: true},
           	nuevoEmpresaVuelo : { patron_numerosTexto: true},
			nuevoNroVuelo : { patron_numerosTexto: true},
     		nuevoNroAsiento: { patron_numerosTexto: true},
     		nuevoContactoCovid: { required: true},
     		nuevoNombreContactoCovid: { patron_texto: true},
     		nuevoPaisContactoCovid: { patron_texto: true},
     		nuevoDepartamentoContactoCovid: { patron_texto: true},
     		nuevoLocalidadContactoCovid: { patron_texto: true},

     		// 4. DATOS CLÍNICOS
     		nuevoMalestaresOtros: { patron_numerosTexto: true},
     		nuevoEstadoPaciente: { required: true},
     		nuevoDepartamentoContactoCovid: { patron_texto: true},
     		nuevoDiagnosticoClinico: { required: true, patron_texto: true},

     		// 5. DATOS HOSPITALIZACIÓN AISLAMIENTO
    		nuevoLugarAislamiento : { patron_numerosTexto: true},
     		nuevoEstablecimientoInternacion: { patron_numerosTexto: true},
     		nuevoVentilacionMecanica : { required: true},
     		nuevoTerapiaIntensiva : { required: true},

     		// 6. ENFERMEDADES DE BASE O CONDICIONES DE RIESGO
     		enfEstado : { required: true},
     		nuevoEnfRiesgoOtros: { patron_numerosTexto: true},

     		// 8. LABORATORIO
     		nuevoEstadoMuestra : { required: true},
     		nuevoLugarMuestra: { required: true},
     		nuevoTipoMuestra: { required: true, patron_texto: true},
     		nuevoFechaMuestra: { required: true},
     		nuevoFechaEnvio: { required: true},
     		nuevoResponsableMuestra: { required: true, patron_texto: true},

     		// DATOS DEL PERSONAL QUE NOTIFICA
     		nuevoPaternoNotif : { patron_texto: true},
     		nuevoMaternoNotif: { patron_texto: true},
     		nuevoNombreNotif: { required: true, patron_texto: true},
     		nuevoTelefonoNotif: { minlength: 7, patron_numeros: true},
     		nuevoCargoNotif: { patron_numerosTexto: true}
     		
    	},

    	messages: {
    		// 1. DATOS ESTABLECIMIENTO NOTIFICADOR
       		nuevoEstablecimiento : "Elija un establecimiento",
           	nuevoDepartamento : "Elija un departamento",
           	nuevoLocalidad : "Elija una Localidad",
           	nuevoBusquedaActiva : "Elija un valor",

           	// 2. IDENTIFICACIÓN DEL CASO PACIENTE
           	nuevoCodAsegurado : "Elija un asegurado",
           	nuevoSexoPaciente: "Elija un sexo",
           	nuevoDepartamentoPaciente : "Elija un departamento",
           	nuevoLocalidadPaciente : "Elija una localidad",
           	nuevoPaisPaciente : "Elija un pais",

           	// 3. ANTECEDENTES EPIDEMIOLOGICOS
           	nuevoAntVacunaInfluenza : "Elija una opción",
           	nuevoViajeRiesgo: "Elija una opción",
           	nuevoContactoCovid : "Elija una opción",

           	// 4. DATOS CLÍNICOS
           	nuevoEstadoPaciente : "Elija una opción",

           	// 5. DATOS HOSPITALIZACIÓN AISLAMIENTO
           	nuevoVentilacionMecanica : "Elija una opción",
     		nuevoTerapiaIntensiva : "Elija una opción",

           	// 6. ENFERMEDADES DE BASE O CONDICIONES DE RIESGO
           	enfEstado : "Elija una opción",

           	// 8. LABORATORIO
           	nuevoEstadoMuestra : "Elija una opción",
       		nuevoLugarMuestra : "Elija una opción",

		},

		errorPlacement: function(label, element) {

       		if (element.attr("name") == "enfEstado" ) {
            	
            	label.addClass('errorMsq');
           		element.parent().parent().append(label);

			} else {

				label.addClass('errorMsq');
				element.parent().append(label);

			}

        },

	});


	//GUARDANDO DATOS DE FICHA EPIDEMIOLOGICA

	$("#fichaEpidemiologicaCentro").on("click", ".btnGuardar", function() {

        if ($("#fichaEpidemiologicaCentro").valid()) {

        	console.log("VALIDADO FICHAS");

        	// 1. DATOS ESTABLECIMIENTO NOTIFICADOR
        	var id_ficha = $ ("#idFicha").val();
        	var id_establecimiento = $("#nuevoEstablecimiento").val();	
			var cod_establecimiento = $("#nuevoCodEstablecimiento").val();
			var id_consultorio = $("#nuevoConsultorio").val();		
			var red_salud = $("#nuevoRedSalud").val();
			var id_departamento = $ ("#nuevoDepartamento").val();
			var id_localidad = $ ("#nuevoLocalidad").val();
			var fecha_notificacion = $ ("#nuevoFechaNotificacion").val();
			var semana_epidemiologica = $ ("#nuevoSemEpidemiologica").val();
			var busqueda_activa = $ ("#nuevoBusquedaActiva").val();

			// 2. IDENTIFICACIÓN DEL CASO PACIENTE
			var cod_asegurado = $("#nuevoCodAsegurado").val();
			var cod_afiliado = $("#nuevoCodAfiliado").val();
			var cod_empleador = $("#nuevoCodEmpleador").val();
			var nombre_empleador = $("#nuevoNombreEmpleador").val();
			var paterno = $("#nuevoPaternoPaciente").val();		
			var materno = $("#nuevoMaternoPaciente").val();		
			var nombre = $("#nuevoNombrePaciente").val();		
			var sexo = $("#nuevoSexoPaciente").val();
			var nro_documento = $ ("#nuevoNroDocumentoPaciente").val();
			var fecha_nacimiento = $ ("#nuevoFechaNacPaciente").val();
			var edad = $ ("#nuevoEdadPaciente").val();
			var id_departamento_paciente = $ ("#nuevoDepartamentoPaciente").val();
			var id_localidad_paciente = $ ("#nuevoLocalidadPaciente").val();
			var id_pais_paciente = $ ("#nuevoPaisPaciente").val();
			var zona = $ ("#nuevoZonaPaciente").val();
			var calle = $ ("#nuevoCallePaciente").val();
			var nro_calle = $ ("#nuevoNroCallePaciente").val();
			var telefono = $ ("#nuevoTelefonoPaciente").val();
			var nombre_apoderado = $ ("#nuevoNombreApoderado").val();
			var telefono_apoderado = $ ("#nuevoTelefonoApoderado").val();

			// 3. ANTECEDENTES EPIDEMIOLOGICOS
			var ocupacion = $("#nuevoAntOcupacion").val();
			var ant_vacuna_influenza = $("#nuevoAntVacunaInfluenza").val();
			var fecha_vacuna_influenza = $("#nuevoFechaVacunaInfluenza").val();
			var viaje_riesgo = $("#nuevoViajeRiesgo").val();
			var pais_ciudad_riesgo = $("#nuevoPaisCiudadRiesgo").val();		
			var fecha_retorno = $("#nuevoFechaRetorno").val();		
			var nro_vuelo = $("#nuevoNroVuelo").val();		
			var nro_asiento = $("#nuevoNroAsiento").val();
			var contacto_covid = $ ("#nuevoContactoCovid").val();
			var fecha_contacto_covid = $ ("#nuevoFechaContactoCovid").val();
			var nombre_contacto_covid = $ ("#nuevoNombreContactoCovid").val();
			var telefono_contacto_covid = $ ("#nuevoTelefonoContactoCovid").val();
			var pais_contacto_covid = $ ("#nuevoPaisContactoCovid").val();
			var departamento_contacto_covid = $ ("#nuevoDepartamentoContactoCovid").val();
			var localidad_contacto_covid = $ ("#nuevoLocalidadContactoCovid").val();

			// 4. DATOS CLÍNICOS
			var fecha_inicio_sintomas = $("#nuevoFechaInicioSintomas").val();
			var malestares = []; 
			$('[name="nuevoMalestares"]').each(function() {

				if ($(this).is(":checked")) {

					malestares.push($(this).val());
				}
				
			});
			malestares = malestares.toString();
			var malestares_otros = $ ("#nuevoMalestaresOtros").val();
			var estado_paciente = $ ("#nuevoEstadoPaciente").val();
			var fecha_defuncion = $ ("#nuevoFechaDefuncion").val();
			var diagnostico_clinico = $ ("#nuevoDiagnosticoClinico").val();

			// 5. DATOS HOSPITALIZACIÓN AISLAMIENTO
			var fecha_aislamiento = $("#nuevoFechaAislamiento").val();
			var lugar_aislamiento = $("#nuevoLugarAislamiento").val();
			var fecha_internacion = $("#nuevoFechaInternacion").val();
			var establecimiento_internacion = $("#nuevoEstablecimientoInternacion").val();
			var ventilacion_mecanica = $("#nuevoVentilacionMecanica").val();		
			var terapia_intensiva = $("#nuevoTerapiaIntensiva").val();
			var fecha_ingreso_UTI = $("#nuevoFechaIngresoUTI").val();

			// 6. ENFERMEDADES DE BASE O CONDICIONES DE RIESGO
			var enf_estado = $('input:radio[name="enfEstado"]:checked').val();
			var enf_riesgo = []; 			
			$('[name="nuevoEnfRiesgo"]').each(function() {

				if ($(this).is(":checked")) {

					enf_riesgo.push($(this).val());
				}
				
			});
			enf_riesgo = enf_riesgo.toString();
			var enf_riesgo_otros = $ ("#nuevoEnfRiesgoOtros").val();

			// 8. LABORATORIO
			var estado_muestra = $("#nuevoEstadoMuestra").val();
			var id_establecimiento_lab = $("#nuevoLugarMuestra").val();
			var tipo_muestra = $("#nuevoTipoMuestra").val();
			var fecha_muestra = $("#nuevoFechaMuestra").val();	
			var fecha_envio = $("#nuevoFechaEnvio").val();
			var responsable_muestra = $("#nuevoResponsableMuestra").val();


			// DATOS DEL PERSONAL QUE NOTIFICA
			var paterno_notificador = $("#nuevoPaternoNotif").val();
			var materno_notificador = $("#nuevoMaternoNotif").val();
			var nombre_notificador = $("#nuevoNombreNotif").val();
			var telefono_notificador = $("#nuevoTelefonoNotif").val();
			var cargo_notificador = $("#nuevoCargoNotif").val();

			var datos = new FormData();
			datos.append("guardarFichaEpidemiologica", 'guardarFichaEpidemiologica');

			// 1. DATOS ESTABLECIMIENTO NOTIFICADOR
			datos.append("id_ficha", id_ficha);
			datos.append("id_establecimiento", id_establecimiento);
			datos.append("cod_establecimiento", cod_establecimiento);
			datos.append("id_consultorio", id_consultorio);
			datos.append("red_salud", red_salud);
			datos.append("id_departamento", id_departamento);
			datos.append("id_localidad", id_localidad);
			datos.append("fecha_notificacion", fecha_notificacion);
			datos.append("semana_epidemiologica", semana_epidemiologica);
			datos.append("busqueda_activa", busqueda_activa);

			// 2. IDENTIFICACIÓN DEL CASO PACIENTE
			datos.append("cod_asegurado", cod_asegurado);
			datos.append("cod_afiliado", cod_afiliado);
			datos.append("cod_empleador", cod_empleador);
			datos.append("nombre_empleador", nombre_empleador);
			datos.append("paterno", paterno);	
			datos.append("materno", materno);	
			datos.append("nombre", nombre);	
			datos.append("sexo", sexo);
			datos.append("nro_documento", nro_documento);
			datos.append("fecha_nacimiento", fecha_nacimiento);
			datos.append("edad", edad);
			datos.append("id_departamento_paciente", id_departamento_paciente);
			datos.append("id_localidad_paciente", id_localidad_paciente);
			datos.append("id_pais_paciente", id_pais_paciente);
			datos.append("zona", zona);
			datos.append("calle", calle);
			datos.append("nro_calle", nro_calle);
			datos.append("telefono", telefono);
			datos.append("nombre_apoderado", nombre_apoderado);
			datos.append("telefono_apoderado", telefono_apoderado);

			// 3. ANTECEDENTES EPIDEMIOLOGICOS
			datos.append("ocupacion", ocupacion);
			datos.append("ant_vacuna_influenza", ant_vacuna_influenza);
			datos.append("fecha_vacuna_influenza", fecha_vacuna_influenza);
			datos.append("viaje_riesgo", viaje_riesgo);
			datos.append("pais_ciudad_riesgo", pais_ciudad_riesgo);	
			datos.append("fecha_retorno", fecha_retorno);	
			datos.append("nro_vuelo", nro_vuelo);	
			datos.append("nro_asiento", nro_asiento);
			datos.append("contacto_covid", contacto_covid);
			datos.append("fecha_contacto_covid", fecha_contacto_covid);
			datos.append("nombre_contacto_covid", nombre_contacto_covid);
			datos.append("telefono_contacto_covid", telefono_contacto_covid);
			datos.append("pais_contacto_covid", pais_contacto_covid);
			datos.append("departamento_contacto_covid", departamento_contacto_covid);
			datos.append("localidad_contacto_covid", localidad_contacto_covid);

			// 4. DATOS CLÍNICOS
			datos.append("fecha_inicio_sintomas", fecha_inicio_sintomas);
			datos.append("malestares", malestares);
			datos.append("malestares_otros", malestares_otros);
			datos.append("estado_paciente", estado_paciente);
			datos.append("fecha_defuncion", fecha_defuncion);
			datos.append("diagnostico_clinico", diagnostico_clinico);

			// 5. DATOS HOSPITALIZACIÓN AISLAMIENTO
			datos.append("fecha_aislamiento", fecha_aislamiento);
			datos.append("lugar_aislamiento", lugar_aislamiento);
			datos.append("fecha_internacion", fecha_internacion);
			datos.append("establecimiento_internacion", establecimiento_internacion);
			datos.append("ventilacion_mecanica", ventilacion_mecanica);	
			datos.append("terapia_intensiva", terapia_intensiva);
			datos.append("fecha_ingreso_UTI", fecha_ingreso_UTI);

			// 6. ENFERMEDADES DE BASE O CONDICIONES DE RIESGO
			datos.append("enf_estado", enf_estado);
			datos.append("enf_riesgo", enf_riesgo);
			datos.append("enf_riesgo_otros", enf_riesgo_otros);

			// 8. LABORATORIO
			datos.append("estado_muestra", estado_muestra);
			datos.append("id_establecimiento_lab", id_establecimiento_lab);
			datos.append("tipo_muestra", tipo_muestra);
			datos.append("fecha_muestra", fecha_muestra);	
			datos.append("fecha_envio", fecha_envio);	
			datos.append("responsable_muestra", responsable_muestra);

			// DATOS DEL PERSONAL QUE NOTIFICA
			datos.append("paterno_notificador", paterno_notificador);
			datos.append("materno_notificador", materno_notificador);
			datos.append("nombre_notificador", nombre_notificador);
			datos.append("telefono_notificador", telefono_notificador);
			datos.append("cargo_notificador", cargo_notificador);	

			$.ajax({

				url:"ajax/fichas.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "html",
				success: function(respuesta) {
					console.log("respuesta", respuesta);
				
					if (respuesta == "ok") {

						swal.fire({
							
							icon: "success",
							title: "¡Los datos se guardaron correctamente!",
							showConfirmButton: true,
							allowOutsideClick: false,
							confirmButtonText: "Cerrar"

						}).then((result) => {
		  					
		  					if (result.value) {

		  						window.location = "ficha-epidemiologica";

							}

						});

					} else {

						swal.fire({
								
							title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
							icon: "error",
							allowOutsideClick: false,
							confirmButtonText: "¡Cerrar!"

						});
						
					}

				},
				error: function(error) {

			        console.log("No funciona");
			        
			    }

			});

        } 
        else {

        	swal.fire({
								
				title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales, por favor revise el formulario!",
				icon: "error",
				allowOutsideClick: false,
				confirmButtonText: "¡Cerrar!"

			});
        }

    });

	//GUARDANDO DATOS DE FICHA EPIDEMIOLOGICA DINAMICAMENTE

	$("#fichaEpidemiologicaCentro").ready(function() {
		
		var id_ficha = $ ("#idFicha").val();
		// console.log("id_ficha", id_ficha);
		var item = "";
		var valor = "";
		var tabla = "";

		// 1. DATOS DEL ESTABLECIMIENTO NOTIFICADOR

    	$("#nuevoEstablecimiento").change(function() {

			item = "id_establecimiento";
			valor = $(this).val();
			tabla = "fichas"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

			// SI EL VALOR ELEGIDO ES DIFERENTE DE POLICLINICO 10 DE NOVIEMBRE SE BORRA EL VALOR DE CONSULTORIO

			if (valor != "2") {

				item = "id_consultorio";
				valor = "";

				// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

				actualizarCampoFicha(id_ficha, item, valor, tabla)

			}

		});

		$("#nuevoCodEstablecimiento").change(function() {

			item = "cod_establecimiento";
			valor = $(this).val();
			tabla = "fichas"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoConsultorio").change(function() {

			item = "id_consultorio";
			valor = $(this).val();
			tabla = "fichas"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoRedSalud").change(function() {

			item = "red_salud";
			valor = $(this).val();
			tabla = "fichas"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoDepartamento").change(function() {

			item = "id_departamento";
			valor = $(this).val();
			tabla = "fichas"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoLocalidad").change(function() {

			item = "id_localidad";
			valor = $(this).val();
			tabla = "fichas"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoFechaNotificacion").blur(function() {

			item = "fecha_notificacion";
			valor = $(this).val();
			tabla = "fichas"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoSemEpidemiologica").change(function() {

			item = "semana_epidemiologica";
			valor = $(this).val();
			tabla = "fichas"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoBusquedaActiva").change(function() {

			item = "busqueda_activa";
			valor = $(this).val();
			tabla = "fichas"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoBusquedaActiva").change(function() {

			item = "busqueda_activa";
			valor = $(this).val();
			tabla = "fichas"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoNroControl").change(function() {

			item = "nro_control";
			valor = $(this).val();
			tabla = "fichas"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		// 2. IDENTIFICACION DEL CASO/PACIENTE

		$("#nuevoSexoPaciente").change(function() {

			item = "sexo";
			valor = $(this).val();
			tabla = "pacientes_asegurados"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoNroDocumentoPaciente").change(function() {

			item = "nro_documento";
			valor = $(this).val();
			tabla = "pacientes_asegurados"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoDepartamentoPaciente").change(function() {

			item = "id_departamento_paciente";
			valor = $(this).val();
			tabla = "pacientes_asegurados"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoLocalidadPaciente").change(function() {

			item = "id_localidad_paciente";
			valor = $(this).val();
			tabla = "pacientes_asegurados"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoPaisPaciente").change(function() {

			item = "id_pais_paciente";
			valor = $(this).val();
			tabla = "pacientes_asegurados"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoZonaPaciente").change(function() {

			item = "zona";
			valor = $(this).val();
			tabla = "pacientes_asegurados"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoCallePaciente").change(function() {

			item = "calle";
			valor = $(this).val();
			tabla = "pacientes_asegurados"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoNroCallePaciente").change(function() {

			item = "nro_calle";
			valor = $(this).val();
			tabla = "pacientes_asegurados"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoTelefonoPaciente").change(function() {

			item = "telefono";
			valor = $(this).val();
			tabla = "pacientes_asegurados"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoNombreApoderado").change(function() {

			item = "nombre_apoderado";
			valor = $(this).val();
			tabla = "pacientes_asegurados"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoTelefonoApoderado").change(function() {

			item = "telefono_apoderado";
			valor = $(this).val();
			tabla = "pacientes_asegurados"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		// 3. ANTECEDENTES EPIDEMIOLOGICOS

		$("#nuevoAntOcupacion").change(function() {

			item = "ocupacion";
			valor = $(this).val();
			tabla = "ant_epidemiologicos"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoAntVacunaInfluenza").change(function() {

			item = "ant_vacuna_influenza";
			valor = $(this).val();
			tabla = "ant_epidemiologicos"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

			// SI EL VALOR ELEGIDO ES NO SE BORRA EL VALOR DE CAMPO FECHA DE VACUNACIÒN DE INFLUENZA

			if (valor == "NO") {

				item = "fecha_vacuna_influenza";
				valor = "";

				// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

				actualizarCampoFicha(id_ficha, item, valor, tabla)
			}

		});

		$("#nuevoFechaVacunaInfluenza").blur(function() {

			item = "fecha_vacuna_influenza";
			valor = $(this).val();
			tabla = "ant_epidemiologicos"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoViajeRiesgo").change(function() {

			item = "viaje_riesgo";
			valor = $(this).val();
			tabla = "ant_epidemiologicos"

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

			// SI EL VALOR ELEGIDO ES NO SE BORRA LOS VALORES DE LOS CAMPOS INHABILITADOS

			if (valor == "NO") {

				item = "pais_ciudad_riesgo";
				valor = "";

				// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

				actualizarCampoFicha(id_ficha, item, valor, tabla)

				item = "fecha_retorno";

				// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

				actualizarCampoFicha(id_ficha, item, valor, tabla)

				item = "empresa_vuelo";

				// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

				actualizarCampoFicha(id_ficha, item, valor, tabla)

				item = "nro_vuelo";

				// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

				actualizarCampoFicha(id_ficha, item, valor, tabla)

				item = "nro_asiento";

				// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

				actualizarCampoFicha(id_ficha, item, valor, tabla)

			}

		});

		$("#nuevoPaisCiudadRiesgo").change(function() {

			item = "pais_ciudad_riesgo";
			valor = $(this).val();
			tabla = "ant_epidemiologicos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoFechaRetorno").blur(function() {

			item = "fecha_retorno";
			valor = $(this).val();
			tabla = "ant_epidemiologicos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoEmpresaVuelo").change(function() {

			item = "empresa_vuelo";
			valor = $(this).val();
			tabla = "ant_epidemiologicos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoNroVuelo").change(function() {

			item = "nro_vuelo";
			valor = $(this).val();
			tabla = "ant_epidemiologicos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoNroAsiento").change(function() {

			item = "nro_asiento";
			valor = $(this).val();
			tabla = "ant_epidemiologicos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoContactoCovid").change(function() {

			item = "contacto_covid";
			valor = $(this).val();
			tabla = "ant_epidemiologicos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

			// SI EL VALOR ELEGIDO ES NO SE BORRA LOS VALORES DE LOS CAMPOS INHABILITADOS

			if (valor == "NO") {

				item = "fecha_contacto_covid";
				valor = "";

				// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

				actualizarCampoFicha(id_ficha, item, valor, tabla)

				item = "nombre_contacto_covid";
				valor = "COMUNITARIO";

				// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

				actualizarCampoFicha(id_ficha, item, valor, tabla)

				item = "telefono_contacto_covid";
				valor = "";

				// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

				actualizarCampoFicha(id_ficha, item, valor, tabla)

				item = "pais_contacto_covid";
				valor = "BOLIVIA";

				// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

				actualizarCampoFicha(id_ficha, item, valor, tabla)

				item = "departamento_contacto_covid";
				valor = "POTOSÍ";

				// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

				actualizarCampoFicha(id_ficha, item, valor, tabla)

				item = "localidad_contacto_covid";
				valor = "POTOSÍ";

				// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

				actualizarCampoFicha(id_ficha, item, valor, tabla)

			}

		});

		$("#nuevoFechaContactoCovid").blur(function() {

			item = "fecha_contacto_covid";
			valor = $(this).val();
			tabla = "ant_epidemiologicos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoNombreContactoCovid").change(function() {

			item = "nombre_contacto_covid";
			valor = $(this).val();
			tabla = "ant_epidemiologicos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoTelefonoContactoCovid").change(function() {

			item = "telefono_contacto_covid";
			valor = $(this).val();
			tabla = "ant_epidemiologicos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoPaisContactoCovid").change(function() {

			item = "pais_contacto_covid";
			valor = $(this).val();
			tabla = "ant_epidemiologicos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoDepartamentoContactoCovid").change(function() {

			item = "departamento_contacto_covid";
			valor = $(this).val();
			tabla = "ant_epidemiologicos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoLocalidadContactoCovid").change(function() {

			item = "localidad_contacto_covid";
			valor = $(this).val();
			tabla = "ant_epidemiologicos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		// 4. DATOS CLINICOS

		$("#nuevoFechaInicioSintomas").change(function() {

			item = "fecha_inicio_sintomas";
			valor = $(this).val();
			tabla = "datos_clinicos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		var malestares = []; 

		$('[name="nuevoMalestares"]').change(function() {

			// malestares = $("#malestares").val();

			if ($(this).is(":checked")) {

				malestares.push($(this).val());

			} else {


			}

			item = "malestares";
			valor = malestares;
			tabla = "datos_clinicos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)
			
		});

		$("#nuevoMalestaresOtros").change(function() {

			item = "malestares_otros";
			valor = $(this).val();
			tabla = "datos_clinicos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoEstadoPaciente").change(function() {

			item = "estado_paciente";
			valor = $(this).val();
			tabla = "datos_clinicos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

			// SI EL VALOR ELEGIDO ES LEVE SE BORRA EL VALOR DE FECHA DE DEFUNCION INHABILITADOS

			if (valor == "LEVE" || valor == "GRAVE") {

				item = "fecha_defuncion";
				valor = "";

				// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

				actualizarCampoFicha(id_ficha, item, valor, tabla)

			}

		});

		$("#nuevoFechaDefuncion").blur(function() {

			item = "fecha_defuncion";
			valor = $(this).val();
			tabla = "datos_clinicos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoDiagnosticoClinico").change(function() {

			item = "diagnostico_clinico";
			valor = $(this).val();
			tabla = "datos_clinicos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		// 5. DATOS EN CASO DE HOSPITALIZACIÓN Y/O AISLAMIENTO (SEGUIMIENTO)

		$("#nuevoDiasNotificacion").change(function() {

			item = "dias_notificacion";
			valor = $(this).val();
			tabla = "hospitalizaciones_aislamientos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoDiasSinSintomas").change(function() {

			item = "dias_sin_sintomas";
			valor = $(this).val();
			tabla = "hospitalizaciones_aislamientos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoFechaAislamiento").blur(function() {

			item = "fecha_aislamiento";
			valor = $(this).val();
			tabla = "hospitalizaciones_aislamientos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoLugarAislamiento").change(function() {

			item = "lugar_aislamiento";
			valor = $(this).val();
			tabla = "hospitalizaciones_aislamientos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoFechaInternacion").blur(function() {

			item = "fecha_internacion";
			valor = $(this).val();
			tabla = "hospitalizaciones_aislamientos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoEstablecimientoInternacion").change(function() {

			item = "establecimiento_internacion";
			valor = $(this).val();
			tabla = "hospitalizaciones_aislamientos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoVentilacionMecanica").change(function() {

			item = "ventilacion_mecanica";
			valor = $(this).val();
			tabla = "hospitalizaciones_aislamientos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoTerapiaIntensiva").change(function() {

			item = "terapia_intensiva";
			valor = $(this).val();
			tabla = "hospitalizaciones_aislamientos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoFechaIngresoUTI").blur(function() {

			item = "fecha_ingreso_UTI";
			valor = $(this).val();
			tabla = "hospitalizaciones_aislamientos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoLugarIngresoUTI").change(function() {

			item = "lugar_ingreso_UTI";
			valor = $(this).val();
			tabla = "hospitalizaciones_aislamientos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		var tratamiento = []; 

		$('[name="nuevoTratamiento"]').change(function() {

			if ($(this).is(":checked")) {

				tratamiento.push($(this).val());

			} else {


			}

			item = "tratamiento";
			valor = tratamiento;
			tabla = "hospitalizaciones_aislamientos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)
			
		});

		$("#nuevoTratamientoOtros").change(function() {

			item = "tratamiento_otros";
			valor = $(this).val();
			tabla = "hospitalizaciones_aislamientos";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		// 6. ENFERMEDADES DE BASE O CONDICIONES DE RIESGO

		$("input:radio[name='enfEstado']").change(function() {

			item = "enf_estado";
			valor = $(this).val();
			console.log("valor", valor);
			tabla = "enfermedades_bases";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		var enf_riesgo = []; 

		$('[name="nuevoEnfRiesgo"]').change(function() {

			if ($(this).is(":checked")) {

				enf_riesgo.push($(this).val());

			} else {


			}

			item = "enf_riesgo";
			valor = enf_riesgo;
			tabla = "enfermedades_bases";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)
			
		});

		$("#nuevoEnfRiesgoOtros").change(function() {

			item = "enf_riesgo_otros";
			valor = $(this).val();
			tabla = "enfermedades_bases";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		// 8. LABORATORIOS

		$("#nuevoEstadoMuestra").change(function() {

			item = "estado_muestra";
			valor = $(this).val();
			tabla = "laboratorios";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});


		$("#nuevoLugarMuestra").change(function() {

			item = "id_establecimiento";
			valor = $(this).val();
			tabla = "laboratorios";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoTipoMuestra").change(function() {

			item = "tipo_muestra";
			valor = $(this).val();
			tabla = "laboratorios";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoFechaMuestra").blur(function() {

			item = "fecha_muestra";
			valor = $(this).val();
			tabla = "laboratorios";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoFechaEnvio").blur(function() {

			item = "fecha_envio";
			valor = $(this).val();
			tabla = "laboratorios";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoResponsableMuestra").change(function() {

			item = "responsable_muestra";
			valor = $(this).val();
			tabla = "laboratorios";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		// DATOS DEL PERSONAL QUE NOTIFICA:

		$("#nuevoPaternoNotif").change(function() {

			item = "paterno_notificador";
			valor = $(this).val();
			tabla = "personas_notificadores";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoMaternoNotif").change(function() {

			item = "materno_notificador";
			valor = $(this).val();
			tabla = "personas_notificadores";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoNombreNotif").change(function() {

			item = "nombre_notificador";
			valor = $(this).val();
			tabla = "personas_notificadores";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoTelefonoNotif").change(function() {

			item = "telefono_notificador";
			valor = $(this).val();
			tabla = "personas_notificadores";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});

		$("#nuevoCargoNotif").change(function() {

			item = "cargo_notificador";
			valor = $(this).val();
			tabla = "personas_notificadores";

			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

			actualizarCampoFicha(id_ficha, item, valor, tabla)

		});
    	
    });


	//VALIDANDO DATOS DE MODAL NUEVA PERSONA CONTACTO

    $("#nuevoPersonaContacto").validate({

    	rules: {
    		nuevoPaternoContacto : { patron_texto: true},
     		nuevoMaternoContacto: { patron_texto: true},
     		nuevoNombreContacto: { required: true, patron_texto: true},
     		nuevoRelacionContacto: { required: true, patron_numerosTexto: true},
     		nuevoEdadContacto: { patron_numeros: true},
     		nuevoTelefonoContacto: { minlength: 7, patron_numeros: true},
     		nuevaDireccionContacto: { patron_textoEspecial: true},
     		nuevoFechaContacto: { required: true},
     		nuevoLugarContacto: { patron_numerosTexto: true}
    	},

	});

	//GUARDANDO DATOS DE MODAL NUEVA PERSONA CONTACTO

	$("#nuevoPersonaContacto").on("click", "#guardarPersonaContacto", function() {

		if ($("#nuevoPersonaContacto").valid()) {

			$('#modalNuevoPersonaContacto').modal('toggle');

			console.log("AGREGAR PERSONA CONTACTO");

			var paterno_contacto = $('#nuevoPaternoContacto').val();
			var materno_contacto = $('#nuevoMaternoContacto').val();
			var nombre_contacto = $('#nuevoNombreContacto').val();
			var relacion_contacto = $('#nuevoRelacionContacto').val();
			var edad_contacto = $('#nuevoEdadContacto').val();
			var telefono_contacto = $('#nuevoTelefonoContacto').val();
			var direccion_contacto = $('#nuevaDireccionContacto').val();
			var fecha_contacto = $('#nuevoFechaContacto').val();
			var lugar_contacto = $('#nuevoLugarContacto').val();
			var id_ficha = $ ("#idFicha").val();

			var datos = new FormData();
			datos.append("guardarPersonasContactos", 'guardarPersonasContactos');
			datos.append("paterno_contacto", paterno_contacto);
			datos.append("materno_contacto", materno_contacto);
			datos.append("nombre_contacto", nombre_contacto);
			datos.append("relacion_contacto", relacion_contacto);
			datos.append("edad_contacto", edad_contacto);
			datos.append("telefono_contacto", telefono_contacto);
			datos.append("direccion_contacto", direccion_contacto);
			datos.append("fecha_contacto", fecha_contacto);
			datos.append("lugar_contacto", lugar_contacto);
			datos.append("id_ficha", id_ficha);

			$.ajax({

				url:"ajax/personas_contactos.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "html",
				success: function(id_persona_contacto) {
					console.log("id_persona_contacto", id_persona_contacto);
				
					if (id_persona_contacto != "error") {

						swal.fire({
							
							icon: "success",
							title: "¡Los datos se guardaron correctamente!",
							showConfirmButton: true,
							allowOutsideClick: false,
							confirmButtonText: "Cerrar"

						}).then((result) => {
		  					
		  					if (result.value) {

		  						var datos2 = new FormData();
								datos2.append("mostrarPersonaContacto", 'mostrarPersonaContacto');
								datos2.append("id_persona_contacto", id_persona_contacto);

		  						$.ajax({

									url:"ajax/personas_contactos.ajax.php",
									method: "POST",
									data: datos2,
									cache: false,
									contentType: false,
									processData: false,
									dataType: "json",
									success: function(respuesta) {
										
										$('#nuevoPaternoContacto').val("");
										$('#nuevoMaternoContacto').val("");
										$('#nuevoNombreContacto').val("");
										$('#nuevoRelacionContacto').val("");
										$('#nuevoEdadContacto').val("");
										$('#nuevoTelefonoContacto').val("");
										$('#nuevaDireccionContacto').val("");
										$('#nuevoFechaContacto').val("");
										$('#nuevoLugarContacto').val("");

										$("#tablaPersonasContactos").append(

											'<tr>'+
												'<td>'+respuesta["paterno_contacto"]+' '+respuesta["materno_contacto"]+' '+respuesta["nombre_contacto"]+'</td>'+
												'<td>'+respuesta["relacion_contacto"]+'</td>'+
												'<td>'+respuesta["edad_contacto"]+'</td>'+
												'<td>'+respuesta["telefono_contacto"]+'</td>'+
												'<td>'+respuesta["direccion_contacto"]+'</td>'+
												'<td>'+respuesta["fecha_contacto"]+'</td>'+
												'<td>'+respuesta["lugar_contacto"]+'</td>'+
												'<td>'+
													'<div class="btn-group"><button class="btn btn-warning btnEditarPersonaContacto" idPersonaContacto="'+respuesta["id"]+'" data-toggle="modal" data-target="#modalEditarPersonaContacto" data-toggle="tooltip" title="Editar"><i class="fas fa-pencil-alt"></i></button><button class="btn btn-danger btnEliminarPersonaContacto" idPersonaContacto="'+respuesta["id"]+'" data-toggle="tooltip" title="Eliminar"><i class="fas fa-times"></i></button>'+
													'</div>'+
												'</td>'+
											'</tr>'		

										)	

									},
									error: function(error) {

								        console.log("No funciona2");
								        
								    }

								});
		  						
							}

						});

					} else {

						swal.fire({
								
							title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
							icon: "error",
							allowOutsideClick: false,
							confirmButtonText: "¡Cerrar!"

						});
						
					}

				},
				error: function(error) {

			        console.log("No funciona");
			        
			    }

			});

		}

	});

	//VALIDANDO DATOS DE LABORATORIO EN LA FICHA EPIDEMIOLOGICA

    $("#fichaEpidemiologicaLab").validate({

    	rules: {
    		nuevoEstadoMuestra : { required: true},
     		nuevoLugarMuestra: { required: true},
     		nuevoTipoMuestra: { required: true, patron_texto: true},
     		nuevoNombreLaboratorio: { patron_numerosTexto: true},
     		nuevoFechaMuestra: { required: true},
     		nuevoFechaEnvio: { required: true},
     		nuevoCodLaboratorio: { required: true, patron_numerosLetras: true},
     		nuevoResponsableMuestra: { required: true, patron_texto: true},
     		nuevoObsMuestra: { patron_textoEspecial: true},
     		nuevoResultadoLaboratorio: { required: true},
     		nuevoFechaResultado: { required: true}
    	},

    	messages: {
       		nuevoEstadoMuestra : "Elija una opción",
       		nuevoLugarMuestra : "Elija una opción",
       		nuevoResultadoLaboratorio : "Elija una opción"
		},

       	errorPlacement: function(label, element) {

       		if (element.attr("name") == "nuevoResultadoLaboratorio" ) {
            	
            	label.addClass('errorMsq');
           		element.parent().parent().append(label);

			} else {

				label.addClass('errorMsq');
				element.parent().append(label);

			}

        },

	});

	//GUARDANDO DATOS DE LABORATORIO EN LA FICHA EPIDEMIOLOGICA

	$("#fichaEpidemiologicaLab").on("click", ".btnGuardarLab", function() {

		if ($("#fichaEpidemiologicaLab").valid()) {

			console.log("GUARDAR LABORATORIO");

			var estado_muestra = $("#nuevoEstadoMuestra").val();
			var id_establecimiento = $("#nuevoLugarMuestra").val();
			var tipo_muestra = $("#nuevoTipoMuestra").val();
			var nombre_laboratorio = $("#nuevoNombreLaboratorio").val();
			var fecha_muestra = $("#nuevoFechaMuestra").val();	
			var fecha_envio = $("#nuevoFechaEnvio").val();
			var cod_laboratorio = $("#nuevoCodLaboratorio").val();		
			var responsable_muestra = $("#nuevoResponsableMuestra").val();
			var observaciones_muestra = $("#nuevoObsMuestra").val();		
			var resultado_laboratorio = $('input:radio[name="nuevoResultadoLaboratorio"]:checked').val();
			var fecha_resultado = $("#nuevoFechaResultado").val();				
			var id_ficha = $ ("#idFicha").val();
			console.log("id_ficha", id_ficha);

			var cod_asegurado = $("#nuevoCodAsegurado").val();
			var cod_afiliado = $("#nuevoCodAfiliado").val();
			var cod_empleador = $("#nuevoCodEmpleador").val();
			var nombre_empleador = $("#nuevoNombreEmpleador").val();
			var paterno = $("#nuevoPaternoPaciente").val();
			var materno = $("#nuevoMaternoPaciente").val();
			var nombre = $("#nuevoNombrePaciente").val();
			var id_departamento = $("#nuevoDepartamentoPaciente").val();
			var documento_ci = $("#nuevoNroDocumentoPaciente").val();
			var sexo = $("#nuevoSexoPaciente").val();
			var fecha_nacimiento = $("#nuevoFechaNacPaciente").val();
			var telefono = $("#nuevoTelefonoPaciente").val();
			var email = "";
			var id_localidad = $("#nuevoLocalidadPaciente").val();
			var zona = $("#nuevoZonaPaciente").val();
			var calle = $("#nuevoCallePaciente").val();
			var nro_calle = $("#nuevoNroCallePaciente").val();
			var id_usuario = $("#idUsuario").val();
			var foto = "vistas/img/covid_resultados/default/anonymous.png";

			
			var datos = new FormData();
			datos.append("guardarLaboratorio", 'guardarLaboratorio');
			datos.append("estado_muestra", estado_muestra);
			datos.append("id_establecimiento", id_establecimiento);
			datos.append("tipo_muestra", tipo_muestra);
			datos.append("nombre_laboratorio", nombre_laboratorio);
			datos.append("fecha_muestra", fecha_muestra);	
			datos.append("fecha_envio", fecha_envio);
			datos.append("cod_laboratorio", cod_laboratorio);	
			datos.append("responsable_muestra", responsable_muestra);
			datos.append("observaciones_muestra", observaciones_muestra);
			datos.append("resultado_laboratorio", resultado_laboratorio);
			datos.append("fecha_resultado", fecha_resultado);
			datos.append("id_ficha", id_ficha);

			datos.append("cod_asegurado", cod_asegurado);
			datos.append("cod_afiliado", cod_afiliado);
			datos.append("cod_empleador", cod_empleador);
			datos.append("nombre_empleador", nombre_empleador);
			datos.append("paterno", paterno);	
			datos.append("materno", materno);
			datos.append("nombre", nombre);	
			datos.append("id_departamento", id_departamento);
			datos.append("documento_ci", documento_ci);
			datos.append("sexo", sexo);
			datos.append("fecha_nacimiento", fecha_nacimiento);
			datos.append("telefono", telefono);
			datos.append("email", email);
			datos.append("id_localidad", id_localidad);	
			datos.append("zona", zona);
			datos.append("calle", calle);
			datos.append("nro_calle", nro_calle);
			datos.append("id_usuario", id_usuario);
			datos.append("foto", foto);

			$.ajax({

				url:"ajax/laboratorios.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "html",
				success: function(respuesta) {
					console.log("respuesta", respuesta);
				
					if (respuesta == "ok") {

						swal.fire({
							
							icon: "success",
							title: "¡Los datos se guardaron correctamente!",
							showConfirmButton: true,
							allowOutsideClick: false,
							confirmButtonText: "Cerrar"

						}).then((result) => {
		  					
		  					if (result.value) {

		  						window.location = "ficha-epidemiologica";

							}

						});

					} else {

						swal.fire({
								
							title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
							icon: "error",
							allowOutsideClick: false,
							confirmButtonText: "¡Cerrar!"

						});
						
					}

				},
				error: function(error) {

			        console.log("No funciona");
			        
			    }

			});

		}

		else {

        	swal.fire({
								
				title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales, por favor revise el formulario!",
				icon: "error",
				allowOutsideClick: false,
				confirmButtonText: "¡Cerrar!"

			});
        }

	});

	//CARGANDO DATOS AL FORMULARIO DE PERSONAS CONTACTO EN LA FICHA EPIDEMIOLOGICA

	$(document).on("click", ".btnEditarPersonaContacto", function() {

		console.log("CARGAR PERSONA CONTACTO");

		var id_persona_contacto = $(this).attr("idPersonaContacto");
		console.log("id_persona_contacto", id_persona_contacto);

		var fila = $(this).parent().parent().parent().attr("id", "fila"+id_persona_contacto);
		console.log("fila", fila);

		var datos = new FormData();
		datos.append("mostrarPersonaContacto", 'mostrarPersonaContacto');
		datos.append("id_persona_contacto", id_persona_contacto);

		$.ajax({

			url: "ajax/personas_contactos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta) {

				$('#editarPaternoContacto').val(respuesta["paterno_contacto"]);
				$('#editarMaternoContacto').val(respuesta["materno_contacto"]);
				$('#editarNombreContacto').val(respuesta["nombre_contacto"]);
				$('#editarRelacionContacto').val(respuesta["relacion_contacto"]);
				$('#editarEdadContacto').val(respuesta["edad_contacto"]);
				$('#editarTelefonoContacto').val(respuesta["telefono_contacto"]);
				$('#editarDireccionContacto').val(respuesta["direccion_contacto"]);
				$('#editarFechaContacto').val(respuesta["fecha_contacto"]);
				$('#editarLugarContacto').val(respuesta["lugar_contacto"]);
				$('#editarIdPersonaContacto').val(respuesta["id"]);

			},
		    error: function(error){

		      console.log("No funciona");
		        
		    }

		});

	});

	//VALIDANDO DATOS DE MODAL EDITAR PERSONA CONTACTO 

    $("#guardarEditarPersonaContacto").validate({

    	rules: {
    		editarPaternoContacto : { patron_texto: true},
     		editarMaternoContacto: { patron_texto: true},
     		editarNombreContacto: { required: true, patron_texto: true},
     		editarRelacionContacto: { required: true, patron_numerosTexto: true},
     		editarEdadContacto: { patron_numeros: true},
     		editarTelefonoContacto: { minlength: 7, patron_numeros: true},
     		nuevaDireccionContacto: { patron_textoEspecial: true},
     		editarFechaContacto: { required: true},
     		editarLugarContacto: { patron_numerosTexto: true}
    	},

	});

	//EDITANDO DE MODAL EDITAR PERSONA CONTACTO 

	$("#guardarEditarPersonaContacto").on("click", "#btnModificarPersonaContacto", function() {

		if ($("#guardarEditarPersonaContacto").valid()) {

			$('#modalEditarPersonaContacto').modal('toggle');

			console.log("EDITAR PERSONA CONTACTO");

			var id_persona_contacto = $('#editarIdPersonaContacto').val();
			var paterno_contacto = $('#editarPaternoContacto').val();
			var materno_contacto = $('#editarMaternoContacto').val();
			var nombre_contacto = $('#editarNombreContacto').val();
			var relacion_contacto = $('#editarRelacionContacto').val();
			var edad_contacto = $('#editarEdadContacto').val();
			var telefono_contacto = $('#editarTelefonoContacto').val();
			var direccion_contacto = $('#editarDireccionContacto').val();
			var fecha_contacto = $('#editarFechaContacto').val();
			var lugar_contacto = $('#editarLugarContacto').val();
			//var id_ficha = $ ("#idFicha").val();

			var datos = new FormData();
			datos.append("editarPersonasContactos", 'editarPersonasContactos');
			datos.append("id_persona_contacto", id_persona_contacto);
			datos.append("paterno_contacto", paterno_contacto);
			datos.append("materno_contacto", materno_contacto);
			datos.append("nombre_contacto", nombre_contacto);
			datos.append("relacion_contacto", relacion_contacto);
			datos.append("edad_contacto", edad_contacto);
			datos.append("telefono_contacto", telefono_contacto);
			datos.append("direccion_contacto", direccion_contacto);
			datos.append("fecha_contacto", fecha_contacto);
			datos.append("lugar_contacto", lugar_contacto);
			//datos.append("id_ficha", id_ficha);

			$.ajax({

				url:"ajax/personas_contactos.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "html",
				success: function(id_persona_contacto) {
				
					if (id_persona_contacto != "error") {

						swal.fire({
							
							icon: "success",
							title: "¡Los datos se modificaron correctamente!",
							showConfirmButton: true,
							allowOutsideClick: false,
							confirmButtonText: "Cerrar"

						}).then((result) => {
		  					
		  					if (result.value) {

		  						// Eliminamos el contenido de la fila
		  						$("#fila"+id_persona_contacto).empty();

		  						var datos2 = new FormData();
								datos2.append("mostrarPersonaContacto", 'mostrarPersonaContacto');
								datos2.append("id_persona_contacto", id_persona_contacto);

		  						$.ajax({

									url:"ajax/personas_contactos.ajax.php",
									method: "POST",
									data: datos2,
									cache: false,
									contentType: false,
									processData: false,
									dataType: "json",
									success: function(respuesta) {
										
										$('#editarPaternoContacto').val("");
										$('#editarMaternoContacto').val("");
										$('#editarNombreContacto').val("");
										$('#editarRelacionContacto').val("");
										$('#editarEdadContacto').val("");
										$('#editarTelefonoContacto').val("");
										$('#editarDireccionContacto').val("");
										$('#editarFechaContacto').val("");
										$('#editarLugarContacto').val("");

										// Agregamos el contenido editado en la fila
										$("#fila"+id_persona_contacto).append(

											// '<tr>'+
												'<td>'+respuesta["paterno_contacto"]+' '+respuesta["materno_contacto"]+' '+respuesta["nombre_contacto"]+'</td>'+
												'<td>'+respuesta["relacion_contacto"]+'</td>'+
												'<td>'+respuesta["edad_contacto"]+'</td>'+
												'<td>'+respuesta["telefono_contacto"]+'</td>'+
												'<td>'+respuesta["direccion_contacto"]+'</td>'+
												'<td>'+respuesta["fecha_contacto"]+'</td>'+
												'<td>'+respuesta["lugar_contacto"]+'</td>'+
												'<td>'+
													'<div class="btn-group"><button class="btn btn-warning btnEditarPersonaContacto" idPersonaContacto="'+respuesta["id"]+'" data-toggle="modal" data-target="#modalEditarPersonaContacto" data-toggle="tooltip" title="Editar"><i class="fas fa-pencil-alt"></i></button><button class="btn btn-danger btnEliminarPersonaContacto" idPersonaContacto="'+respuesta["id"]+'" data-toggle="tooltip" title="Eliminar"><i class="fas fa-times"></i></button>'+
													'</div>'+
												'</td>'
											// '</tr>'		

										)	

									},
									error: function(error) {

								        console.log("No funciona2");
								        
								    }

								});
		  						
							}

						});

					} else {

						swal.fire({
								
							title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
							icon: "error",
							allowOutsideClick: false,
							confirmButtonText: "¡Cerrar!"

						});
						
					}

				},
				error: function(error) {

			        console.log("No funciona");
			        
			    }

			});

		}

	});

	//ELIMINADO UNA FILA DE LA TABLA DE PERSONAS CONTACTO EN LA FICHA EPIDEMIOLOGICA

	$(document).on("click", ".btnEliminarPersonaContacto", function() {

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

				console.log("ELIMINAR PERSONA CONTACTO");

				var id_persona_contacto = $(this).attr("idPersonaContacto");
				console.log("id_persona_contacto", id_persona_contacto);

				var fila = $(this).parent().parent().parent().attr("id", "fila"+id_persona_contacto);
				console.log("fila", fila);

				var datos = new FormData();
				datos.append("eliminarPersonaContacto", 'eliminarPersonaContacto');
				datos.append("id_persona_contacto", id_persona_contacto);

				$.ajax({

					url: "ajax/personas_contactos.ajax.php",
					method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "html",
					success: function(respuesta) {
						console.log("respuesta", respuesta);
					
						if (respuesta == "ok") {

							swal.fire({
								
								icon: "success",
								title: "¡Los datos se eliminaron correctamente!",
								showConfirmButton: true,
								allowOutsideClick: false,
								confirmButtonText: "Cerrar"

							}).then((result) => {
			  					
			  					if (result.value) {

			  						// Eliminamos el contenido de la fila
		  							$("#fila"+id_persona_contacto).empty();

								}

							});

						} else {

							swal.fire({
									
								title: "¡Erroe en la Transacción o conexión a la Base de Datos!",
								icon: "error",
								allowOutsideClick: false,
								confirmButtonText: "¡Cerrar!"

							});
							
						}

					},
					error: function(error) {

				        console.log("No funciona");
				        
				    }

				});

			}

		});

	});

	/*=============================================
	FICHA CONTROL Y SEGUIMIENTO
	=============================================*/	
    
    //VALIDANDO DATOS DE FICHA CONTROL Y SEGUIMIENTO

    $("#fichaControlCentro").validate({

    	rules: {
    		// 1. DATOS ESTABLECIMIENTO NOTIFICADOR
    		nuevoEstablecimiento : { required: true},
			nuevoDepartamento : { required: true},
           	nuevoLocalidad : { required: true},
			nuevoFechaNotificacion : { required: true},
     		nuevoNroControl : { required: true},

     		// 2. IDENTIFICACIÓN DEL CASO PACIENTE
     		nuevoCodAsegurado : { required: true},
			nuevoSexoPaciente : { required: true},
			nuevoNroDocumentoPaciente : { required: true, patron_numerosLetras: true},
			nuevoTelefonoPaciente : { patron_numeros: true},

     		// 3. SEGUIMIENTO
     		nuevoDiasNotificacion : { required: true},
     		nuevoDiasSinSintomas : { patron_numeros: true},
    		nuevoLugarAislamiento : { patron_numerosTexto: true},
     		nuevoEstablecimientoInternacion : { patron_numerosTexto: true},
     		nuevoLugarIngresoUTI : { patron_numerosTexto: true}, 
     		nuevoVentilacionMecanica : { required: true},
     		nuevoTratamientoOtros : { patron_numerosTexto: true},

     		// 4. LABORATORIO
     		nuevoTipoMuestra: { required: true, patron_texto: true},
     		nuevoFechaMuestra: { required: true},
     		nuevoFechaEnvio: { required: true},
     		nuevoResponsableMuestra: { required: true, patron_texto: true},

     		// DATOS DEL PERSONAL QUE NOTIFICA
     		nuevoPaternoNotif : { patron_texto: true},
     		nuevoMaternoNotif : { patron_texto: true},
     		nuevoNombreNotif : { required: true, patron_texto: true},
     		nuevoTelefonoNotif : { minlength: 7, patron_numeros: true},
     		nuevoCargoNotif : { patron_numerosTexto: true}
     		
    	},

    	messages: {
    		// 1. DATOS ESTABLECIMIENTO NOTIFICADOR
       		nuevoEstablecimiento : "Elija un establecimiento",
           	nuevoDepartamento : "Elija un departamento",
           	nuevoLocalidad : "Elija una Localidad",
           	nuevoNroControl : "Elija un valor",

           	// 2. IDENTIFICACIÓN DEL CASO PACIENTE
           	nuevoCodAsegurado : "Elija un asegurado",
           	nuevoSexoPaciente : "Elija un sexo",

           	// 3. SEGUIMIENTO
           	nuevoDiasNotificacion : "Elija una opción",
           	nuevoVentilacionMecanica : "Elija una opción",

		},

	});

	//GUARDANDO DATOS DE FICHA CONTROL Y SEGUIMIENTO

	$("#fichaControlCentro").on("click", ".btnGuardar", function() {

		console.log("GUARDAR FICHA CONTROL");

        if ($("#fichaControlCentro").valid()) {

        	console.log("VALIDADO FICHA CONTROL");

        	// 1. DATOS ESTABLECIMIENTO NOTIFICADOR
        	var id_ficha = $ ("#idFicha").val();
        	var id_establecimiento = $("#nuevoEstablecimiento").val();	
        	var id_consultorio = $("#nuevoConsultorio").val();	
			var id_departamento = $ ("#nuevoDepartamento").val();
			var id_localidad = $ ("#nuevoLocalidad").val();
			var fecha_notificacion = $ ("#nuevoFechaNotificacion").val();
			var nro_control = $ ("#nuevoNroControl").val();

			// 2. IDENTIFICACIÓN DEL CASO PACIENTE
			var cod_asegurado = $("#nuevoCodAsegurado").val();
			var cod_afiliado = $("#nuevoCodAfiliado").val();
			var cod_empleador = $("#nuevoCodEmpleador").val();
			var nombre_empleador = $("#nuevoNombreEmpleador").val();
			var paterno = $("#nuevoPaternoPaciente").val();		
			var materno = $("#nuevoMaternoPaciente").val();		
			var nombre = $("#nuevoNombrePaciente").val();		
			var sexo = $("#nuevoSexoPaciente").val();
			var nro_documento = $ ("#nuevoNroDocumentoPaciente").val();
			var fecha_nacimiento = $ ("#nuevoFechaNacPaciente").val();
			console.log("fecha_nacimiento", fecha_nacimiento);
			var edad = $ ("#nuevoEdadPaciente").val();
			var telefono = $ ("#nuevoTelefonoPaciente").val();

			// 3. SEGUIMIENTO
			var dias_notificacion = $("#nuevoDiasNotificacion").val();
			var dias_sin_sintomas = $("#nuevoDiasSinSintomas").val();
			var fecha_aislamiento = $("#nuevoFechaAislamiento").val();
			var lugar_aislamiento = $("#nuevoLugarAislamiento").val();
			var fecha_internacion = $("#nuevoFechaInternacion").val();
			var establecimiento_internacion = $("#nuevoEstablecimientoInternacion").val();
			var fecha_ingreso_UTI = $("#nuevoFechaIngresoUTI").val();
			var lugar_ingreso_UTI = $("#nuevoLugarIngresoUTI").val();
			var ventilacion_mecanica = $("#nuevoVentilacionMecanica").val();		
			var tratamiento = []; 
			$('[name="nuevoTratamiento"]').each(function() {

				if ($(this).is(":checked")) {

					tratamiento.push($(this).val());
				}
				
			});
			tratamiento = tratamiento.toString();
			var tratamiento_otros = $ ("#nuevoTratamientoOtros").val();

			// 4. LABORATORIO
			var tipo_muestra = $("#nuevoTipoMuestra").val();
			var fecha_muestra = $("#nuevoFechaMuestra").val();	
			var fecha_envio = $("#nuevoFechaEnvio").val();
			var responsable_muestra = $("#nuevoResponsableMuestra").val();

			// DATOS DEL PERSONAL QUE NOTIFICA
			var paterno_notificador = $("#nuevoPaternoNotif").val();
			var materno_notificador = $("#nuevoMaternoNotif").val();
			var nombre_notificador = $("#nuevoNombreNotif").val();
			var telefono_notificador = $("#nuevoTelefonoNotif").val();
			var cargo_notificador = $("#nuevoCargoNotif").val();

			var datos = new FormData();
			datos.append("guardarFichaControl", 'guardarFichaControl');

			// 1. DATOS ESTABLECIMIENTO NOTIFICADOR
			datos.append("id_ficha", id_ficha);
			datos.append("id_establecimiento", id_establecimiento);
			datos.append("id_consultorio", id_consultorio);
			datos.append("id_departamento", id_departamento);
			datos.append("id_localidad", id_localidad);
			datos.append("fecha_notificacion", fecha_notificacion);
			datos.append("nro_control", nro_control);

			// 2. IDENTIFICACIÓN DEL CASO PACIENTE
			datos.append("cod_asegurado", cod_asegurado);
			datos.append("cod_afiliado", cod_afiliado);
			datos.append("cod_empleador", cod_empleador);
			datos.append("nombre_empleador", nombre_empleador);
			datos.append("paterno", paterno);	
			datos.append("materno", materno);	
			datos.append("nombre", nombre);	
			datos.append("sexo", sexo);
			datos.append("nro_documento", nro_documento);
			datos.append("fecha_nacimiento", fecha_nacimiento);
			datos.append("edad", edad);
			datos.append("telefono", telefono);			

			// 3. SEGUIMIENTO
			datos.append("dias_notificacion", dias_notificacion);
			datos.append("dias_sin_sintomas", dias_sin_sintomas);
			datos.append("fecha_aislamiento", fecha_aislamiento);
			datos.append("lugar_aislamiento", lugar_aislamiento);
			datos.append("fecha_internacion", fecha_internacion);
			datos.append("establecimiento_internacion", establecimiento_internacion);
			datos.append("fecha_ingreso_UTI", fecha_ingreso_UTI);
			datos.append("lugar_ingreso_UTI", lugar_ingreso_UTI);
			datos.append("ventilacion_mecanica", ventilacion_mecanica);	
			datos.append("tratamiento", tratamiento);	
			datos.append("tratamiento_otros", tratamiento_otros);

			// 4. LABORATORIO
			datos.append("tipo_muestra", tipo_muestra);
			datos.append("fecha_muestra", fecha_muestra);	
			datos.append("fecha_envio", fecha_envio);	
			datos.append("responsable_muestra", responsable_muestra);

			// DATOS DEL PERSONAL QUE NOTIFICA
			datos.append("paterno_notificador", paterno_notificador);
			datos.append("materno_notificador", materno_notificador);
			datos.append("nombre_notificador", nombre_notificador);
			datos.append("telefono_notificador", telefono_notificador);
			datos.append("cargo_notificador", cargo_notificador);	

			$.ajax({

				url:"ajax/fichas.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "html",
				success: function(respuesta) {
					console.log("respuesta", respuesta);
				
					if (respuesta == "ok") {

						swal.fire({
							
							icon: "success",
							title: "¡Los datos se guardaron correctamente!",
							showConfirmButton: true,
							allowOutsideClick: false,
							confirmButtonText: "Cerrar"

						}).then((result) => {
		  					
		  					if (result.value) {

		  						window.location = "ficha-epidemiologica";

							}

						});

					} else {

						swal.fire({
								
							title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
							icon: "error",
							allowOutsideClick: false,
							confirmButtonText: "¡Cerrar!"

						});
						
					}

				},
				error: function(error) {

			        console.log("No funciona");
			        
			    }

			});

        } 

        else {

        	swal.fire({
								
				title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales, por favor revise el formulario!",
				icon: "error",
				allowOutsideClick: false,
				confirmButtonText: "¡Cerrar!"

			});
        }

    });

	//VALIDANDO DATOS DE LABORATORIO EN LA FICHA CONTRO Y SEGUIMIENTO

    $("#fichaControlLab").validate({

    	rules: {
     		nuevoTipoMuestra: { required: true, patron_texto: true},
     		nuevoNombreLaboratorio: { patron_numerosTexto: true},
     		nuevoFechaMuestra: { required: true},
     		nuevoFechaEnvio: { required: true},
     		nuevoCodLaboratorio: { required: true, patron_numerosLetras: true},
     		nuevoResponsableMuestra: { required: true, patron_texto: true},
     		nuevoObsMuestra: { patron_textoEspecial: true},
     		nuevoResultadoLaboratorio: { required: true},
     		nuevoFechaResultado: { required: true}
    	},

    	messages: {
       		nuevoResultadoLaboratorio : "Elija una opción"
		},

       	errorPlacement: function(label, element) {

       		if (element.attr("name") == "nuevoResultadoLaboratorio" ) {
            	
            	label.addClass('errorMsq');
           		element.parent().parent().append(label);

			} else {

				label.addClass('errorMsq');
				element.parent().append(label);

			}

        },

	});

	//GUARDANDO DATOS DE LABORATORIO EN LA FICHA CONTROL Y SEGUIMIENTO

	$("#fichaControlLab").on("click", ".btnGuardarLab", function() {

		if ($("#fichaControlLab").valid()) {

			console.log("GUARDAR LABORATORIO");

			var tipo_muestra = $("#nuevoTipoMuestra").val();
			var nombre_laboratorio = $("#nuevoNombreLaboratorio").val();
			var fecha_muestra = $("#nuevoFechaMuestra").val();	
			var fecha_envio = $("#nuevoFechaEnvio").val();
			var cod_laboratorio = $("#nuevoCodLaboratorio").val();		
			var responsable_muestra = $("#nuevoResponsableMuestra").val();
			var observaciones_muestra = $("#nuevoObsMuestra").val();		
			var resultado_laboratorio = $('input:radio[name="nuevoResultadoLaboratorio"]:checked').val();
			console.log("resultado_laboratorio", resultado_laboratorio);
			var fecha_resultado = $("#nuevoFechaResultado").val();				
			var id_ficha = $ ("#idFicha").val();
			console.log("id_ficha", id_ficha);

			var id_establecimiento = $("#nuevoEstablecimiento").val();
			var cod_asegurado = $("#nuevoCodAsegurado").val();
			var cod_afiliado = $("#nuevoCodAfiliado").val();
			var cod_empleador = $("#nuevoCodEmpleador").val();
			var nombre_empleador = $("#nuevoNombreEmpleador").val();
			var paterno = $("#nuevoPaternoPaciente").val();
			var materno = $("#nuevoMaternoPaciente").val();
			var nombre = $("#nuevoNombrePaciente").val();
			var id_departamento = $("#nuevoDepartamento").val();
			var documento_ci = $("#nuevoNroDocumentoPaciente").val();
			var sexo = $("#nuevoSexoPaciente").val();
			var fecha_nacimiento = $("#nuevoFechaNacPaciente").val();
			var telefono = $("#nuevoTelefonoPaciente").val();
			var email = "";
			var id_localidad = $("#nuevoLocalidad").val();
			var zona = "";
			var calle = "";
			var nro_calle = "";
			var id_usuario = $("#idUsuario").val();
			var foto = "vistas/img/covid_resultados/default/anonymous.png";

			var datos = new FormData();
			datos.append("guardarLaboratorioControl", 'guardarLaboratorioControl');
			datos.append("tipo_muestra", tipo_muestra);
			datos.append("nombre_laboratorio", nombre_laboratorio);
			datos.append("fecha_muestra", fecha_muestra);	
			datos.append("fecha_envio", fecha_envio);
			datos.append("cod_laboratorio", cod_laboratorio);	
			datos.append("responsable_muestra", responsable_muestra);
			datos.append("observaciones_muestra", observaciones_muestra);
			datos.append("resultado_laboratorio", resultado_laboratorio);
			datos.append("fecha_resultado", fecha_resultado);
			datos.append("id_ficha", id_ficha);

			datos.append("id_establecimiento", id_establecimiento);
			datos.append("cod_asegurado", cod_asegurado);
			datos.append("cod_afiliado", cod_afiliado);
			datos.append("cod_empleador", cod_empleador);
			datos.append("nombre_empleador", nombre_empleador);
			datos.append("paterno", paterno);	
			datos.append("materno", materno);
			datos.append("nombre", nombre);	
			datos.append("id_departamento", id_departamento);
			datos.append("documento_ci", documento_ci);
			datos.append("sexo", sexo);
			datos.append("fecha_nacimiento", fecha_nacimiento);
			datos.append("telefono", telefono);
			datos.append("email", email);
			datos.append("id_localidad", id_localidad);	
			datos.append("zona", zona);
			datos.append("calle", calle);
			datos.append("nro_calle", nro_calle);
			datos.append("id_usuario", id_usuario);
			datos.append("foto", foto);

			$.ajax({

				url:"ajax/laboratorios.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "html",
				success: function(respuesta) {
				
					if (respuesta == "ok") {

						swal.fire({
							
							icon: "success",
							title: "¡Los datos se guardaron correctamente!",
							showConfirmButton: true,
							allowOutsideClick: false,
							confirmButtonText: "Cerrar"

						}).then((result) => {
		  					
		  					if (result.value) {

		  						window.location = "ficha-epidemiologica";

							}

						});

					} else {

						swal.fire({
								
							title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
							icon: "error",
							allowOutsideClick: false,
							confirmButtonText: "¡Cerrar!"

						});
						
					}

				},
				error: function(error) {

			        console.log("No funciona");
			        
			    }

			});

		}
		else {

        	swal.fire({
								
				title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales, por favor revise el formulario!",
				icon: "error",
				allowOutsideClick: false,
				confirmButtonText: "¡Cerrar!"

			});
        }

	});

});

/*=============================================
FUNCIÓN PARA ACTUALIZAR UN CAMPO EDITADO DE LA FICHA EPIDEMIOLOGICA
=============================================*/

function actualizarCampoFicha(id_ficha, item, valor, tabla) {

	var datos = new FormData();

	datos.append("guardarCampoFicha", "guardarCampoFicha");
	datos.append("id_ficha", id_ficha);
	datos.append("item", item);
	datos.append("valor", valor);
	datos.append("tabla", tabla);

  $.ajax({

   	url:"ajax/fichas.ajax.php",
  	method: "POST",
  	data: datos,
  	cache: false,
  	contentType: false,
  	processData: false,
  	dataType: "html",
  	success: function(respuesta) {

	    if (respuesta == "ok") {

			toastr.success('El Dato se guardó correctamente.')

		} else {

			toastr.warning('¡Error! Falla 1 en la consulta a BD, no se modificaron.')
		}

  	},
	error: function(error) {

      	toastr.warning('¡Error! Falla 2 en la conexión a BD, no se modificaron.')
        
    }

	});

}

/*=============================================
BOTÓN EDITAR FICHA EPIDEMIOLOGICA COVID RESULTADOS
=============================================*/

$(document).on("click", "button.btnEditarFichaEpidemiologica", function() {
	
	var idFicha = $(this).attr("idFicha");

	window.location = "index.php?ruta=editar-ficha-epidemiologica&idFicha="+idFicha;

});

/*=============================================
BOTÓN AGREGAR RESULTADO DE LABORATORIO EN FICHA EPIDEMIOLOGICA 
=============================================*/

$(document).on("click", "button.btnAgregarResultadoLab", function() {
	
	var idFicha = $(this).attr("idFicha");

	window.location = "index.php?ruta=editar-ficha-epidemiologica-lab&idFicha="+idFicha;

});

/*=============================================
BOTÓN EDITAR FICHA CONTROL Y SEGUIMIENTO COVID RESULTADOS
=============================================*/

$(document).on("click", "button.btnEditarFichaControl", function() {
	
	var idFicha = $(this).attr("idFicha");

	window.location = "index.php?ruta=editar-ficha-control&idFicha="+idFicha;

});

/*=============================================
BOTÓN AGREGAR RESULTADO DE LABORATORIO EN FICHA CONTROL Y SEGUIMIENTO 
=============================================*/

$(document).on("click", "button.btnAgregarResultadoControlLab", function() {
	
	var idFicha = $(this).attr("idFicha");

	window.location = "index.php?ruta=editar-ficha-control-lab&idFicha="+idFicha;

});

/*=============================================
BOTÓN GENERERAR PDF PARA IMPRIMIR FICHA EPIDEMIOLÓGICA 
=============================================*/

$(document).on("click", "button.btnImprimirFichaEpidemiologica", function() {
	
	var idFicha = $(this).attr("idFicha");
	console.log("idFicha", idFicha);

	var datos = new FormData();

	datos.append("fichaEpidemiologicaPDF", "fichaEpidemiologicaPDF");
	datos.append("idFicha", idFicha);
	// datos.append("nombre_usuario", nombre_usuario);

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

		url: "ajax/fichas.ajax.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta) {

			//Para cerrar la alerta personalizada de loading
			swal.close();

			$('#ver-pdf').modal({

				show:true,
				backdrop:'static'

			});	

			PDFObject.embed("temp/ficha-"+idFicha+".pdf", "#view_pdf");

		}

	});

});

/*=============================================
BOTÓN GENERERAR PDF PARA IMPRIMIR FICHA CONTROL Y SEGUIMIENTO 
=============================================*/

$(document).on("click", "button.btnImprimirFichaControl", function() {
	
	var idFicha = $(this).attr("idFicha");
	console.log("idFicha", idFicha);

	var datos = new FormData();

	datos.append("fichaControlPDF", "fichaControlPDF");
	datos.append("idFicha", idFicha);
	// datos.append("nombre_usuario", nombre_usuario);

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

		url: "ajax/fichas.ajax.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta) {

			//Para cerrar la alerta personalizada de loading
			swal.close();

			$('#ver-pdf').modal({

				show:true,
				backdrop:'static'

			});	

			PDFObject.embed("temp/ficha-"+idFicha+".pdf", "#view_pdf");

		}

	});

});

//GUARDANDO DATOS DE FICHA EPIDEMIOLOGICA DINAMICAMENTE

// $("#fichaControlCentro").ready(function() {
	
// 	var id_ficha = $("#idFicha").val();
// 	var item = "";
// 	var valor = "";
// 	var tabla = "";

// 	// 1. DATOS DEL ESTABLECIMIENTO NOTIFICADOR

// 	$("#nuevoEstablecimiento").change(function() {

// 		item = "id_establecimiento";
// 		valor = $(this).val();
// 		tabla = "fichas"

// 		// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

// 		actualizarCampoFicha(id_ficha, item, valor, tabla)

// 		// SI EL VALOR ELEGIDO ES DIFERENTE DE POLICLINICO 10 DE NOVIEMBRE SE BORRA EL VALOR DE CONSULTORIO

// 		if (valor != "2") {

// 			item = "id_consultorio";
// 			valor = "";

// 			// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

// 			actualizarCampoFicha(id_ficha, item, valor, tabla)

// 		}

// 	});

// 	$("#nuevoConsultorio").change(function() {

// 		item = "id_consultorio";
// 		valor = $(this).val();
// 		tabla = "fichas"

// 		// ACTUALIZA UN VALOR MODIFICADO DE LA FICHA

// 		actualizarCampoFicha(id_ficha, item, valor, tabla)

// 	});

// });
