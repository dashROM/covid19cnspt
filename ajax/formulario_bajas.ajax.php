<?php

require_once "../controladores/formulario_bajas.controlador.php";
require_once "../modelos/formulario_bajas.modelo.php";

require_once "../controladores/covid_resultados.controlador.php";
require_once "../modelos/covid_resultados.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

require_once "../controladores/departamentos.controlador.php";
require_once "../modelos/departamentos.modelo.php";

require_once "../controladores/establecimientos.controlador.php";
require_once "../modelos/establecimientos.modelo.php";

require_once "../controladores/localidades.controlador.php";
require_once "../modelos/localidades.modelo.php";

require_once('../extensiones/tcpdf/tcpdf.php');

class AjaxFormularioBajas {

	public $idCovidResultado;

	public function ajaxMostrarFormularioBajas()	{


		$item = "id";
		$valor = $this->idCovidResultado;

		$respuesta =ControladorCovidResultados::ctrMostrarCovidResultados($item, $valor);

		echo json_encode($respuesta);

	}

	public $riesgo;
	public $fechaIni;
	public $fechaFin;
	public $diasIncapacidad;
	public $lugar;
	public $fecha;
	public $clave;

	public function ajaxIngresarFormularioBaja() {

		// Patrón (admite letras acentuadas y espacios):
		$patron_texto_numero = "/^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ ]+$/";

		if (!empty($this->idCovidResultado) || !empty($this->riesgo) || !empty($this->fechaIni) || !empty($this->fechaFin) || !empty($this->diasIncapacidad) || !empty($this->lugar) || !empty($this->fecha) || !empty($this->clave)) {

			if (preg_match($patron_texto_numero, $this->lugar) &&
				preg_match($patron_texto_numero, $this->clave)) {

				$tabla = "formulario_bajas";

				$datos = array("id_covid_resultado" => $this->idCovidResultado,
						        "riesgo" 		    => $this->riesgo,
						        "fecha_ini" 		=> date("Y-m-d", strtotime($this->fechaIni)), 
								"fecha_fin"         => date("Y-m-d", strtotime($this->fechaFin)),
								"dias_incapacidad"	=> $this->diasIncapacidad,
								"lugar" 		    => $this->lugar,
								"fecha"		        => date("Y-m-d", strtotime($this->fecha)),
								"clave"   		    => $this->clave
				);

				$respuesta = ModeloFormularioBajas::mdlIngresarFormularioBaja($tabla, $datos);

			} else {

				$respuesta = "error";

			}

			
		} else {

			$respuesta = "error";

		}

		echo $respuesta;

	}

	/*=============================================
	MOSTRAR FORMULARIO DE BAJA GENERADO EN PDF
	=============================================*/

	public $idFormularioBaja;

