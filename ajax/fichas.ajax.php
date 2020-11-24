<?php
// namespace Dompdf;
require_once "../controladores/fichas.controlador.php";
require_once "../modelos/fichas.modelo.php";

require_once "../controladores/pacientes_asegurados.controlador.php";
require_once "../modelos/pacientes_asegurados.modelo.php";

require_once "../controladores/ant_epidemiologicos.controlador.php";
require_once "../modelos/ant_epidemiologicos.modelo.php";

require_once "../controladores/datos_clinicos.controlador.php";
require_once "../modelos/datos_clinicos.modelo.php";

require_once "../controladores/hospitalizaciones_aislamientos.controlador.php";
require_once "../modelos/hospitalizaciones_aislamientos.modelo.php";

require_once "../controladores/enfermedades_bases.controlador.php";
require_once "../modelos/enfermedades_bases.modelo.php";

require_once "../controladores/personas_contactos.controlador.php";
require_once "../modelos/personas_contactos.modelo.php";

require_once "../controladores/laboratorios.controlador.php";
require_once "../modelos/laboratorios.modelo.php";

require_once "../controladores/personas_notificadores.controlador.php";
require_once "../modelos/personas_notificadores.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

require_once "../controladores/departamentos.controlador.php";
require_once "../modelos/departamentos.modelo.php";

require_once "../controladores/establecimientos.controlador.php";
require_once "../modelos/establecimientos.modelo.php";

require_once "../controladores/consultorios.controlador.php";
require_once "../modelos/consultorios.modelo.php";

require_once "../controladores/localidades.controlador.php";
require_once "../modelos/localidades.modelo.php";

require_once "../controladores/paises.controlador.php";
require_once "../modelos/paises.modelo.php";

// require_once('../extensiones/dompdf/autoload.inc.php');

require_once('../extensiones/tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'cns-logo.png';
        $this->Image($image_file, 5, 5, 10, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 14);
        // Titulo
        $this->Cell(0, 0, 'FICHA EPIDEMIOLÓGICA Y SOLICITUD DE ESTUDIOS DE LABORATORIO', 0, 1, 'C', 0, '', 1);
        // Subtitulo
        $this->Cell(0, 0, 'COVID-19', 0, 1, 'C', 0, '', 1);

	}

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

class AjaxFichas {

	public $paterno_notificador; 
	public $materno_notificador;
	public $nombre_notificador; 
	public $telefono_notificador; 
	public $cargo_notificador; 
	
	/*=============================================
	CREAR UNA NUEVA FICHA EPIDEMIOLÓGICA
	=============================================*/

	public function ajaxCrearFichaEpidemiologica()	{

		/*=============================================
		ALMACENANDO LOS DATOS EN LA BD
		=============================================*/

		$datos = array( "id_establecimiento"	=> "", 
						"cod_establecimiento"	=> "", 
						"red_salud"     	    => "",
						"id_departamento"     	=> "",
						"id_localidad"  		=> "",
						"fecha_notificacion"    => "",
						"semana_epidemiologica" => "",
						"busqueda_activa"   	=> "",
						"paterno_notificador"   => $this->paterno_notificador,
						"materno_notificador"   => $this->materno_notificador,
						"nombre_notificador"   	=> $this->nombre_notificador,
						"cargo_notificador"   	=> $this->cargo_notificador,
						"tipo_ficha"   	     	=> "FICHA EPIDEMIOLOGICA"
						);	

		$respuesta = ControladorFichas::ctrCrearFicha($datos);

		echo $respuesta;

	}

	/*=============================================
	CREAR UNA NUEVA FICHA DE CONTROL Y SEGUIMIENTO
	=============================================*/

	public function ajaxCrearFichaControl()	{

		/*=============================================
		ALMACENANDO LOS DATOS EN LA BD
		=============================================*/

		$datos = array( "id_establecimiento"	=> "", 
						"cod_establecimiento"	=> "", 
						"red_salud"     	    => "",
						"id_departamento"     	=> "",
						"id_localidad"  		=> "",
						"fecha_notificacion"    => "",
						"semana_epidemiologica" => "",
						"busqueda_activa"   	=> "",
						"nro_control" 		  	=> "",
						"paterno_notificador"   => $this->paterno_notificador,
						"materno_notificador"   => $this->materno_notificador,
						"nombre_notificador"   	=> $this->nombre_notificador,
						"cargo_notificador"   	=> $this->cargo_notificador,
						"tipo_ficha"   	     	=> "FICHA CONTROL Y SEGUIMIENTO",
						);	

		$respuesta = ControladorFichas::ctrCrearFicha($datos);

		echo $respuesta;

	}

	// 1. DATOS ESTABLECIMIENTO NOTIFICADOR
	public $id_ficha;
	public $id_establecimiento;
	public $cod_establecimiento;
	public $id_consultorio;
	public $red_salud;
	public $id_departamento;
	public $id_localidad;
	public $fecha_notificacion;
	public $nro_control;
	public $semana_epidemiologica;
	public $busqueda_activa;

	// 2. IDENTIFICACIÓN DEL CASO PACIENTE
	public $cod_asegurado; 
	public $cod_afiliado; 
	public $cod_empleador; 
	public $nombre_empleador; 
	public $paterno; 
	public $materno; 
	public $nombre; 
	public $sexo; 
	public $nro_documento; 
	public $fecha_nacimiento; 
	public $edad; 
	public $id_departamento_paciente; 
	public $id_localidad_paciente; 
	public $id_pais_paciente; 
	public $zona; 
	public $calle; 
	public $nro_calle; 
	public $telefono; 
	public $nombre_apoderado; 
	public $telefono_apoderado; 

	// 3. ANTECEDENTES EPIDEMIOLOGICOS
	public $ocupacion; 
	public $ant_vacuna_influenza; 
	public $fecha_vacuna_influenza; 
	public $viaje_riesgo; 
	public $pais_ciudad_riesgo; 
	public $fecha_retorno; 
	public $nro_vuelo; 
	public $nro_asiento; 
	public $contacto_covid; 
	public $fecha_contacto_covid; 
	public $nombre_contacto_covid; 
	public $telefono_contacto_covid; 
	public $pais_contacto_covid; 
	public $departamento_contacto_covid; 
	public $localidad_contacto_covid; 

	// 4. DATOS CLÍNICOS
	public $fecha_inicio_sintomas;  
	public $malestares;
	public $malestares_otros; 
	public $estado_paciente; 
	public $fecha_defuncion; 
	public $diagnostico_clinico; 

	// 5. DATOS HOSPITALIZACIÓN AISLAMIENTO
	public $dias_notificacion; 
	public $dias_sin_sintomas;
	public $fecha_aislamiento; 
	public $lugar_aislamiento;
	public $fecha_internacion; 
	public $establecimiento_internacion; 
	public $ventilacion_mecanica; 
	public $terapia_intensiva; 
	public $fecha_ingreso_UTI;
	public $lugar_ingreso_UTI;
	public $tratamiento;
	public $tratamiento_otros; 

	// 6. ENFERMEDADES DE BASE O CONDICIONES DE RIESGO
	public $enf_estado; 
	public $enf_riesgo;
	public $enf_riesgo_otros; 

	// 8. LABORATORIOS
	public $estado_muestra;
	public $id_establecimiento_lab;
	public $tipo_muestra;
	public $fecha_muestra;
	public $fecha_envio;
	public $responsable_muestra;

	/*=============================================
	GUARDANDO DATOS EN LA FICHA EPIDEMIOLÓGICA
	=============================================*/

