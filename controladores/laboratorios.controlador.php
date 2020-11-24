<?php 

class ControladorLaboratorios {
	
	/*=============================================
	MOSTRAR LOS DATOS DE LABORATORIO EN LA FICHA EPIDEMIOLOGICA
	=============================================*/
	
	static public function ctrMostrarLaboratorios($item, $valor) {

		$tabla = "laboratorios";

		$respuesta = ModeloLaboratorios::mdlMostrarLaboratorios($tabla, $item, $valor);

		return $respuesta;

	}

}