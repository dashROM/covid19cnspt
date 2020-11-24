<?php

require_once "../controladores/reportes_ficha.controlador.php";
require_once "../modelos/reportes_ficha.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

require_once "../controladores/departamentos.controlador.php";
require_once "../modelos/departamentos.modelo.php";

require_once "../controladores/establecimientos.controlador.php";
require_once "../modelos/establecimientos.modelo.php";

require_once "../controladores/localidades.controlador.php";
require_once "../modelos/localidades.modelo.php";

require_once('../extensiones/tcpdf/tcpdf.php');

class AjaxReportesFicha {
	
	/*=============================================
	MOSTRAR REPORTE POR FECHA DE TOMA DE MUESTRA
	=============================================*/
	
	public $fechaInicio;
	public $fechaFin;

	public $nombre_usuario;

	public function ajaxMostrarReportesFichaFechas()	{
		
		$valor1 = date("Y-m-d", strtotime($this->fechaInicio));
		$valor2 = date("Y-m-d", strtotime($this->fechaFin));

		$valor3 = "SI";

		$busquedaActivaSI = ControladorReportesFicha::ctrContarBusquedaActiva($valor1, $valor2, $valor3);

		$valor3 = "NO";

		$busquedaActivaNO = ControladorReportesFicha::ctrContarBusquedaActiva($valor1, $valor2, $valor3);

		$valor3 = "F";

		$sexo_femenino = ControladorReportesFicha::ctrContarSexoPaciente($valor1, $valor2, $valor3);

		$valor3 = "M";

		$sexo_masculino = ControladorReportesFicha::ctrContarSexoPaciente($valor1, $valor2, $valor3);

		$valor3 = "PERSONAL DE SALUD";

		$personal_salud = ControladorReportesFicha::ctrContarOcupacion($valor1, $valor2, $valor3);

		$valor3 = "PERSONAL DE LABORATORIO";

		$personal_laboratorio = ControladorReportesFicha::ctrContarOcupacion($valor1, $valor2, $valor3);

		$valor3 = "TRABAJADOR PRENSA";

		$trabajador_prensa = ControladorReportesFicha::ctrContarOcupacion($valor1, $valor2, $valor3);

		$valor3 = "FF.AA.";

		$ff_aa = ControladorReportesFicha::ctrContarOcupacion($valor1, $valor2, $valor3);

		$valor3 = "POLICIA";

		$policia = ControladorReportesFicha::ctrContarOcupacion($valor1, $valor2, $valor3);

		$otra_ocupacion = ControladorReportesFicha::ctrContarOtraOcupacion($valor1, $valor2);

		$valor3 = "SI";

		$vacunaSI = ControladorReportesFicha::ctrContarVacunaInfluenza($valor1, $valor2, $valor3);

		$valor3 = "NO";

		$vacunaNO = ControladorReportesFicha::ctrContarVacunaInfluenza($valor1, $valor2, $valor3);

		$valor3 = "SI";

		$viajeSI = ControladorReportesFicha::ctrContarViajeRiesgo($valor1, $valor2, $valor3);

		$valor3 = "NO";

		$viajeNO = ControladorReportesFicha::ctrContarViajeRiesgo($valor1, $valor2, $valor3);

		$valor3 = "SI";

		$contactoSI = ControladorReportesFicha::ctrContarContactoCovid($valor1, $valor2, $valor3);

		$valor3 = "NO";

		$contactoNO = ControladorReportesFicha::ctrContarContactoCovid($valor1, $valor2, $valor3);

		$malestares = ControladorReportesFicha::ctrContarMalestar($valor1, $valor2, $valor3);

		$malestares_num = count($malestares);

		$tos_seca = 0;
		$fiebre = 0; 
		$malestar = 0;
		$cefalea = 0;
		$dif_respiratoria = 0;
		$mialgias = 0;
		$dolor_garganta = 0;
		$perd_olfato = 0;
		$perd_gusto = 0;
		$asintomatico = 0;

		for ($i = 0; $i < $malestares_num; ++$i){

		    $buscar_tos_seca = 'TOS SECA';

		    $buscar_fiebre = 'FIEBRE';

		    $buscar_malestar = 'MALESTAR GENERAL';

		    $buscar_cefalea = 'CEFALEA';

			$buscar_dif_respiratoria = 'DIFICULTAD RESPIRATORIA';

			$buscar_mialgias = 'MIALGIAS';

			$buscar_dolor_garganta = 'DOLOR DE GARGANTA';

			$buscar_perd_olfato = 'PÉRDIDA O DISMINUCIÓN DEL SENTIDO DEL OLFATO';

			$buscar_perd_gusto = 'PÉRDIDA O DISMINUCIÓN DEL SENTIDO DEL GUSTO';

			$buscar_asintomatico = 'ASINTOMÁTICO';
		    
		    $array_malestares = explode(",", $malestares[$i]["malestares"]);
			
			if(in_array($buscar_tos_seca, $array_malestares)){
			
			    $tos_seca++;
			
			} 

			if (in_array($buscar_fiebre, $array_malestares)) {

				$fiebre++;
				
			}

			if (in_array($buscar_malestar, $array_malestares)) {

				$malestar++;
				
			}

			if (in_array($buscar_cefalea, $array_malestares)) {

				$cefalea++;
				
			}

			if (in_array($buscar_dif_respiratoria, $array_malestares)) {

				$dif_respiratoria++;
				
			}

			if (in_array($buscar_mialgias, $array_malestares)) {

				$mialgias++;
				
			}

			if (in_array($buscar_dolor_garganta, $array_malestares)) {

				$dolor_garganta++;
				
			}

			if (in_array($buscar_perd_olfato, $array_malestares)) {

				$perd_olfato++;
				
			}

			if (in_array($buscar_perd_gusto, $array_malestares)) {

				$perd_gusto++;
				
			}

			if (in_array($buscar_asintomatico, $array_malestares)) {

				$asintomatico++;
				
			}

		}

		$malestares_otros = ControladorReportesFicha::ctrContarOtroMalestar($valor1, $valor2);

		$valor3 = "LEVE";

		$estadoPacienteLeve = ControladorReportesFicha::ctrContarEstadoPaciente($valor1, $valor2, $valor3);

		$valor3 = "GRAVE";

		$estadoPacienteGrave = ControladorReportesFicha::ctrContarEstadoPaciente($valor1, $valor2, $valor3);

		$valor3 = "FALLECIDO";

		$estadoPacienteFallecido = ControladorReportesFicha::ctrContarEstadoPaciente($valor1, $valor2, $valor3);

		$valor3 = "IRA";

		$diagnostico_ira = ControladorReportesFicha::ctrContarDiagnostico($valor1, $valor2, $valor3);

		$valor3 = "IRAG";

		$diagnostico_irag  = ControladorReportesFicha::ctrContarDiagnostico($valor1, $valor2, $valor3);

		$valor3 = "NEUMONIA";

		$diagnostico_neumonia  = ControladorReportesFicha::ctrContarDiagnostico($valor1, $valor2, $valor3);

		$otro_diagnostico = ControladorReportesFicha::ctrContarOtroDiagnostico($valor1, $valor2);


		// echo $tos_seca." ".$fiebre." ".$malestar;

		// var_dump($malestares);

		$datosJson = '{
			"data": [';

		$datosJson .='
			"'.$busquedaActivaSI["busqueda_activa"].'",	
			"'.$busquedaActivaNO["busqueda_activa"].'",
			"'.$sexo_femenino["sexo"].'",	
			"'.$sexo_masculino["sexo"].'",
			"'.$personal_salud["ocupacion"].'",
			"'.$personal_laboratorio["ocupacion"].'",
			"'.$trabajador_prensa["ocupacion"].'",
			"'.$ff_aa["ocupacion"].'",
			"'.$policia["ocupacion"].'",
			"'.$otra_ocupacion["ocupacion"].'",
			"'.$vacunaSI["ant_vacuna_influenza"].'",
			"'.$vacunaNO["ant_vacuna_influenza"].'",
			"'.$viajeSI["viaje_riesgo"].'",
			"'.$viajeNO["viaje_riesgo"].'",
			"'.$contactoSI["contacto_covid"].'",
			"'.$contactoNO["contacto_covid"].'",
			"'.$tos_seca.'",
			"'.$fiebre.'",
			"'.$malestar.'",
			"'.$cefalea.'",
			"'.$dif_respiratoria.'",
			"'.$mialgias.'",
			"'.$dolor_garganta.'",
			"'.$perd_olfato.'",
			"'.$perd_gusto.'",			
			"'.$asintomatico.'",
			"'.$malestares_otros["malestares_otros"].'",
			"'.$estadoPacienteLeve["estado_paciente"].'",
			"'.$estadoPacienteGrave["estado_paciente"].'",
			"'.$estadoPacienteFallecido["estado_paciente"].'",
			"'.$diagnostico_ira["diagnostico_clinico"].'",
			"'.$diagnostico_irag["diagnostico_clinico"].'",
			"'.$diagnostico_neumonia["diagnostico_clinico"].'",
			"'.$otro_diagnostico["diagnostico_clinico"].'"
		';

		$datosJson .= ']
		}';	

		echo $datosJson;

	}

}

/*=============================================
MOSTRAR REPORTE FICHA POR FECHAS DE TOMA DE MUESTRA
=============================================*/

if (isset($_POST["reporte"])) {

	$reportesCovid = new AjaxReportesFicha();
	$reportesCovid -> fechaInicio = $_POST["fechaInicio"];
	$reportesCovid -> fechaFin = $_POST["fechaFin"];
	$reportesCovid -> ajaxMostrarReportesFichaFechas();

}

