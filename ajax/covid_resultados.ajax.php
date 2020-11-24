<?php

require_once "../controladores/reportes_covid.controlador.php";
require_once "../modelos/reportes_covid.modelo.php";

require_once "../controladores/covid_resultados.controlador.php";
require_once "../modelos/covid_resultados.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

require_once "../controladores/departamentos.controlador.php";
require_once "../modelos/departamentos.modelo.php";

require_once "../controladores/establecimientos.controlador.php";
require_once "../modelos/establecimientos.modelo.php";

require_once "../controladores/localidades.controlador.php";
require_once "../modelos/localidades.modelo.php";

require_once('../extensiones/tcpdf/tcpdf.php');

class AjaxCovidResultados {
	
	/*=============================================
	MOSTRAR RESULTADOS COVID POR FECHA DE TOMA DE MUESTRA
	=============================================*/
	
	public $fechaMuestra;

	public function ajaxMostrarCovidResultadosFechaMuestra()	{

		$fecha_formato = date("Y-m-d", strtotime($this->fechaMuestra));

		$item = "fecha_muestra";
		$valor = $fecha_formato;

		$respuesta = ControladorCovidResultados::ctrMostrarCovidResultadosFechaMuestra($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	MOSTRAR RESULTADOS COVID POR FECHA DE RESULTADO
	=============================================*/
	
	// public $fechaResultado;

	// public function ajaxMostrarCovidResultadosFechaResultado()	{

	// 	$fecha_formato = date("Y-m-d", strtotime($this->fechaResultado));

	// 	$item = "fecha_resultado";
	// 	$valor = $fecha_formato;

	// 	$respuesta = ControladorCovidResultados::ctrMostrarCovidResultadosFechaResultado($item, $valor);

	// 	echo json_encode($respuesta);

	// }

}

/*=============================================
MOSTRAR RESULTADOS COVID POR FECHA DE TOMA DE MUESTRA
=============================================*/

if (isset($_POST["resultadosFormBaja"])) {

	$resultadosCovid = new AjaxCovidResultados();
	$resultadosCovid -> fechaMuestra = $_POST["fechaMuestra"];
	$resultadosCovid -> ajaxMostrarCovidResultadosFechaMuestra();

}

/*=============================================
MOSTRAR RESULTADOS COVID POR FECHA DE TOMA DE MUESTRA
=============================================*/

// if (isset($_POST["resultadosLab"])) {

// 	$resultadosCovid = new AjaxCovidResultados();
// 	$resultadosCovid -> fechaResultado = $_POST["fechaResultado"];
// 	$resultadosCovid -> ajaxMostrarCovidResultadosFechaResultado();

// }
