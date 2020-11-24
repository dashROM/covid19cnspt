<?php

require_once "conexion.db.php";

class ModeloReportesFicha {

	/*=============================================
	TABULANDO LOS DATOS DE FICHA EPIDEMIOLÓGICA BUSQUEDA ACTIVA SI
	=============================================*/
	
	static public function mdlContarBusquedaActiva($valor1, $valor2, $valor3) {

		// devuelve los campos que coincidan con el rango de fechas

		$sql = "SELECT COUNT(f.busqueda_activa) AS busqueda_activa FROM fichas f, laboratorios l WHERE f.id_ficha = l.id_ficha AND f.tipo_ficha = 'FICHA EPIDEMIOLOGICA' AND f.busqueda_activa = :busqueda_activa AND l.fecha_muestra BETWEEN :fechaInicio AND :fechaFin";

		$stmt = Conexion::conectarBDFicha()->prepare($sql);

		$stmt->bindParam(":fechaInicio", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $valor2, PDO::PARAM_STR);
		$stmt->bindParam(":busqueda_activa", $valor3, PDO::PARAM_STR);

		$stmt->execute(); 

		return $stmt->fetch();

	}

	/*=============================================
	TABULANDO LOS DATOS DE FICHA EPIDEMIOLÓGICA SEXO PACIENTE
	=============================================*/
	
	static public function mdlContarSexoPaciente($valor1, $valor2, $valor3) {
		$sql = "SELECT COUNT(pa.sexo) AS sexo FROM fichas f, pacientes_asegurados pa, laboratorios l WHERE f.id_ficha = l.id_ficha AND f.id_ficha = pa.id_ficha AND f.tipo_ficha = 'FICHA EPIDEMIOLOGICA' AND pa.sexo = :sexo AND l.fecha_muestra BETWEEN :fechaInicio AND :fechaFin";

		$stmt = Conexion::conectarBDFicha()->prepare($sql);

		$stmt->bindParam(":fechaInicio", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $valor2, PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $valor3, PDO::PARAM_STR);

		$stmt->execute(); 

		return $stmt->fetch();

	}

	/*=============================================
	TABULANDO LOS DATOS DE FICHA EPIDEMIOLÓGICA OCUPACION
	=============================================*/
	
	static public function mdlContarOcupacion($valor1, $valor2, $valor3) {
		$sql = "SELECT COUNT(ae.ocupacion) AS ocupacion FROM fichas f, ant_epidemiologicos ae, laboratorios l WHERE f.id_ficha = l.id_ficha AND f.id_ficha = ae.id_ficha AND f.tipo_ficha = 'FICHA EPIDEMIOLOGICA' AND ae.ocupacion = :ocupacion AND l.fecha_muestra BETWEEN :fechaInicio AND :fechaFin";

		$stmt = Conexion::conectarBDFicha()->prepare($sql);

		$stmt->bindParam(":fechaInicio", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $valor2, PDO::PARAM_STR);
		$stmt->bindParam(":ocupacion", $valor3, PDO::PARAM_STR);

		$stmt->execute(); 

		return $stmt->fetch();

	}

	/*=============================================
	TABULANDO LOS DATOS DE FICHA EPIDEMIOLÓGICA OTRA OCUPACIÓN
	=============================================*/
	
	static public function mdlContarOtraOcupacion($valor1, $valor2) {
		$sql = "SELECT COUNT(ae.ocupacion) AS ocupacion FROM fichas f, ant_epidemiologicos ae, laboratorios l WHERE f.id_ficha = l.id_ficha AND f.id_ficha = ae.id_ficha AND f.tipo_ficha = 'FICHA EPIDEMIOLOGICA' AND ae.ocupacion <> 'PERSONAL DE SALUD' AND ae.ocupacion <> 'PERSONAL DE LABORATORIO' AND ae.ocupacion <> 'TRABAJADOR PRENSA' AND ae.ocupacion <> 'FF.AA.' AND ae.ocupacion <> 'POLICIA' AND ae.ocupacion <> '' AND l.fecha_muestra BETWEEN :fechaInicio AND :fechaFin";

		$stmt = Conexion::conectarBDFicha()->prepare($sql);

		$stmt->bindParam(":fechaInicio", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $valor2, PDO::PARAM_STR);

		$stmt->execute(); 

		return $stmt->fetch();

	}

