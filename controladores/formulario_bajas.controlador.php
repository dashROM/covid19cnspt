<?php 

class ControladorFormularioBajas {
	
	/*=============================================
	MOSTRAR LOS AFILIADOS QUE TIENEN PRUEBAS DE LABORATORIO COVID-19 Y FORMULARIOS DE BAJA
	=============================================*/
	
	static public function ctrMostrarFormularioBajas($item, $valor) {

		$tabla = "formulario_bajas";

		$respuesta = ModeloFormularioBajas::mdlMostrarFormularioBajas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR FORMULARIO BAJA
	=============================================*/

	static public function ctrEditarFormularioBaja() {

		// Patrón (admite letras acentuadas y espacios y Caracteres Especiales -> punto y parentesis:
		$patron_numerosTexto = "/^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ .-]+$/";

		if (isset($_POST["fechaIniFormBaja"])) {
				
			if (preg_match($patron_numerosTexto, $_POST["claveFormBaja"])) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/
				
				$ruta = $_POST["ImagenActual"];

				if (isset($_FILES["imagenFormBaja"]["tmp_name"])) {

					list($ancho, $alto) = getimagesize($_FILES["imagenFormBaja"]["tmp_name"]);
					
					$nuevoAncho = $ancho;
					$nuevoAlto = $alto;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL AFILIADO QUE TIENE RESULTADOS DE LABORATIRO COVID
					=============================================*/

					$directorio = "vistas/img/form_bajas/".$_POST["idFormularioBaja"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if (!empty($_POST["ImagenActual"])) {

						unlink($_POST["ImagenActual"]);

					} else {

						mkdir($directorio, 0755);

					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if ($_FILES["imagenFormBaja"]["type"] == "image/jpeg") {
						
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/form_bajas/".$_POST["idFormularioBaja"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["imagenFormBaja"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if ($_FILES["imagenFormBaja"]["type"] == "image/png") {
						
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/form_bajas/".$_POST["idFormularioBaja"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["imagenFormBaja"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				/*=============================================
				ALMACENANDO LOS DATOS EN LA BD
				=============================================*/

				$tabla = "formulario_bajas";

				$datos = array("id"					=> $_POST["idFormularioBaja"],
							   "id_covid_resultado"	=> $_POST["idCovidResultado"], 
							   "riesgo"             => $_POST["riesgoFormBaja"],
							   "fecha_ini" 		    => date("Y-m-d", strtotime($_POST["fechaIniFormBaja"])),
							   "fecha_fin"	        => date("Y-m-d", strtotime($_POST["fechaFinFormBaja"])),
							   "dias_incapacidad"	=> $_POST["diasIncapacidadFormBaja"],
							   "lugar"			    => $_POST["lugarFormBaja"],
							   "fecha"				=> date("Y-m-d", strtotime($_POST["fechaFormBaja"])),
							   "clave"   		    => $_POST["claveFormBaja"],
							   "imagen"     		=> $ruta);

				$respuesta = ModeloFormularioBajas::mdlEditarFormularioBaja($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>		

						swal.fire({
							
							icon: "success",
							title: "¡El formulario ha sido editado correctamente!",
							showConfirmButton: true,
							allowOutsideClick: false,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

						}).then((result) => {
		  					
		  					if (result.value) {

								window.location = "formulario-bajas";

							}
						});

					</script>';

				}

				else {

					echo '<script>		

						swal.fire({

							title: "Error de Base de Datos",
							text: "¡Error en la consulta a la Base de Datos!",
							icon: "error",
							allowOutsideClick: false,
							confirmButtonText: "¡Cerrar!"

						}).then((result) => {
		  					
		  					if (result.value) {

								window.location = "index.php?ruta=editar-formulario-bajas&idFormularioBaja="'+$_POST["idFormularioBaja"]+';
							}

						});

					</script>';

				}

			} else {

				echo '<script>		

					swal.fire({

						title: "Error al introducir datos",
						text: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!,
						icon: "error",
						allowOutsideClick: false,
						confirmButtonText: "¡Cerrar!"

					}).then((result) => {
	  					
	  					if (result.value) {

							window.location = "index.php?ruta=editar-formulario-bajas&idFormularioBaja="'+$_POST["idFormularioBaja"]+';

						}

					});

				</script>';

			}

		}

	}

	/*=============================================
	BORRAR REGISTRO DE AFILIADO CON RESULTADOS DE LABORATORIO COVID-19
	=============================================*/

	static public function ctrEliminarFormularioBaja() {
		
		if (isset($_GET["idFormularioBaja"])) {
			
			$tabla = "formulario_bajas";
			$datos = $_GET["idFormularioBaja"];

			if ($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/form_bajas/default/anonymous.png") {
				
				unlink($_GET["imagen"]);
				rmdir("vistas/img/form_bajas/".$_GET["idFormularioBaja"]);
			}

			$respuesta = ModeloFormularioBajas::mdlEliminarFormularioBaja($tabla, $datos);

			if ($respuesta == "ok") {
					
				echo '<script>		

					swal.fire({
						
						icon: "success",
						title: "¡El formulario ha sido borrado correctamente!",
						showConfirmButton: true,
						allowOutsideClick: false,
						confirmButtonText: "Cerrar"
						
					}).then((result) => {
	  					
	  					if (result.value) {

							window.location = "formulario-bajas";

						}
					});

				</script>';

			}

			else {

				echo '<script>		

					swal.fire({

						title: "Error de Base de Datos",
						text: "¡Error en la consulta a la Base de Datos!",
						icon: "error",
						allowOutsideClick: false,
						confirmButtonText: "¡Cerrar!"

					}).then((result) => {
	  					
	  					if (result.value) {

							window.location = "formulario-bajas";
						}

					});

				</script>';
				
			}

		}
		
	}

}