	public function ajaxGuardarFichaEpidemiologica()	{

		/*=============================================
		ALMACENANDO LOS DATOS EN LA BD
		=============================================*/

		$datos = array( "id_ficha"  				       => $this->id_ficha,
						"id_establecimiento"		       => $this->id_establecimiento, 
						"cod_establecimiento"	           => $this->cod_establecimiento,
						"id_consultorio"		       	   => $this->id_consultorio,  
						"red_salud"     	               => mb_strtoupper($this->red_salud,'utf-8'),
						"id_departamento"     	           => $this->id_departamento,
						"id_localidad"  		           => $this->id_localidad,
						"fecha_notificacion"     	       => $this->fecha_notificacion,
						"semana_epidemiologica"   	       => $this->semana_epidemiologica,
						"busqueda_activa"   	           => $this->busqueda_activa,
						"tipo_ficha"   	     		       => "FICHA EPIDEMIOLOGICA",
						"estado_ficha"   	     		   => "1",

						"cod_asegurado"		  	           => $this->cod_asegurado, 
						"cod_afiliado"	      	           => $this->cod_afiliado, 
						"cod_empleador"    		           => $this->cod_empleador,
						"nombre_empleador"    	           => $this->nombre_empleador,
						"paterno"     	      	           => $this->paterno,
						"materno"     	      	           => $this->materno,
						"nombre"     	      	           => $this->nombre,
						"sexo"     	          	           => $this->sexo,
						"nro_documento"    		           => $this->nro_documento,
						"fecha_nacimiento"    	           => $this->fecha_nacimiento,
						"edad"     	          	           => $this->edad,
						"id_departamento_paciente"    	   => $this->id_departamento_paciente,
						"id_localidad_paciente"  		   => $this->id_localidad_paciente,
						"id_pais_paciente"     	      	   => $this->id_pais_paciente,
						"zona"   	          	           => mb_strtoupper($this->zona,'utf-8'),
						"calle"   	          	           => mb_strtoupper($this->calle,'utf-8'),
						"nro_calle"   	      	           => $this->nro_calle,
						"telefono"   	      	           => $this->telefono,
						"nombre_apoderado"  	           => mb_strtoupper($this->nombre_apoderado,'utf-8'),
						"telefono_apoderado"  	           => $this->telefono_apoderado,

						"ocupacion"		  			       => mb_strtoupper($this->ocupacion,'utf-8'), 
						"ant_vacuna_influenza"	      	   => $this->ant_vacuna_influenza, 
						"fecha_vacuna_influenza"    	   => $this->fecha_vacuna_influenza,
						"viaje_riesgo"    	               => $this->viaje_riesgo,
						"pais_ciudad_riesgo"     	       => $this->pais_ciudad_riesgo,
						"fecha_retorno"     	      	   => $this->fecha_retorno,
						"nro_vuelo"     	      	       => $this->nro_vuelo,
						"nro_asiento"     	          	   => $this->nro_asiento,
						"contacto_covid"    		       => $this->contacto_covid,
						"fecha_contacto_covid"    	       => $this->fecha_contacto_covid,
						"nombre_contacto_covid"     	   => mb_strtoupper($this->nombre_contacto_covid,'utf-8'),
						"telefono_contacto_covid"    	   => $this->telefono_contacto_covid,
						"pais_contacto_covid"     	       => mb_strtoupper($this->pais_contacto_covid,'utf-8'),
						"departamento_contacto_covid"      => mb_strtoupper($this->departamento_contacto_covid,'utf-8'),
						"localidad_contacto_covid"   	   => mb_strtoupper($this->localidad_contacto_covid,'utf-8'),

						"fecha_inicio_sintomas"	           => $this->fecha_inicio_sintomas, 
						"malestares"                       => $this->malestares,
						"malestares_otros"    	           => mb_strtoupper($this->malestares_otros,'utf-8'),
						"estado_paciente"     	           => $this->estado_paciente,
						"fecha_defuncion"                  => $this->fecha_defuncion,
						"diagnostico_clinico"              => mb_strtoupper($this->diagnostico_clinico,'utf-8'),

						"fecha_aislamiento"	               => $this->fecha_aislamiento, 
						"lugar_aislamiento"     	       => mb_strtoupper($this->lugar_aislamiento,'utf-8'),
						"fecha_internacion"    	           => $this->fecha_internacion,
						"establecimiento_internacion"      => mb_strtoupper($this->establecimiento_internacion,'utf-8'),
						"ventilacion_mecanica"             => $this->ventilacion_mecanica,
						"terapia_intensiva"   	           => $this->terapia_intensiva,
						"fecha_ingreso_UTI"   	           => $this->fecha_ingreso_UTI,

						"enf_estado"	                   => $this->enf_estado, 
						"enf_riesgo"                       => $this->enf_riesgo,
						"enf_riesgo_otros"                 => mb_strtoupper($this->enf_riesgo_otros,'utf-8'),

						"estado_muestra"		           => $this->estado_muestra, 
						"id_establecimiento_lab"	       => $this->id_establecimiento_lab, 
						"tipo_muestra"     	               => mb_strtoupper($this->tipo_muestra,'utf-8'),
						"fecha_muestra"  		           => $this->fecha_muestra,
						"fecha_envio"     	               => $this->fecha_envio,
						"responsable_muestra" 	           => mb_strtoupper($this->responsable_muestra),

						"paterno_notificador"	           => mb_strtoupper($this->paterno_notificador,'utf-8'), 
						"materno_notificador"              => mb_strtoupper($this->materno_notificador,'utf-8'),
						"nombre_notificador"               => mb_strtoupper($this->nombre_notificador,'utf-8'),
						"telefono_notificador"             => $this->telefono_notificador,
						"cargo_notificador"                => mb_strtoupper($this->cargo_notificador,'utf-8'),

						);	

		// var_dump($datos);

		$respuesta = ControladorFichas::ctrGuardarFichaEpidemiologica($datos);

		echo $respuesta;

	}

	/*=============================================
	GUARDANDO DATOS EN LA FICHA DE CONTROL Y SEGUIMIENTO
	=============================================*/

	public function ajaxGuardarFichaControl()	{

		/*=============================================
		ALMACENANDO LOS DATOS EN LA BD
		=============================================*/

		$datos = array( "id_ficha"  				       => $this->id_ficha,
						"id_establecimiento"		       => $this->id_establecimiento, 
						"id_consultorio"		       	   => $this->id_consultorio,
						"id_departamento"     	           => $this->id_departamento,
						"id_localidad"  		           => $this->id_localidad,
						"fecha_notificacion"     	       => $this->fecha_notificacion,
						"nro_control"   		           => $this->nro_control,
						"tipo_ficha"   	     		       => "FICHA CONTROL Y SEGUIMIENTO",
						"estado_ficha"   	     		   => "1",

						"cod_asegurado"		  	           => $this->cod_asegurado, 
						"cod_afiliado"	      	           => $this->cod_afiliado, 
						"cod_empleador"    		           => $this->cod_empleador,
						"nombre_empleador"    	           => $this->nombre_empleador,
						"paterno"     	      	           => $this->paterno,
						"materno"     	      	           => $this->materno,
						"nombre"     	      	           => $this->nombre,
						"sexo"     	          	           => $this->sexo,
						"nro_documento"    		           => $this->nro_documento,
						"fecha_nacimiento"    	           => $this->fecha_nacimiento,
						"edad"     	          	           => $this->edad,
						"telefono"     	          	       => $this->telefono,
					
						"dias_notificacion"	               => $this->dias_notificacion, 
						"dias_sin_sintomas"	               => $this->dias_sin_sintomas, 
						"fecha_aislamiento"	               => $this->fecha_aislamiento, 
						"lugar_aislamiento"     	       => mb_strtoupper($this->lugar_aislamiento,'utf-8'),
						"fecha_internacion"    	           => $this->fecha_internacion,
						"establecimiento_internacion"      => mb_strtoupper($this->establecimiento_internacion,'utf-8'),
						"fecha_ingreso_UTI"   	           => $this->fecha_ingreso_UTI,
						"lugar_ingreso_UTI"   	           => $this->lugar_ingreso_UTI,
						"ventilacion_mecanica"             => $this->ventilacion_mecanica,
						"tratamiento"       		       => $this->tratamiento,
						"tratamiento_otros"         	   => mb_strtoupper($this->tratamiento_otros,'utf-8'),

						"tipo_muestra"     	               => mb_strtoupper($this->tipo_muestra,'utf-8'),
						"fecha_muestra"  		           => $this->fecha_muestra,
						"fecha_envio"     	               => $this->fecha_envio,
						"responsable_muestra" 	           => mb_strtoupper($this->responsable_muestra),

						"paterno_notificador"	           => mb_strtoupper($this->paterno_notificador,'utf-8'), 
						"materno_notificador"              => mb_strtoupper($this->materno_notificador,'utf-8'),
						"nombre_notificador"               => mb_strtoupper($this->nombre_notificador,'utf-8'),
						"telefono_notificador"             => $this->telefono_notificador,
						"cargo_notificador"                => mb_strtoupper($this->cargo_notificador,'utf-8'),

						);	

		$respuesta = ControladorFichas::ctrGuardarFichaControl($datos);

		echo $respuesta;

	}

	public $item; 
	public $valor;
	public $tabla;

	public function ajaxGuardarCampoFicha()	{

		/*=============================================
		ALMACENANDO LOS DATOS EN LA BD
		=============================================*/

		$id_ficha = $this->id_ficha;
		$item = $this->item;
		$valor = mb_strtoupper($this->valor,'utf-8');
		$tabla = $this->tabla; 	

		$respuesta = ControladorFichas::ctrGuardarCampoFichaEpidemiologica($id_ficha, $item, $valor, $tabla);

		echo $respuesta;

	}

	/*=============================================
	MOSTRAR EN PDF FICHA EPIDEMIOLÓGICA
	=============================================*/

	public function ajaxMostrarFichaEpidemiologicaPDF()	{

		/*=============================================
	    DATOS SECCION 1. DATOS DEL ESTABLECIMIENTO NOTIFICADOR
	    =============================================*/
		
		$item = "id_ficha";
		$valor = $this->idFicha;

		$ficha = ControladorFichas::ctrMostrarDatosFicha($item, $valor);

	    //TRAEMOS LOS DATOS DE DEPARTAMENTO

	    $item = "id";
	    $valor = $ficha["id_departamento"];
	    $departamento = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);

	    //TRAEMOS LOS DATOS DE ESTABLECIMIENTO

	    $valor = $ficha["id_establecimiento"];
	    $establecimiento = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

	    //TRAEMOS LOS CONSULTORIOS

	    $valor = $ficha["id_consultorio"];
	    $consultorio = ControladorConsultorios::ctrMostrarConsultorios($item, $valor);

	    //TRAEMOS LOS DATOS DE LOCALIDAD

	    $valor = $ficha["id_localidad"];
	    $localidad = ControladorLocalidades::ctrMostrarLocalidades($item, $valor);

	    /*=============================================
	    DATOS SECCION 2. IDENTIFICACION DEL CASO/PACIENTE
	    =============================================*/

	    $item = "id_ficha";
	    $valor = $this->idFicha;

	    $pacienteAsegurado = ControladorPacientesAsegurados::ctrMostrarPacientesAsegurados($item, $valor);

			//TRAEMOS LOS DATOS DE DEPARTAMENTO

	    $item = "id";
	    $valor_depto = $pacienteAsegurado["id_departamento_paciente"];

