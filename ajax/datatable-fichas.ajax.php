<?php

require_once "../controladores/fichas.controlador.php";
require_once "../modelos/fichas.modelo.php";

class TablaFichas {

	public $request;
	public $perfil;

	/*=============================================
	MOSTRAR LA TABLA DE FICHAS PARA LABORATORIO
	=============================================*/
		
	public function mostrarTablaFichasLab() {

		$request = $this->request;

		$col = array(
		    0   =>  'id_ficha',
		    1   =>  'cod_asegurado',
		    2   =>  'nombre_completo',
		    3   =>  'nro_documento'
		);  //create column like table in database

		$totalData = ControladorFichas::ctrContarFichasLab();

		$totalFilter = $totalData;

		// echo json_encode($totalData);

		//Search
		$sql = "";

		if(!empty($request['search']['value'])) {

		    $sql .= " AND (id_ficha Like '".$request['search']['value']."%' ";
		    $sql .= " OR cod_asegurado Like '".$request['search']['value']."%' ";
		    $sql .= " OR nombre_completo Like '".$request['search']['value']."%' ";
		    $sql .= " OR nro_documento Like '".$request['search']['value']."%' )";

		}

		$totalFilter = ControladorFichas::ctrContarFiltradoFichasLab($sql);

		//Order
		$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
    	$request['start']."  ,".$request['length']."  ";

  	$fichas = ControladorFichas::ctrMostrarFichasLab($sql);

		$data = array();

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

			if ($this->perfil == "ADMIN_SYSTEM") {

				// Agrupamos los botones
				$botones = "<div class='btn-group'>".$botonImprimir.$botonEditar.$botonLaboratorio."</div>";

			} else if ($this->perfil == "SECRETARIO" || $this->perfil == "LABORATORISTA") {

				if ($fichas[$i]['resultado_laboratorio'] == "") {

					// Agrupamos los botones
					$botones = "<div class='btn-group'>".$botonImprimir.$botonLaboratorio."</div>";
					
				} else {

					// Agrupamos los botones
					$botones = "<div class='btn-group'>".$botonImprimir."</div>";

				}				

			} else {

				$botones = "";

			}

			$subdata = array();
	    $subdata[] = $fichas[$i]["id_ficha"]; 
	    $subdata[] = $fichas[$i]["tipo_ficha"];
	    $subdata[] = $fichas[$i]["cod_asegurado"]; 
	    $subdata[] = $fichas[$i]["nombre_completo"]; 
	    $subdata[] = $fichas[$i]["nro_documento"];  
	    $subdata[] = $fichas[$i]["sexo"]; 
	    $subdata[] = $fecha_nacimiento; 
	    $subdata[] = $fecha_muestra; 
	    $subdata[] = $fichas[$i]["resultado_laboratorio"]; 
	    $subdata[] = $fecha_resultado; 
	    $subdata[] = $botones;
	    $subdata[] = $fichas[$i]["estado_ficha"];

	    $data[] = $subdata;	

		}

		$json_data = array(
		    "draw"              =>  intval($request['draw']),
		    "recordsTotal"      =>  intval($totalData),
		    "recordsFiltered"   =>  intval($totalFilter),
		    "data"              =>  $data
		);