	public function ajaxImprimirFormularioBaja()	{

		/*=============================================
		TRAEMOS LOS DATOS DE FORMULARIO BAJA
		=============================================*/

		$item = "id";
        $valor = $this->idFormularioBaja;
        $covid_respuesta = ControladorFormularioBajas::ctrMostrarFormularioBajas($item, $valor); 

        /*=============================================
        TRAEMOS LOS DATOS DE COVID RESULTADOS
        =============================================*/

        $valorCovidResultado = $covid_respuesta["id_covid_resultado"];
        $covidResultado = ControladorCovidResultados::ctrMostrarCovidResultados($item, $valorCovidResultado);

        /*=============================================
        Extend the TCPDF class to create custom Header and Footer
        =============================================*/

		$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('CNS Potosí');
		$pdf->SetTitle('formularioIncapacidad-'.$valor);
		$pdf->SetSubject('Reporte Resultados Covid CNS');
		$pdf->SetKeywords('TCPDF, PDF, CNS, Reporte, CovidCNS');

		$pdf->setPrintHeader(false); 
		$pdf->setPrintFooter(false);
		$pdf->SetMargins(5, 10, 5, 5); 
		$pdf->SetAutoPageBreak(true, 10); 
		$pdf->SetFont('Helvetica', '', 10);
		$pdf->addPage();

		// set cell padding
		$pdf->setCellPaddings(1, 1, 1, 1);

		// set cell margins
		$pdf->setCellMargins(1, 1, 1, 1);

		// set color for background
		$pdf->SetFillColor(255, 255, 127);

		// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

		// Título del Formulario
		$title1 = 'CAJA NACIONAL DE SALUD
		DEPARTAMENTO DE AFILIACIÓN
		CERTIFICADO DE INCAPACIDAD TEMPORAL';

		// Estilos necesarios para el Codigo QR
		$style = array(
		    'border' => 0,
		    'vpadding' => 'auto',
		    'hpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255)
		    'module_width' => 1, // width of a single module in points
		    'module_height' => 1 // height of a single module in points
		);

		//	Datos a mostrar en el código QR
		$codeContents = 'AP. PATERNO: '.$covidResultado["paterno"]."\n";
		$codeContents .= 'AP. MATERNO: '.$covidResultado["materno"]."\n";
		$codeContents .= 'NOMBRE: '.$covidResultado["nombre"]."\n";
		$codeContents .= 'Nro. Asegurado: '.$covidResultado["cod_asegurado"]."\n";
		$codeContents .= 'NOMBRE DEL EMPLEADOR: '.$covidResultado["nombre_empleador"]."\n";
		$codeContents .= 'Nro. Empleador: '.$covidResultado["cod_empleador"]."\n";

		/*=============================================
		CONTRUCCION DEL FORMULARIO PRINCIPAL Y SU COPIA
		=============================================*/

		$n = 5;
		
		for ($i = 0; $i < 2; $i++) {
			
			/*=============================================
			PRIMERA SECCION CABEZERA DEL FORMULARIOS
			=============================================*/

			$pdf->MultiCell(200, 22, '', 1, 'C', 0, 0, 5, 2 + $n, true);

			$image_file = K_PATH_IMAGES.'cns-logo.png';
	        $pdf->Image($image_file, 10, 5 + $n, 10, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);

			// Multicell test
			$pdf->MultiCell(90, 20, $title1, 0, 'C', 0, 0, '', '', true);

			$pdf->MultiCell(90, 20, 'AVC-09', 0, 'R', 0, 1, '', '', true);

			$pdf->write2DBarcode($codeContents, 'QRCODE,L', 150, 2 + $n, 24, 24, $style, 'N');	

			/*=============================================
			SEGUNDA SECCION DATOS ASEGURADO
			=============================================*/

			$pdf->SetFont('Helvetica', 'B', 10);

			$pdf->MultiCell(50, 5, '(1) AP. PATERNO', 1, 'C', 0, 0, '',24 + $n, true, 1);
			$pdf->MultiCell(50, 5, '(2) AP. MATERNO', 1, 'C', 0, 0, 55, '', true, 1);
			$pdf->MultiCell(50, 5, '(3) NOMBRE', 1, 'C', 0, 0, 105, '', true, 0);
			$pdf->MultiCell(50, 5, '(4) Número Asegurado', 1, 'C', 0, 1, 155, '', true);

			$pdf->SetFont('Helvetica', '', 10);

			$pdf->MultiCell(50, 5, $covidResultado["paterno"], 1, 'C', 0, 0, '', 30.5 + $n, true, 0);
			$pdf->MultiCell(50, 5, $covidResultado["materno"], 1, 'C', 0, 0, 55, '', true, 0);
			$pdf->MultiCell(50, 5, $covidResultado["nombre"], 1, 'C', 0, 0, 105, '', true, 0);
			$pdf->MultiCell(50, 5, $covidResultado["cod_asegurado"], 1, 'C', 0, 1, 155, '', true);

			$pdf->SetFont('Helvetica', 'B', 10);

			$pdf->MultiCell(150, 5, '(5) NOMBRE O RAZÓN SOCIAL DEL EMPLEADOR', 1, 'C', 0, 0, '', 37 + $n, true, 0);
			$pdf->MultiCell(50, 5, '(6) Número Empleador', 1, 'C', 0, 1, 155, '', true);

			$pdf->SetFont('Helvetica', '', 10);

			$pdf->MultiCell(150, 5, $covidResultado["nombre_empleador"], 1, 'C', 0, 0, '', 43.5 + $n, true, 0);
			$pdf->MultiCell(50, 5, $covidResultado["cod_empleador"], 1, 'C', 0, 1, 155, '', true);

			/*=============================================
			TERCERA SECCION DATOS FORMULARIO DE BAJA
			=============================================*/

			$left_column = '
			<table>
				<tr>
					<td colspan="2">(7) Riesgo</td>
				</tr>
				<tr>
					<td colspan="2" align="center">'.$covid_respuesta["riesgo"].'<br></td>
				</tr>
				<tr>
					<td>INCAPACIDAD DESDE: </td>
					<td>'.date("d-m-Y", strtotime($covid_respuesta["fecha_ini"])).'</td>
				</tr>
				<tr>
					<td>INCAPACIDAD HASTA: </td>
					<td>'.date("d-m-Y", strtotime($covid_respuesta["fecha_fin"])).'</td>
				</tr>
				<tr>
					<td>DÍAS INCAPACIDAD: </td>
					<td>'.$covid_respuesta["dias_incapacidad"].'</td>
				</tr>
				<tr>
					<td>FIRMA DEL MÉDICO<br><br><br><br></td>
					<td align="center">'.$covid_respuesta["lugar"].' '.date("d-m-Y", strtotime($covid_respuesta["fecha"])).'<br>.........................................<br>Lugar y Fecha</td>
				</tr>
				<tr>
					<td>UNIDAD SANIT.</td>
					<td>CLAVE: '.$covid_respuesta["clave"].'</td>
				</tr>
			</table>';

			$right_column = '
			<table>
				<tr>
					<td>(8)</td>
				</tr>
				<tr>
					<td>Salario Bs. ............................................<br></td>
					
				</tr>
				<tr>
					<td>Importe Subsidio Bs. .................................<br></td>
					
				</tr>
				<tr>
					<td>SON:........................................................................................................BOLIVIANOS<br></td>
					
				</tr>
				<tr>
					<td>CERTIFICO: .................................<br></td>
					
				</tr>
				<tr>
					<td align="center"><br>..................................................<br>Nombre y Firma C.N.S.</td>
					
				</tr>
			</table>';

			// // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

			// get current vertical position
			$y = $pdf->getY();


			// write the first column
			$pdf->writeHTMLCell(125, '', '', 50 + $n, $left_column, 1, 0, 0, true, 'J', true);

			$pdf->writeHTMLCell(75, '', 130, '', $right_column, 1, 1, 0, true, 'J', true);


			/*=============================================
			CUARTA SECCION FIRMAS
			=============================================*/

			$pdf->MultiCell(200, 30, '', 1, 'C', 0, 0, 5, 105 + $n, true);

			$pdf->MultiCell(185, 5, '(9)....................................................................................', 0, 'C', 0, 1, '', 110 + $n, true, 0);

			$pdf->MultiCell(185, 5, 'Lugar y Fecha', 0, 'C', 0, 1, '', 114 + $n, true);

			$pdf->MultiCell(95, 5, '(10)..............................................................', 0, 'C', 0, 0, '', 122 + $n, true, 0);
			$pdf->MultiCell(90, 5, '(11)..............................................................', 0, 'C', 0, 1, 90, '', true);

			$pdf->MultiCell(95, 5, 'Firma del Asegurado', 0, 'C', 0, 0, '', 128 + $n, true, 0);
			$pdf->MultiCell(90, 5, 'Sello Y Firma Empresa', 0, 'C', 0, 1, 90, '', true);


			$n = $n + 145;
			
		}	

		$pdf->writeHTML($content, true, 0, true, 0);

		$pdf->lastPage();

		$pdf->output('../temp/formularioIncapacidad-'.$valor.'.pdf', 'F');

	}

}