	    $departamento_paciente = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor_depto);

	    // var_dump($departamento_paciente);

	    //TRAEMOS LOS DATOS DE LOCALIDAD

	    $valor_localidad = $pacienteAsegurado["id_localidad_paciente"];

	    $localidad_paciente = ControladorLocalidades::ctrMostrarLocalidades($item, $valor_localidad);

	    //TRAEMOS LOS DATOS DE PAIS

	    $valor_pais = $pacienteAsegurado["id_pais_paciente"];

	    $pais_paciente = ControladorPaises::ctrMostrarPaises($item, $valor_pais);

	    /*=============================================
	    DATOS SECCION 3. ANTECEDENTES EPIDEMIOLOGICOS
	    =============================================*/

	    $item = "id_ficha";
	    $valor = $this->idFicha;

	    $ant_epidemiologicos = ControladorAntEpidemiologicos::ctrMostrarAntEpidemiologicos($item, $valor);

	    /*=============================================
	    DATOS SECCION 4. DATOS CLINICOS
	    =============================================*/

	    $item = "id_ficha";
	    $valor = $this->idFicha;

	    $datos_clinicos = ControladorDatosClinicos::ctrMostrarDatosClinicos($item, $valor);

	    /*=============================================
	    DATOS SECCION 5. DATOS EN CASO DE HOSPITALIZACIÓN Y/O AISLAMIENTO
	    =============================================*/

	    $item = "id_ficha";
	    $valor = $this->idFicha;

	    $hospitalizaciones_aislamientos = ControladorHospitalizacionesAislamientos::ctrMostrarHospitalizacionesAislamientos($item, $valor);

	    /*=============================================
	    DATOS SECCION 6. ENFERMEDADES DE BASE O CONDICIONES DE RIESGO
	    =============================================*/

	    $item = "id_ficha";
	    $valor = $this->idFicha;

	    $enfermedades_bases = ControladorEnfermedadesBases::ctrMostrarEnfermedadesBases($item, $valor);

	    /*=============================================
	    DATOS SECCION 8. LABORATORIO
	    =============================================*/

	    $item = "id_ficha";
	    $valor = $this->idFicha;

	    $laboratorios = ControladorLaboratorios::ctrMostrarLaboratorios($item, $valor);

	    // TRAEMOS LOS DATOS DE ESTABLECIMIENTO PARA LABORATORIO

	    $item = "id";
	    $valor = $laboratorios["id_establecimiento"];

	    $establecimiento_lab = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

	    /*=============================================
	    DATOS SECCION PERSONAL QUE NOTIFICA
	    =============================================*/

	    $item = "id_ficha";
	    $valor = $this->idFicha;

	    $persona_notificador = ControladorPersonasNotificadores::ctrMostrarPersonasNotificadores($item, $valor);

		// Extend the TCPDF class to create custom Header and Footer

		$pdf = new MYPDF('P', 'mm', 'letter', true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('CNS Potosí');
		$pdf->SetTitle('ficha-'.$valor);
		$pdf->SetSubject('Ficha Epidemiologica Covid-19 CNS');
		$pdf->SetKeywords('TCPDF, PDF, CNS, Reporte, Ficha Epidemiologica,Covid-19');

		$pdf->setPrintHeader(false); 
		$pdf->setPrintFooter(false);

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(5, 5, 5, 0);
		$pdf->SetAutoPageBreak(true, 5); 
		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(5);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('Helvetica', '', 8);

		$pdf->SetPrintFooter(false);

		// add a page
		$pdf->AddPage();

		$content = '';

		  $content .= '

		  <html lang="es">
				<head>

					<style>
						
						body {
							font-size: 21px;
							margin: 0;
							padding: 0;
						}

						.content div{

							line-height: 0px;

						}

						.bg-dark {

							background-color: #444;
							color: #fff;
							text-align: center;
							line-height: 0px;
						
						}

						.bg-dark span {

							line-height: 7px;
							font-weight: bold;

						}

						.font-weight-bold {

							font-weight: bold;

						}

						.titulo {

							text-align: center;
							line-height: 4px;

						}

						.cod_ficha {

							margin-top: 0px;
							text-align: right;
							
						}

						table {

						  line-height: 6px;

						}

						.personas_contactos {

							line-height: 0px;

						}

						td {

						  margin-top: 0px;

						}

						th {

						  text-align: center;

						}

						.mensaje {

							text-align: center;
							line-height: 7px;

						}

						.laboratorios .mensaje {

							margin-top: 0px;
							text-align: center;
							line-height: 0px;

						}

					</style>

				</head>

				<body>

					<div class="content" border="1">

						<div style="line-height: 2px;">
						
							<h3 class="titulo">FICHA EPIDEMIOLÓGICA Y SOLICITUD DE ESTUDIOS DE LABORATORIO COVID-19</h3>

							<h4 class="cod_ficha"></h4>

						</div>

						<div class="datos_establecimiento">
					      
					    <div class="bg-dark">

					      <span>1. DATOS DEL ESTABLECIMIENTO NOTIFICADOR</span>
					      
					    </div>

					    <table>
					    	
					    	<tr>
					    		<td width="300px">
					    			<label class="font-weight-bold">Establecimiento de Salud: </label> '.$establecimiento["nombre_establecimiento"].'
					    		</td>
					    		<td width="150px">
					    			<label class="font-weight-bold">Cod. Estab: </label> '.$ficha["cod_establecimiento"].'
					    		</td>
					    		<td width="150px">
					    			<label class="font-weight-bold">Consultorio: </label> '.$consultorio["nombre_consultorio"].'
					    		</td>
					    		<td width="150px">
					    			<label class="font-weight-bold">Red de Salud:</label> '.$ficha["red_salud"].'
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="200px">
					    			<label class="font-weight-bold">Departamento:</label> '.$departamento["nombre_depto"].'
					    		</td>
					    		<td width="200px">
					    			<label class="font-weight-bold">Localidad:</label> '.$localidad["nombre_localidad"].'
					    		</td>
					    		<td width="200px">';

					    		if ($ficha["fecha_notificacion"] == "0000-00-00") {
					    			
					    			$content .= 
					    			'<label class="font-weight-bold">Fecha de Notificación:</label>';

					    		} else {

					    			$content .= 
					    			'<label class="font-weight-bold">Fecha de Notificación:</label> '.date("d/m/Y", strtotime($ficha["fecha_notificacion"]));

					    		}

					    		$content .=
					    		'</td>
					    		<td width="150px">';

					    		if ($ficha["semana_epidemiologica"] == "0") {
					    			
					    			$content .= 
					    			'<label class="font-weight-bold">Sem. Epidemiológica:</label>';

					    		} else {

					    			$content .= 
					    			'<label class="font-weight-bold">Sem. Epidemiológica:</label> '.$ficha["semana_epidemiologica"];

					    		}

					    		$content .=
					    		'</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="350px">

					    			<label class="font-weight-bold">Caso identificado por búsqueda activa:</label> '.$ficha["busqueda_activa"].'
					    			
					    		</td>
					    	</tr>

					    </table>

					  </div>

					  <div class="paciente">
					      
					    <div class="bg-dark py-1 text-center text-white">

					      <span>2. IDENTIFICACIÓN DEL CASO/PACIENTE</span>
					      
					    </div>

					    <table>
					    	
					    	<tr>
					    		<td width="250px">
					    			<label class="font-weight-bold">Cod. Asegurado:</label> '.$pacienteAsegurado['cod_asegurado'].'
					    		</td>
					    		<td width="250px">
					    			<label class="font-weight-bold">Cod. Afiliado:</label> '.$pacienteAsegurado['cod_afiliado'].'
					    		</td>
					    		<td width="250px">
					    			<label class="font-weight-bold">Cod. Empleador:</label> '.$pacienteAsegurado['cod_empleador'].'
					    		</td>
					    	</tr>

					    </table>

					     <table>

					    	<tr>
					    		<td width="800px">

					    			<label class="font-weight-bold">Nombre Empleador:</label> '.$pacienteAsegurado['nombre_empleador'].'
					    			
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="400px">
					    			<label class="font-weight-bold">Apellido(s) y Nombre(s):</label> '.$pacienteAsegurado['paterno'].' '.$pacienteAsegurado['materno'].' '.$pacienteAsegurado['nombre'].'
					    		</td>
					    		<td width="200px">
					    			<label class="font-weight-bold">Sexo:</label> '.$pacienteAsegurado['sexo'].'
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="250px">
					    			<label class="font-weight-bold">N° Carnet de Indentidad:</label> '.$pacienteAsegurado['nro_documento'].'
					    		</td>
					    		<td width="250px">';
					    		if ($pacienteAsegurado['fecha_nacimiento'] == "0000-00-00") {
					    			
					    			$content .= 
					    			'<label class="font-weight-bold">Fecha de Nacimiento:</label>';

					    		} else {

					    			$content .= 
					    			'<label class="font-weight-bold">Fecha de Nacimiento:</label> '.date("d/m/Y", strtotime($pacienteAsegurado['fecha_nacimiento']));

					    		}

					    		$content .=
					    		'</td>
					    		<td width="100px">
					    			<label class="font-weight-bold">Edad:</label> '.$pacienteAsegurado['edad'].'
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="300px">
					    			<label class="font-weight-bold">Lugar de residencia, Departamento:</label> '.$departamento_paciente["nombre_depto"].'
					    		</td>
					    		<td width="200px">
					    			<label class="font-weight-bold">Localidad:</label> '.$localidad_paciente["nombre_localidad"].'
					    		</td>
					    		<td width="150px">
					    			<label class="font-weight-bold">País:</label> '.$pais_paciente["nombre_pais"].'
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="250px">
					    			<label class="font-weight-bold">Zona:</label> '.$pacienteAsegurado['zona'].'
					    		</td>
					    		<td width="250px">
					    			<label class="font-weight-bold">Dirección:</label> '.$pacienteAsegurado['calle'].' '.$pacienteAsegurado['nro_calle'].'
					    		</td>
					    		<td width="200px">
					    			<label class="font-weight-bold">Teléfono:</label> '.$pacienteAsegurado['telefono'].'
					    		</td>
					    	</tr>

					    </table>
					    
					    <hr>

					    <table>

					    	<tr>
					    		
					    		<td width="450px">
					    			<label class="font-weight-bold">Si es menor de edad Nombre del Padre/Madre o apoderado:</label> '.$pacienteAsegurado['nombre_apoderado'].'
					    		</td>
					    		<td width="200px">
					    			<label class="font-weight-bold">Teléfono Apoderado:</label> '.$pacienteAsegurado['telefono_apoderado'].'
					    		</td>

					    	</tr>

					    </table>

					  </div>

					  <div class="antecedentes_epidemiologicos">
					      
					    <div class="bg-dark py-1 text-center text-white">

					      <span>3. ANTECEDENTES EPIDEMIOLOGICOS</span>
					      
					    </div>

					    <table>
					    	
					    	<tr>
					    		<td colspan="2" width="500px">
					    			<label class="font-weight-bold">Ocupación: </label> '.$ant_epidemiologicos['ocupacion'].'
					    		</td>
					    	</tr>
					    	<tr>
					    		<td width="400px">
					    			<label class="font-weight-bold">Antecedentes de vacunación para influenza: </label> '.$ant_epidemiologicos['ant_vacuna_influenza'].'
					    		</td>
					    		<td width="200px">';
					    		if ($ant_epidemiologicos['fecha_vacuna_influenza'] == "0000-00-00") {
					    			
					    			$content .= 
					    			'<label class="font-weight-bold">Fecha de Vacunación:</label>';

					    		} else {

					    			$content .= 
					    			'<label class="font-weight-bold">Fecha de Vacunación:</label> '.date("d/m/Y", strtotime($ant_epidemiologicos['fecha_vacuna_influenza']));

					    		}

					    		$content .=
					    		'</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="700px">
					    			<label class="font-weight-bold">¿Tuvo un viaje a un lugar de riesgo dentro o fuera del pais?</label> '.$ant_epidemiologicos['viaje_riesgo'].'
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="500px">
					    			<label class="font-weight-bold">¿Dondé (país y ciudad)?:</label> '.$ant_epidemiologicos['pais_ciudad_riesgo'].'
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="200px">';

					    		if ($ant_epidemiologicos['fecha_retorno'] == "0000-00-00") {
					    			
					    			$content .= 
					    			'<label class="font-weight-bold">Fecha retorno de Viaje:</label>';

					    		} else {

					    			$content .= 
					    			'<label class="font-weight-bold">Fecha retorno de Viaje:</label> '.date("d/m/Y", strtotime($ant_epidemiologicos['fecha_retorno']));

					    		}

					    		$content .=
					    		'</td>

					    		<td width="200px">
					    			<label class="font-weight-bold">Empresa:</label> '.$ant_epidemiologicos['empresa_vuelo'].'	    			
					    		</td>	    	
					    		<td width="100px">
					    			<label class="font-weight-bold">N° Vuelo:</label> '.$ant_epidemiologicos['nro_vuelo'].'
					    		</td>
					    		<td width="100px">
					    			<label class="font-weight-bold">N° Asiento:</label> '.$ant_epidemiologicos['nro_asiento'].'	    			
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="550px">
					    			<label class="font-weight-bold">¿Tuvo contacto con un caso confirmado de COVID-19 en los 14 días previos al inicio de sintomas, en domicilio o establecimiento de salud?:</label> '.$ant_epidemiologicos['contacto_covid'].'
					    		</td>
					    		<td width="150px">';

					    		if ($ant_epidemiologicos['fecha_contacto_covid'] == "0000-00-00") {
					    			$content .= 
					    			'<label class="font-weight-bold">Fecha de Contacto:</label>';

					    		} else {

										$content .= 
					    			'<label class="font-weight-bold">Fecha de Contacto:</label> '.date("d/m/Y", strtotime($ant_epidemiologicos['fecha_contacto_covid']));					    			

					    		}

									$content .=
					    		'</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="400px">
					    			<label class="font-weight-bold">Apellido(s) y Nombre(s) (del caso positivo):</label> '.$ant_epidemiologicos['nombre_contacto_covid'].'
					    		</td>
					    		<td width="200px">
					    			<label class="font-weight-bold">Teléfono (del caso positivo):</label> '.$ant_epidemiologicos['telefono_contacto_covid'].'
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td colspan="3" width="300px">
					    			<label class="font-weight-bold">Lugar de contacto con el caso positivo:</label>
					    		</td>
					    	</tr>
					    	<tr>
					    		<td width="200px">
					    			<label class="font-weight-bold">País:</label> '.$ant_epidemiologicos['pais_contacto_covid'].'   			
					    		</td>	    	
					    		<td width="300px">
					    			<label class="font-weight-bold">Departamento/Estado:</label> '.$ant_epidemiologicos['departamento_contacto_covid'].'
					    		</td>
					    		<td width="200px">
					    			<label class="font-weight-bold">Localidad:</label> '.$ant_epidemiologicos['localidad_contacto_covid'].'
					    		</td>
					    	</tr>

					    </table>

					  </div>

					  <div class="datos_clinicos">
					      
					    <div class="bg-dark py-1 text-center text-white">

					      <span>4. DATOS CLINICOS</span>
					      
					    </div>

					    <table>
					    	
					    	<tr>
					    		<td width="200px">';

					    		if ($datos_clinicos['fecha_inicio_sintomas'] == "0000-00-00") {
					    			$content .= 
					    			'<label class="font-weight-bold">Fecha de inicio de síntomas:</label>';

					    		} else {

										$content .= 
					    			'<label class="font-weight-bold">Fecha de inicio de síntomas:</label> '.date("d/m/Y", strtotime($datos_clinicos['fecha_inicio_sintomas']));					    			

					    		}

									$content .=
					    		'</td>
					    	</tr>
					    	<tr>
					    		<td width="650px">
					    			'.$datos_clinicos['malestares'].','.$datos_clinicos['malestares_otros'].'
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="400px">
					    			<label class="font-weight-bold">Estado actual del paciente (al momento del reporte):</label> '.$datos_clinicos['estado_paciente'].'
					    		</td>
					    		<td width="200px">';

					    		if ($datos_clinicos['fecha_defuncion'] == "0000-00-00") {
					    			$content .= 
					    			'<label class="font-weight-bold">Fecha de defunción:</label>';

					    		} else {

										$content .= 
					    			'<label class="font-weight-bold">Fecha de defunción:</label> '.date("d/m/Y", strtotime($datos_clinicos['fecha_defuncion']));					    			
					    		}

									$content .=  			
					    		'</td>
					    	</tr>
					    	<tr>
					    		<td colspan="2" width="400px">
					    			<label class="font-weight-bold">Diagnostico clínico:</label> '.$datos_clinicos['diagnostico_clinico'].'  			
					    		</td>
					    	</tr>

					    </table>

					  </div>

					  <div class="hospitalizacion_aislamiento">
					      
					    <div class="bg-dark py-1 text-center text-white">

					      <span>5. DATOS EN CASO DE HOSPITALIZACIÓN Y/O AISLAMIENTO</span>
					      
					    </div>

					    <table>
					    	
					    	<tr>
					    		<td width="200px">';

					    		if ($hospitalizaciones_aislamientos['fecha_aislamiento'] == "0000-00-00") {
					    			$content .= 
					    			'<label class="font-weight-bold">Fecha de Aislamiento:</label>';

					    		} else {

										$content .= 
					    			'<label class="font-weight-bold">Fecha de Aislamiento:</label> '.date("d/m/Y", strtotime($hospitalizaciones_aislamientos['fecha_aislamiento']));					    			
					    		}

									$content .=  
					    		'</td>
					    		<td width="300px">
					    			<label class="font-weight-bold">Lugar de Aislamiento: </label> '.$hospitalizaciones_aislamientos['lugar_aislamiento'].'
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="200px">';

					    		if ($hospitalizaciones_aislamientos['fecha_internacion'] == "0000-00-00") {
					    			$content .= 
					    			'<label class="font-weight-bold">Fecha de Internación:</label>';

					    		} else {

										$content .= 
					    			'<label class="font-weight-bold">Fecha de Internación:</label> '.date("d/m/Y", strtotime($hospitalizaciones_aislamientos['fecha_internacion']));	

					    		}

									$content .=  
					    		'</td>
					    		<td width="400px">
					    			<label class="font-weight-bold">Establecimiento de salud de Internación:</label> '.$hospitalizaciones_aislamientos['establecimiento_internacion'].'   			
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="200px">
					    			<label class="font-weight-bold">Ventilación mecánica</label> '.$hospitalizaciones_aislamientos['ventilacion_mecanica'].'
					    		</td>
					    		<td width="200px">
					    			<label class="font-weight-bold">Terapia intensiva:</label> '.$hospitalizaciones_aislamientos['terapia_intensiva'].'
					    		</td>
					    		<td width="200px">';

					    		if ($hospitalizaciones_aislamientos['fecha_ingreso_UTI'] == "0000-00-00") {
					    			$content .= 
					    			'<label class="font-weight-bold">Fecha Ingreso UTI:</label>';

					    		} else {

										$content .= 
					    			'<label class="font-weight-bold">Fecha Ingreso UTI:</label> '.date("d/m/Y", strtotime($hospitalizaciones_aislamientos['fecha_ingreso_UTI']));	

					    		}

									$content .=  
					    		'</td>
					    	</tr>

					    </table>

					  </div>

					  <div class="enfermedades_base">
					      
					    <div class="bg-dark py-1 text-center text-white">

					      <span>6. ENFERMEDADES DE BASE O CONDICIONES DE RIESGO</span>
					      
					    </div>

					    <table>
					    	
					    	<tr>
					    		<td width="200px">
					    			<label class="font-weight-bold">'.$enfermedades_bases['enf_estado'].' </label> 
					    		</td>
					    	</tr>
					    	<tr>
					    		<td width="650px">';

					    		if ($enfermedades_bases['enf_estado'] == "PRESENTA") {

					    				$content .= $enfermedades_bases['enf_riesgo'];

					    		}
					    		$content .=  
					    		'</td>
					    	</tr>

					    </table>

					  </div>

					  <div class="personas_contactos">
					      
					    <div class="bg-dark">

					      <span>7. DATOS DE PERSONAS CON LAS QUE EL CASO SOSPECHOSO ESTUVO EN CONTACTO (desde el inicio de los sintomas)</span>
					      
					    </div>

					    <table border="1">
					    	
					    	<thead>

				          <tr>
				            <th width="180px">APELLIDO(S) Y NOMBRE(S)</th>
				            <th width="70px">RELACIÓN</th>
				            <th width="40px">EDAD</th>
				            <th width="60px">TELEFÓNO</th>
				            <th width="150px">DIRECCIÓN</th>
				            <th width="100px">FECHA CONTACTO</th>
				            <th width="123px">LUGAR DE CONTACTO</th>
				          </tr>
				          
				        </thead>

				        <tbody>';

				        /*=============================================
						    DATOS SECCION 7. DATOS DE PERSONAS CON LAS QUE EL CASO SOSPECHOSO ESTUVO EN CONTACTO
						    =============================================*/

				        $item = "id_ficha";
	              $valor = $this->idFicha;

	              $personas_contactos = ControladorPersonasContactos::ctrMostrarPersonasContactos($item, $valor);

	              foreach ($personas_contactos as $value) {

	                $content .=  
	                '<tr>
	                  <td width="180px">'.$value["paterno_contacto"].' '.$value["materno_contacto"].'  '.$value["nombre_contacto"].'</td>
	                  <td width="70px">'.$value["relacion_contacto"].'</td>
	                  <td width="40px">'.$value["edad_contacto"].'</td>
	                  <td width="60px">'.$value["telefono_contacto"].'</td>
	                  <td width="150px">'.$value["direccion_contacto"].'</td>
	                  <td width="100px">'.date("d/m/Y", strtotime($value["fecha_contacto"])).'</td>
	                  <td width="123px">'.$value["lugar_contacto"].'</td>
	                </tr>';
                }

				        $content .= 
				        '</tbody>

					    </table>

					  </div>

					  <div class="laboratorios">
					      
					    <div class="bg-dark py-1 text-center text-white">

					      <span>8. LABORATORIOS</span>
					      
					    </div>

					    <table>
					    	
					    	<tr>
					    		<td width="200px">
					    			<label class="font-weight-bold">Se tomó muestra para Laboratorio: </label> '.$laboratorios['estado_muestra'].'
					    		</td>
					    		<td width="300px">
					    			<label class="font-weight-bold">Lugar de toma de muestra: </label> '.$establecimiento_lab['nombre_establecimiento'].'
					    		</td>
					    		<td width="250px">
					    			<label class="font-weight-bold">Tipo de muestra tomada:</label> '.$laboratorios['tipo_muestra'].'
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="450px">
					    			<label class="font-weight-bold">Nombre de Lab. que procesara la muestra:</label> '.$laboratorios['nombre_laboratorio'].'
					    		</td>
					    		<td width="150px">';

					    		if ($laboratorios['fecha_muestra'] == "0000-00-00") {
					    			$content .= 
					    			'<label class="font-weight-bold">Fecha de toma de muestra:</label>';

					    		} else {

										$content .= 
					    			'<label class="font-weight-bold">Fecha de toma de muestra:</label> '.date("d/m/Y", strtotime($laboratorios['fecha_muestra']));	

					    		}

									$content .=  
					    		'</td>
					    		<td width="150px">';

					    		if ($laboratorios['fecha_envio'] == "0000-00-00") {
					    			$content .= 
					    			'<label class="font-weight-bold">Fecha de Envío:</label>';

					    		} else {

										$content .= 
					    			'<label class="font-weight-bold">Fecha de Envío:</label> '.date("d/m/Y", strtotime($laboratorios['fecha_envio']));	

					    		}

									$content .=  
					    		'</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="300px">
					    			<label class="font-weight-bold" style="line-height: 18px; margin-bottom: 0px;">Responsable de Toma de Muestra:</label> '.$laboratorios['responsable_muestra'].'
					    		</td>
					    		<td width="350px">
					    			<label class="font-weight-bold" style="line-height: 18px; margin-bottom: 0px;">Firma y Sello</label>
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td colspan="2" width="700px">
					    			<label class="my-0 font-weight-bold">Observaciones:</label> '.$laboratorios['observaciones_muestra'].'
					    		</td>
					    	</tr>
					    	<tr>
					    		<td width="300px">
					    			<label class="my-0 font-weight-bold">Resultado:</label> '.$laboratorios['resultado_laboratorio'].'
					    		</td>
					    		<td width="250px">';
					    		if ($laboratorios['fecha_resultado'] == "0000-00-00") {
					    			$content .= 
					    			'<label class="font-weight-bold">Fecha de Resultado:</label>';

					    		} else {

										$content .= 
					    			'<label class="font-weight-bold">Fecha de Resultado:</label> '.date("d/m/Y", strtotime($laboratorios['fecha_resultado']));	

					    		}

									$content .=  
					    		'</td>
					    		<td width="150px">
					    			<h2 style="line-height: 0px;">Cod Laboratorio '.$laboratorios['cod_laboratorio'].'</h2>
					    		</td>
					    	</tr>
					    </table>

					    <hr>

					    <table>

					    	<tr>
					    		<td colspan="2" width="700px">
					    			<label class="font-weight-bold">DATOS DEL PERSONAL QUE NOTIFICA</label>
					    		</td>
					    	</tr>
					    	<tr>
					    		<td width="350px">
					    			<label class="font-weight-bold">APELLIDO(S) Y NOMBRE(S):</label> '.$persona_notificador['paterno_notificador'].' '.$persona_notificador['materno_notificador'].' '.$persona_notificador['nombre_notificador'].'
					    		</td>
					    		<td width="350px">
					    			<label class="font-weight-bold">Teléfono:</label> '.$persona_notificador['telefono_notificador'].'
					    		</td>
					    	</tr>

					    </table>

					    <table>
					    	
					    	<tr>
					    		<td width="350px">
					    			<label class="font-weight-bold" style="line-height: 18px;">Firma y Sello</label>
					    		</td>
					    		<td width="350px">
					    			<label class="font-weight-bold" style="line-height: 18px;">Sello del EESS</label>
					    		</td>
					    	</tr>

					    </table>

					    <table border="1">

					    	<tr>
					    		<td width="714px">
					    			<span class="mensaje font-weight-bold">Este formulario tiene el carácter de declaración jurada que realiza el equipo de salud, contiene información sujeta a vigilancia epidemiológica, por esta razón debe ser llenada correctamente en las secciones necesarias y enviadas oprotunamente</span>
					    		</td>
					    	</tr>

					    </table>

					  </div>

					</div>
					
				</body>

			</html>';
			
		// Reconociendo la estructura HTML
		$pdf->writeHTML($content, true, 0, true, true);

		// Insertando el Logo
		$image_file = K_PATH_IMAGES.'cns-logo-simple.png';

		$pdf->Image($image_file, 13, 9, 12, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);

		// Estilos necesarios para el Codigo QR
		$style = array(
		    'border' => 0,
		    'vpadding' => 'auto',
		    'hpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255)
		    'module_width' => 1, // width of a single module in points
		    'module_height' => 1 // height of a single module in points
		);

		//	Datos a mostrar en el código QR
		$codeContents = 'COD. FICHA: '.$this->idFicha."\n";

		// insertando el código QR
		$pdf->write2DBarcode($codeContents, 'QRCODE,L', 190, 8 + $n, 15, 15, $style, 'N');	

		$pdf->lastPage();

		$pdf->output('../temp/ficha-'.$valor.'.pdf', 'F');

	}

	/*=============================================
	MOSTRAR EN PDF FICHA CONTROL Y SEGUIMIENTO
	=============================================*/

	public function ajaxMostrarFichaControlPDF()	{

		/*=============================================
	    DATOS SECCION 1. DATOS DEL ESTABLECIMIENTO NOTIFICADOR
	    =============================================*/
			
		$item = "id_ficha";
		$valor = $this->idFicha;

		$ficha = ControladorFichas::ctrMostrarDatosFicha($item, $valor);

	    //TRAEMOS LOS DATOS DE DEPARTAMENTO

	    $item = "id";
	    $valor = $ficha["id_departamento"];
	    $departamento = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);

	    //TRAEMOS LOS DATOS DE ESTABLECIMIENTO

	    $valor = $ficha["id_establecimiento"];
	    $establecimiento = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

	    //TRAEMOS LOS CONSULTORIOS

	    $valor = $ficha["id_consultorio"];
	    $consultorio = ControladorConsultorios::ctrMostrarConsultorios($item, $valor);

	    //TRAEMOS LOS DATOS DE LOCALIDAD

	    $valor = $ficha["id_localidad"];
	    $localidad = ControladorLocalidades::ctrMostrarLocalidades($item, $valor);

	    /*=============================================
	    DATOS SECCION 2. IDENTIFICACION DEL CASO/PACIENTE
	    =============================================*/

	    $item = "id_ficha";
	    $valor = $this->idFicha;

	    $pacienteAsegurado = ControladorPacientesAsegurados::ctrMostrarPacientesAsegurados($item, $valor);

			//TRAEMOS LOS DATOS DE DEPARTAMENTO

	    $item = "id";
	    $valor_depto = $pacienteAsegurado["id_departamento_paciente"];

	    $departamento_paciente = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor_depto);

	    // var_dump($departamento_paciente);

	    //TRAEMOS LOS DATOS DE LOCALIDAD

	    $valor_localidad = $pacienteAsegurado["id_localidad_paciente"];

	    $localidad_paciente = ControladorLocalidades::ctrMostrarLocalidades($item, $valor_localidad);

	    //TRAEMOS LOS DATOS DE PAIS

	    $valor_pais = $pacienteAsegurado["id_pais_paciente"];

	    $pais_paciente = ControladorPaises::ctrMostrarPaises($item, $valor_pais);

	    /*=============================================
	    DATOS SECCION 5. DATOS EN CASO DE HOSPITALIZACIÓN Y/O AISLAMIENTO
	    =============================================*/

	    $item = "id_ficha";
	    $valor = $this->idFicha;

	    $hospitalizaciones_aislamientos = ControladorHospitalizacionesAislamientos::ctrMostrarHospitalizacionesAislamientos($item, $valor);

	    /*=============================================
	    DATOS SECCION 8. LABORATORIO
	    =============================================*/

	    $item = "id_ficha";
	    $valor = $this->idFicha;

	    $laboratorios = ControladorLaboratorios::ctrMostrarLaboratorios($item, $valor);

	    // TRAEMOS LOS DATOS DE ESTABLECIMIENTO PARA LABORATORIO

	    $item = "id";
	    $valor = $laboratorios["id_establecimiento"];

	    $establecimiento_lab = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

	    /*=============================================
	    DATOS SECCION PERSONAL QUE NOTIFICA
	    =============================================*/

	    $item = "id_ficha";
	    $valor = $this->idFicha;

	    $persona_notificador = ControladorPersonasNotificadores::ctrMostrarPersonasNotificadores($item, $valor);

		// Extend the TCPDF class to create custom Header and Footer

		$pdf = new MYPDF('P', 'mm', 'letter', true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('CNS Potosí');
		$pdf->SetTitle('ficha-'.$valor);
		$pdf->SetSubject('Ficha Control y Seguimiento Covid-19 CNS');
		$pdf->SetKeywords('TCPDF, PDF, CNS, Reporte, Ficha Control Seguimiento,Covid-19');

		$pdf->setPrintHeader(false); 
		$pdf->setPrintFooter(false);

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(5, 5, 5, 0);
		$pdf->SetAutoPageBreak(true, 5); 
		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(5);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('Helvetica', '', 8);

		$pdf->SetPrintFooter(false);

		// add a page
		$pdf->AddPage();

		$content = '';

		  $content .= '

		  <html lang="es">
				<head>

					<style>
						
						body {
							font-size: 21px;
							margin: 0;
							padding: 0;
						}

						.content div{

							line-height: 0px;

						}

						.bg-dark {

							background-color: #444;
							color: #fff;
							text-align: center;
							line-height: 0px;
						
						}

						.bg-dark span {

							line-height: 7px;
							font-weight: bold;

						}

						.font-weight-bold {

							font-weight: bold;

						}

						.titulo {

							text-align: center;
							line-height: 3px;

						}

						.cod_ficha {

							margin-top: 0px;
							text-align: right;
							
						}

						table {

						  line-height: 6px;

						}

						.personas_contactos {

							line-height: 0px;

						}

						td {

						  margin-top: 0px;

						}

						th {

						  text-align: center;

						}

						.mensaje {

							text-align: center;
							line-height: 7px;

						}

						.laboratorios .mensaje {

							margin-top: 0px;
							text-align: center;
							line-height: 0px;

						}

					</style>

				</head>

				<body>

					<div class="content" border="1">

						<div style="line-height: 0px;">
						
							<h3 class="titulo" style="line-height: 4px;">FICHA DE CONTROL Y SEGUIMIENTO<br>SOLICITUD DE ESTUDIOS DE LABORATORIO COVID-19</h3>

							<h4 class="cod_ficha"></h4>

						</div>

						<div class="datos_establecimiento">
					      
					    <div class="bg-dark">

					      <span>1. DATOS DEL ESTABLECIMIENTO NOTIFICADOR</span>
					      
					    </div>

					    <table>
					    	
					    	<tr>
					    		<td width="400px">
					    			<label class="font-weight-bold">Establecimiento de Salud/Centro de Aislamiento:</label> '.$establecimiento["nombre_establecimiento"].'
					    		</td>
					    		<td width="150px">
					    			<label class="font-weight-bold">Consultorio: </label> '.$consultorio["nombre_consultorio"].'
					    		</td>			    		
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="200px">
					    			<label class="font-weight-bold">Departamento:</label> '.$departamento["nombre_depto"].'
					    		</td>
					    		<td width="200px">
					    			<label class="font-weight-bold">Localidad:</label> '.$localidad["nombre_localidad"].'
					    		</td>					    		
					    		<td width="200px">';

					    		if ($ficha["fecha_notificacion"] == "0000-00-00") {
					    			
					    			$content .=
					    			'<label class="font-weight-bold">  Fecha de Notificación:</label>';

					    		} else {

					    			$content .=
					    			'<label class="font-weight-bold">  Fecha de Notificación:</label> '.date("d/m/Y", strtotime($ficha["fecha_notificacion"]));

					    		}

					    		$content .=
					    		'</td>
					    		<td width="150px">
					    			<label class="font-weight-bold">Control:</label> '.$ficha["nro_control"].' CONTROL
					    		</td>
					    	</tr>

					    </table>

					  </div>

					  <div class="paciente">
					      
					    <div class="bg-dark py-1 text-center text-white">

					      <span>2. IDENTIFICACIÓN DEL CASO/PACIENTE</span>
					      
					    </div>

					    <table>
					    	
					    	<tr>
					    		<td width="250px">
					    			<label class="font-weight-bold">Cod. Asegurado:</label> '.$pacienteAsegurado['cod_asegurado'].'
					    		</td>
					    		<td width="250px">
					    			<label class="font-weight-bold">Cod. Afiliado:</label> '.$pacienteAsegurado['cod_afiliado'].'
					    		</td>
					    		<td width="250px">
					    			<label class="font-weight-bold">Cod. Empleador:</label> '.$pacienteAsegurado['cod_empleador'].'
					    		</td>
					    	</tr>

					    </table>

					     <table>

					    	<tr>
					    		<td width="800px">

					    			<label class="font-weight-bold">Nombre Empleador:</label> '.$pacienteAsegurado['nombre_empleador'].'
					    			
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="350px">
					    			<label class="font-weight-bold">Apellido(s) y Nombre(s):</label> '.$pacienteAsegurado['paterno'].' '.$pacienteAsegurado['materno'].' '.$pacienteAsegurado['nombre'].'
					    		</td>
					    		<td width="150px">
					    			<label class="font-weight-bold">Sexo:</label> '.$pacienteAsegurado['sexo'].'
					    		</td>
					    		<td width="200px">
					    			<label class="font-weight-bold">N° Carnet de Indentidad:</label> '.$pacienteAsegurado['nro_documento'].'
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>					    		
					    		<td width="250px">
					    			<label class="font-weight-bold">Fecha de Nacimiento:</label> '.date("d/m/Y", strtotime($pacienteAsegurado['fecha_nacimiento'])).'
					    		</td>
					    		<td width="100px">
					    			<label class="font-weight-bold">Edad:</label> '.$pacienteAsegurado['edad'].'
					    		</td>
					    		<td width="250px">
					    			<label class="font-weight-bold">Teléfono:</label> '.$pacienteAsegurado['telefono'].'
					    		</td>
					    	</tr>

					    </table>

					  </div>

					  <div class="hospitalizacion_aislamiento">
					      
					    <div class="bg-dark py-1 text-center text-white">

					      <span>3. SEGUIMIENTO</span>
					      
					    </div>

					    <table>
					    	
					    	<tr>
					    		<td width="200px">
					    			<label class="font-weight-bold">¿Han pasado 14 días desde la notificación?:</label> '.$hospitalizaciones_aislamientos['dias_notificacion'].'
					    		</td>
					    		<td width="200px">';

					    		if ($hospitalizaciones_aislamientos['dias_sin_sintomas'] == "0") {
					    			$content .= 
					    			'<label class="font-weight-bold">  N° de días SIN sintomas:</label>';

					    		} else {

										$content .= 
					    			'<label class="font-weight-bold">  N° de días SIN sintomas:</label> '.date("d/m/Y", strtotime($hospitalizaciones_aislamientos['dias_sin_sintomas']));					    			
					    		}

									$content .= 
					    		'</td>
					    	</tr>

					    </table>

					    <table>
					    	
					    	<tr>
					    		<td width="200px">';

					    		if ($hospitalizaciones_aislamientos['fecha_aislamiento'] == "0000-00-00") {
					    			$content .= 
					    			'<label class="font-weight-bold">  Fecha de Aislamiento:</label>';

					    		} else {

										$content .= 
					    			'<label class="font-weight-bold">  Fecha de Aislamiento:</label> '.date("d/m/Y", strtotime($hospitalizaciones_aislamientos['fecha_aislamiento']));					    			
					    		}

									$content .=  
					    		'</td>
					    		<td width="300px">
					    			<label class="font-weight-bold">Lugar de Aislamiento: </label> '.$hospitalizaciones_aislamientos['lugar_aislamiento'].'
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="200px">';

					    		if ($hospitalizaciones_aislamientos['fecha_internacion'] == "0000-00-00") {
					    			$content .= 
					    			'<label class="font-weight-bold">  Fecha de Internación:</label>';

					    		} else {

										$content .= 
					    			'<label class="font-weight-bold">  Fecha de Internación:</label> '.date("d/m/Y", strtotime($hospitalizaciones_aislamientos['fecha_internacion']));	

					    		}

									$content .=  
					    		'</td>
					    		<td width="400px">
					    			<label class="font-weight-bold">Establecimiento de salud de Internación:</label> '.$hospitalizaciones_aislamientos['establecimiento_internacion'].'   			
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="200px">';

					    		if ($hospitalizaciones_aislamientos['fecha_ingreso_UTI'] == "0000-00-00") {
					    			$content .= 
					    			'<label class="font-weight-bold">  Fecha de Ingreso a UTI:</label>';

					    		} else {

										$content .= 
					    			'<label class="font-weight-bold">  Fecha de Ingreso a UTI:</label> '.date("d/m/Y", strtotime($hospitalizaciones_aislamientos['fecha_ingreso_UTI']));	

					    		}

									$content .=  
					    		'</td>
					    		<td width="400px">
					    			<label class="font-weight-bold">Lugar de UTI:</label> '.$hospitalizaciones_aislamientos['lugar_ingreso_UTI'].'   			
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="200px">
					    			<label class="font-weight-bold">Ventilación mecánica</label> '.$hospitalizaciones_aislamientos['ventilacion_mecanica'].'
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="650px">
					    			<label class="font-weight-bold">Tratamiento:</label> '.$hospitalizaciones_aislamientos['tratamiento'].','.$hospitalizaciones_aislamientos['tratamiento_otros'].' 
					    		</td>
					    	</tr>

					    </table>

					  </div>

					  <div class="laboratorios">
					      
					    <div class="bg-dark py-1 text-center text-white">

					      <span>4. LABORATORIOS</span>
					      
					    </div>

					    <table>
					    	
					    	<tr>
					    		<td width="250px">
					    			<label class="font-weight-bold">Tipo de muestra tomada:</label> '.$laboratorios['tipo_muestra'].'
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="450px">
					    			<label class="font-weight-bold">Nombre de Lab. que procesara la muestra:</label> '.$laboratorios['nombre_laboratorio'].'
					    		</td>
					    		<td width="150px">';

					    		if ($laboratorios['fecha_muestra'] == "0000-00-00") {
					    			$content .= 
					    			'<label class="font-weight-bold">Fecha de toma de muestra:</label>';

					    		} else {

										$content .= 
					    			'<label class="font-weight-bold">Fecha de toma de muestra:</label> '.date("d/m/Y", strtotime($laboratorios['fecha_muestra']));	

					    		}

									$content .=  
					    		'</td>
					    		<td width="150px">';

					    		if ($laboratorios['fecha_envio'] == "0000-00-00") {
					    			$content .= 
					    			'<label class="font-weight-bold">Fecha de Envío:</label>';

					    		} else {

										$content .= 
					    			'<label class="font-weight-bold">Fecha de Envío:</label> '.date("d/m/Y", strtotime($laboratorios['fecha_envio']));	

					    		}

									$content .=  
					    		'</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td width="300px">
					    			<label class="font-weight-bold" style="line-height: 18px; margin-bottom: 0px;">Responsable de Toma de Muestra:</label> '.$laboratorios['responsable_muestra'].'
					    		</td>
					    		<td width="350px">
					    			<label class="font-weight-bold" style="line-height: 18px; margin-bottom: 0px;">Firma y Sello</label>
					    		</td>
					    	</tr>

					    </table>

					    <table>

					    	<tr>
					    		<td colspan="2" width="700px">
					    			<label class="my-0 font-weight-bold">Observaciones:</label> '.$laboratorios['observaciones_muestra'].'
					    		</td>
					    	</tr>
					    	<tr>
					    		<td width="300px">
					    			<label class="my-0 font-weight-bold">Resultado:</label> '.$laboratorios['resultado_laboratorio'].'
					    		</td>
					    		<td width="250px">';

					    		if ($laboratorios['fecha_resultado'] == "0000-00-00") {
					    			$content .= 
					    			'<label class="font-weight-bold">Fecha de Resultado:</label>';

					    		} else {

										$content .= 
					    			'<label class="font-weight-bold">Fecha de Resultado:</label> '.date("d/m/Y", strtotime($laboratorios['fecha_resultado']));	

					    		}

									$content .=  
					    		'</td>
					    		<td width="150px">
					    			<h2 style="line-height: 0px;">Cod Laboratorio '.$laboratorios['cod_laboratorio'].'</h2>
					    		</td>
					    	</tr>
					    </table>

					    <hr>

					    <table>

					    	<tr>
					    		<td colspan="2" width="700px">
					    			<label class="font-weight-bold">DATOS DEL PERSONAL QUE NOTIFICA</label>
					    		</td>
					    	</tr>
					    	<tr>
					    		<td width="350px">
					    			<label class="font-weight-bold">APELLIDO(S) Y NOMBRE(S):</label> '.$persona_notificador['paterno_notificador'].' '.$persona_notificador['materno_notificador'].' '.$persona_notificador['nombre_notificador'].'
					    		</td>
					    		<td width="350px">
					    			<label class="font-weight-bold">Teléfono:</label> '.$persona_notificador['telefono_notificador'].'
					    		</td>
					    	</tr>

					    </table>

					    <table>
					    	
					    	<tr>
					    		<td width="350px">
					    			<label class="font-weight-bold" style="line-height: 18px;">Firma y Sello</label>
					    		</td>
					    		<td width="350px">
					    			<label class="font-weight-bold" style="line-height: 18px;">Sello del EESS</label>
					    		</td>
					    	</tr>

					    </table>

					    <table border="1">

					    	<tr>
					    		<td width="714px">
					    			<span class="mensaje font-weight-bold">Este formulario tiene el carácter de declaración jurada que realiza el equipo de salud, contiene información sujeta a vigilancia epidemiológica, por esta razón debe ser llenada correctamente en las secciones necesarias y enviadas oprotunamente</span>
					    		</td>
					    	</tr>

					    </table>

					  </div>

					</div>
					
				</body>

			</html>';
			
		// Reconociendo la estructura HTML
		$pdf->writeHTML($content, true, 0, true, true);

		// Insertando el Logo
		$image_file = K_PATH_IMAGES.'cns-logo-simple.png';

		$pdf->Image($image_file, 13, 9, 13, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);

		// Estilos necesarios para el Codigo QR
		$style = array(
		    'border' => 0,
		    'vpadding' => 'auto',
		    'hpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255)
		    'module_width' => 1, // width of a single module in points
		    'module_height' => 1 // height of a single module in points
		);

		//	Datos a mostrar en el código QR
		$codeContents = 'COD. FICHA: '.$this->idFicha."\n";

		// insertando el código QR
		$pdf->write2DBarcode($codeContents, 'QRCODE,L', 190, 8 + $n, 15, 15, $style, 'N');	

		$pdf->lastPage();

		$pdf->output('../temp/ficha-'.$valor.'.pdf', 'F');

	}


}

