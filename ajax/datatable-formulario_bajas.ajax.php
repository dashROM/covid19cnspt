<?php

require_once "../controladores/formulario_bajas.controlador.php";
require_once "../modelos/formulario_bajas.modelo.php";

require_once "../controladores/covid_resultados.controlador.php";
require_once "../modelos/covid_resultados.modelo.php";

class TablaFormularioBajas {

	/*=============================================
	MOSTRAR LA TABLA DE DE AFILIADOS CON RESULTADOS DE LABORATORIO COVID
	=============================================*/
		
	public function mostrarTablaFormularioBajas() {

		$item = null;
		$valor = null;

		$formularioBajas = ControladorFormularioBajas::ctrMostrarFormularioBajas($item, $valor);

		if ($formularioBajas == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
			"data": [';

			for ($i = 0; $i < count($formularioBajas); $i++) { 				

				/*=============================================
				TRAEMOS LOS DATOS COVID RESULTADOS
				=============================================*/

				$itemCovidResultado = "id";
				$valorCovidResultado = $formularioBajas[$i]["id_covid_resultado"];

				$covidResultado = ControladorCovidResultados::ctrMostrarCovidResultados($itemCovidResultado, $valorCovidResultado);

				/*=============================================
				TRAEMOS LAS ACCIONES
				=============================================*/

				$botonImprimir = "<button class='btn btn-info btnImprimirFormularioBaja' idFormularioBaja='".$formularioBajas[$i]["id"]."' data-toggle='tooltip' title='Imprimir'><i class='fas fa-print'></i></button>";

				$botonEditar = "<button class='btn btn-warning btnEditarFormularioBaja' idFormularioBaja='".$formularioBajas[$i]["id"]."' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button>";

				$botonEliminar ="<button class='btn btn-danger btnEliminarFormularioBaja' idFormularioBaja='".$formularioBajas[$i]["id"]."' imagen='".$formularioBajas[$i]["imagen"]."' data-toggle='tooltip' title='Eliminar'><i class='fas fa-trash-alt'></i></button>";
				
				$botones = "<div class='btn-group'>".$botonImprimir.$botonEditar.$botonEliminar."</div>";				

				$datosJson .='[
					"'.$covidResultado["cod_laboratorio"].'",	
					"'.$covidResultado["cod_asegurado"].'",	
					"'.$covidResultado["paterno"].' '.$covidResultado["materno"].' '.$covidResultado["nombre"].'",
					"'.str_replace('"', '\"', $covidResultado["nombre_empleador"]).'",
					"'.$covidResultado["cod_empleador"].'",
					"'.$formularioBajas[$i]["riesgo"].'",
					"'.date("d-m-Y", strtotime($formularioBajas[$i]["fecha_ini"])).'",
					"'.date("d-m-Y", strtotime($formularioBajas[$i]["fecha_fin"])).'",
					"'.$formularioBajas[$i]["dias_incapacidad"].'",
					"'.$formularioBajas[$i]["lugar"].' '.date("d-m-Y", strtotime($formularioBajas[$i]["fecha"])).'",
					"'.$formularioBajas[$i]["clave"].'",
					"'.$botones.'"
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
ACTIVAR TABLA DE COVIDRESULTADOS
=============================================*/

$activarFormularioBajas = new TablaFormularioBajas();
$activarFormularioBajas -> mostrarTablaFormularioBajas();