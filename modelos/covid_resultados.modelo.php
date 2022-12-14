<?php

require_once "conexion.db.php";

class ModeloCovidResultados {

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA COVID RESULTADOS (LABORATORIO)
	=============================================*/
	
	static public function mdlContarCovidResultadosLab($tabla) {

		// devuelve el numero de registros de la vista mostrar_covid_resultados

		$sql = "SELECT * FROM $tabla";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->execute();

		$cuenta_col = $stmt->rowCount();

		return $cuenta_col;

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA COVID RESULTADOS FILTRADO (LABORATORIO)
	=============================================*/
	
	static public function mdlContarFiltradoCovidResultadosLab($tabla, $sql) {


		if($sql == "") {

			// devuelve el numero de registros de la vista_covid_resultados

			$sql2 = "SELECT * FROM $tabla WHERE 1 = 1";

			$stmt = Conexion::conectar()->prepare($sql2);

			$stmt->execute();

			$cuenta_col = $stmt->rowCount();

			return $cuenta_col;

		} else {

			// devuelve el numero de registros de la vista_covid_resultados

			$sql2 = "SELECT * FROM $tabla WHERE 1 = 1 $sql";

			$stmt = Conexion::conectar()->prepare($sql2);

			$stmt->execute();

			$cuenta_col = $stmt->rowCount();

			return $cuenta_col;

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTAR LOS REGISTROS QUE EXISTE EN LA TABLA COVID RESULTADOS (LABORATORIO)
	=============================================*/
	
	static public function mdlMostrarCovidResultadosLab($tabla, $sql) {

		// devuelve el numero de registros de la vista mostrar_covid_resultados

		$sql = "SELECT * FROM $tabla WHERE 1 = 1 $sql";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA COVID RESULTADOS (CENTRO COVID)
	=============================================*/
	
	static public function mdlContarCovidResultadosCentro($tabla) {

		// devuelve el numero de registros de la vista mostrar_covid_resultados

		$sql2 = "SELECT * FROM $tabla WHERE estado = 1";

		$stmt = Conexion::conectar()->prepare($sql2);

		$stmt->execute();

		$cuenta_col = $stmt->rowCount();

		return $cuenta_col;

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR LOS AFILIADOS QUE TIENEN RESULTADOS DE PRUEBAS DE LABORATORIO COVID-19 (CENTRO COVID)
	=============================================*/
	
	static public function mdlContarFiltradoCovidResultadosCentro($tabla, $sql) {

		// devuelve el numero de registros de la vista mostrar_covid_resultados

		if($sql == "") {

			$sql2 = "SELECT * FROM $tabla WHERE 1 = 1 AND estado = 1";

			$stmt = Conexion::conectar()->prepare($sql2);

			$stmt->execute();

			$cuenta_col = $stmt->rowCount();

			return $cuenta_col;

		} else {

			// devuelve el numero de registros de la vista mostrar_covid_resultados

			$sql2 = "SELECT * FROM $tabla WHERE 1 = 1 AND estado = 1 $sql";

			$stmt = Conexion::conectar()->prepare($sql2);

			$stmt->execute();

			$cuenta_col = $stmt->rowCount();

			return $cuenta_col;

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTAR LOS REGISTROS QUE EXISTE EN LA TABLA COVID RESULTADOS (CENTRO COVID)
	=============================================*/
	
	static public function mdlMostrarCovidResultadosCentro($tabla, $sql) {

		// devuelve el numero de registros de la vista mostrar_covid_resultados

		$sql = "SELECT * FROM $tabla WHERE 1 = 1 AND estado = 1 $sql";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR LOS DATOS DE AFILIADOS CON LABORATORIO COVID-19
	=============================================*/
	
	static public function mdlMostrarCovidResultados($tabla, $item, $valor) {

		if ($item != null) {

			// devuelve los campos que coincidan con el valor del item

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute(); 

			return $stmt->fetch();

		} else {

			// // devuelve todos los datos de la tabla

			// $sql = "SELECT cr.id AS id, cr.cod_laboratorio AS cod_laboratorio, cr.cod_asegurado AS cod_asegurado, cr.cod_afiliado AS cod_afiliado, concat_ws(' ', cr.paterno, cr.materno, cr.nombre) AS nombre_completo, cr.documento_ci AS documento_ci, cr.fecha_muestra AS fecha_muestra, cr.tipo_muestra AS tipo_muestra, cr.fecha_recepcion AS fecha_recepcion, cr.muestra_control AS muestra_control, d.nombre_depto AS nombre_depto, e.nombre_establecimiento AS nombre_establecimiento, cr.sexo AS sexo, cr.fecha_nacimiento AS fecha_nacimiento, cr.telefono AS telefono, cr.email AS email, l.nombre_localidad AS nombre_localidad, cr.zona AS zona, concat_ws(' ', cr.calle, cr.nro_calle) AS direccion ,cr.fecha_resultado AS fecha_resultado, cr.resultado AS resultado, cr.cod_empleador AS cod_empleador, cr.nombre_empleador AS nombre_empleador, cr.observaciones AS observaciones, cr.estado AS estado, cr.foto AS foto FROM covid_resultados cr, departamentos d, establecimientos e, localidades l WHERE cr.id_departamento = d.id AND cr.id_establecimiento = e.id AND cr.id_localidad = l.id ORDER BY id DESC LIMIT 5000";

			// // $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha_resultado DESC LIMIT 5000");

			// $stmt = Conexion::conectar()->prepare($sql);

			// $stmt->execute();

			// return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR LOS RESULTADOS COVID DE ACUERDO A LA FECHA DE RESULTADO
	=============================================*/
	
	static public function mdlMostrarCovidResultadosFecha($tabla, $item, $valor) {

		if ($item != null) {

			// devuelve los campos que coincidan con el valor del item

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY cod_laboratorio");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute(); 

			return $stmt->fetchAll();

		} else {

			// devuelve todos los datos de la tabla

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY cod_laboratorio ASC LIMIT 5000");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	REGISTRO DE NUEVO AFILIADOS CON LABORATORIO COVID RESULTADO
	=============================================*/

	static public function mdlIngresarCovidResultado($tabla, $datos) {

		$pdo = Conexion::conectar();
		$stmt = $pdo->prepare("INSERT INTO $tabla(cod_asegurado, cod_afiliado, cod_empleador, nombre_empleador, fecha_recepcion, fecha_muestra, cod_laboratorio, nombre_laboratorio, muestra_control, tipo_muestra, id_departamento, id_establecimiento, documento_ci, foto, paterno, materno, nombre, sexo, fecha_nacimiento, telefono, email, id_localidad, zona, calle, nro_calle, metodo_diagnostico, resultado, fecha_resultado, observaciones, id_usuario) VALUES (:cod_asegurado, :cod_afiliado, :cod_empleador, :nombre_empleador, :fecha_recepcion, :fecha_muestra, :cod_laboratorio, :nombre_laboratorio, :muestra_control, :tipo_muestra, :id_departamento, :id_establecimiento, :documento_ci, :foto, :paterno, :materno, :nombre, :sexo, :fecha_nacimiento, :telefono, :email, :id_localidad, :zona, :calle, :nro_calle, :metodo_diagnostico, :resultado, :fecha_resultado, :observaciones, :id_usuario)");

		$stmt->bindParam(":cod_asegurado", $datos["cod_asegurado"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_afiliado", $datos["cod_afiliado"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_empleador", $datos["cod_empleador"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_empleador", $datos["nombre_empleador"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_recepcion", $datos["fecha_recepcion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_muestra", $datos["fecha_muestra"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_laboratorio", $datos["cod_laboratorio"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre_laboratorio", $datos["nombre_laboratorio"], PDO::PARAM_STR);
		$stmt->bindParam(":muestra_control", $datos["muestra_control"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_muestra", $datos["tipo_muestra"], PDO::PARAM_STR);
		$stmt->bindParam(":id_departamento", $datos["id_departamento"], PDO::PARAM_INT);
		$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
		$stmt->bindParam(":documento_ci", $datos["documento_ci"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":paterno", $datos["paterno"], PDO::PARAM_STR);
		$stmt->bindParam(":materno", $datos["materno"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":id_localidad", $datos["id_localidad"], PDO::PARAM_STR);
		$stmt->bindParam(":zona", $datos["zona"], PDO::PARAM_STR);
		$stmt->bindParam(":calle", $datos["calle"], PDO::PARAM_STR);
		$stmt->bindParam(":nro_calle", $datos["nro_calle"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_diagnostico", $datos["metodo_diagnostico"], PDO::PARAM_STR);
		$stmt->bindParam(":resultado", $datos["resultado"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_resultado", $datos["fecha_resultado"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR REGISTRO DE AFILIADO CON LABORATORIO COVID RESULTADO
	=============================================*/

	static public function mdlEditarCovidResultado($tabla, $datos) {

		$pdo1 = Conexion::conectar();
		$pdo2 = Conexion::conectarBDFicha();

		try {
 
		    //We start our transaction.
		    $pdo1->beginTransaction();
		    $pdo2->beginTransaction();
		 
		    //Consulta 1: Actualizando datos del listado de Covid Resultados

			$stmt = $pdo1->prepare("UPDATE $tabla SET cod_asegurado = :cod_asegurado, cod_afiliado = :cod_afiliado, cod_empleador = :cod_empleador, nombre_empleador = :nombre_empleador, fecha_recepcion = :fecha_recepcion, fecha_muestra = :fecha_muestra, cod_laboratorio = :cod_laboratorio, nombre_laboratorio = :nombre_laboratorio, muestra_control = :muestra_control, tipo_muestra = :tipo_muestra, id_departamento = :id_departamento, id_establecimiento = :id_establecimiento, documento_ci = :documento_ci, foto = :foto, paterno = :paterno, materno = :materno, nombre = :nombre, sexo = :sexo, fecha_nacimiento = :fecha_nacimiento, telefono = :telefono, email = :email, id_localidad = :id_localidad, zona = :zona, calle = :calle, nro_calle = :nro_calle, metodo_diagnostico = :metodo_diagnostico, resultado = :resultado, fecha_resultado = :fecha_resultado, observaciones = :observaciones, id_usuario = :id_usuario WHERE id = :id");

			$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
			$stmt->bindParam(":cod_asegurado", $datos["cod_asegurado"], PDO::PARAM_STR);
			$stmt->bindParam(":cod_afiliado", $datos["cod_afiliado"], PDO::PARAM_STR);
			$stmt->bindParam(":cod_empleador", $datos["cod_empleador"], PDO::PARAM_STR);
			$stmt->bindParam(":nombre_empleador", $datos["nombre_empleador"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_recepcion", $datos["fecha_recepcion"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_muestra", $datos["fecha_muestra"], PDO::PARAM_STR);
			$stmt->bindParam(":cod_laboratorio", $datos["cod_laboratorio"], PDO::PARAM_INT);
			$stmt->bindParam(":nombre_laboratorio", $datos["nombre_laboratorio"], PDO::PARAM_STR);
			$stmt->bindParam(":muestra_control", $datos["muestra_control"], PDO::PARAM_STR);
			$stmt->bindParam(":tipo_muestra", $datos["tipo_muestra"], PDO::PARAM_STR);
			$stmt->bindParam(":id_departamento", $datos["id_departamento"], PDO::PARAM_INT);
			$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
			$stmt->bindParam(":documento_ci", $datos["documento_ci"], PDO::PARAM_STR);
			$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
			$stmt->bindParam(":paterno", $datos["paterno"], PDO::PARAM_STR);
			$stmt->bindParam(":materno", $datos["materno"], PDO::PARAM_STR);
			$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
			$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
			$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
			$stmt->bindParam(":id_localidad", $datos["id_localidad"], PDO::PARAM_STR);
			$stmt->bindParam(":zona", $datos["zona"], PDO::PARAM_STR);
			$stmt->bindParam(":calle", $datos["calle"], PDO::PARAM_STR);
			$stmt->bindParam(":nro_calle", $datos["nro_calle"], PDO::PARAM_STR);
			$stmt->bindParam(":metodo_diagnostico", $datos["metodo_diagnostico"], PDO::PARAM_STR);
			$stmt->bindParam(":resultado", $datos["resultado"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_resultado", $datos["fecha_resultado"], PDO::PARAM_STR);
			$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
			$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

			if ($stmt->execute()) {

				//Consulta 2: Actualizando datos de la ficha Epidemiologica

				$stmt2 = $pdo2->prepare("UPDATE laboratorios SET tipo_muestra = :tipo_muestra, nombre_laboratorio = :nombre_laboratorio, cod_laboratorio = :cod_laboratorio, observaciones_muestra = :observaciones_muestra, metodo_diagnostico = :metodo_diagnostico, resultado_laboratorio = :resultado_laboratorio, fecha_resultado = :fecha_resultado WHERE id_ficha = :id_ficha");

				$stmt2->bindParam(":tipo_muestra", $datos["tipo_muestra"], PDO::PARAM_STR);
				$stmt2->bindParam(":nombre_laboratorio", $datos["nombre_laboratorio"], PDO::PARAM_STR);
				$stmt2->bindParam(":cod_laboratorio", $datos["cod_laboratorio"], PDO::PARAM_STR);
				$stmt2->bindParam(":observaciones_muestra", $datos["observaciones"], PDO::PARAM_STR);
				$stmt2->bindParam(":metodo_diagnostico", $datos["metodo_diagnostico"], PDO::PARAM_STR);
				$stmt2->bindParam(":resultado_laboratorio", $datos["resultado"], PDO::PARAM_STR);
				$stmt2->bindParam(":fecha_resultado", $datos["fecha_resultado"], PDO::PARAM_STR);
				$stmt2->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);

				if ($stmt2->execute()) {

					//We've got this far without an exception, so commit the changes.
				    $pdo1->commit();
				    $pdo2->commit();

				    return "ok";

				} else {

					$pdo1->rollBack();
					$pdo2->rollBack();

		    		return "error2";

				}

			} else {
				
				return "error";

			}

		} 
		//Our catch block will handle any exceptions that are thrown.
		catch (Exception $e){
		    //An exception has occured, which means that one of our database queries
		    //failed.
		    //Print out the error message.
		    echo $e->getMessage();
		    //Rollback the transaction.
		    $pdo1->rollBack();
		    $pdo2->rollBack();

		    return "error";

		}
		
		$stmt->close();
		$stmt = null;
		$stmt2->close();
		$stmt2 = null;

	}

	/*=============================================
	BORRAR REGISTRO DE AFILIADO CON LABORATORIO COVID RESULTADO
	=============================================*/

	static public function mdlEliminarCovidResultado($tabla, $datos) {

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;
		
	}

	/*=============================================
	PUBLICAR REGISTRO DE AFILIADO CON LABORATORIO COVID RESULTADO
	=============================================*/

	static public function mdlPublicarCovidResultado($tabla, $id, $estado) {

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado WHERE id = :id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":estado", $estado, PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;
		
	}

}