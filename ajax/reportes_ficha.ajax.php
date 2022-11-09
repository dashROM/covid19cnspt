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

	/*=============================================
	MOSTRAR REPORTE DE DATOS FICHA POR FECHA DE RESULTADO DE LABORATORIO
	=============================================*/

	public function ajaxMostrarReportesDatosFichaFechas()	{
		
		$valor1 = date("Y-m-d", strtotime($this->fechaInicio));
		$valor2 = date("Y-m-d", strtotime($this->fechaFin));

		$respuesta = ControladorReportesFicha::ctrMostrarReportesDatosFichaFechas($valor1, $valor2);

		echo json_encode($respuesta);

	}

	/*=============================================
	MOSTRAR DATOS FICHA POR FECHA DE RESULTADO DE LABORATORIO PARA EXPORTAR AL SIVE
	=============================================*/

	public function ajaxExportarDatosFichaSive()	{
		
		$valor1 = date("Y-m-d", strtotime($this->fechaInicio));
		$valor2 = date("Y-m-d", strtotime($this->fechaFin));

		$respuesta = ControladorReportesFicha::ctrExportarDatosFichaSive($valor1, $valor2);

		if ($respuesta == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($respuesta); $i++) {

					// ADECUANDO CAMPO SEXO
					if ($respuesta[$i]['sexo'] == "M") {
						$genero = "MASCULINO";
					} else {
						$genero = "FEMENINO";
					}

					// ADECUANDO CAMPO MENOR DE EDAD
					if ($respuesta[$i]['edad'] < 18) {
						$edad_menor = "SI";
					}
					else {
						$edad_menor = "NO";
					}

					// ADECUANDO CAMPO TIPO ASEGURADO
					if (substr($respuesta[$i]['cod_afiliado'], -2) == "ID") {
						$tipo_asegurado = 1;
					} else {
						$tipo_asegurado = 2;
					}

					// ADECUANDO CAMPO OCUPACION
					if ($respuesta[$i]['ocupacion'] == "PERSONAL DE SALUD") {
						$ocupacion = 2;
						$otra_ocupacion = "";
					} elseif ($respuesta[$i]['ocupacion'] == "PERSONAL DE LABORATORIO") {
						$ocupacion = 4;
						$otra_ocupacion = "";
					} elseif ($respuesta[$i]['ocupacion'] == "FF.AA.") {
						$ocupacion = 5;
						$otra_ocupacion = "";
					} elseif ($respuesta[$i]['ocupacion'] == "POLICIA") {
						$ocupacion = 6;
						$otra_ocupacion = "";
					} elseif ($respuesta[$i]['ocupacion'] == "TRABAJADOR PRENSA") {
						$ocupacion = 7;
						$otra_ocupacion = "";
					} else {
						$ocupacion = 50;
						$otra_ocupacion = $respuesta[$i]['ocupacion'];
					}

					// ADECUANDO CAMPO CONTACTO CON CASO POSITIVO COVID
					if ($respuesta[$i]['contacto_covid'] == "SI") {
						$fecha_contacto_covid = date("d/m/Y", strtotime($respuesta[$i]['fecha_contacto_covid']));
					}
					else {
						$fecha_contacto_covid = "";
					}

					// ADECUANDO DOSIS DE VACUNA PROVEEDOR VACUNA
					if ($respuesta[$i]['ant_vacuna'] == "SI") {
						if ($respuesta[$i]['dosis_vacuna'] == "1ER DOSIS") {
							$primera_dosis = "X";
							$codigo_primera_dosis = $respuesta[$i]['proveedor_vacuna'];
							$segunda_dosis = "";
							$codigo_segunda_dosis = "";
							$dosis_unica = "";
							$codigo_dosis_unica = "";
							$primera_dosis_refuerzo = "";
							$codigo_primera_dosis_refuerzo = "";
							$segunda_dosis_refuerzo = "";
							$codigo_segunda_dosis_refuerzo = "";
						} elseif ($respuesta[$i]['dosis_vacuna'] == "2DA DOSIS") {
							$primera_dosis = "";
							$codigo_primera_dosis = "";
							$segunda_dosis = "X";
							$codigo_segunda_dosis = $respuesta[$i]['proveedor_vacuna'];
							$dosis_unica = "";
							$codigo_dosis_unica = "";
							$primera_dosis_refuerzo = "";
							$codigo_primera_dosis_refuerzo = "";
							$segunda_dosis_refuerzo = "";
							$codigo_segunda_dosis_refuerzo = "";
						} elseif ($respuesta[$i]['dosis_vacuna'] == "DOSIS UNICA") {
							$primera_dosis = "";
							$codigo_primera_dosis = "";
							$segunda_dosis = "";
							$codigo_segunda_dosis = "";
							$dosis_unica = "X";
							$codigo_dosis_unica = "JHONSON";
							$primera_dosis_refuerzo = "";
							$codigo_primera_dosis_refuerzo = "";
							$segunda_dosis_refuerzo = "";
							$codigo_segunda_dosis_refuerzo = "";
						} elseif ($respuesta[$i]['dosis_vacuna'] == "DOSIS DE REFUERZO (1ER DOSIS)") {
							$primera_dosis = "";
							$codigo_primera_dosis = "";
							$segunda_dosis = "";
							$codigo_segunda_dosis = "";
							$dosis_unica = "";
							$codigo_dosis_unica = "";
							$primera_dosis_refuerzo = "X";
							$codigo_primera_dosis_refuerzo = $respuesta[$i]['proveedor_vacuna'];
							$segunda_dosis_refuerzo = "";
							$codigo_segunda_dosis_refuerzo = "";
						} elseif ($respuesta[$i]['dosis_vacuna'] == "DOSIS DE REFUERZO (2DA DOSIS)") {
							$primera_dosis = "";
							$codigo_primera_dosis = "";
							$segunda_dosis = "";
							$codigo_segunda_dosis = "";
							$dosis_unica = "";
							$codigo_dosis_unica = "";
							$primera_dosis_refuerzo = "";
							$codigo_primera_dosis_refuerzo = "";
							$segunda_dosis_refuerzo = "X";
							$codigo_segunda_dosis_refuerzo = $respuesta[$i]['proveedor_vacuna'];
						} else {
							$primera_dosis = "";
							$codigo_primera_dosis = "";
							$segunda_dosis = "";
							$codigo_segunda_dosis = "";
							$dosis_unica = "";
							$codigo_dosis_unica = "";
							$primera_dosis_refuerzo = "";
							$codigo_primera_dosis_refuerzo = "";
							$segunda_dosis_refuerzo = "";
							$codigo_segunda_dosis_refuerzo = "";
						}
					} else {
						$primera_dosis = "";
						$codigo_primera_dosis = "";
						$segunda_dosis = "";
						$codigo_segunda_dosis = "";
						$dosis_unica = "";
						$codigo_dosis_unica = "";
						$primera_dosis_refuerzo = "";
						$codigo_primera_dosis_refuerzo = "";
						$segunda_dosis_refuerzo = "";
						$codigo_segunda_dosis_refuerzo = "";
					}

					// ADECUANDO CAMPO FECHA ULTIMA VACUNA COVID
					if ($respuesta[$i]['ant_vacuna'] != "SI") {
						$fecha_dosis_vacuna = "";
					}
					else {
						$fecha_dosis_vacuna = date("d/m/Y", strtotime($respuesta[$i]['fecha_dosis_vacuna']));
					}

					// ADECUANDO CAMPO SINTOMAS
					if ($respuesta[$i]['tipo_paciente'] == "ASINTOMÁTICO") {
						$asintomatico = "X";
					} else {
						$asintomatico = "";
					}

					$malestares = explode(",", $respuesta[$i]['malestares']);

					$tos_seca = "";
					$dolor_garganta = "";
					$fiebre = "";
					$dif_respiratoria = "";
					$mialgias = "";
					$malestar_gral = "";
					$cefalea = "";
					$perdida_olfato = "";
					$perdida_gusto = "";

					foreach ($malestares as $malestar) {

				    if ($malestar == "TOS SECA") {
				    	$tos_seca = "X";
				    } 
				    if ($malestar == "DOLOR DE GARGANTA") {
				    	$dolor_garganta = "X";
				    } 
				    if ($malestar == "FIEBRE") {
				    	$fiebre = "X";
				    } 
				    if ($malestar == "DIFICULTAD RESPIRATORIA") {
				    	$dif_respiratoria = "X";
				    } 
				    if ($malestar == "MIALGIAS") {
				    	$mialgias = "X";
				    } 
				    if ($malestar == "MALESTAR GENERAL") {
				    	$malestar_gral = "X";
				    }
				    if ($malestar == "CEFALEA") {
				    	$cefalea = "X";
				    }
				    if ($malestar == "PÉRDIDA O DISMINUCIÓN DEL SENTIDO DEL OLFATO") {
				    	$perdida_olfato = "X";
				    }
				    if ($malestar == "PÉRDIDA O DISMINUCIÓN DEL SENTIDO DEL GUSTO") {
				    	$perdida_gusto = "X";
				    }
					}

					if ($respuesta[$i]['malestares_otros'] != "") {
						$malestares_otros1 = "X";
						$malestares_otros2 = $respuesta[$i]['malestares_otros'];
					} else {
						$malestares_otros1 = "";
						$malestares_otros2 = "";
					}

					// ADECUANDO CAMPO ESTADO REPORTE
					if ($respuesta[$i]['estado_paciente'] == "LEVE") {
						$estado_paciente = 1;
						$fecha_defuncion = "";
					} elseif ($respuesta[$i]['estado_paciente'] == "GRAVE") {
						$estado_paciente = 2;
						$fecha_defuncion = "";
					} elseif ($respuesta[$i]['estado_paciente'] == "FALLECIDO") {
						$estado_paciente = 3;
						$fecha_defuncion = date("d/m/Y", strtotime($respuesta[$i]['fecha_defuncion']));
					} else {
						$estado_paciente = 1;
						$fecha_defuncion = "";
					}

					// ADECUANDO CAMPO DIAGNOSTICO CLINICO
					if ($respuesta[$i]['diagnostico_clinico'] == "SINDROME GRIPAL/IRA/BRONQUITIS") {
						$diagnostico_clinico = 7;
						$otro_diagnostico = "";
					} elseif ($respuesta[$i]['diagnostico_clinico'] == "IRAG/NEUMONIA") {
						$diagnostico_clinico = 6;
						$otro_diagnostico = "";
					} elseif ($respuesta[$i]['diagnostico_clinico'] == "") {
						$diagnostico_clinico = 4;
						$otro_diagnostico = "NINGUNO";
					} else {
						$diagnostico_clinico = 4;
						$otro_diagnostico = $respuesta[$i]['diagnostico_clinico'];
					}

					// ADECUANDO CAMPO SEMANA EPIDEMIOLOGICA DE INICIO SINTOMAS
					if ($respuesta[$i]['fecha_inicio_sintomas'] == "0000-00-00") {
						$fecha_inicio_sintomas = "";
						$semana_epidemiologica_sintomas = ""; 
					} else {
						$fecha_inicio_sintomas = date("d/m/Y", strtotime($respuesta[$i]['fecha_inicio_sintomas']));
						$semana_epidemiologica_sintomas = date("W", strtotime($respuesta[$i]['fecha_inicio_sintomas']));
					}

					// ADECUANDO CAMPO CODIGO AMBULATORIO O INTERNADO - FECHA INTERNACION
					if ($respuesta[$i]['tipo_aislamiento'] == "AMBULATORIO") {
						$ambulatorio_internado = 1;
						$fecha_internacion = "";
					} elseif ($respuesta[$i]['tipo_aislamiento'] == "INTERNADO") {
						$ambulatorio_internado = 2;
						$fecha_internacion = date("d/m/Y", strtotime($respuesta[$i]['fecha_internacion']));
					} else {
						$ambulatorio_internado = "";
						$fecha_internacion = "";
					}

					// ADECUANDO CAMPO FECHA AISLAMIENTO
					if ($respuesta[$i]['fecha_aislamiento'] == "0000-00-00") {
						$fecha_aislamiento = "";
					} else {
						$fecha_aislamiento = date("d/m/Y", strtotime($respuesta[$i]['fecha_aislamiento']));
					}

					// ADECUANDO CAMPO TERAPIA INTENSIVA - FECHA INGRESO UTI
					if ($respuesta[$i]['terapia_intensiva'] == "SI") {
						$terapia_intensiva = "SI";
						$fecha_ingreso_UTI = date("d/m/Y", strtotime($respuesta[$i]['fecha_ingreso_UTI']));
					} else {
						$terapia_intensiva = "NO";						
						$fecha_ingreso_UTI = "";
					}

					// ADECUANDO CAMPO ENFERMEDADES DE BASE
					$enfermedades_riesgo = explode(",", $respuesta[$i]['enf_riesgo']);

					$diabetes = "";
					$obesidad = "";
					$enfermedad_renal = "";
					$embarazo = "";
					$hipertension_arterial = "";
					$enfermedad_cardiaca = "";
					$enfermedad_oncologica = "";
					$enfermedad_respiratoria = "";

					if ($respuesta[$i]['enf_estado'] == "PRESENTA") {

						$enf_estado = "SI";

						foreach ($enfermedades_riesgo as $enf_riesgo) {

					    if ($enf_riesgo == "DIABETES GENERAL") {
					    	$diabetes = "X";
					    } 
					    if ($enf_riesgo == "OBESIDAD") {
					    	$obesidad = "X";
					    } 
					    if ($enf_riesgo == "ENFERMEDAD RENAL CRÓNICA") {
					    	$enfermedad_renal = "X";
					    } 
					    if ($enf_riesgo == "EMBARAZO" && $respuesta[$i]['sexo'] == "F") {
					    	$embarazo = "X";
					    } 
					    if ($enf_riesgo == "HIPERTENSIÓN ARTERIAL") {
					    	$hipertension_arterial = "X";
					    } 
					    if ($enf_riesgo == "ENFERMEDAD CARDIACA") {
					    	$enfermedad_cardiaca = "X";
					    }
					    if ($enf_riesgo == "ENFERMEDAD ONCOLÓGICA") {
					    	$enfermedad_oncologica = "X";
					    }
					    if ($enf_riesgo == "ENFERMEDAD RESPIRATORIA") {
					    	$enfermedad_respiratoria = "X";
					    }
						}

					} elseif ($respuesta[$i]['enf_estado'] == "NO PRESENTA") {
						$enf_estado = "NO";

					} else {
						$enf_estado = "";
					}

					if ($respuesta[$i]['enf_riesgo_otros'] != "") {
						$enf_riesgo_otros1 = "X";
						$enf_riesgo_otros2 = $respuesta[$i]['enf_riesgo_otros'];
					} else {
						$enf_riesgo_otros1 = "";
						$enf_riesgo_otros2 = "";
					}

					// ADECUANDO CAMPO TOMO MUESTRA - CODIGO TIPO DE MUESTRA TOMADA
					if ($respuesta[$i]['estado_muestra'] == "SI") {
						$estado_muestra = $respuesta[$i]['estado_muestra'];
						if ($respuesta[$i]['tipo_muestra'] == "ASPIRADO") {
							$tipo_muestra = 1;
						} elseif ($respuesta[$i]['tipo_muestra'] == "ESPUTO") {
							$tipo_muestra = 7;
						} elseif ($respuesta[$i]['tipo_muestra'] == "LAVADO BRONCO ALVELAR") {
							$tipo_muestra = 3;
						} elseif ($respuesta[$i]['tipo_muestra'] == "HISOPADO NASOFARÍNGEO") {
							$tipo_muestra = 2;
						} elseif ($respuesta[$i]['tipo_muestra'] == "HISOPADO COMBINADO") {
							$tipo_muestra = 6;
						} else {
							$tipo_muestra = 4;
						}
						if ($respuesta[$i]['fecha_muestra'] == "0000-00-00") {
							$fecha_toma_muestra = "";
						} else {
							$fecha_toma_muestra = date("d/m/Y", strtotime($respuesta[$i]['fecha_muestra']));
						}						
					} else {
						$estado_muestra = $respuesta[$i]['estado_muestra'];
						$tipo_muestra = "";
						$fecha_toma_muestra = "";
					}

					// ADECUANDO CAMPO FECHA ENVIO MUESTRA
					if ($respuesta[$i]['fecha_envio'] == "0000-00-00") {
						$fecha_envio = "";
					} else {
						$fecha_envio = date("d/m/Y", strtotime($respuesta[$i]['fecha_envio']));
					}

					// ADECUANDO CAMPO METODO DIAGNOSTICO
					if ($respuesta[$i]['metodo_diagnostico'] == "RT-PCR EN TIEMPO REAL") {
							$metodo_diagnostico = 1;
					} elseif ($respuesta[$i]['metodo_diagnostico'] == "RT-PCR GENEXPERT" || $respuesta[$i]['metodo_diagnostico'] == "PRUEBA RÁPIDA - ANTICUERPOS (IgM/IgG)") {
						$metodo_diagnostico = 2;
					} elseif ($respuesta[$i]['metodo_diagnostico'] == "ELISA") {
						$metodo_diagnostico = 3;
					} elseif ($respuesta[$i]['metodo_diagnostico'] == "CLIA") {
						$metodo_diagnostico = 4;
					} elseif ($respuesta[$i]['metodo_diagnostico'] == "PRUEBA ANTIGÉNICA") {
						$metodo_diagnostico = 5;
					} else {
						$metodo_diagnostico = "";
					}

					// ADECUANDO CAMPO FECHA ENVIO RESULTADO
					if ($respuesta[$i]['fecha_resultado'] == "0000-00-00") {
						$fecha_resultado = "";
					} else {
						$fecha_resultado = date("d/m/Y", strtotime($respuesta[$i]['fecha_resultado']));
					}

					// ADECUANDO CAMPO CODIGO RESULTADO
					if ($respuesta[$i]['resultado_laboratorio'] == "POSITIVO") {
							$resultado_laboratorio = 1;
					} elseif ($respuesta[$i]['resultado_laboratorio'] == "NEGATIVO") {
						$resultado_laboratorio = 2;
					} elseif ($respuesta[$i]['resultado_laboratorio'] == "MUESTRA OBSERVADA") {
						$resultado_laboratorio = 3;
					} else {
						$resultado_laboratorio = "";
					}

					$datosJson .='[				
						"",
						"",
						"'.date("d/m/Y", strtotime($respuesta[$i]['fecha_notificacion'])).'",
						"'.$respuesta[$i]['semana_epidemiologica'].'",
						"'.$respuesta[$i]['busqueda_activa'].'",
						"CI",
						"'.$respuesta[$i]['nro_documento'].'",
						"",
						"'.date("d/m/Y", strtotime($respuesta[$i]['fecha_nacimiento'])).'",
						"'.$respuesta[$i]['edad'].'",
						"'.$respuesta[$i]['nombre'].'",
						"'.$respuesta[$i]['paterno'].'",
						"'.$respuesta[$i]['materno'].'",
						"",
						"'.$genero.'",
						"1",
						"BO",
						"'.$respuesta[$i]['telefono'].'",
						"",
						"'.$respuesta[$i]['calle'].'",
						"'.$respuesta[$i]['zona'].'",
						"'.$respuesta[$i]['nro_calle'].'",
						"'.$edad_menor.'",
						"'.$respuesta[$i]['nombre_apoderado'].'",
						"'.$respuesta[$i]['telefono_apoderado'].'",
						"SI",
						"0202",
						"'.str_replace('"','\\"',$respuesta[$i]['nombre_empleador']).'",
						"'.$respuesta[$i]['cod_asegurado'].'",
						"'.$tipo_asegurado.'",
						"'.$ocupacion.'",
						"'.str_replace('"','\\"',$otra_ocupacion).'",
						"'.$respuesta[$i]['contacto_covid'].'",
						"'.$fecha_contacto_covid.'",
						"",
						"",
						"'.$respuesta[$i]['localidad_contacto_covid'].'",
						"'.$respuesta[$i]['ant_vacuna'].'",
						"'.$primera_dosis.'",
						"'.$segunda_dosis.'",
						"'.$dosis_unica.'",
						"'.$primera_dosis_refuerzo.'",
						"'.$segunda_dosis_refuerzo.'",
						"'.$codigo_primera_dosis.'",
						"'.$codigo_segunda_dosis.'",
						"'.$codigo_dosis_unica.'",
						"'.$codigo_primera_dosis_refuerzo.'",
						"'.$codigo_segunda_dosis_refuerzo.'",
						"'.$fecha_dosis_vacuna.'",
						"'.$asintomatico.'",
						"'.$tos_seca.'",
						"'.$dolor_garganta.'",
						"'.$fiebre.'",
						"'.$dif_respiratoria.'",
						"'.$mialgias.'",
						"'.$malestar_gral.'",
						"'.$cefalea.'",
						"'.$perdida_olfato.'",
						"'.$perdida_gusto.'",
						"'.$malestares_otros1.'",
						"'.$malestares_otros2.'",
						"'.$estado_paciente.'",
						"'.$fecha_defuncion.'",
						"'.$diagnostico_clinico.'",
						"'.$otro_diagnostico.'",
						"'.$fecha_inicio_sintomas.'",
						"'.$semana_epidemiologica_sintomas.'",
						"'.$ambulatorio_internado.'",
						"'.$fecha_internacion.'",
						"",
						"'.$respuesta[$i]['lugar_aislamiento'].'",
						"'.$fecha_aislamiento.'",
						"'.$terapia_intensiva.'",
						"'.$fecha_ingreso_UTI.'",
						"'.$respuesta[$i]['ventilacion_mecanica'].'",
						"'.$enf_estado.'",
						"'.$diabetes.'",
						"'.$obesidad.'",
						"'.$enfermedad_renal.'",
						"'.$embarazo.'",
						"'.$hipertension_arterial.'",
						"'.$enfermedad_cardiaca.'",
						"'.$enfermedad_oncologica.'",
						"'.$enfermedad_respiratoria.'",
						"'.$enf_riesgo_otros1.'",
						"'.$enf_riesgo_otros2.'",
						"'.$estado_muestra.'",
						"'.$tipo_muestra.'",
						"",
						"'.$fecha_toma_muestra.'",
						"'.$fecha_envio.'",
						"'.$respuesta[$i]['observaciones_muestra'].'",
						"'.$metodo_diagnostico.'",
						"'.$fecha_envio.'",
						"",
						"'.$fecha_resultado.'",
						"'.$resultado_laboratorio.'",
						"",
						"'.$respuesta[$i]['nombre_notificador'].'",
						"'.$respuesta[$i]['telefono_notificador'].'"

					],';
				}

				$datosJson = substr($datosJson, 0, -1);

			$datosJson .= ']

			}';

		}
		
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

if (isset($_POST["reporteDatosFicha"])) {

	$reportesDatosFicha = new AjaxReportesFicha();
	$reportesDatosFicha -> fechaInicio = $_POST["fechaInicio"];
	$reportesDatosFicha -> fechaFin = $_POST["fechaFin"];
	$reportesDatosFicha -> ajaxMostrarReportesDatosFichaFechas();

}

if (isset($_POST["exportarDatosFichaSive"])) {

	$reportesDatosFicha = new AjaxReportesFicha();
	$reportesDatosFicha -> fechaInicio = $_POST["fechaInicio"];
	$reportesDatosFicha -> fechaFin = $_POST["fechaFin"];
	$reportesDatosFicha -> ajaxExportarDatosFichaSive();

}