/*=============================================
CREAR UNA NUEVA FICHA EPIDEMIOLOGICA
=============================================*/

if (isset($_POST["crearFichaEpidemiologica"])) {

	$crearFicha = new AjaxFichas();
	$crearFicha -> paterno_notificador = $_POST["paterno_notificador"];
	$crearFicha -> materno_notificador = $_POST["materno_notificador"];
	$crearFicha -> nombre_notificador = $_POST["nombre_notificador"];
	$crearFicha -> cargo_notificador = $_POST["cargo_notificador"];
	$crearFicha -> ajaxCrearFichaEpidemiologica();

}

/*=============================================
CREAR UNA NUEVA FICHA DE CONTROL Y SEGUIMIENTO
=============================================*/

if (isset($_POST["crearFichaControl"])) {

	$crearFicha = new AjaxFichas();
	$crearFicha -> paterno_notificador = $_POST["paterno_notificador"];
	$crearFicha -> materno_notificador = $_POST["materno_notificador"];
	$crearFicha -> nombre_notificador = $_POST["nombre_notificador"];
	$crearFicha -> cargo_notificador = $_POST["cargo_notificador"];
	$crearFicha -> ajaxCrearFichaControl();

}

/*=============================================
GUARDAR NUEVA FICHA EPIDEMIOLOGICA
=============================================*/

