<?php

require_once "conexion.db.php";

class ModeloFichas {

	/*=============================================
	MOSTRAR LOS DATOS DE FICHA EPIDEMIOLOGICA
	=============================================*/
	
	static public function mdlMostrarFichas($tabla, $item, $valor) {

		if ($item != null) {

			// devuelve los campos que coincidan con el valor del item

			$stmt = Conexion::conectarBDFicha()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute(); 

			return $stmt->fetch();

		} else {

			// devuelve todos los datos de la tabla

			$stmt = Conexion::conectarBDFicha()->prepare("SELECT f.id_ficha, f.tipo_ficha, l.fecha_muestra, f.busqueda_activa, pa.cod_asegurado, concat_ws(' ', pa.paterno, pa.materno, pa.nombre) AS nombre_completo, pa.nro_documento, pa.sexo, pa.fecha_nacimiento, l.resultado_laboratorio, l.fecha_resultado, f.estado_ficha FROM fichas f, pacientes_asegurados pa, laboratorios l WHERE f.id_ficha = pa.id_ficha AND f.id_ficha = l.id_ficha ORDER BY id_ficha DESC");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR LOS DATOS DE FICHA DE ACUERDO A LA FECHA
	=============================================*/
	
	static public function mdlMostrarFichasFecha($tabla, $item, $valor) {

		if ($item != null) {

			// devuelve los campos que coincidan con el valor del item

			$stmt = Conexion::conectarBDFicha()->prepare("SELECT f.id_ficha, f.tipo_ficha, l.fecha_muestra, f.busqueda_activa, pa.cod_asegurado, concat_ws(' ', pa.paterno, pa.materno, pa.nombre) AS nombre_completo, pa.nro_documento, pa.sexo, pa.fecha_nacimiento, l.resultado_laboratorio, l.fecha_resultado, f.estado_ficha FROM fichas f, pacientes_asegurados pa, laboratorios l WHERE f.id = pa.id_ficha AND f.id_ficha = l.id_ficha AND $item = :$item ORDER BY id_ficha DESC");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute(); 

			return $stmt->fetchAll();

		} else {

			// devuelve todos los datos de la tabla

			$stmt = Conexion::conectarBDFicha()->prepare("SELECT f.id_ficha, f.tipo_ficha, l.fecha_muestra, f.busqueda_activa, pa.cod_asegurado, concat_ws(' ', pa.paterno, pa.materno, pa.nombre) AS nombre_completo, pa.nro_documento, pa.sexo, pa.fecha_nacimiento, l.resultado_laboratorio, l.fecha_resultado, f.estado_ficha FROM fichas f, pacientes_asegurados pa, laboratorios l WHERE f.id_ficha = pa.id_ficha AND f.id = l.id_ficha ORDER BY id DESC ASC LIMIT 5000");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR DATOS DE UNA FICHA EPIDEMIOLOGICA
	=============================================*/
	
	static public function mdlMostrarDatosFicha($tabla, $item, $valor) {

		if ($item != null) {

			// devuelve los campos que coincidan con el valor del item

			$sql = "SELECT tipo_ficha, id_establecimiento, cod_establecimiento, id_consultorio, red_salud, id_departamento, id_localidad, fecha_notificacion, busqueda_activa, semana_epidemiologica, nro_control, busqueda_activa FROM $tabla WHERE $item = :$item";

			$stmt = Conexion::conectarBDFicha()->prepare($sql);

			// $stmt = Conexion::conectarBDFicha()->prepare("SELECT * FROM fichas WHERE id = 4");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt->execute(); 

			return $stmt->fetch();

		} else {

			// devuelve los campos que coincidan con el valor del item

			$sql = "SELECT * FROM $tabla";

			$stmt = Conexion::conectarBDFicha()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute(); 

			return $stmt->fetchAll();
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE NUEVA FICHA COVID	
	=============================================*/

	static public function mdlCrearFicha($tabla, $datos) {

		$pdo = Conexion::conectarBDFicha();

		try {
 
		    //Inicio de las transacciones.

		    $pdo->beginTransaction();
		 
		    // Consulta 1: Ingreso de datos por defecto en la tabla fichas.

			$stmt = $pdo->prepare("INSERT INTO $tabla(id_establecimiento, cod_establecimiento, red_salud, id_departamento, id_localidad, fecha_notificacion, semana_epidemiologica, busqueda_activa, tipo_ficha) VALUES (:id_establecimiento, :cod_establecimiento, :red_salud, :id_departamento, :id_localidad, :fecha_notificacion, :semana_epidemiologica, :busqueda_activa, :tipo_ficha)");

			$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
			$stmt->bindParam(":cod_establecimiento", $datos["cod_establecimiento"], PDO::PARAM_STR);
			$stmt->bindParam(":red_salud", $datos["red_salud"], PDO::PARAM_INT);
			$stmt->bindParam(":id_departamento", $datos["id_departamento"], PDO::PARAM_INT);
			$stmt->bindParam(":id_localidad", $datos["id_localidad"], PDO::PARAM_INT);
			$stmt->bindParam(":fecha_notificacion", $datos["fecha_notificacion"], PDO::PARAM_STR);
			$stmt->bindParam(":semana_epidemiologica", $datos["semana_epidemiologica"], PDO::PARAM_INT);
			$stmt->bindParam(":busqueda_activa", $datos["busqueda_activa"], PDO::PARAM_STR);
			$stmt->bindParam(":tipo_ficha", $datos["tipo_ficha"], PDO::PARAM_STR);

			if ($stmt->execute()) {

				// return $pdo->lastInsertId();
				$id_ficha = $pdo->lastInsertId();

				// Consulta 2: Ingreso de Datos por defecto en la tabla pacientes_asegurados.

			    $stmt = $pdo->prepare("INSERT INTO pacientes_asegurados(id_ficha) VALUES (:id_ficha)");

				$stmt->bindParam(":id_ficha", $id_ficha, PDO::PARAM_INT);

				if ($stmt->execute()) {

					// Consulta 3: Ingreso de Datos por defecto en la tabla ant_epidemiologicos.

				    $stmt = $pdo->prepare("INSERT INTO ant_epidemiologicos(id_ficha) VALUES (:id_ficha)");

					$stmt->bindParam(":id_ficha", $id_ficha, PDO::PARAM_INT);

					if ($stmt->execute()) {

						// Consulta 4: Ingreso de Datos por defecto en la tabla datos_clinicos.

					    $stmt = $pdo->prepare("INSERT INTO datos_clinicos(id_ficha) VALUES (:id_ficha)");

						$stmt->bindParam(":id_ficha", $id_ficha, PDO::PARAM_INT);

						if ($stmt->execute()) {

							// Consulta 5: Ingreso de Datos por defecto en la tabla hospitalizaciones_aislamientos.

						    $stmt = $pdo->prepare("INSERT INTO hospitalizaciones_aislamientos(id_ficha) VALUES (:id_ficha)");

							$stmt->bindParam(":id_ficha", $id_ficha, PDO::PARAM_INT);

							if ($stmt->execute()) {

								// Consulta 6: Ingreso de Datos por defecto en la tabla enfermedades_bases.

							    $stmt = $pdo->prepare("INSERT INTO enfermedades_bases(id_ficha) VALUES (:id_ficha)");

								$stmt->bindParam(":id_ficha", $id_ficha, PDO::PARAM_INT);

								if ($stmt->execute()) {

									// Consulta 7: Ingreso de Datos por defecto en la tabla laboratorios.

								    $stmt = $pdo->prepare("INSERT INTO laboratorios(id_ficha) VALUES (:id_ficha)");

									$stmt->bindParam(":id_ficha", $id_ficha, PDO::PARAM_INT);

									if ($stmt->execute()) {

										// Consulta 8: Ingreso de Datos por defecto en la tabla personas_notificadores.

									    $stmt = $pdo->prepare("INSERT INTO personas_notificadores(paterno_notificador, materno_notificador, nombre_notificador, cargo_notificador, id_ficha) VALUES (:paterno_notificador, :materno_notificador, :nombre_notificador, :cargo_notificador, :id_ficha)");

										$stmt->bindParam(":paterno_notificador", $datos["paterno_notificador"], PDO::PARAM_STR);
										$stmt->bindParam(":materno_notificador", $datos["materno_notificador"], PDO::PARAM_STR);
										$stmt->bindParam(":nombre_notificador", $datos["nombre_notificador"], PDO::PARAM_STR);
										$stmt->bindParam(":cargo_notificador", $datos["cargo_notificador"], PDO::PARAM_STR);
										$stmt->bindParam(":id_ficha", $id_ficha, PDO::PARAM_INT);

										if ($stmt->execute()) {

											// Permitir la transacción.
										    $pdo->commit();

										    return $id_ficha;

										} else {

											// Revertir la transacción.
											$pdo->rollBack();

							    			return "error8";

										}

									} else {

										// Revertir la transacción.
										$pdo->rollBack();

						    			return "error7";

									}

								} else {

									// Revertir la transacción.
									$pdo->rollBack();

					    			return "error6";

								}

							} else {

								// Revertir la transacción.
								$pdo->rollBack();

				    			return "error5";

							}

						} else {

							// Revertir la transacción.
							$pdo->rollBack();

			    			return "error4";

						}

					} else {

						// Revertir la transacción.
						$pdo->rollBack();

		    			return "error3";

					}

				} else {

					// Revertir la transacción.
					$pdo->rollBack();

		    		return "error2";

				}

			} else {
				
				return "error1";

			}

		} 
		// Bloque de captura manejará cualquier excepción que se lance.
		catch (Exception $e){
		    // Se ha producido una excepción, lo que significa que una de nuestras consultas de base de datos hafallado
		    // Imprimiendo mensaje de error.
		    echo $e->getMessage();
		    // Revertir la transacción.
		    $pdo->rollBack();

		    return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	GUARDAR DATOS DE FICHA EPIDEMIOLOGICA
	=============================================*/

	static public function mdlGuardarFichaEpidemiologica($tabla, $datos) {

		$pdo = Conexion::conectarBDFicha();

		try {
 
		    //Inicio de las transacciones.

		    $pdo->beginTransaction();
		 
		    // Consulta 1: Ingreso de datos por defecto en la tabla fichas.

			$stmt = $pdo->prepare("UPDATE $tabla SET id_establecimiento = :id_establecimiento, cod_establecimiento = :cod_establecimiento, id_consultorio = :id_consultorio, red_salud = :red_salud, id_departamento = :id_departamento, id_localidad = :id_localidad, fecha_notificacion = :fecha_notificacion, semana_epidemiologica = :semana_epidemiologica, busqueda_activa = :busqueda_activa, tipo_ficha = :tipo_ficha, estado_ficha = :estado_ficha  WHERE id_ficha = :id_ficha");

			$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
			$stmt->bindParam(":cod_establecimiento", $datos["cod_establecimiento"], PDO::PARAM_STR);
			$stmt->bindParam(":id_consultorio", $datos["id_consultorio"], PDO::PARAM_INT);
			$stmt->bindParam(":red_salud", $datos["red_salud"], PDO::PARAM_INT);
			$stmt->bindParam(":id_departamento", $datos["id_departamento"], PDO::PARAM_INT);
			$stmt->bindParam(":id_localidad", $datos["id_localidad"], PDO::PARAM_INT);
			$stmt->bindParam(":fecha_notificacion", $datos["fecha_notificacion"], PDO::PARAM_STR);
			$stmt->bindParam(":semana_epidemiologica", $datos["semana_epidemiologica"], PDO::PARAM_INT);
			$stmt->bindParam(":busqueda_activa", $datos["busqueda_activa"], PDO::PARAM_STR);
			$stmt->bindParam(":tipo_ficha", $datos["tipo_ficha"], PDO::PARAM_STR);
			$stmt->bindParam(":estado_ficha", $datos["estado_ficha"], PDO::PARAM_INT);
			$stmt->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);

			if ($stmt->execute()) {

				// Consulta 2: Ingreso de Datos por defecto en la tabla pacientes_asegurados.

			    $stmt = $pdo->prepare("UPDATE pacientes_asegurados SET cod_asegurado = :cod_asegurado, cod_afiliado = :cod_afiliado, cod_empleador = :cod_empleador, nombre_empleador = :nombre_empleador, paterno = :paterno, materno = :materno, nombre = :nombre, sexo = :sexo, nro_documento = :nro_documento, fecha_nacimiento = :fecha_nacimiento, edad = :edad, id_departamento_paciente = :id_departamento_paciente, id_localidad_paciente = :id_localidad_paciente, id_pais_paciente = :id_pais_paciente, zona = :zona, calle = :calle, nro_calle = :nro_calle, telefono = :telefono, nombre_apoderado = :nombre_apoderado, telefono_apoderado = :telefono_apoderado WHERE id_ficha = :id_ficha");

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
				$stmt->bindParam(":id_departamento_paciente", $datos["id_departamento_paciente"], PDO::PARAM_INT);
				$stmt->bindParam(":id_localidad_paciente", $datos["id_localidad_paciente"], PDO::PARAM_INT);
				$stmt->bindParam(":id_pais_paciente", $datos["id_pais_paciente"], PDO::PARAM_INT);
				$stmt->bindParam(":zona", $datos["zona"], PDO::PARAM_STR);
				$stmt->bindParam(":calle", $datos["calle"], PDO::PARAM_STR);
				$stmt->bindParam(":nro_calle", $datos["nro_calle"], PDO::PARAM_STR);
				$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
				$stmt->bindParam(":nombre_apoderado", $datos["nombre_apoderado"], PDO::PARAM_STR);
				$stmt->bindParam(":telefono_apoderado", $datos["telefono_apoderado"], PDO::PARAM_STR);
				$stmt->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);

				if ($stmt->execute()) {

					// Consulta 3: Ingreso de Datos por defecto en la tabla ant_epidemiologicos.

				    $stmt = $pdo->prepare("UPDATE ant_epidemiologicos SET ocupacion = :ocupacion, ant_vacuna_influenza = :ant_vacuna_influenza, fecha_vacuna_influenza = :fecha_vacuna_influenza, viaje_riesgo = :viaje_riesgo, pais_ciudad_riesgo = :pais_ciudad_riesgo, fecha_retorno = :fecha_retorno, nro_vuelo = :nro_vuelo, nro_asiento = :nro_asiento, contacto_covid = :contacto_covid, fecha_contacto_covid = :fecha_contacto_covid, nombre_contacto_covid = :nombre_contacto_covid, telefono_contacto_covid = :telefono_contacto_covid, pais_contacto_covid = :pais_contacto_covid, departamento_contacto_covid = :departamento_contacto_covid, localidad_contacto_covid = :localidad_contacto_covid WHERE  id_ficha = :id_ficha");

					$stmt->bindParam(":ocupacion", $datos["ocupacion"], PDO::PARAM_STR);
					$stmt->bindParam(":ant_vacuna_influenza", $datos["ant_vacuna_influenza"], PDO::PARAM_STR);
					$stmt->bindParam(":fecha_vacuna_influenza", $datos["fecha_vacuna_influenza"], PDO::PARAM_STR);
					$stmt->bindParam(":viaje_riesgo", $datos["viaje_riesgo"], PDO::PARAM_STR);
					$stmt->bindParam(":pais_ciudad_riesgo", $datos["pais_ciudad_riesgo"], PDO::PARAM_STR);
					$stmt->bindParam(":fecha_retorno", $datos["fecha_retorno"], PDO::PARAM_STR);
					$stmt->bindParam(":nro_vuelo", $datos["nro_vuelo"], PDO::PARAM_STR);
					$stmt->bindParam(":nro_asiento", $datos["nro_asiento"], PDO::PARAM_STR);
					$stmt->bindParam(":contacto_covid", $datos["contacto_covid"], PDO::PARAM_STR);
					$stmt->bindParam(":fecha_contacto_covid", $datos["fecha_contacto_covid"], PDO::PARAM_STR);
					$stmt->bindParam(":nombre_contacto_covid", $datos["nombre_contacto_covid"], PDO::PARAM_STR);
					$stmt->bindParam(":telefono_contacto_covid", $datos["telefono_contacto_covid"], PDO::PARAM_STR);
					$stmt->bindParam(":pais_contacto_covid", $datos["pais_contacto_covid"], PDO::PARAM_STR);
					$stmt->bindParam(":departamento_contacto_covid", $datos["departamento_contacto_covid"], PDO::PARAM_STR);
					$stmt->bindParam(":localidad_contacto_covid", $datos["localidad_contacto_covid"], PDO::PARAM_STR);
					$stmt->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);

					if ($stmt->execute()) {

						// Consulta 4: Ingreso de Datos por defecto en la tabla datos_clinicos.

					    $stmt = $pdo->prepare("UPDATE datos_clinicos SET fecha_inicio_sintomas = :fecha_inicio_sintomas, malestares = :malestares, malestares_otros = :malestares_otros, estado_paciente = :estado_paciente, fecha_defuncion = :fecha_defuncion, diagnostico_clinico = :diagnostico_clinico WHERE id_ficha = :id_ficha");

						$stmt->bindParam(":fecha_inicio_sintomas", $datos["fecha_inicio_sintomas"], PDO::PARAM_STR);
						$stmt->bindParam(":malestares", $datos["malestares"], PDO::PARAM_STR);
						$stmt->bindParam(":malestares_otros", $datos["malestares_otros"], PDO::PARAM_STR);
						$stmt->bindParam(":estado_paciente", $datos["estado_paciente"], PDO::PARAM_STR);
						$stmt->bindParam(":fecha_defuncion", $datos["fecha_defuncion"], PDO::PARAM_STR);
						$stmt->bindParam(":diagnostico_clinico", $datos["diagnostico_clinico"], PDO::PARAM_STR);
						$stmt->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);

						if ($stmt->execute()) {

							// Consulta 5: Ingreso de Datos por defecto en la tabla hospitalizaciones_aislamientos.

						    $stmt = $pdo->prepare("UPDATE hospitalizaciones_aislamientos SET fecha_aislamiento = :fecha_aislamiento, lugar_aislamiento = :lugar_aislamiento, fecha_internacion = :fecha_internacion, establecimiento_internacion = :establecimiento_internacion, ventilacion_mecanica = :ventilacion_mecanica, terapia_intensiva = :terapia_intensiva, fecha_ingreso_UTI = :fecha_ingreso_UTI WHERE id_ficha = :id_ficha");

							$stmt->bindParam(":fecha_aislamiento", $datos["fecha_aislamiento"], PDO::PARAM_STR);
							$stmt->bindParam(":lugar_aislamiento", $datos["lugar_aislamiento"], PDO::PARAM_STR);
							$stmt->bindParam(":fecha_internacion", $datos["fecha_internacion"], PDO::PARAM_STR);
							$stmt->bindParam(":establecimiento_internacion", $datos["establecimiento_internacion"], PDO::PARAM_STR);
							$stmt->bindParam(":ventilacion_mecanica", $datos["ventilacion_mecanica"], PDO::PARAM_STR);
							$stmt->bindParam(":terapia_intensiva", $datos["terapia_intensiva"], PDO::PARAM_STR);
							$stmt->bindParam(":fecha_ingreso_UTI", $datos["fecha_ingreso_UTI"], PDO::PARAM_STR);
							$stmt->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);

							if ($stmt->execute()) {

								// Consulta 6: Ingreso de Datos por defecto en la tabla enfermedades_bases.

							    $stmt = $pdo->prepare("UPDATE enfermedades_bases SET enf_estado = :enf_estado, enf_riesgo = :enf_riesgo, enf_riesgo_otros = :enf_riesgo_otros WHERE id_ficha = :id_ficha");

								$stmt->bindParam(":enf_estado", $datos["enf_estado"], PDO::PARAM_STR);
								$stmt->bindParam(":enf_riesgo", $datos["enf_riesgo"], PDO::PARAM_STR);
								$stmt->bindParam(":enf_riesgo_otros", $datos["enf_riesgo_otros"], PDO::PARAM_STR);
								$stmt->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);

								if ($stmt->execute()) {

									// Consulta 7: Ingreso de Datos por defecto en la tabla laboratorios.

								    $stmt = $pdo->prepare("UPDATE laboratorios SET estado_muestra = :estado_muestra, id_establecimiento = :id_establecimiento, tipo_muestra = :tipo_muestra, fecha_muestra = :fecha_muestra, fecha_envio = :fecha_envio, responsable_muestra = :responsable_muestra WHERE id_ficha = :id_ficha");

										$stmt->bindParam(":estado_muestra", $datos["estado_muestra"], PDO::PARAM_STR);
										$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento_lab"], PDO::PARAM_INT);
										$stmt->bindParam(":tipo_muestra", $datos["tipo_muestra"], PDO::PARAM_STR);
										$stmt->bindParam(":fecha_muestra", $datos["fecha_muestra"], PDO::PARAM_STR);
										$stmt->bindParam(":fecha_envio", $datos["fecha_envio"], PDO::PARAM_STR);
										$stmt->bindParam(":responsable_muestra", $datos["responsable_muestra"], PDO::PARAM_STR);
										$stmt->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);

									if ($stmt->execute()) {

										// Consulta 8: Ingreso de Datos por defecto en la tabla personas_notificadores.

										$stmt = $pdo->prepare("UPDATE personas_notificadores SET paterno_notificador = :paterno_notificador, materno_notificador = :materno_notificador, nombre_notificador = :nombre_notificador, telefono_notificador = :telefono_notificador, cargo_notificador = :cargo_notificador WHERE id_ficha = :id_ficha");

										$stmt->bindParam(":paterno_notificador", $datos["paterno_notificador"], PDO::PARAM_STR);
										$stmt->bindParam(":materno_notificador", $datos["materno_notificador"], PDO::PARAM_STR);
										$stmt->bindParam(":nombre_notificador", $datos["nombre_notificador"], PDO::PARAM_STR);
										$stmt->bindParam(":telefono_notificador", $datos["telefono_notificador"], PDO::PARAM_STR);
										$stmt->bindParam(":cargo_notificador", $datos["cargo_notificador"], PDO::PARAM_STR);
										$stmt->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);

										if ($stmt->execute()) {

											// Permitir la transacción.
										    $pdo->commit();

										    return "ok";

										} else {

											// Revertir la transacción.
											$pdo->rollBack();

							    			return "error8";

										}


									} else {

										// Revertir la transacción.
										$pdo->rollBack();

						    			return "error7";

									}

								} else {

									// Revertir la transacción.
									$pdo->rollBack();

					    			return "error6";

								}

							} else {

								// Revertir la transacción.
								$pdo->rollBack();

				    			return "error5";

							}

						} else {

							// Revertir la transacción.
							$pdo->rollBack();

			    			return "error4";

						}

					} else {

						// Revertir la transacción.
						$pdo->rollBack();

		    			return "error3";

					}

				} else {

					// Revertir la transacción.
					$pdo->rollBack();

		    		return "error2";

				}

			} else {
				
				return "error1";

			}

		} 
		// Bloque de captura manejará cualquier excepción que se lance.
		catch (Exception $e){
		    // Se ha producido una excepción, lo que significa que una de nuestras consultas de base de datos hafallado
		    // Imprimiendo mensaje de error.
		    echo $e->getMessage();
		    // Revertir la transacción.
		    $pdo->rollBack();

		    return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	GUARDAR DATOS DE FICHA CONTROL Y SEGUIMIENTO
	=============================================*/

	static public function mdlGuardarFichaControl($tabla, $datos) {

		$pdo = Conexion::conectarBDFicha();

		try {
 
		    //Inicio de las transacciones.

		    $pdo->beginTransaction();
		 
		    // Consulta 1: Ingreso de datos por defecto en la tabla fichas.

			$stmt = $pdo->prepare("UPDATE $tabla SET id_establecimiento = :id_establecimiento, id_consultorio = :id_consultorio, id_departamento = :id_departamento, id_localidad = :id_localidad, fecha_notificacion = :fecha_notificacion, nro_control = :nro_control, tipo_ficha = :tipo_ficha, estado_ficha = :estado_ficha WHERE id_ficha = :id_ficha");

			$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
			$stmt->bindParam(":id_consultorio", $datos["id_consultorio"], PDO::PARAM_INT);
			$stmt->bindParam(":id_departamento", $datos["id_departamento"], PDO::PARAM_INT);
			$stmt->bindParam(":id_localidad", $datos["id_localidad"], PDO::PARAM_INT);
			$stmt->bindParam(":fecha_notificacion", $datos["fecha_notificacion"], PDO::PARAM_STR);
			$stmt->bindParam(":nro_control", $datos["nro_control"], PDO::PARAM_INT);
			$stmt->bindParam(":tipo_ficha", $datos["tipo_ficha"], PDO::PARAM_STR);
			$stmt->bindParam(":estado_ficha", $datos["estado_ficha"], PDO::PARAM_INT);
			$stmt->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);

			if ($stmt->execute()) {

				// Consulta 2: Ingreso de Datos por defecto en la tabla pacientes_asegurados.

			    $stmt = $pdo->prepare("UPDATE pacientes_asegurados SET cod_asegurado = :cod_asegurado, cod_afiliado = :cod_afiliado, cod_empleador = :cod_empleador, nombre_empleador = :nombre_empleador, paterno = :paterno, materno = :materno, nombre = :nombre, sexo = :sexo, nro_documento = :nro_documento, fecha_nacimiento = :fecha_nacimiento, edad = :edad, telefono = :telefono WHERE id_ficha = :id_ficha");

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
				$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
				$stmt->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);

				if ($stmt->execute()) {

					// Consulta 3: Ingreso de Datos por defecto en la tabla hospitalizaciones_aislamientos. (Seguimiento)

				    $stmt = $pdo->prepare("UPDATE hospitalizaciones_aislamientos SET dias_notificacion = :dias_notificacion, dias_sin_sintomas = :dias_sin_sintomas, fecha_aislamiento = :fecha_aislamiento, lugar_aislamiento = :lugar_aislamiento, fecha_internacion = :fecha_internacion, establecimiento_internacion = :establecimiento_internacion, fecha_ingreso_UTI = :fecha_ingreso_UTI, lugar_ingreso_UTI = :lugar_ingreso_UTI, ventilacion_mecanica = :ventilacion_mecanica, tratamiento = :tratamiento, tratamiento_otros = :tratamiento_otros WHERE id_ficha = :id_ficha");

					$stmt->bindParam(":dias_notificacion", $datos["dias_notificacion"], PDO::PARAM_STR);
					$stmt->bindParam(":dias_sin_sintomas", $datos["dias_sin_sintomas"], PDO::PARAM_INT);
					$stmt->bindParam(":fecha_aislamiento", $datos["fecha_aislamiento"], PDO::PARAM_STR);
					$stmt->bindParam(":lugar_aislamiento", $datos["lugar_aislamiento"], PDO::PARAM_STR);
					$stmt->bindParam(":fecha_internacion", $datos["fecha_internacion"], PDO::PARAM_STR);
					$stmt->bindParam(":establecimiento_internacion", $datos["establecimiento_internacion"], PDO::PARAM_STR);
					$stmt->bindParam(":fecha_ingreso_UTI", $datos["fecha_ingreso_UTI"], PDO::PARAM_STR);
					$stmt->bindParam(":lugar_ingreso_UTI", $datos["lugar_ingreso_UTI"], PDO::PARAM_STR);
					$stmt->bindParam(":ventilacion_mecanica", $datos["ventilacion_mecanica"], PDO::PARAM_STR);
					$stmt->bindParam(":tratamiento", $datos["tratamiento"], PDO::PARAM_STR);
					$stmt->bindParam(":tratamiento_otros", $datos["tratamiento_otros"], PDO::PARAM_STR);
					$stmt->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);

					if ($stmt->execute()) {

						// Consulta 4: Ingreso de Datos por defecto en la tabla laboratorios

					    $stmt = $pdo->prepare("UPDATE laboratorios SET tipo_muestra = :tipo_muestra, fecha_muestra = :fecha_muestra, fecha_envio = :fecha_envio, responsable_muestra = :responsable_muestra WHERE id_ficha = :id_ficha");

						$stmt->bindParam(":tipo_muestra", $datos["tipo_muestra"], PDO::PARAM_STR);
						$stmt->bindParam(":fecha_muestra", $datos["fecha_muestra"], PDO::PARAM_STR);
						$stmt->bindParam(":fecha_envio", $datos["fecha_envio"], PDO::PARAM_STR);
						$stmt->bindParam(":responsable_muestra", $datos["responsable_muestra"], PDO::PARAM_STR);
						$stmt->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);

						if ($stmt->execute()) {

							// Consulta 5: Ingreso de Datos por defecto en la tabla personas_notificadores.

							$stmt = $pdo->prepare("UPDATE personas_notificadores SET paterno_notificador = :paterno_notificador, materno_notificador = :materno_notificador, nombre_notificador = :nombre_notificador, telefono_notificador = :telefono_notificador, cargo_notificador = :cargo_notificador WHERE id_ficha = :id_ficha");

							$stmt->bindParam(":paterno_notificador", $datos["paterno_notificador"], PDO::PARAM_STR);
							$stmt->bindParam(":materno_notificador", $datos["materno_notificador"], PDO::PARAM_STR);
							$stmt->bindParam(":nombre_notificador", $datos["nombre_notificador"], PDO::PARAM_STR);
							$stmt->bindParam(":telefono_notificador", $datos["telefono_notificador"], PDO::PARAM_STR);
							$stmt->bindParam(":cargo_notificador", $datos["cargo_notificador"], PDO::PARAM_STR);
							$stmt->bindParam(":id_ficha", $datos["id_ficha"], PDO::PARAM_INT);

							if ($stmt->execute()) {

								// Permitir la transacción.
							    $pdo->commit();

							    return "ok";

							} else {

								// Revertir la transacción.
								$pdo->rollBack();

				    			return "error5";

							}

						} else {

							// Revertir la transacción.
							$pdo->rollBack();

			    			return "error4";

						}

					} else {

						// Revertir la transacción.
						$pdo->rollBack();

		    			return "error3";

					}

				} else {

					// Revertir la transacción.
					$pdo->rollBack();

		    		return "error2";

				}

			} else {
				
				return "error1";

			}

		} 
		// Bloque de captura manejará cualquier excepción que se lance.
		catch (Exception $e){
		    // Se ha producido una excepción, lo que significa que una de nuestras consultas de base de datos hafallado
		    // Imprimiendo mensaje de error.
		    echo $e->getMessage();
		    // Revertir la transacción.
		    $pdo->rollBack();

		    return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	GUARDANDO DATO DE UN CAMPO EN FICHA EPIDEMIOLÓGICA DINAMICAMENTE
	=============================================*/

	static public function mdlGuardarCampoFichaEpidemiologica($id_ficha, $item, $valor, $tabla) {

		$pdo = Conexion::conectarBDFicha();
		 
	    // Consulta 1: Ingreso de datos por defecto en la tabla fichas.

	    $sql = "UPDATE $tabla SET $item = :valor WHERE id_ficha = :id_ficha";

		$stmt = $pdo->prepare($sql);

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt->bindParam(":id_ficha", $id_ficha, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
				
		} else {

		    return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	GUARDANDO DATOS AFILIADO EN FICHA EPIDEMIOLÓGICA DINAMICAMENTE
	=============================================*/

	static public function mdlGuardarAfiliadoFicha($id_ficha, $datos, $tabla) {

		$nacimiento = new DateTime($datos["pac_fecha_nac"]);

		$hoy = new DateTime();

		$edad = $hoy->diff($nacimiento);

		$pdo = Conexion::conectarBDFicha();
		 
	    // Consulta 1: Ingreso de datos por defecto en la tabla fichas.

		$stmt = $pdo->prepare("UPDATE $tabla SET cod_asegurado = :cod_asegurado, cod_afiliado = :cod_afiliado, cod_empleador = :cod_empleador, nombre_empleador = :nombre_empleador, paterno = :paterno, materno = :materno, nombre = :nombre, fecha_nacimiento = :fecha_nacimiento, edad = :edad WHERE id_ficha = :id_ficha");

		$stmt->bindParam(":cod_asegurado", $datos["pac_numero_historia"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_afiliado", $datos["pac_codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_empleador", $datos["emp_nro_empleador"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_empleador", $datos["emp_nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":paterno", $datos["pac_primer_apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":materno", $datos["pac_segundo_apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["pac_nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["pac_fecha_nac"], PDO::PARAM_STR);
		$stmt->bindParam(":edad", $edad->y, PDO::PARAM_STR);
		// $stmt->bindParam(":edad", $datos["pac_fecha_nac"], PDO::PARAM_STR);
		$stmt->bindParam(":id_ficha", $id_ficha, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "";
				
		} else {

		    return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

}