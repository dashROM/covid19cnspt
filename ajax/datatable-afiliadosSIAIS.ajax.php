<?php

require_once "../controladores/afiliadosSIAIS.controlador.php";
require_once "../modelos/afiliadosSIAIS.modelo.php";

class TablaAfiliadosSIAIS {

	/*=============================================
	MOSTRAR LA TABLA DE POBLACION AFILIADA
	=============================================*/

	public $afiliado;

	public function mostrarTablaAfiliadosSIAIS() {
 
		
		$item1 = "nombre_completo";
		$item2 = "cod_asegurado";
		$valor = $this->afiliado;
		
		$respuesta = ControladorAfiliadosSIAIS::ctrMostrarAfiliadosSIAIS($item1, $item2, $valor);

		echo json_encode($respuesta);

	}
	
	/*=============================================
	MOSTRAR LA TABLA DE POBLACION AFILIADA DE ACUERDO AL CRITERIO DE IDEMPLEADOR
	=============================================*/
	
	public $idEmpleador;

	public function mostrarTablaAfiliadosEmpleadorSIAIS() {

		$item1 = "idempleador";
		$item2 = null;
		$valor = $this->idEmpleador;

		$afiliados = ControladorAfiliadosSIAIS::ctrMostrarAfiliadosSIAIS($item1, $item2, $valor);

		if ($afiliados == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($afiliados); $i++) { 

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/

					$botones = "<div class='btn-group'><button class='btn btn-info btnRegistrarResultadosCovid' idAfiliado='".$afiliados[$i]["idafiliacion"]."' data-toggle='tooltip' title='Seleccionar Afiliado'><i class='fas fa-check'></i></button></div>";

					
					$datosJson .='[
						"'.($i+1).'",					
						"'.$afiliados[$i]['pac_numero_historia'].'",
						"'.$afiliados[$i]['pac_codigo'].'",
						"'.$afiliados[$i]['pac_primer_apellido'].' '.$afiliados[$i]['pac_segundo_apellido'].' '.$afiliados[$i]['pac_nombre'].'",
						"'.date("d/m/Y", strtotime($afiliados[$i]['pac_fecha_nac'])).'",
						"'.$afiliados[$i]['emp_nro_empleador'].'",
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
ACTIVAR TABLA AFILIADOS
=============================================*/

if (isset($_GET["idEmpleador"])) {

	$activarAfiliadosSIAIS = new TablaAfiliadosSIAIS();
	$activarAfiliadosSIAIS -> idEmpleador = $_GET["idEmpleador"];
	$activarAfiliadosSIAIS -> mostrarTablaAfiliadosEmpleadorSIAIS();

} else if (isset($_POST["afiliado"])) {

	$activarAfiliadosSIAIS = new TablaAfiliadosSIAIS();
	$activarAfiliadosSIAIS -> afiliado = $_POST["afiliado"];
	$activarAfiliadosSIAIS -> mostrarTablaAfiliadosSIAIS();

}