if (isset($_POST["guardarFichaEpidemiologica"])) {

	$guardarFichaEpidemiologica = new AjaxFichas();
	// 1. DATOS ESTABLECIMIENTO NOTIFICADOR
	$guardarFichaEpidemiologica -> id_ficha = $_POST["id_ficha"];
	$guardarFichaEpidemiologica -> id_establecimiento = $_POST["id_establecimiento"];
	$guardarFichaEpidemiologica -> cod_establecimiento = $_POST["cod_establecimiento"];
	$guardarFichaEpidemiologica -> id_consultorio = $_POST["id_consultorio"];
	$guardarFichaEpidemiologica -> red_salud = $_POST["red_salud"];
	$guardarFichaEpidemiologica -> id_departamento = $_POST["id_departamento"];
	$guardarFichaEpidemiologica -> id_localidad = $_POST["id_localidad"];
	$guardarFichaEpidemiologica -> fecha_notificacion = $_POST["fecha_notificacion"];
	$guardarFichaEpidemiologica -> semana_epidemiologica = $_POST["semana_epidemiologica"];
	$guardarFichaEpidemiologica -> busqueda_activa = $_POST["busqueda_activa"];

	// 2. IDENTIFICACIÓN DEL CASO PACIENTE
	$guardarFichaEpidemiologica -> cod_asegurado = $_POST["cod_asegurado"];
	$guardarFichaEpidemiologica -> cod_afiliado = $_POST["cod_afiliado"];
	$guardarFichaEpidemiologica -> cod_empleador = $_POST["cod_empleador"];
	$guardarFichaEpidemiologica -> nombre_empleador = $_POST["nombre_empleador"];
	$guardarFichaEpidemiologica -> paterno = $_POST["paterno"];	
	$guardarFichaEpidemiologica -> materno = $_POST["materno"];	
	$guardarFichaEpidemiologica -> nombre = $_POST["nombre"];	
	$guardarFichaEpidemiologica -> sexo = $_POST["sexo"];
	$guardarFichaEpidemiologica -> nro_documento = $_POST["nro_documento"];
	$guardarFichaEpidemiologica -> fecha_nacimiento = $_POST["fecha_nacimiento"];
	$guardarFichaEpidemiologica -> edad = $_POST["edad"];
	$guardarFichaEpidemiologica -> id_departamento_paciente = $_POST["id_departamento_paciente"];
	$guardarFichaEpidemiologica -> id_localidad_paciente = $_POST["id_localidad_paciente"];
	$guardarFichaEpidemiologica -> id_pais_paciente = $_POST["id_pais_paciente"];
	$guardarFichaEpidemiologica -> zona = $_POST["zona"];
	$guardarFichaEpidemiologica -> calle = $_POST["calle"];
	$guardarFichaEpidemiologica -> nro_calle = $_POST["nro_calle"];
	$guardarFichaEpidemiologica -> telefono = $_POST["telefono"];
	$guardarFichaEpidemiologica -> nombre_apoderado = $_POST["nombre_apoderado"];
	$guardarFichaEpidemiologica -> telefono_apoderado = $_POST["telefono_apoderado"];

	// 3. ANTECEDENTES EPIDEMIOLOGICOS
	$guardarFichaEpidemiologica -> ocupacion = $_POST["ocupacion"];
	$guardarFichaEpidemiologica -> ant_vacuna_influenza = $_POST["ant_vacuna_influenza"];
	$guardarFichaEpidemiologica -> fecha_vacuna_influenza = $_POST["fecha_vacuna_influenza"];
	$guardarFichaEpidemiologica -> viaje_riesgo = $_POST["viaje_riesgo"];
	$guardarFichaEpidemiologica -> pais_ciudad_riesgo = $_POST["pais_ciudad_riesgo"];
	$guardarFichaEpidemiologica -> fecha_retorno = $_POST["fecha_retorno"];
	$guardarFichaEpidemiologica -> nro_vuelo = $_POST["nro_vuelo"];
	$guardarFichaEpidemiologica -> nro_asiento = $_POST["nro_asiento"];
	$guardarFichaEpidemiologica -> contacto_covid = $_POST["contacto_covid"];
	$guardarFichaEpidemiologica -> fecha_contacto_covid = $_POST["fecha_contacto_covid"];
	$guardarFichaEpidemiologica -> nombre_contacto_covid = $_POST["nombre_contacto_covid"];
	$guardarFichaEpidemiologica -> telefono_contacto_covid = $_POST["telefono_contacto_covid"];
	$guardarFichaEpidemiologica -> pais_contacto_covid = $_POST["pais_contacto_covid"];
	$guardarFichaEpidemiologica -> departamento_contacto_covid = $_POST["departamento_contacto_covid"];
	$guardarFichaEpidemiologica -> localidad_contacto_covid = $_POST["localidad_contacto_covid"];

	// 4. DATOS CLÍNICOS
	$guardarFichaEpidemiologica -> fecha_inicio_sintomas = $_POST["fecha_inicio_sintomas"];
	$guardarFichaEpidemiologica -> malestares = $_POST["malestares"];
	$guardarFichaEpidemiologica -> malestares_otros = $_POST["malestares_otros"];
	$guardarFichaEpidemiologica -> estado_paciente = $_POST["estado_paciente"];
	$guardarFichaEpidemiologica -> fecha_defuncion = $_POST["fecha_defuncion"];
	$guardarFichaEpidemiologica -> diagnostico_clinico = $_POST["diagnostico_clinico"];

	// 5. DATOS HOSPITALIZACIÓN AISLAMIENTO
	$guardarFichaEpidemiologica -> fecha_aislamiento = $_POST["fecha_aislamiento"];
	$guardarFichaEpidemiologica -> lugar_aislamiento = $_POST["lugar_aislamiento"];
	$guardarFichaEpidemiologica -> fecha_internacion = $_POST["fecha_internacion"];
	$guardarFichaEpidemiologica -> establecimiento_internacion = $_POST["establecimiento_internacion"];
	$guardarFichaEpidemiologica -> ventilacion_mecanica = $_POST["ventilacion_mecanica"];
	$guardarFichaEpidemiologica -> terapia_intensiva = $_POST["terapia_intensiva"];
	$guardarFichaEpidemiologica -> fecha_ingreso_UTI = $_POST["fecha_ingreso_UTI"];

	// 6. ENFERMEDADES DE BASE O CONDICIONES DE RIESGO
	$guardarFichaEpidemiologica -> enf_estado = $_POST["enf_estado"];
	$guardarFichaEpidemiologica -> enf_riesgo = $_POST["enf_riesgo"];
	$guardarFichaEpidemiologica -> enf_riesgo_otros = $_POST["enf_riesgo_otros"];

	// 8. LABORATORIOS
	$guardarFichaEpidemiologica -> estado_muestra = $_POST["estado_muestra"];
	$guardarFichaEpidemiologica -> id_establecimiento_lab = $_POST["id_establecimiento_lab"];
	$guardarFichaEpidemiologica -> tipo_muestra = $_POST["tipo_muestra"];
	$guardarFichaEpidemiologica -> fecha_muestra = $_POST["fecha_muestra"];
	$guardarFichaEpidemiologica -> fecha_envio = $_POST["fecha_envio"];
	$guardarFichaEpidemiologica -> responsable_muestra = $_POST["responsable_muestra"];

	// DATOS DEL PERSONAL QUE NOTIFICA
	$guardarFichaEpidemiologica -> paterno_notificador = $_POST["paterno_notificador"];
	$guardarFichaEpidemiologica -> materno_notificador = $_POST["materno_notificador"];
	$guardarFichaEpidemiologica -> nombre_notificador = $_POST["nombre_notificador"];
	$guardarFichaEpidemiologica -> telefono_notificador = $_POST["telefono_notificador"];
	$guardarFichaEpidemiologica -> cargo_notificador = $_POST["cargo_notificador"];	
	$guardarFichaEpidemiologica -> ajaxGuardarFichaEpidemiologica();

}

