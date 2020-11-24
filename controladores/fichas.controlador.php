<?php 

class ControladorFichas {
	
	/*=============================================
	MOSTRAR LOS DATOS DE FICHAS COVID-19
	=============================================*/
	
	static public function ctrMostrarFichas($item, $valor) {

		$tabla = "fichas";

		$respuesta = ModeloFichas::mdlMostrarFichas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR LOS DE FICHA COVID-19 DE ACUERDO A LA FECHA
	=============================================*/
	
	static public function ctrMostrarFichasFecha($item, $valor) {

		$tabla = "fichas";

		$respuesta = ModeloFichas::mdlMostrarFichasFecha($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR DATOS DE UNA FICHA COVID 19
	=============================================*/
	
	static public function ctrMostrarDatosFicha($item, $valor) {

		$tabla = "fichas";

		$respuesta = ModeloFichas::mdlMostrarDatosFicha($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR UNA NUEVA FICHA
	=============================================*/
	
	static public function ctrCrearFicha($datos) {

		$tabla = "fichas";

		$respuesta = ModeloFichas::mdlCrearFicha($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	GUARDANDO DATOS DE FICHA EPIDEMIOLÓGICA
	=============================================*/
	
	static public function ctrGuardarFichaEpidemiologica($datos) {

		$tabla = "fichas";

		$respuesta = ModeloFichas::mdlGuardarFichaEpidemiologica($tabla, $datos);

		echo $respuesta;

	}

	/*=============================================
	GUARDANDO DATOS DE FICHA CONTROL Y SEGUIMIENTO
	=============================================*/
	
	static public function ctrGuardarFichaControl($datos) {

		$tabla = "fichas";

		$respuesta = ModeloFichas::mdlGuardarFichaControl($tabla, $datos);

		echo $respuesta;

	}

	/*=============================================
	GUARDANDO DATO DE UN CAMPO EN FICHA EPIDEMIOLÓGICA DINAMICAMENTE
	=============================================*/
	
	static public function ctrGuardarCampoFichaEpidemiologica($id_ficha, $item, $valor, $tabla) {

		$respuesta = ModeloFichas::mdlGuardarCampoFichaEpidemiologica($id_ficha, $item, $valor, $tabla);

		echo $respuesta;

	}

	/*=============================================
	GUARDANDO DATOS AFILIADO EN FICHA EPIDEMIOLÓGICA DINAMICAMENTE
	=============================================*/
	
	static public function ctrGuardarAfiliadoFicha($id_ficha, $datos) {

		$tabla = "pacientes_asegurados";

		$respuesta = ModeloFichas::mdlGuardarAfiliadoFicha($id_ficha, $datos, $tabla);

		echo $respuesta;

	}

}