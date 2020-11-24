<?php

require_once "../controladores/fichas.controlador.php";
require_once "../modelos/fichas.modelo.php";

class TablaFichas {

	/*=============================================
	MOSTRAR LA TABLA DE FICHAS
	=============================================*/
		
	public function mostrarTablaFichas() {

		$item = null;
		$valor = null;

		$fichas = ControladorFichas::ctrMostrarFichas($item, $valor);
		
		if ($fichas == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($fichas); $i++) { 

					/*=============================================
					FORMATEAMOS LAS FECHAS
					=============================================*/
					// fecha nacimiento
					if ($fichas[$i]['fecha_nacimiento'] == "0000-00-00" ) {

						$fecha_nacimiento = "";

					} else {

						$fecha_nacimiento = date("d/m/Y", strtotime($fichas[$i]['fecha_nacimiento']));
					}

					// fecha muestra
					if ($fichas[$i]['fecha_muestra'] == "0000-00-00" ) {

						$fecha_muestra = "";

					} else {

						$fecha_muestra = date("d/m/Y", strtotime($fichas[$i]['fecha_muestra']));
					}

					//fecha resultado
					if ($fichas[$i]['fecha_resultado'] == "0000-00-00" ) {

						$fecha_resultado = "";

					} else {

						$fecha_resultado = date("d/m/Y", strtotime($fichas[$i]['fecha_resultado']));
					}

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/
					if ($fichas[$i]['tipo_ficha'] == "FICHA EPIDEMIOLOGICA") {
						
						$botonImprimir = "<button class='btn btn-danger btnImprimirFichaEpidemiologica' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Imprimir PDF'><i class='fas fa-file-pdf'></i></button>";

						$botonEditar = "<button class='btn btn-warning btnEditarFichaEpidemiologica' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button>";

						$botonLaboratorio = "<button class='btn btn-info btnAgregarResultadoLab' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Agregar Resultado'><i class='fas fa-vial'></i></button>";
						
					} else {

						$botonImprimir = "<button class='btn btn-danger btnImprimirFichaControl' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Imprimir PDF'><i class='fas fa-file-pdf'></i></button>";

						$botonEditar = "<button class='btn btn-warning btnEditarFichaControl' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button>";

						$botonLaboratorio = "<button class='btn btn-info btnAgregarResultadoControlLab' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Agregar Resultado'><i class='fas fa-vial'></i></button>";

					}

					if ($_GET["perfilOculto"] == "ADMIN_SYSTEM") {

						// Agrupamos los botones
						$botones = "<div class='btn-group'>".$botonImprimir.$botonEditar.$botonLaboratorio."</div>";

					} else if ($_GET["perfilOculto"] == "MEDICO") {

						if ($fichas[$i]['resultado_laboratorio'] == "") {

							// Agrupamos los botones
							$botones = "<div class='btn-group'>".$botonImprimir.$botonEditar."</div>";
							
						} else {

							// Agrupamos los botones
							$botones = "<div class='btn-group'>".$botonImprimir."</div>";
						}					

					} else if ($_GET["perfilOculto"] == "SECRETARIO" || $_GET["perfilOculto"] == "LABORATORISTA") {

						if ($fichas[$i]['resultado_laboratorio'] == "") {

							// Agrupamos los botones
							$botones = "<div class='btn-group'>".$botonLaboratorio."</div>";
							
						} else {

							$botones = "";
						}				

					} else {

						$botones = "";

					}				
					
					if (($_GET["perfilOculto"] == "SECRETARIO" || $_GET["perfilOculto"] == "LABORATORISTA") && $fichas[$i]["estado_ficha"] == "1") {

						$datosJson .='[					
							"'.$fichas[$i]['id_ficha'].'",
							"'.$fichas[$i]['tipo_ficha'].'",
							"'.$fichas[$i]['cod_asegurado'].'",
							"'.$fichas[$i]['nombre_completo'].'",
							"'.$fichas[$i]['nro_documento'].'",
							"'.$fichas[$i]['sexo'].'",
							"'.$fecha_nacimiento.'",
							"'.$fecha_muestra.'",
							"'.$fichas[$i]['resultado_laboratorio'].'",
							"'.$fecha_resultado.'",
							"'.$botones.'"
						],';

					} else {

					}

					if ($_GET["perfilOculto"] == "ADMIN_SYSTEM" || $_GET["perfilOculto"] == "MEDICO") {

						$datosJson .='[					
							"'.$fichas[$i]['id_ficha'].'",
							"'.$fichas[$i]['tipo_ficha'].'",
							"'.$fichas[$i]['cod_asegurado'].'",
							"'.$fichas[$i]['nombre_completo'].'",
							"'.$fichas[$i]['nro_documento'].'",
							"'.$fichas[$i]['sexo'].'",
							"'.$fecha_nacimiento.'",
							"'.$fecha_muestra.'",
							"'.$fichas[$i]['resultado_laboratorio'].'",
							"'.$fecha_resultado.'",
							"'.$botones.'",
							"'.$fichas[$i]["estado_ficha"].'"
						],';
						
					} else {

					}

				}

				$datosJson = substr($datosJson, 0, -1);

			$datosJson .= ']

			}';

		}
		
		echo $datosJson;
	
	}

	public $fecha;
	public $action;

	/*=============================================
	MOSTRAR LA TABLA DE FICHAS
	=============================================*/
		
	public function mostrarTablaFichasFechaMuestra() {

		$item = $this->action;
		$valor = $this->fecha;

		$fichas = ControladorFichas::ctrMostrarFichasFecha($item, $valor);

		if ($fichas == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($fichas); $i++) { 

					$loading = "<span><img src='vistas/img/cargando.gif' class='cargando hide'></span>";

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/
					if ($fichas[$i]['tipo_ficha'] == "FICHA EPIDEMIOLOGICA") {
						
						$botonImprimir = "<button class='btn btn-danger btnImprimirFichaEpidemiologica' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Imprimir PDF'><i class='fas fa-file-pdf'></i></button>";

						$botonEditar = "<button class='btn btn-warning btnEditarFichaEpidemiologica' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button>";

						$botonLaboratorio = "<button class='btn btn-info btnAgregarResultadoLab' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Agregar Resultado'><i class='fas fa-vial'></i></button>";
						
					} else {

						$botonImprimir = "<button class='btn btn-danger btnImprimirFichaControl' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Imprimir PDF'><i class='fas fa-file-pdf'></i></button>";

						$botonEditar = "<button class='btn btn-warning btnEditarFichaControl' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button>";

						$botonLaboratorio = "<button class='btn btn-info btnAgregarResultadoControlLab' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Agregar Resultado'><i class='fas fa-vial'></i></button>";

					}

					if ($_GET["perfilOculto"] == "ADMIN_SYSTEM") {

						// Agrupamos los botones
						$botones = "<div class='btn-group'>".$botonImprimir.$botonEditar.$botonLaboratorio.$loading."</div>";

					} else if ($_GET["perfilOculto"] == "MEDICO") {

						if ($fichas[$i]['resultado_laboratorio'] == "") {

							// Agrupamos los botones
							$botones = "<div class='btn-group'>".$botonEditar."</div>";
						} else {

							// Agrupamos los botones
							$botones = "<div class='btn-group'>".$botonImprimir.$loading."</div>";
						}					

					} else if ($_GET["perfilOculto"] == "SECRETARIO" || $_GET["perfilOculto"] == "LABORATORISTA") {

						// Agrupamos los botones
						$botones = "<div class='btn-group'>".$botonLaboratorio."</div>";

					} else {

						$botones = "";

					}

					if ($_GET["perfilOculto"] == "SECRETARIO" || $_GET["perfilOculto"] == "LABORATORISTA" && $fichas[$i]["estado_ficha"] == 1) {

						$datosJson .='[					
							"'.$fichas[$i]['id_ficha'].'",
							"'.$fichas[$i]['tipo_ficha'].'",
							"'.$fichas[$i]['cod_asegurado'].'",
							"'.$fichas[$i]['nombre_completo'].'",
							"'.$fichas[$i]['nro_documento'].'",
							"'.$fichas[$i]['sexo'].'",
							"'.date("d/m/Y", strtotime($fichas[$i]["fecha_nacimiento"])).'",
							"'.date("d/m/Y", strtotime($fichas[$i]['fecha_muestra'])).'",
							"'.$fichas[$i]['resultado_laboratorio'].'",
							"'.date("d/m/Y", strtotime($fichas[$i]["fecha_resultado"])).'",
							"'.$botones1.'"
						],';

					}

					if ($_GET["perfilOculto"] == "ADMIN_SYSTEM" || $_GET["perfilOculto"] == "MEDICO") {

						$datosJson .='[					
							"'.$fichas[$i]['id_ficha'].'",
							"'.$fichas[$i]['tipo_ficha'].'",
							"'.$fichas[$i]['cod_asegurado'].'",
							"'.$fichas[$i]['nombre_completo'].'",
							"'.$fichas[$i]['nro_documento'].'",
							"'.$fichas[$i]['sexo'].'",
							"'.date("d/m/Y", strtotime($fichas[$i]["fecha_nacimiento"])).'",
							"'.date("d/m/Y", strtotime($fichas[$i]['fecha_muestra'])).'",
							"'.$fichas[$i]['resultado_laboratorio'].'",
							"'.date("d/m/Y", strtotime($fichas[$i]["fecha_resultado"])).'",
							"'.$botones1.'"
						],';
						
					}

				}

				$datosJson = substr($datosJson, 0, -1);

			$datosJson .= ']

			}';

		}
		
		echo $datosJson;
	
	}

}

/*=============================================
ACTIVAR TABLA FICHAS
=============================================*/

if (isset($_GET["actionBuscarFichaFecha"])) {

	if ($_GET["actionBuscarFichaFecha"] == "fecha_resultado") {

		$activarFichas = new TablaFichas();
		$activarFichas -> action = $_GET["actionBuscarFichaFecha"];
		$activarFichas -> fecha = $_GET["fecha"];
		$activarFichas -> mostrarTablaFichasFechaResultado();

	} else if ($_GET["actionBuscarFichaFecha"] == "fecha_muestra") {

		$activarFichas = new TablaFichas();
		$activarFichas -> action = $_GET["actionBuscarFichaFecha"];
		$activarFichas -> fecha = $_GET["fecha"];
		$activarFichas -> mostrarTablaFichasFechaMuestra();

	// } else if ($_GET["actionCovidResultados"] == "lab") {

	// 	$activarCovidResultados = new TablaCovidResultados();
	// 	$activarCovidResultados -> mostrarTablaCovidResultadosLab();

	} else if ($_GET["actionBuscarFichaFecha"] == "centro") {

		$activarFichas = new TablaFichas();
		$activarFichas -> mostrarTablaFichas();

	}

}