/*=============================================
GUARDAR NUEVA FICHA CONTROL Y SEGUIMIENTO
=============================================*/

if (isset($_POST["guardarFichaControl"])) {

	$guardarFichaControl = new AjaxFichas();
	// 1. DATOS ESTABLECIMIENTO NOTIFICADOR
	$guardarFichaControl -> id_ficha = $_POST["id_ficha"];
	$guardarFichaControl -> id_establecimiento = $_POST["id_establecimiento"];
	$guardarFichaControl -> id_consultorio = $_POST["id_consultorio"];
	$guardarFichaControl -> id_departamento = $_POST["id_departamento"];
	$guardarFichaControl -> id_localidad = $_POST["id_localidad"];
	$guardarFichaControl -> fecha_notificacion = $_POST["fecha_notificacion"];
	$guardarFichaControl -> nro_control = $_POST["nro_control"];

	// 2. IDENTIFICACIÓN DEL CASO PACIENTE
	$guardarFichaControl -> cod_asegurado = $_POST["cod_asegurado"];
	$guardarFichaControl -> cod_afiliado = $_POST["cod_afiliado"];
	$guardarFichaControl -> cod_empleador = $_POST["cod_empleador"];
	$guardarFichaControl -> nombre_empleador = $_POST["nombre_empleador"];
	$guardarFichaControl -> paterno = $_POST["paterno"];	
	$guardarFichaControl -> materno = $_POST["materno"];	
	$guardarFichaControl -> nombre = $_POST["nombre"];	
	$guardarFichaControl -> sexo = $_POST["sexo"];
	$guardarFichaControl -> nro_documento = $_POST["nro_documento"];
	$guardarFichaControl -> fecha_nacimiento = $_POST["fecha_nacimiento"];
	$guardarFichaControl -> edad = $_POST["edad"];
	$guardarFichaControl -> telefono = $_POST["telefono"];

	// 3. SEGUIMIENTO
	$guardarFichaControl -> dias_notificacion = $_POST["dias_notificacion"];
	$guardarFichaControl -> dias_sin_sintomas = $_POST["dias_sin_sintomas"];
	$guardarFichaControl -> fecha_aislamiento = $_POST["fecha_aislamiento"];
	$guardarFichaControl -> lugar_aislamiento = $_POST["lugar_aislamiento"];
	$guardarFichaControl -> fecha_internacion = $_POST["fecha_internacion"];
	$guardarFichaControl -> establecimiento_internacion = $_POST["establecimiento_internacion"];
	$guardarFichaControl -> fecha_ingreso_UTI = $_POST["fecha_ingreso_UTI"];
	$guardarFichaControl -> lugar_ingreso_UTI = $_POST["lugar_ingreso_UTI"];
	$guardarFichaControl -> ventilacion_mecanica = $_POST["ventilacion_mecanica"];
	$guardarFichaControl -> tratamiento = $_POST["tratamiento"];
	$guardarFichaControl -> tratamiento_otros = $_POST["tratamiento_otros"];

	// 4. LABORATORIOS
	$guardarFichaControl -> tipo_muestra = $_POST["tipo_muestra"];
	$guardarFichaControl -> fecha_muestra = $_POST["fecha_muestra"];
	$guardarFichaControl -> fecha_envio = $_POST["fecha_envio"];
	$guardarFichaControl -> responsable_muestra = $_POST["responsable_muestra"];

	// DATOS DEL PERSONAL QUE NOTIFICA
	$guardarFichaControl -> paterno_notificador = $_POST["paterno_notificador"];
	$guardarFichaControl -> materno_notificador = $_POST["materno_notificador"];
	$guardarFichaControl -> nombre_notificador = $_POST["nombre_notificador"];
	$guardarFichaControl -> telefono_notificador = $_POST["telefono_notificador"];
	$guardarFichaControl -> cargo_notificador = $_POST["cargo_notificador"];	
	$guardarFichaControl -> ajaxGuardarFichaControl();

}

