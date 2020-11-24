<?php

require_once "../controladores/covid_resultados.controlador.php";
require_once "../modelos/covid_resultados.modelo.php";

require_once "../controladores/departamentos.controlador.php";
require_once "../modelos/departamentos.modelo.php";

require_once "../controladores/establecimientos.controlador.php";
require_once "../modelos/establecimientos.modelo.php";

require_once "../controladores/localidades.controlador.php";
require_once "../modelos/localidades.modelo.php";



class TablaCovidResultados {

	/*=============================================
	MOSTRAR LA TABLA DE DE AFILIADOS CON RESULTADOS DE LABORATORIO COVID PARA LAB
	=============================================*/
		
	public function mostrarTablaCovidResultadosLab() {

		// $sql_details = array(
		// 	'host' => 'localhost',
		//     'user' => 'root',
		//     'pass' => '3000REIVAJinf1976',
		//     'db'   => 'bdcovid19cnspt'    
		// );

		// $table = 'mostrar_covid_resultados';
 
		// $primaryKey = 'id';
		 
		// $columns = array(
		//     array( 'db' => 'cod_laboratorio', 'dt' => 0 ),
		//     array( 'db' => 'cod_asegurado',  'dt' => 1 ),
		//     array( 'db' => 'cod_afiliado',   'dt' => 2 ),
		//     array( 'db' => 'nombre_completo', 'dt' => 3 ),
		//     array( 'db' => 'documento_ci', 'dt' => 4 ),
		//     array( 'db' => 'fecha_muestra','dt' => 5,
		//         'formatter' => function( $d, $row ) {
		//             return date( 'd-m-Y', strtotime($d));
		//         }
		//     )
		   
		// );
		 
		 
		// echo json_encode(
		//     SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
		// );

		// Database connection info 
		$dbDetails = array( 
		    'host' => 'localhost', 
		    'user' => 'root', 
		    'pass' => '3000REIVAJinf1976', 
		    'db'   => 'bdcovid19cnspt' 
		); 
		 
		// DB table to use 
		$table = 'mostrar_covid_resultados'; 
		 
		// Table's primary key 
		$primaryKey = 'id'; 
		 
		// Array of database columns which should be read and sent back to DataTables. 
		// The `db` parameter represents the column name in the database.  
		// The `dt` parameter represents the DataTables column identifier. 
		$columns = array( 
		    array( 'db' => 'cod_laboratorio',  'dt' => 0 ), 
		    array( 'db' => 'cod_asegurado',    'dt' => 1 ), 
		    array( 'db' => 'cod_afiliado',     'dt' => 2 ), 
		    array( 'db' => 'nombre_completo',  'dt' => 3 ), 
		    array( 'db' => 'documento_ci',     'dt' => 4 ), 
		    array( 
		        'db'        => 'fecha_recepcion', 
		        'dt'        => 5, 
		        'formatter' => function( $d, $row ) { 
		            return date( 'd/m/Y', strtotime($d)); 
		        } 
		    ),
		    array( 
		        'db'        => 'fecha_muestra', 
		        'dt'        => 6, 
		        'formatter' => function( $d, $row ) { 
		            return date( 'd/m/Y', strtotime($d)); 
		        } 
		    ),
		    array( 'db' => 'tipo_muestra',     'dt' => 7 ), 
		    array( 'db' => 'muestra_control',     'dt' => 8 ),
		    array( 'db' => 'sexo',     'dt' => 9 )
		    // array( 
		    //     'db'        => 'status', 
		    //     'dt'        => 6, 
		    //     'formatter' => function( $d, $row ) { 
		    //         return ($d == 1)?'Active':'Inactive'; 
		    //     } 
		    // ) 
		); 
		 
		// Include SQL query processing class 
		require '../modelos/ssp.class.php'; 
		 
		// Output data as json format 
		echo json_encode(
			SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns )
		);

		// require "../modelos/serverside.php";

		// $table_data->get('mostrar_covid_resultados','id',array('cod_laboratorio','cod_asegurado','cod_afiliado','nombre_completo','documento_ci','fecha_muestra','fecha_recepcion','tipo_muestra','muestra_control','nombre_depto','nombre_establecimiento','sexo','fecha_nacimiento','telefono','email','nombre_localidad','zona','direccion','fecha_resultado','resultado','observaciones','id'));


