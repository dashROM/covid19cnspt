<?php


class ControladorConsultorios {

	/*=============================================
	MOSTRAR CONSULTORIOS
	=============================================*/
	
	static public function ctrMostrarConsultorios($item, $valor) {

		$tabla = "consultorios";

		$respuesta = ModeloConsultorios::mdlMostrarConsultorios($tabla, $item, $valor);

		return $respuesta;

	}

}