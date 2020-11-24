<?php 

class ControladorPacientesAsegurados {
	
	/*=============================================
	MOSTRAR LOS DATOS DE PACIENTE ASEGURADO EN LA FICHA EPIDEMIOLOGICA
	=============================================*/
	
	static public function ctrMostrarPacientesAsegurados($item, $valor) {

		$tabla = "pacientes_asegurados";

		$respuesta = ModeloPacientesAsegurados::mdlMostrarPacientesAsegurados($tabla, $item, $valor);

		return $respuesta;

	}

}