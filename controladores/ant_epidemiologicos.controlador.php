<?php 

class ControladorAntEpidemiologicos {
	
	/*=============================================
	MOSTRAR LOS DATOS DE ANTENCEDENTES EPIDEMIOLOGICOS EN LA FICHA EPIDEMIOLOGICA
	=============================================*/
	
	static public function ctrMostrarAntEpidemiologicos($item, $valor) {

		$tabla = "ant_epidemiologicos";

		$respuesta = ModeloAntEpidemiologicos::mdlMostrarAntEpidemiologico($tabla, $item, $valor);

		return $respuesta;

	}

}