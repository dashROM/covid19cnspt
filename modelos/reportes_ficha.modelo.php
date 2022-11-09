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

		return $stmt->fetchAll();

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

	/*=============================================
	MOSTRAR RESULTADOS DATOS FICHA COVID FILTRADO POR RANGO DE FECHAS DE RESULTADO
	=============================================*/
	
	static public function mdlMostrarReportesDatosFichaFechas($valor1, $valor2) {
		$sql = "SELECT f.id_ficha, f.tipo_ficha, f.fecha_creacion, f.fecha_notificacion, f.semana_epidemiologica, f.busqueda_activa, f.nro_control, f.id_establecimiento, f.red_salud, f.id_departamento, f.id_localidad, concat_ws(' ', pa.paterno, pa.materno, pa.nombre) AS nombre_asegurado, pa.cod_asegurado, pa.cod_empleador, pa.nombre_empleador, pa.nro_documento, pa.sexo, pa.fecha_nacimiento, pa.edad, pa.id_departamento_paciente, pa.id_localidad_paciente, pa.id_pais_paciente, pa.zona, concat_ws(' ', pa.calle, pa.nro_calle) AS direccion, pa.telefono, pa.nombre_apoderado, pa.telefono_apoderado, ae.ocupacion, ae.ant_vacuna_influenza, ae.contacto_covid, ae.fecha_contacto_covid, ae.ant_vacuna, ae.fecha_dosis_vacuna, ae.dosis_vacuna, ae.proveedor_vacuna, ae.diagnosticado_covid, ae.fecha_diagnosticado_covid, dc.tipo_paciente, dc.fecha_inicio_sintomas, dc.malestares, dc.malestares_otros, dc.estado_paciente, dc.fecha_defuncion, dc.diagnostico_clinico, ha.tipo_aislamiento, ha.dias_notificacion, ha.dias_sin_sintomas, ha.fecha_aislamiento, ha.lugar_aislamiento, ha.fecha_internacion, ha.establecimiento_internacion, ha.ventilacion_mecanica, ha.terapia_intensiva, ha.fecha_ingreso_UTI, ha.lugar_ingreso_UTI, ha.tratamiento, ha.tratamiento_otros, eb.enf_estado, eb.enf_riesgo, eb.enf_riesgo_otros, l.estado_muestra, l.no_toma_muestra, l.id_establecimiento AS id_establecimiento2, l.tipo_muestra, l.nombre_laboratorio, l.cod_laboratorio, l.fecha_muestra, l.fecha_envio, l.responsable_muestra, l.observaciones_muestra, l.metodo_diagnostico, l.resultado_laboratorio, l.fecha_resultado, concat_ws(' ', pn.paterno_notificador, pn.materno_notificador, pn.nombre_notificador) AS nombre_notificador, pn.cargo_notificador, pn.telefono_notificador FROM fichas f, pacientes_asegurados pa, ant_epidemiologicos ae, datos_clinicos dc, hospitalizaciones_aislamientos ha, enfermedades_bases eb, laboratorios l, personas_notificadores pn WHERE f.id_ficha = pa.id_ficha AND f.id_ficha = ae.id_ficha AND f.id_ficha = dc.id_ficha AND f.id_ficha = ha.id_ficha AND f.id_ficha = eb.id_ficha AND f.id_ficha = l.id_ficha AND f.id_ficha = pn.id_ficha AND f.id_ficha AND f.estado_ficha = 1 AND l.fecha_resultado BETWEEN :fechaInicio AND :fechaFin ORDER BY l.fecha_resultado ASC";

		$stmt = Conexion::conectarBDFicha()->prepare($sql);

		$stmt->bindParam(":fechaInicio", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $valor2, PDO::PARAM_STR);

		$stmt->execute(); 

		return $stmt->fetchAll();

	}		

	/*=============================================
	MOSTRAR RESULTADOS DATOS FICHA COVID PARA EXPORTAR AL SIVE FILTRADO POR RANGO DE FECHAS DE RESULTADO
	=============================================*/
	
	static public function mdlExportarDatosFichaSive($valor1, $valor2) {
		$sql = "SELECT f.fecha_notificacion, f.semana_epidemiologica, f.busqueda_activa, pa.nro_documento, pa.fecha_nacimiento, pa.edad, pa.nombre, pa.paterno, pa.materno, pa.sexo, pa.telefono, pa.calle, pa.zona, pa.nro_calle, pa.nombre_apoderado, pa.telefono_apoderado, pa.nombre_empleador, pa.cod_asegurado, pa.cod_afiliado, ae.ocupacion, ae.contacto_covid, ae.fecha_contacto_covid, ae.localidad_contacto_covid, ae.ant_vacuna, ae.dosis_vacuna, ae.proveedor_vacuna, ae.fecha_dosis_vacuna, dc.tipo_paciente, dc.malestares, dc.malestares_otros, dc.estado_paciente, dc.fecha_defuncion, dc.diagnostico_clinico, dc.fecha_inicio_sintomas, ha.tipo_aislamiento, ha.fecha_internacion, ha.lugar_aislamiento, ha.fecha_aislamiento, ha.terapia_intensiva, ha.fecha_ingreso_UTI, ha.ventilacion_mecanica, eb.enf_estado, eb.enf_riesgo, eb.enf_riesgo_otros, l.estado_muestra, l.tipo_muestra, l.fecha_muestra, l.fecha_envio, l.observaciones_muestra, l.fecha_envio, l.cod_laboratorio, l.metodo_diagnostico, l.fecha_resultado, l.resultado_laboratorio, pn.nombre_notificador, pn.telefono_notificador FROM fichas f, pacientes_asegurados pa, ant_epidemiologicos ae, datos_clinicos dc, hospitalizaciones_aislamientos ha, enfermedades_bases eb, laboratorios l, personas_notificadores pn WHERE f.id_ficha = pa.id_ficha AND f.id_ficha = ae.id_ficha AND f.id_ficha = dc.id_ficha AND f.id_ficha = ha.id_ficha AND f.id_ficha = eb.id_ficha AND f.id_ficha = l.id_ficha AND f.id_ficha = pn.id_ficha AND f.id_ficha AND f.estado_ficha = 1 AND l.fecha_resultado BETWEEN :fechaInicio AND :fechaFin ORDER BY l.fecha_resultado ASC";

		$stmt = Conexion::conectarBDFicha()->prepare($sql);

		$stmt->bindParam(":fechaInicio", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $valor2, PDO::PARAM_STR);

		$stmt->execute(); 

		return $stmt->fetchAll();

	}		

}