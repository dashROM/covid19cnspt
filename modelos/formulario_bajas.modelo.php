<?php

require_once "conexion.db.php";

class ModeloFormularioBajas {

	/*=============================================
	MOSTRAR LOS DATOS DE FORMULARIO DE BAJA QUE CUENTE UN AFILIADO
	=============================================*/
	
	static public function mdlMostrarFormularioBajas($tabla, $item, $valor) {

		if ($item != null) {

			// devuelve los campos que coincidan con el valor del item

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute(); 

			return $stmt->fetch();

		} else {

			// devuelve todos los datos de la tabla

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE NUEVO FORMULARIO DE BAJA A UN AFILIADO QUE TIENE RESULTADO DE LABORATORIO COVID
	=============================================*/

	static public function mdlIngresarFormularioBaja($tabla, $datos) {

		$pdo = Conexion::conectar();
		$stmt = $pdo->prepare("INSERT INTO $tabla(id_covid_resultado, riesgo, fecha_ini, fecha_fin, dias_incapacidad, lugar, fecha, clave, codigo) VALUES (:id_covid_resultado, :riesgo, :fecha_ini, :fecha_fin, :dias_incapacidad, :lugar, :fecha, :clave, :codigo)");

		$stmt->bindParam(":id_covid_resultado", $datos["id_covid_resultado"], PDO::PARAM_INT);
		$stmt->bindParam(":riesgo", $datos["riesgo"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ini", $datos["fecha_ini"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
		$stmt->bindParam(":dias_incapacidad", $datos["dias_incapacidad"], PDO::PARAM_STR);
		$stmt->bindParam(":lugar", $datos["lugar"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR DATOS DE FORMULARIO BAJA
	=============================================*/

	static public function mdlEditarFormularioBaja($tabla, $datos) {

		$pdo = Conexion::conectar();
		$stmt = $pdo->prepare("UPDATE $tabla SET id_covid_resultado = :id_covid_resultado, riesgo = :riesgo, fecha_ini = :fecha_ini, fecha_fin = :fecha_fin, dias_incapacidad = :dias_incapacidad, lugar = :lugar, fecha = :fecha, clave = :clave, imagen = :imagen WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":id_covid_resultado", $datos["id_covid_resultado"], PDO::PARAM_INT);
		$stmt->bindParam(":riesgo", $datos["riesgo"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ini", $datos["fecha_ini"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
		$stmt->bindParam(":dias_incapacidad", $datos["dias_incapacidad"], PDO::PARAM_STR);
		$stmt->bindParam(":lugar", $datos["lugar"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR REGISTRO DE FORMULARIO BAJA
	=============================================*/

	static public function mdlEliminarFormularioBaja($tabla, $datos) {

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

}