<?php

require_once "conexion.db.php";

class ModeloPacientesAsegurados {

	/*=============================================
	MOSTRAR LOS DATOS DE PACIENTES ASEGURADOS EN LA FICHA EPIDEMIOLOGICA
	=============================================*/
	
	static public function mdlMostrarPacientesAsegurados($tabla, $item, $valor) {

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
	REGISTRO DE DATOS DEL PACIENTE ASEGURADO EN LA FICHA EPIDEMIOLOGICA
	=============================================*/

	static public function mdlIngresarPacienteAsegurado($tabla, $datos) {

		$pdo = Conexion::conectarBDFicha();

		// try {
 
		//     //We start our transaction.
		//     $pdo->beginTransaction();
		 
		    //Query 1: Attempt to insert the payment record into our database.
			
			$stmt = $pdo->prepare("INSERT INTO $tabla(cod_asegurado, cod_afiliado, cod_empleador, nombre_empleador, paterno, materno, nombre, sexo, nro_documento, fecha_nacimiento, edad, id_departamento, id_localidad, id_pais, zona, calle, nro_calle, telefono, email, nombre_apoderado, telefono_apoderado, id_ficha) VALUES (:cod_asegurado, :cod_afiliado, :cod_empleador, :nombre_empleador, :paterno, :materno, :nombre, :sexo, :nro_documento, :fecha_nacimiento, :edad, :id_departamento, :id_localidad, :id_pais, :zona, :calle, :nro_calle, :telefono, :email, :nombre_apoderado, :telefono_apoderado, :id_ficha)");

			$stmt->bindParam(":cod_asegurado", $datos["cod_asegurado"], PDO::PARAM_STR);
			$stmt->bindParam(":cod_afiliado", $datos["cod_afiliado"], PDO::PARAM_STR);
			$stmt->bindParam(":cod_empleador", $datos["cod_empleador"], PDO::PARAM_STR);
			$stmt->bindParam(":nombre_empleador", $datos["nombre_empleador"], PDO::PARAM_STR);
			$stmt->bindParam(":paterno", $datos["paterno"], PDO::PARAM_STR);
			$stmt->bindParam(":materno", $datos["materno"], PDO::PARAM_STR);
			$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
			$stmt->bindParam(":nro_documento", $datos["nro_documento"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
			$stmt->bindParam(":edad", $datos["edad"], PDO::PARAM_INT);
			$stmt->bindParam(":id_departamento", $datos["id_departamento"], PDO::PARAM_INT);
			$stmt->bindParam(":id_localidad", $datos["id_localidad"], PDO::PARAM_INT);
			$stmt->bindParam(":id_pais", $datos["id_pais"], PDO::PARAM_INT);
			$stmt->bindParam(":zona", $datos["zona"], PDO::PARAM_STR);
			$stmt->bindParam(":calle", $datos["calle"], PDO::PARAM_STR);
			$stmt->bindParam(":nro_calle", $datos["nro_calle"], PDO::PARAM_STR);
			$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
			$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
			$stmt->bindParam(":nombre_apoderado", $datos["nombre_apoderado"], PDO::PARAM_STR);
			$stmt->bindParam(":telefono_apoderado", $datos["telefono_apoderado"], PDO::PARAM_STR);
			$stmt->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);

			if ($stmt->execute()) {

				return "ok";

				// $id_paciente_asegurado = $pdo->lastInsertId();
		    
			    //Query 2: Attempt to update the fichas.

			 //    $stmt = $pdo->prepare("UPDATE fichas SET id_paciente_asegurado = :id_paciente_asegurado WHERE id = :id");

			 //    $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
				// $stmt->bindParam(":id_paciente_asegurado", $id_paciente_asegurado, PDO::PARAM_INT);

				// if ($stmt->execute()) {


				// 	//We've got this far without an exception, so commit the changes.
				//     $pdo->commit();

				//     return "ok";

				// } else {

				// 	$pdo->rollBack();

		  //   		return "error2";

				// }

			} else {
				
				return "error";

			}
		    
		// } 
		// //Our catch block will handle any exceptions that are thrown.
		// catch (Exception $e){
		//     //An exception has occured, which means that one of our database queries
		//     //failed.
		//     //Print out the error message.
		//     echo $e->getMessage();
		//     //Rollback the transaction.
		//     $pdo->rollBack();

		//     return "error";

		// }
		
		$stmt->close();
		$stmt = null;

	}

}