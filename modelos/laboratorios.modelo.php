<?php

require_once "conexion.db.php";

class ModeloLaboratorios {

	/*=============================================
	MOSTRAR LOS DATOS CLINICOS EN LA FICHA EPIDEMIOLOGICA
	=============================================*/
	
	static public function mdlMostrarLaboratorios($tabla, $item, $valor) {

		if ($item != null) {

			// devuelve los campos que coincidan con el valor del item

			$stmt = Conexion::conectarBDFicha()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute(); 

			return $stmt->fetch();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE DATOS DE LABORATORIO DE LA FICHA EPIDEMIOLÓGICA
	=============================================*/

	static public function mdlGuardarLaboratorio($tabla, $datos) {

		$pdo1 = Conexion::conectarBDFicha();
		$pdo2 = Conexion::conectar();

		try {
 
		    //We start our transaction.
		    $pdo1->beginTransaction();
		    $pdo2->beginTransaction();
		 
		    //Consulta 1: Actualizando datos de la ficha Epidemiologica
			
			$stmt = $pdo1->prepare("UPDATE $tabla SET estado_muestra = :estado_muestra, id_establecimiento = :id_establecimiento, tipo_muestra = :tipo_muestra, nombre_laboratorio = :nombre_laboratorio, fecha_muestra = :fecha_muestra, fecha_envio =:fecha_envio, cod_laboratorio = :cod_laboratorio, responsable_muestra = :responsable_muestra, observaciones_muestra = :observaciones_muestra, resultado_laboratorio = :resultado_laboratorio, fecha_resultado = :fecha_resultado WHERE id_ficha = :id_ficha");

			$stmt->bindParam(":estado_muestra", $datos["estado_muestra"], PDO::PARAM_STR);
			$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
			$stmt->bindParam(":tipo_muestra", $datos["tipo_muestra"], PDO::PARAM_STR);
			$stmt->bindParam(":nombre_laboratorio", $datos["nombre_laboratorio"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_muestra", $datos["fecha_muestra"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_envio", $datos["fecha_envio"], PDO::PARAM_STR);
			$stmt->bindParam(":cod_laboratorio", $datos["cod_laboratorio"], PDO::PARAM_STR);
			$stmt->bindParam(":responsable_muestra", $datos["responsable_muestra"], PDO::PARAM_STR);
			$stmt->bindParam(":observaciones_muestra", $datos["observaciones_muestra"], PDO::PARAM_STR);
			$stmt->bindParam(":resultado_laboratorio", $datos["resultado_laboratorio"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_resultado", $datos["fecha_resultado"], PDO::PARAM_STR);
			$stmt->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);

			if ($stmt->execute()) {

				//Consulta 2: Actualizando datos del listado de Covid Resultados

				$stmt2 = $pdo2->prepare("INSERT INTO covid_resultados (cod_asegurado, cod_afiliado, cod_empleador, nombre_empleador, fecha_recepcion, fecha_muestra, cod_laboratorio, nombre_laboratorio, muestra_control, tipo_muestra, id_departamento, id_establecimiento, documento_ci, foto, paterno, materno, nombre, sexo, fecha_nacimiento, telefono, email, id_localidad, zona, calle, nro_calle, resultado, fecha_resultado, observaciones, id_usuario, id_ficha) VALUES (:cod_asegurado, :cod_afiliado, :cod_empleador, :nombre_empleador, :fecha_recepcion, :fecha_muestra, :cod_laboratorio, :nombre_laboratorio, :muestra_control, :tipo_muestra, :id_departamento, :id_establecimiento, :documento_ci, :foto, :paterno, :materno, :nombre, :sexo, :fecha_nacimiento, :telefono, :email, :id_localidad, :zona, :calle, :nro_calle, :resultado, :fecha_resultado, :observaciones, :id_usuario, :id_ficha)");

				$stmt2->bindParam(":cod_asegurado", $datos["cod_asegurado"], PDO::PARAM_STR);
				$stmt2->bindParam(":cod_afiliado", $datos["cod_afiliado"], PDO::PARAM_STR);
				$stmt2->bindParam(":cod_empleador", $datos["cod_empleador"], PDO::PARAM_INT);
				$stmt2->bindParam(":nombre_empleador", $datos["nombre_empleador"], PDO::PARAM_STR);
				$stmt2->bindParam(":fecha_recepcion", $datos["fecha_envio"], PDO::PARAM_STR);
				$stmt2->bindParam(":fecha_muestra", $datos["fecha_muestra"], PDO::PARAM_STR);
				$stmt2->bindParam(":cod_laboratorio", $datos["cod_laboratorio"], PDO::PARAM_INT);
				$stmt2->bindParam(":nombre_laboratorio", $datos["nombre_laboratorio"], PDO::PARAM_STR);
				$stmt2->bindParam(":muestra_control", $datos["muestra_control"], PDO::PARAM_STR);
				$stmt2->bindParam(":tipo_muestra", $datos["tipo_muestra"], PDO::PARAM_STR);
				$stmt2->bindParam(":id_departamento", $datos["id_departamento"], PDO::PARAM_INT);
				$stmt2->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
				$stmt2->bindParam(":documento_ci", $datos["documento_ci"], PDO::PARAM_STR);
				$stmt2->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
				$stmt2->bindParam(":paterno", $datos["paterno"], PDO::PARAM_STR);
				$stmt2->bindParam(":materno", $datos["materno"], PDO::PARAM_STR);
				$stmt2->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
				$stmt2->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
				$stmt2->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
				$stmt2->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
				$stmt2->bindParam(":email", $datos["email"], PDO::PARAM_STR);
				$stmt2->bindParam(":id_localidad", $datos["id_localidad"], PDO::PARAM_STR);
				$stmt2->bindParam(":zona", $datos["zona"], PDO::PARAM_STR);
				$stmt2->bindParam(":calle", $datos["calle"], PDO::PARAM_STR);
				$stmt2->bindParam(":nro_calle", $datos["nro_calle"], PDO::PARAM_STR);
				$stmt2->bindParam(":resultado", $datos["resultado_laboratorio"], PDO::PARAM_STR);
				$stmt2->bindParam(":fecha_resultado", $datos["fecha_resultado"], PDO::PARAM_STR);
				$stmt2->bindParam(":observaciones", $datos["observaciones_muestra"], PDO::PARAM_STR);
				$stmt2->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
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
				
				return  "error";

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
	REGISTRO DE DATOS DE LABORATORIO DE LA FICHA CONTROL Y SEGUIMIENTO
	=============================================*/

	static public function mdlGuardarLaboratorioControl($tabla, $datos) {

		$pdo1 = Conexion::conectarBDFicha();
		$pdo2 = Conexion::conectar();

		try {
 
		    //We start our transaction.
		    $pdo1->beginTransaction();
		    $pdo2->beginTransaction();
		 
		    //Query 1: Attempt to insert the payment record into our database.
		
			$stmt = $pdo1->prepare("UPDATE $tabla SET tipo_muestra = :tipo_muestra, nombre_laboratorio = :nombre_laboratorio, fecha_muestra = :fecha_muestra, fecha_envio =:fecha_envio, cod_laboratorio = :cod_laboratorio, responsable_muestra = :responsable_muestra, observaciones_muestra = :observaciones_muestra, resultado_laboratorio = :resultado_laboratorio, fecha_resultado = :fecha_resultado WHERE id_ficha = :id_ficha");

			$stmt->bindParam(":tipo_muestra", $datos["tipo_muestra"], PDO::PARAM_STR);
			$stmt->bindParam(":nombre_laboratorio", $datos["nombre_laboratorio"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_muestra", $datos["fecha_muestra"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_envio", $datos["fecha_envio"], PDO::PARAM_STR);
			$stmt->bindParam(":cod_laboratorio", $datos["cod_laboratorio"], PDO::PARAM_STR);
			$stmt->bindParam(":responsable_muestra", $datos["responsable_muestra"], PDO::PARAM_STR);
			$stmt->bindParam(":observaciones_muestra", $datos["observaciones_muestra"], PDO::PARAM_STR);
			$stmt->bindParam(":resultado_laboratorio", $datos["resultado_laboratorio"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_resultado", $datos["fecha_resultado"], PDO::PARAM_STR);
			$stmt->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);

			if ($stmt->execute()) {

				$stmt2 = $pdo2->prepare("INSERT INTO covid_resultados (cod_asegurado, cod_afiliado, cod_empleador, nombre_empleador, fecha_recepcion, fecha_muestra, cod_laboratorio, nombre_laboratorio, muestra_control, tipo_muestra, id_departamento, id_establecimiento, documento_ci, foto, paterno, materno, nombre, sexo, fecha_nacimiento, telefono, email, id_localidad, zona, calle, nro_calle, resultado, fecha_resultado, observaciones, id_usuario, id_ficha) VALUES (:cod_asegurado, :cod_afiliado, :cod_empleador, :nombre_empleador, :fecha_recepcion, :fecha_muestra, :cod_laboratorio, :nombre_laboratorio, :muestra_control, :tipo_muestra, :id_departamento, :id_establecimiento, :documento_ci, :foto, :paterno, :materno, :nombre, :sexo, :fecha_nacimiento, :telefono, :email, :id_localidad, :zona, :calle, :nro_calle, :resultado, :fecha_resultado, :observaciones, :id_usuario, :id_ficha)");

				$stmt2->bindParam(":cod_asegurado", $datos["cod_asegurado"], PDO::PARAM_STR);
				$stmt2->bindParam(":cod_afiliado", $datos["cod_afiliado"], PDO::PARAM_STR);
				$stmt2->bindParam(":cod_empleador", $datos["cod_empleador"], PDO::PARAM_INT);
				$stmt2->bindParam(":nombre_empleador", $datos["nombre_empleador"], PDO::PARAM_STR);
				$stmt2->bindParam(":fecha_recepcion", $datos["fecha_envio"], PDO::PARAM_STR);
				$stmt2->bindParam(":fecha_muestra", $datos["fecha_muestra"], PDO::PARAM_STR);
				$stmt2->bindParam(":cod_laboratorio", $datos["cod_laboratorio"], PDO::PARAM_INT);
				$stmt2->bindParam(":nombre_laboratorio", $datos["nombre_laboratorio"], PDO::PARAM_STR);
				$stmt2->bindParam(":muestra_control", $datos["muestra_control"], PDO::PARAM_STR);
				$stmt2->bindParam(":tipo_muestra", $datos["tipo_muestra"], PDO::PARAM_STR);
				$stmt2->bindParam(":id_departamento", $datos["id_departamento"], PDO::PARAM_INT);
				$stmt2->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
				$stmt2->bindParam(":documento_ci", $datos["documento_ci"], PDO::PARAM_STR);
				$stmt2->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
				$stmt2->bindParam(":paterno", $datos["paterno"], PDO::PARAM_STR);
				$stmt2->bindParam(":materno", $datos["materno"], PDO::PARAM_STR);
				$stmt2->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
				$stmt2->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
				$stmt2->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
				$stmt2->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
				$stmt2->bindParam(":email", $datos["email"], PDO::PARAM_STR);
				$stmt2->bindParam(":id_localidad", $datos["id_localidad"], PDO::PARAM_STR);
				$stmt2->bindParam(":zona", $datos["zona"], PDO::PARAM_STR);
				$stmt2->bindParam(":calle", $datos["calle"], PDO::PARAM_STR);
				$stmt2->bindParam(":nro_calle", $datos["nro_calle"], PDO::PARAM_STR);
				$stmt2->bindParam(":resultado", $datos["resultado_laboratorio"], PDO::PARAM_STR);
				$stmt2->bindParam(":fecha_resultado", $datos["fecha_resultado"], PDO::PARAM_STR);
				$stmt2->bindParam(":observaciones", $datos["observaciones_muestra"], PDO::PARAM_STR);
				$stmt2->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
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
				
				return  "error";

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

}