	/*=============================================
	TABULANDO LOS DATOS DE FICHA EPIDEMIOLÓGICA ANTECEDENTES DE VACUNACIÓN INFLUENZA
	=============================================*/
	
	static public function mdlContarVacunaInfluenza($valor1, $valor2, $valor3) {
		$sql = "SELECT COUNT(ae.ant_vacuna_influenza) AS ant_vacuna_influenza FROM fichas f, ant_epidemiologicos ae, laboratorios l WHERE f.id_ficha = l.id_ficha AND f.id_ficha = ae.id_ficha AND f.tipo_ficha = 'FICHA EPIDEMIOLOGICA' AND ae.ant_vacuna_influenza = :ant_vacuna_influenza AND l.fecha_muestra BETWEEN :fechaInicio AND :fechaFin";

		$stmt = Conexion::conectarBDFicha()->prepare($sql);

		$stmt->bindParam(":fechaInicio", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $valor2, PDO::PARAM_STR);
		$stmt->bindParam(":ant_vacuna_influenza", $valor3, PDO::PARAM_STR);

		$stmt->execute(); 

		return $stmt->fetch();

	}

	/*=============================================
	TABULANDO LOS DATOS DE FICHA EPIDEMIOLÓGICA VIAJE DE RIESGO
	=============================================*/
	
	static public function mdlContarViajeRiesgo($valor1, $valor2, $valor3) {
		$sql = "SELECT COUNT(ae.viaje_riesgo) AS viaje_riesgo FROM fichas f, ant_epidemiologicos ae, laboratorios l WHERE f.id_ficha = l.id_ficha AND f.id_ficha = ae.id_ficha AND f.tipo_ficha = 'FICHA EPIDEMIOLOGICA' AND ae.viaje_riesgo = :viaje_riesgo AND l.fecha_muestra BETWEEN :fechaInicio AND :fechaFin";

		$stmt = Conexion::conectarBDFicha()->prepare($sql);

		$stmt->bindParam(":fechaInicio", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $valor2, PDO::PARAM_STR);
		$stmt->bindParam(":viaje_riesgo", $valor3, PDO::PARAM_STR);

		$stmt->execute(); 

		return $stmt->fetch();

	}

	/*=============================================
	TABULANDO LOS DATOS DE FICHA EPIDEMIOLÓGICA CONTACTO COVID
	=============================================*/
	
	static public function mdlContarContactoCovid($valor1, $valor2, $valor3) {
		$sql = "SELECT COUNT(ae.contacto_covid) AS contacto_covid FROM fichas f, ant_epidemiologicos ae, laboratorios l WHERE f.id_ficha = l.id_ficha AND f.id_ficha = ae.id_ficha AND f.tipo_ficha = 'FICHA EPIDEMIOLOGICA' AND ae.contacto_covid = :contacto_covid AND l.fecha_muestra BETWEEN :fechaInicio AND :fechaFin";

		$stmt = Conexion::conectarBDFicha()->prepare($sql);

		$stmt->bindParam(":fechaInicio", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $valor2, PDO::PARAM_STR);
		$stmt->bindParam(":contacto_covid", $valor3, PDO::PARAM_STR);

		$stmt->execute(); 

		return $stmt->fetch();

	}

	/*=============================================
	TABULANDO LOS DATOS DE FICHA EPIDEMIOLÓGICA MALESTARES
	=============================================*/
	
	static public function mdlContarMalestar($valor1, $valor2, $valor3) {
		$sql = "SELECT dc.malestares FROM fichas f, datos_clinicos dc, laboratorios l WHERE f.id_ficha = l.id_ficha AND f.id_ficha = dc.id_ficha AND f.tipo_ficha = 'FICHA EPIDEMIOLOGICA' AND l.fecha_muestra BETWEEN :fechaInicio AND :fechaFin";

		$stmt = Conexion::conectarBDFicha()->prepare($sql);

		$stmt->bindParam(":fechaInicio", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $valor2, PDO::PARAM_STR);

		$stmt->execute(); 

		return $stmt->fetchAll();

	}