		echo json_encode($json_data);
	
	}

	/*=============================================
	MOSTRAR LA TABLA DE FICHAS PARA LABORATORIO
	=============================================*/
		
	public function mostrarTablaFichasCentro() {

		$request = $this->request;

		$col = array(
		    0   =>  'id_ficha',
		    1   =>  'cod_asegurado',
		    2   =>  'nombre_completo',
		    3   =>  'nro_documento'
		);  //create column like table in database

		$totalData = ControladorFichas::ctrContarFichasCentro();

		// $totalFilter = $totalData;

		//Search
		$sql = "";

		if(!empty($request['search']['value'])) {

		    $sql .= " AND (id_ficha Like '".$request['search']['value']."%' ";
		    $sql .= " OR cod_asegurado Like '".$request['search']['value']."%' ";
		    $sql .= " OR nombre_completo Like '".$request['search']['value']."%' ";
		    $sql .= " OR nro_documento Like '".$request['search']['value']."%' )";
		    // var_dump($request['search']['value']);

		}

		// echo $sql;

		$totalData = ControladorFichas::ctrContarFiltradoFichasCentro($sql);

		$totalFilter = $totalData;

		//Order
		$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
    	$request['start']."  ,".$request['length']."  ";


    	$fichas = ControladorFichas::ctrMostrarFichasCentro($sql);

  		$data = array();

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
				$botonEliminar = "<button class='btn btn-danger btnEliminarFicha' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Eliminar'><i class='fas fa-times'></i></button>";
				
			} else {

				$botonImprimir = "<button class='btn btn-danger btnImprimirFichaControl' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Imprimir PDF'><i class='fas fa-file-pdf'></i></button>";

				$botonEditar = "<button class='btn btn-warning btnEditarFichaControl' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button>";

				$botonLaboratorio = "<button class='btn btn-info btnAgregarResultadoControlLab' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Agregar Resultado'><i class='fas fa-vial'></i></button>";
				$botonEliminar = "<button class='btn btn-danger btnEliminarFicha' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Eliminar'><i class='fas fa-times'></i></button>";

			}

			if ($this->perfil == "ADMIN_SYSTEM") {

				// Agrupamos los botones
				$botones = "<div class='btn-group'>".$botonImprimir.$botonEditar.$botonLaboratorio.$botonEliminar."</div>";

			} else if ($this->perfil == "MEDICO") {

				if ($fichas[$i]['resultado_laboratorio'] == "") {

					if ($fichas[$i]["estado_ficha"] == 1) {
						
						// Agrupamos los botones
						$botones = "<div class='btn-group'>".$botonImprimir.$botonEditar."</div>";
					} else {

						// Agrupamos los botones
						$botones = "<div class='btn-group'>".$botonEditar."</div>";

					}
					
				} else {

					// Agrupamos los botones
					$botones = "<div class='btn-group'>".$botonImprimir."</div>";
				}					

			} else {

				$botones = "";

			}

			$subdata = array();
		    $subdata[] = $fichas[$i]["id_ficha"]; 
		    $subdata[] = $fichas[$i]["tipo_ficha"];
		    $subdata[] = $fichas[$i]["cod_asegurado"]; 
		    $subdata[] = $fichas[$i]["nombre_completo"]; 
		    $subdata[] = $fichas[$i]["nro_documento"];  
		    $subdata[] = $fichas[$i]["sexo"]; 
		    $subdata[] = $fecha_nacimiento; 
		    $subdata[] = $fecha_muestra; 
		    $subdata[] = $fichas[$i]["resultado_laboratorio"]; 
		    $subdata[] = $fecha_resultado; 
		    $subdata[] = $botones;
		    $subdata[] = $fichas[$i]["estado_ficha"];

		    $data[] = $subdata;	

		}

		$json_data = array(
		    "draw"              =>  intval($request['draw']),
		    "recordsTotal"      =>  intval($totalData),
		    "recordsFiltered"   =>  intval($totalFilter),
		    "data"              =>  $data
		);

		echo json_encode($json_data);

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
						$botonEliminar = "<button class='btn btn-danger btnEliminarFicha' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Eliminar'><i class='fas fa-times'></i></button>";
						
					} else {

						$botonImprimir = "<button class='btn btn-danger btnImprimirFichaControl' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Imprimir PDF'><i class='fas fa-file-pdf'></i></button>";

						$botonEditar = "<button class='btn btn-warning btnEditarFichaControl' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button>";

						$botonLaboratorio = "<button class='btn btn-info btnAgregarResultadoControlLab' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Agregar Resultado'><i class='fas fa-vial'></i></button>";
						$botonEliminar = "<button class='btn btn-danger btnEliminarFicha' idFicha='".$fichas[$i]["id_ficha"]."' data-toggle='tooltip' title='Eliminar'><i class='fas fa-times'></i></button>";

					}

					if ($_GET["perfilOculto"] == "ADMIN_SYSTEM") {

						// Agrupamos los botones
						$botones = "<div class='btn-group'>".$botonImprimir.$botonEditar.$botonLaboratorio.$botonEliminar."</div>";

					} else if ($_GET["perfilOculto"] == "MEDICO") {

						if ($fichas[$i]['resultado_laboratorio'] == "") {

							// Agrupamos los botones
							$botones = "<div class='btn-group'>".$botonEditar."</div>";
						} else {

							// Agrupamos los botones
							$botones = "<div class='btn-group'>".$botonImprimir."</div>";
						}					

					} else if ($_GET["perfilOculto"] == "SECRETARIO" || $_GET["perfilOculto"] == "LABORATORISTA") {

						// Agrupamos los botones
						$botones = "<div class='btn-group'>".$botonImprimir.$botonLaboratorio."</div>";

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
							"'.$fecha_nacimiento.'",
							"'.$fecha_muestra.'",
							"'.$fichas[$i]['resultado_laboratorio'].'",
							"'.$fecha_resultado.'",
							"'.$botones.'"
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
							"'.$fecha_nacimiento.'",
							"'.$fecha_muestra.'",
							"'.$fichas[$i]['resultado_laboratorio'].'",
							"'.$fecha_resultado.'",
							"'.$botones.'"
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

	// } else if ($_GET["actionBuscarFichaFecha"] == "centro") {

	// 	$activarFichas = new TablaFichas();
	// 	$activarFichas -> mostrarTablaFichas();

	}

}

if (isset($_POST["actionFichas"])) { 

	if ($_POST["actionFichas"] == "lab") {

		// var_dump($_REQUEST);

		$activarFichas = new TablaFichas();
		$activarFichas -> request = $_REQUEST;
		$activarFichas -> perfil = $_POST["perfilOculto"];
		$activarFichas -> mostrarTablaFichasLab();

	} else if ($_POST["actionFichas"] == "centro") {

		$activarFichas = new TablaFichas();
		$activarFichas -> request = $_REQUEST;
		$activarFichas -> perfil = $_POST["perfilOculto"];
		$activarFichas -> mostrarTablaFichasCentro();

	}

}