		// $item = null;
		// $valor = null;

		// $covidResultados = ControladorCovidResultados::ctrMostrarCovidResultadosLab($item, $valor);

		// if ($covidResultados == null) {
			
		// 	$datosJson = '{
		// 		"data": []
		// 	}';

		// } else {

		// 	$datosJson = '{
		// 	"data": [';

		// 	for ($i = 0; $i < count($covidResultados); $i++) { 

		// 		/*=============================================
		// 		RESULTADO LABORATORIO
		// 		=============================================*/	

		// 		if ($covidResultados[$i]["resultado"] == "POSITIVO") {
					
		// 			$resultado = "<button class='btn btn-danger' idCovidResultado='".$covidResultados[$i]["id"]."'>".$covidResultados[$i]["resultado"]."</button>";

		// 		} else {

		// 			$resultado = "<button class='btn btn-success' idCovidResultado='".$covidResultados[$i]["id"]."'>".$covidResultados[$i]["resultado"]."</button>";

		// 		}

		// 		/*=============================================
		// 		TRAEMOS LAS ACCIONES
		// 		=============================================*/

		// 		$botonEditar = "<button class='btn btn-warning btnEditarCovidResultado' idCovidResultado='".$covidResultados[$i]["id"]."' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button>";

		// 		$botonEliminar ="<button class='btn btn-danger btnEliminarCovidResultado' idCovidResultado='".$covidResultados[$i]["id"]."' codAsegurado='".$covidResultados[$i]["cod_asegurado"]."' foto='".$covidResultados[$i]["foto"]."' data-toggle='tooltip' title='Eliminar'><i class='fas fa-trash-alt'></i></button>";

		// 		if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "ADMIN_SYSTEM") {

		// 			if ($covidResultados[$i]["estado"] != '0') {

	 //                    $botonPublicar = "<button class='btn btn-info btnPublicarCovidResultado' idCovidResultado='".$covidResultados[$i]["id"]."' estadoResultado='0' data-toggle='tooltip' title='Quitar Resultado Público'><i class='fas fa-download'></i></button>";

	 //                } else {

	 //                    $botonPublicar = "<button class='btn btn-info btnPublicarCovidResultado' idCovidResultado='".$covidResultados[$i]["id"]."' estadoResultado='1' data-toggle='tooltip' title='Publicar Resultado'><i class='fas fa-upload'></i></button>";

	 //                }

	 //                // Agrupamos los botones
		// 			$botones = "<div class='btn-group'>".$botonEditar.$botonEliminar.$botonPublicar."</div>";
					
		// 		} else {

		// 			if ($covidResultados[$i]["estado"] != '0') {

	 //                    // Agrupamos los botones (Si se publico el resultado no se podra modificar por los usuarios)
		// 				$botones = "<div class='btn-group'></div>";

	 //                } else {

	 //                    $botonPublicar = "<button class='btn btn-info btnPublicarCovidResultado' idCovidResultado='".$covidResultados[$i]["id"]."' estadoResultado='1' data-toggle='tooltip' title='Publicar Resultado'><i class='fas fa-upload'></i></button>";

	 //                    // Agrupamos los botones
		// 				$botones = "<div class='btn-group'>".$botonEditar.$botonPublicar."</div>";

	 //                }

		// 		}

		// 		$datosJson .='[
		// 			"'.$covidResultados[$i]["cod_laboratorio"].'",	
		// 			"'.$covidResultados[$i]["cod_asegurado"].'",
		// 			"'.$covidResultados[$i]["cod_afiliado"].'",	
		// 			"'.$covidResultados[$i]["nombre_completo"].'",
		// 			"'.$covidResultados[$i]["documento_ci"].'",
		// 			"'.date("d/m/Y", strtotime($covidResultados[$i]["fecha_recepcion"])).'",
		// 			"'.date("d/m/Y", strtotime($covidResultados[$i]["fecha_muestra"])).'",
		// 			"'.$covidResultados[$i]["tipo_muestra"].'",
		// 			"'.$covidResultados[$i]["muestra_control"].'",
		// 			"'.$covidResultados[$i]["nombre_depto"].'",
		// 			"'.$covidResultados[$i]["nombre_establecimiento"].'",
		// 			"'.$covidResultados[$i]["sexo"].'",
		// 			"'.date("d/m/Y", strtotime($covidResultados[$i]["fecha_nacimiento"])).'",
		// 			"'.$covidResultados[$i]["telefono"].'",
		// 			"'.$covidResultados[$i]["email"].'",
		// 			"'.$covidResultados[$i]["nombre_localidad"].'",
		// 			"'.$covidResultados[$i]["zona"].'",
		// 			"'.$covidResultados[$i]["direccion"].'",
		// 			"'.$resultado.'",
		// 			"'.date("d/m/Y", strtotime($covidResultados[$i]["fecha_resultado"])).'",
		// 			"'.$covidResultados[$i]["observaciones"].'",
		// 			"'.$botones.'",
		// 			"'.$covidResultados[$i]["estado"].'"
		// 		],';

