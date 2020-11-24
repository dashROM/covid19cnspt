<?php

require_once "conexion.db.php";

class ModeloCovidResultados {

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

			// devuelve todos los datos de la tabla

			$sql = "SELECT cr.id AS id, cr.cod_laboratorio AS cod_laboratorio, cr.cod_asegurado AS cod_asegurado, cr.cod_afiliado AS cod_afiliado, concat_ws(' ', cr.paterno, cr.materno, cr.nombre) AS nombre_completo, cr.documento_ci AS documento_ci, cr.fecha_muestra AS fecha_muestra, cr.tipo_muestra AS tipo_muestra, cr.fecha_recepcion AS fecha_recepcion, cr.muestra_control AS muestra_control, d.nombre_depto AS nombre_depto, e.nombre_establecimiento AS nombre_establecimiento, cr.sexo AS sexo, cr.fecha_nacimiento AS fecha_nacimiento, cr.telefono AS telefono, cr.email AS email, l.nombre_localidad AS nombre_localidad, cr.zona AS zona, concat_ws(' ', cr.calle, cr.nro_calle) AS direccion ,cr.fecha_resultado AS fecha_resultado, cr.resultado AS resultado, cr.cod_empleador AS cod_empleador, cr.nombre_empleador AS nombre_empleador, cr.observaciones AS observaciones, cr.estado AS estado, cr.foto AS foto FROM covid_resultados cr, departamentos d, establecimientos e, localidades l WHERE cr.id_departamento = d.id AND cr.id_establecimiento = e.id AND cr.id_localidad = l.id ORDER BY id DESC LIMIT 5000";

			// $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha_resultado DESC LIMIT 5000");

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt->execute();

			return $stmt->fetchAll();

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
		$stmt = $pdo->prepare("INSERT INTO $tabla(cod_asegurado, cod_afiliado, cod_empleador, nombre_empleador, fecha_recepcion, fecha_muestra, cod_laboratorio, nombre_laboratorio, muestra_control, tipo_muestra, id_departamento, id_establecimiento, documento_ci, foto, paterno, materno, nombre, sexo, fecha_nacimiento, telefono, email, id_localidad, zona, calle, nro_calle, resultado, fecha_resultado, observaciones, id_usuario) VALUES (:cod_asegurado, :cod_afiliado, :cod_empleador, :nombre_empleador, :fecha_recepcion, :fecha_muestra, :cod_laboratorio, :nombre_laboratorio, :muestra_control, :tipo_muestra, :id_departamento, :id_establecimiento, :documento_ci, :foto, :paterno, :materno, :nombre, :sexo, :fecha_nacimiento, :telefono, :email, :id_localidad, :zona, :calle, :nro_calle, :resultado, :fecha_resultado, :observaciones, :id_usuario)");

		$stmt->bindParam(":cod_asegurado", $datos["cod_asegurado"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_afiliado", $datos["cod_afiliado"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_empleador", $datos["cod_empleador"], PDO::PARAM_INT);
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

		$pdo = Conexion::conectar();
		$stmt = $pdo->prepare("UPDATE $tabla SET cod_asegurado = :cod_asegurado, cod_afiliado = :cod_afiliado, cod_empleador = :cod_empleador, nombre_empleador = :nombre_empleador, fecha_recepcion = :fecha_recepcion, fecha_muestra = :fecha_muestra, cod_laboratorio = :cod_laboratorio, nombre_laboratorio = :nombre_laboratorio, muestra_control = :muestra_control, tipo_muestra = :tipo_muestra, id_departamento = :id_departamento, id_establecimiento = :id_establecimiento, documento_ci = :documento_ci, foto = :foto, paterno = :paterno, materno = :materno, nombre = :nombre, sexo = :sexo, fecha_nacimiento = :fecha_nacimiento, telefono = :telefono, email = :email, id_localidad = :id_localidad, zona = :zona, calle = :calle, nro_calle = :nro_calle, resultado = :resultado, fecha_resultado = :fecha_resultado, observaciones = :observaciones, id_usuario = :id_usuario WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":cod_asegurado", $datos["cod_asegurado"], PDO::PARAM_INT);
		$stmt->bindParam(":cod_afiliado", $datos["cod_afiliado"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_empleador", $datos["cod_empleador"], PDO::PARAM_INT);
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