/*=============================================
MOSTRAR FORMULARIOS DE BAJA
=============================================*/

if (isset($_POST["mostrarFormBaja"])) {

	$formularioBaja = new AjaxFormularioBajas();
	$formularioBaja -> idCovidResultado = $_POST["idCovidResultado"];
	$formularioBaja -> ajaxMostrarFormularioBajas();

}

/*=============================================
AGREGAR DATOS AL FORMULARIO BAJA
=============================================*/

if (isset($_POST["agregarFormBaja"])) {

	$formularioBaja = new AjaxFormularioBajas();
	$formularioBaja -> idCovidResultado = $_POST["idCovidResultado"];
	$formularioBaja -> riesgo = $_POST["riesgo"];
	$formularioBaja -> fechaIni = $_POST["fechaIni"];
	$formularioBaja -> fechaFin = $_POST["fechaFin"];
	$formularioBaja -> diasIncapacidad = $_POST["diasIncapacidad"];
	$formularioBaja -> lugar = $_POST["lugar"];
	$formularioBaja -> fecha = $_POST["fecha"];
	$formularioBaja -> clave = $_POST["clave"];
	$formularioBaja -> ajaxIngresarFormularioBaja();

}

/*=============================================
IMPRIMIR FORMULARIO DE BAJA
=============================================*/

if (isset($_POST["imprimirFormBaja"])) {

	$formularioBaja = new AjaxFormularioBajas();
	$formularioBaja -> idFormularioBaja = $_POST["idFormularioBaja"];
	$formularioBaja -> nombre_usuario = $_POST["nombre_usuario"];
	$formularioBaja -> ajaxImprimirFormularioBaja();

}