		// 	}

		// 	$datosJson = substr($datosJson, 0, -1);

		// 	$datosJson .= ']
		// 	}';	

		// }

		// echo $datosJson;
	
	}

	/*=============================================
	MOSTRAR LA TABLA DE DE AFILIADOS CON RESULTADOS DE LABORATORIO COVID PARA CENTRO COVID
	=============================================*/
		
	public function mostrarTablaCovidResultadosCentro() {

		$item = null;
		$valor = null;

		$covidResultados = ControladorCovidResultados::ctrMostrarCovidResultados($item, $valor);

		if ($covidResultados == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
			"data": [';

			for ($i = 0; $i < count($covidResultados); $i++) { 

				/*=============================================
				TRAEMOS EL DEPARTAMENTO
				=============================================*/

				// $itemDepartamento = "id";
				// $valorDepartamento = $covidResultados[$i]["id_departamento"];

				// $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($itemDepartamento, $valorDepartamento);

				/*=============================================
				TRAEMOS EL ESTABLECIMIENTO
				=============================================*/

				// $itemEstablecimiento = "id";
				// $valorEstablecimiento = $covidResultados[$i]["id_establecimiento"];

				// $establecimientos = ControladorEstablecimientos::ctrMostrarEstablecimientos($itemEstablecimiento, $valorEstablecimiento);

				/*=============================================
				TRAEMOS LA LOCALIDAD
				=============================================*/

				// $itemLocalidad = "id";
				// $valorLocalidad = $covidResultados[$i]["id_localidad"];

				// $localidades = ControladorLocalidades::ctrMostrarLocalidades($itemLocalidad, $valorLocalidad);


				/*=============================================
				RESULTADO LABORATORIO
				=============================================*/	

				if ($covidResultados[$i]["resultado"] == "POSITIVO") {
					
					$resultado = "<button class='btn btn-danger' idCovidResultado='".$covidResultados[$i]["id"]."'>".$covidResultados[$i]["resultado"]."</button>";

				} else {

					$resultado = "<button class='btn btn-success' idCovidResultado='".$covidResultados[$i]["id"]."'>".$covidResultados[$i]["resultado"]."</button>";

				}

				/*=============================================
				TRAEMOS LAS ACCIONES
				=============================================*/		

				$botonFormBaja = "<button class='btn btn-primary btnMostrarFormBaja' idCovidResultado='".$covidResultados[$i]["id"]."' data-toggle='modal' data-target='#modalFormBaja' data-toggle='tooltip' title='Formulario de Baja'><i class='fab fa-wpforms'></i></button>";

				if ($covidResultados[$i]["resultado"] == "POSITIVO") {

            		$botones = "<div class='btn-group'>".$botonFormBaja."</div>";

            	} else {

            		$botones = "<div class='btn-group'></div>";

            	}		
					

				if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "MEDICO" && $covidResultados[$i]["estado"] == "0") {

				

				} else {

					$datosJson .='[
						"'.$covidResultados[$i]["cod_laboratorio"].'",	
						"'.$covidResultados[$i]["cod_asegurado"].'",
						"'.$covidResultados[$i]["cod_afiliado"].'",	
						"'.$covidResultados[$i]["nombre_completo"].'",
						"'.$covidResultados[$i]["documento_ci"].'",
						"'.date("d/m/Y", strtotime($covidResultados[$i]["fecha_recepcion"])).'",
						"'.date("d/m/Y", strtotime($covidResultados[$i]["fecha_muestra"])).'",
						"'.$covidResultados[$i]["tipo_muestra"].'",
						"'.$covidResultados[$i]["muestra_control"].'",
						"'.$covidResultados[$i]["nombre_depto"].'",
						"'.$covidResultados[$i]["nombre_establecimiento"].'",
						"'.$covidResultados[$i]["sexo"].'",
						"'.date("d/m/Y", strtotime($covidResultados[$i]["fecha_nacimiento"])).'",
						"'.$covidResultados[$i]["telefono"].'",
						"'.$covidResultados[$i]["email"].'",
						"'.$covidResultados[$i]["nombre_localidad"].'",
						"'.$covidResultados[$i]["zona"].'",
						"'.$covidResultados[$i]["direccion"].'",
						"'.$resultado.'",
						"'.date("d/m/Y", strtotime($covidResultados[$i]["fecha_resultado"])).'",
						"'.$covidResultados[$i]["observaciones"].'",
						"'.$botones.'",
						"'.$covidResultados[$i]["estado"].'"
					],';

				}

			}

			$datosJson = substr($datosJson, 0, -1);

			$datosJson .= ']
			}';	

		}

		echo $datosJson;
	
	}

	/*=============================================
	MOSTRAR LA TABLA DE DE AFILIADOS CON RESULTADOS DE LABORATORIO COVID FILTRADO POR FECHA DE RESULTADO
	=============================================*/
	
	public $fecha;
	public $action;

	public function mostrarTablaCovidResultadosFechaResultado() {

		$item = $this->action;
		$valor = date("Y-m-d", strtotime($this->fecha));

		$covidResultados = ControladorCovidResultados::ctrMostrarCovidResultadosFecha($item, $valor);

		if ($covidResultados == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
			"data": [';

			for ($i = 0; $i < count($covidResultados); $i++) { 

				/*=============================================
				TRAEMOS EL DEPARTAMENTO
				=============================================*/

				$itemDepartamento = "id";
				$valorDepartamento = $covidResultados[$i]["id_departamento"];

				$departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($itemDepartamento, $valorDepartamento);

				/*=============================================
				TRAEMOS EL ESTABLECIMIENTO
				=============================================*/

				$itemEstablecimiento = "id";
				$valorEstablecimiento = $covidResultados[$i]["id_establecimiento"];

				$establecimientos = ControladorEstablecimientos::ctrMostrarEstablecimientos($itemEstablecimiento, $valorEstablecimiento);

				/*=============================================
				TRAEMOS LA LOCALIDAD
				=============================================*/

				$itemLocalidad = "id";
				$valorLocalidad = $covidResultados[$i]["id_localidad"];

				$localidades = ControladorLocalidades::ctrMostrarLocalidades($itemLocalidad, $valorLocalidad);


				/*=============================================
				RESULTADO LABORATORIO
				=============================================*/	

				if ($covidResultados[$i]["resultado"] == "POSITIVO") {
					
					$resultado = "<button class='btn btn-danger' idCovidResultado='".$covidResultados[$i]["id"]."'>".$covidResultados[$i]["resultado"]."</button>";

				} else {

					$resultado = "<button class='btn btn-success' idCovidResultado='".$covidResultados[$i]["id"]."'>".$covidResultados[$i]["resultado"]."</button>";

				}

				/*=============================================
				TRAEMOS LAS ACCIONES
				=============================================*/

				$botonEditar = "<button class='btn btn-warning btnEditarCovidResultado' idCovidResultado='".$covidResultados[$i]["id"]."' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button>";

				$botonEliminar ="<button class='btn btn-danger btnEliminarCovidResultado' idCovidResultado='".$covidResultados[$i]["id"]."' codAsegurado='".$covidResultados[$i]["cod_asegurado"]."' foto='".$covidResultados[$i]["foto"]."' data-toggle='tooltip' title='Eliminar'><i class='fas fa-trash-alt'></i></button>";

				if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "ADMIN_SYSTEM") {

					if ($covidResultados[$i]["estado"] != '0') {

	                    $botonPublicar = "<button class='btn btn-info btnPublicarCovidResultado' idCovidResultado='".$covidResultados[$i]["id"]."' estadoResultado='0' data-toggle='tooltip' title='Quitar Resultado Público'><i class='fas fa-download'></i></button>";

	                } else {

	                    $botonPublicar = "<button class='btn btn-info btnPublicarCovidResultado' idCovidResultado='".$covidResultados[$i]["id"]."' estadoResultado='1' data-toggle='tooltip' title='Publicar Resultado'><i class='fas fa-upload'></i></button>";

	                }

	                // Agrupamos los botones
					$botones = "<div class='btn-group'>".$botonEditar.$botonEliminar.$botonPublicar."</div>";
					
				} else {

					if ($covidResultados[$i]["estado"] != '0') {

	                    // Agrupamos los botones (Si se publico el resultado no se podra modificar por los usuarios)
						$botones = "<div class='btn-group'></div>";

	                } else {

	                    $botonPublicar = "<button class='btn btn-info btnPublicarCovidResultado' idCovidResultado='".$covidResultados[$i]["id"]."' estadoResultado='1' data-toggle='tooltip' title='Publicar Resultado'><i class='fas fa-upload'></i></button>";

	                    // Agrupamos los botones
						$botones = "<div class='btn-group'>".$botonEditar.$botonEliminar.$botonPublicar."</div>";

	                }

				}
				

				$datosJson .='[
					"'.$covidResultados[$i]["cod_laboratorio"].'",	
					"'.$covidResultados[$i]["cod_asegurado"].'",
					"'.$covidResultados[$i]["cod_afiliado"].'",	
					"'.$covidResultados[$i]["paterno"].' '.$covidResultados[$i]["materno"].' '.$covidResultados[$i]["nombre"].'",
					"'.$covidResultados[$i]["documento_ci"].'",
					"'.date("d/m/Y", strtotime($covidResultados[$i]["fecha_recepcion"])).'",
					"'.date("d/m/Y", strtotime($covidResultados[$i]["fecha_muestra"])).'",
					"'.$covidResultados[$i]["tipo_muestra"].'",
					"'.$covidResultados[$i]["muestra_control"].'",
					"'.$departamentos["nombre_depto"].'",
					"'.$establecimientos["nombre_establecimiento"].'",
					"'.$covidResultados[$i]["sexo"].'",
					"'.date("d/m/Y", strtotime($covidResultados[$i]["fecha_nacimiento"])).'",
					"'.$covidResultados[$i]["telefono"].'",
					"'.$covidResultados[$i]["email"].'",
					"'.$localidades["nombre_localidad"].'",
					"'.$covidResultados[$i]["zona"].'",
					"'.$covidResultados[$i]["calle"].' '.$covidResultados[$i]["nro_calle"].'",
					"'.$resultado.'",
					"'.date("d/m/Y", strtotime($covidResultados[$i]["fecha_resultado"])).'",
					"'.$covidResultados[$i]["observaciones"].'",
					"'.$botones.'",
					"'.$covidResultados[$i]["estado"].'"
				],';
			}

			$datosJson = substr($datosJson, 0, -1);

			$datosJson .= ']
			}';	

		}

		echo $datosJson;
	
	}

	/*=============================================
	MOSTRAR LA TABLA DE DE AFILIADOS CON RESULTADOS DE LABORATORIO COVID FILTRADO POR FECHA DE MUESTRA
	=============================================*/

	public function mostrarTablaCovidResultadosFechaMuestra() {

		$item = $this->action;
		$valor = date("Y-m-d", strtotime($this->fecha));

		$covidResultados = ControladorCovidResultados::ctrMostrarCovidResultadosFecha($item, $valor);

		if ($covidResultados == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
			"data": [';

			for ($i = 0; $i < count($covidResultados); $i++) { 

				/*=============================================
				TRAEMOS EL DEPARTAMENTO
				=============================================*/

				$itemDepartamento = "id";
				$valorDepartamento = $covidResultados[$i]["id_departamento"];

				$departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($itemDepartamento, $valorDepartamento);

				/*=============================================
				TRAEMOS EL ESTABLECIMIENTO
				=============================================*/

				$itemEstablecimiento = "id";
				$valorEstablecimiento = $covidResultados[$i]["id_establecimiento"];

				$establecimientos = ControladorEstablecimientos::ctrMostrarEstablecimientos($itemEstablecimiento, $valorEstablecimiento);

				/*=============================================
				TRAEMOS LA LOCALIDAD
				=============================================*/

				$itemLocalidad = "id";
				$valorLocalidad = $covidResultados[$i]["id_localidad"];

				$localidades = ControladorLocalidades::ctrMostrarLocalidades($itemLocalidad, $valorLocalidad);


				/*=============================================
				RESULTADO LABORATORIO
				=============================================*/	

				if ($covidResultados[$i]["resultado"] == "POSITIVO") {
					
					$resultado = "<button class='btn btn-danger' idCovidResultado='".$covidResultados[$i]["id"]."'>".$covidResultados[$i]["resultado"]."</button>";

				} else {

					$resultado = "<button class='btn btn-success' idCovidResultado='".$covidResultados[$i]["id"]."'>".$covidResultados[$i]["resultado"]."</button>";

				}

				/*=============================================
				TRAEMOS LAS ACCIONES
				=============================================*/		

				$botonFormBaja = "<button class='btn btn-primary btnMostrarFormBaja' idCovidResultado='".$covidResultados[$i]["id"]."' data-toggle='modal' data-target='#modalFormBaja' data-toggle='tooltip' title='Formulario de Baja'><i class='fab fa-wpforms'></i></button>";

				if ($covidResultados[$i]["resultado"] == "POSITIVO") {

            		$botones = "<div class='btn-group'>".$botonFormBaja."</div>";

            	} else {

            		$botones = "<div class='btn-group'></div>";

            	}		
					

				if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "MEDICO" && $covidResultados[$i]["estado"] == "0") {

				

				} else {

					$datosJson .='[
						"'.$covidResultados[$i]["cod_laboratorio"].'",	
						"'.$covidResultados[$i]["cod_asegurado"].'",
						"'.$covidResultados[$i]["cod_afiliado"].'",	
						"'.$covidResultados[$i]["paterno"].' '.$covidResultados[$i]["materno"].' '.$covidResultados[$i]["nombre"].'",
						"'.$covidResultados[$i]["documento_ci"].'",
						"'.date("d/m/Y", strtotime($covidResultados[$i]["fecha_recepcion"])).'",
						"'.date("d/m/Y", strtotime($covidResultados[$i]["fecha_muestra"])).'",
						"'.$covidResultados[$i]["tipo_muestra"].'",
						"'.$covidResultados[$i]["muestra_control"].'",
						"'.$departamentos["nombre_depto"].'",
						"'.$establecimientos["nombre_establecimiento"].'",
						"'.$covidResultados[$i]["sexo"].'",
						"'.date("d/m/Y", strtotime($covidResultados[$i]["fecha_nacimiento"])).'",
						"'.$covidResultados[$i]["telefono"].'",
						"'.$covidResultados[$i]["email"].'",
						"'.$localidades["nombre_localidad"].'",
						"'.$covidResultados[$i]["zona"].'",
						"'.$covidResultados[$i]["calle"].' '.$covidResultados[$i]["nro_calle"].'",
						"'.$resultado.'",
						"'.date("d/m/Y", strtotime($covidResultados[$i]["fecha_resultado"])).'",
						"'.$covidResultados[$i]["observaciones"].'",
						"'.$botones.'",
						"'.$covidResultados[$i]["estado"].'"
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
ACTIVAR TABLA DE COVID RESULTADOS
=============================================*/

if (isset($_GET["actionCovidResultados"])) {

	if ($_GET["actionCovidResultados"] == "fecha_resultado") {

		$activarCovidResultados = new TablaCovidResultados();
		$activarCovidResultados -> action = $_GET["actionCovidResultados"];
		$activarCovidResultados -> fecha = $_GET["fecha"];
		$activarCovidResultados -> mostrarTablaCovidResultadosFechaResultado();

	} else if ($_GET["actionCovidResultados"] == "fecha_muestra") {

		$activarCovidResultados = new TablaCovidResultados();
		$activarCovidResultados -> action = $_GET["actionCovidResultados"];
		$activarCovidResultados -> fecha = $_GET["fecha"];
		$activarCovidResultados -> mostrarTablaCovidResultadosFechaMuestra();

	} else if ($_GET["actionCovidResultados"] == "lab") {

		$activarCovidResultados = new TablaCovidResultados();
		$activarCovidResultados -> mostrarTablaCovidResultadosLab();

	} else if ($_GET["actionCovidResultados"] == "centro") {

		$activarCovidResultados = new TablaCovidResultados();
		$activarCovidResultados -> mostrarTablaCovidResultadosCentro();

	}

}