	/*=============================================
	TABULANDO LOS DATOS DE FICHA EPIDEMIOLÓGICA OTRO MALESTAR
	=============================================*/
	
	static public function mdlContarOtroMalestar($valor1, $valor2) {
		$sql = "SELECT COUNT(dc.malestares_otros) AS malestares_otros FROM fichas f, datos_clinicos dc, laboratorios l WHERE f.id_ficha = l.id_ficha AND f.id_ficha = dc.id_ficha AND f.tipo_ficha = 'FICHA EPIDEMIOLOGICA' AND dc.malestares_otros <> '' AND l.fecha_muestra BETWEEN :fechaInicio AND :fechaFin";

		$stmt = Conexion::conectarBDFicha()->prepare($sql);

		$stmt->bindParam(":fechaInicio", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $valor2, PDO::PARAM_STR);

		$stmt->execute(); 

		return $stmt->fetch();

	}

	/*=============================================
	TABULANDO LOS DATOS DE FICHA EPIDEMIOLÓGICA CONTACTO COVID
	=============================================*/
	
	static public function mdlContarEstadoPaciente($valor1, $valor2, $valor3) {
		$sql = "SELECT COUNT(dc.estado_paciente) AS estado_paciente FROM fichas f, datos_clinicos dc, laboratorios l WHERE f.id_ficha = l.id_ficha AND f.id_ficha = dc.id_ficha AND f.tipo_ficha = 'FICHA EPIDEMIOLOGICA' AND dc.estado_paciente = :estado_paciente AND l.fecha_muestra BETWEEN :fechaInicio AND :fechaFin";

		$stmt = Conexion::conectarBDFicha()->prepare($sql);

		$stmt->bindParam(":fechaInicio", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $valor2, PDO::PARAM_STR);
		$stmt->bindParam(":estado_paciente", $valor3, PDO::PARAM_STR);

		$stmt->execute(); 

		return $stmt->fetch();

	}


	/*=============================================
	TABULANDO LOS DATOS DE FICHA EPIDEMIOLÓGICA DIAGNOSTICO CLINICO
	=============================================*/
	
	static public function mdlContarDiagnostico($valor1, $valor2, $valor3) {
		$sql = "SELECT COUNT(dc.diagnostico_clinico) AS diagnostico_clinico FROM fichas f, datos_clinicos dc, laboratorios l WHERE f.id_ficha = l.id_ficha AND f.id_ficha = dc.id_ficha AND f.tipo_ficha = 'FICHA EPIDEMIOLOGICA' AND dc.diagnostico_clinico = :diagnostico_clinico AND l.fecha_muestra BETWEEN :fechaInicio AND :fechaFin";

		$stmt = Conexion::conectarBDFicha()->prepare($sql);

		$stmt->bindParam(":fechaInicio", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $valor2, PDO::PARAM_STR);
		$stmt->bindParam(":diagnostico_clinico", $valor3, PDO::PARAM_STR);

		$stmt->execute(); 

		return $stmt->fetch();

	}

	/*=============================================
	TABULANDO LOS DATOS DE FICHA EPIDEMIOLÓGICA OTRO DIAGNOSTICO CLINICO
	=============================================*/
	
	static public function mdlContarOtroDiagnostico($valor1, $valor2) {
		$sql = "SELECT COUNT(dc.diagnostico_clinico) AS diagnostico_clinico FROM fichas f, datos_clinicos dc, laboratorios l WHERE f.id_ficha = l.id_ficha AND f.id_ficha = dc.id_ficha AND f.tipo_ficha = 'FICHA EPIDEMIOLOGICA' AND dc.diagnostico_clinico <> 'IRA' AND dc.diagnostico_clinico <> 'IRAG' AND dc.diagnostico_clinico <> 'NEUMONIA' AND dc.diagnostico_clinico <> '' AND l.fecha_muestra BETWEEN :fechaInicio AND :fechaFin";

		$stmt = Conexion::conectarBDFicha()->prepare($sql);

		$stmt->bindParam(":fechaInicio", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $valor2, PDO::PARAM_STR);

		$stmt->execute(); 

		return $stmt->fetch();

	}

}