/*=============================================
GUARDAR NUEVO ESTABLECIMIENTO DINAMICAMENTE
=============================================*/

if (isset($_POST["guardarCampoFicha"])) {

	$guardarFichaEpidemiologica = new AjaxFichas();
	// 1. DATOS ESTABLECIMIENTO NOTIFICADOR
	$guardarFichaEpidemiologica -> id_ficha = $_POST["id_ficha"];
	$guardarFichaEpidemiologica -> item = $_POST["item"];
	$guardarFichaEpidemiologica -> valor = $_POST["valor"];
	$guardarFichaEpidemiologica -> tabla = $_POST["tabla"];	
	$guardarFichaEpidemiologica -> ajaxGuardarCampoFicha();

}


/*=============================================
MOSTRAR EN PDF FICHA EPIDEMIOLÓGICA
=============================================*/

if (isset($_POST["fichaEpidemiologicaPDF"])) {

	$fichaEpidemiologicaPDF = new AjaxFichas();
	$fichaEpidemiologicaPDF -> idFicha = $_POST["idFicha"];
	$fichaEpidemiologicaPDF -> ajaxMostrarFichaEpidemiologicaPDF();

}

/*=============================================
MOSTRAR EN PDF FICHA CONTROL Y SEGUIMIENTO
=============================================*/

if (isset($_POST["fichaControlPDF"])) {

	$fichaControlPDF = new AjaxFichas();
	$fichaControlPDF -> idFicha = $_POST["idFicha"];
	$fichaControlPDF -> ajaxMostrarFichaControlPDF();

}