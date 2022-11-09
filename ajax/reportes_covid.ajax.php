<?php

require_once "../controladores/reportes_covid.controlador.php";
require_once "../modelos/reportes_covid.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

require_once "../controladores/departamentos.controlador.php";
require_once "../modelos/departamentos.modelo.php";

require_once "../controladores/establecimientos.controlador.php";
require_once "../modelos/establecimientos.modelo.php";

require_once "../controladores/localidades.controlador.php";
require_once "../modelos/localidades.modelo.php";

// require_once('../extensiones/tcpdf/tcpdf.php');
require_once('../extensiones/TCPDF-main/tcpdf.php');

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'cns-logo-simple.png';
        $this->Image($image_file, 5, 5, 15, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 14);
        // Titulo
        $this->Cell(0, 0, 'CAJA  NACIONAL  DE  SALUD             ', 0, 1, 'C', 0, '', 1);
        // Set font
        $this->SetFont('helvetica', 'B', 10);
        // Subtitulo
        $this->Cell(0, 0, 'LABORATORIO HOSPITAL OBRERO Nº5', 0, 1, 'C', 0, '', 1);

	}

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

class AjaxReportesCovid {
	
	/*=============================================
	MOSTRAR REPORTE POR FECHA DE RESULTADO Y TIPO DE RESULTADO
	=============================================*/
	
	public $fechaInicio;
	public $fechaFin;
	public $resultado;

	public $nombre_usuario;

	public function ajaxMostrarReportesCovidFechas()	{
		
		$valor1 = date("Y-m-d", strtotime($this->fechaInicio));
		$valor2 = date("Y-m-d", strtotime($this->fechaFin));
		$valor3 = $this->resultado;

		$respuesta = ControladorReportesCovid::ctrMostrarReportesCovidFechas($valor1, $valor2, $valor3);

		echo json_encode($respuesta);

	}

	/*=============================================
	MOSTRAR REPORTE GENERADO EN PDF POR FECHA DE RESULTADO Y TIPO DE RESULTADO
	=============================================*/

	public function ajaxMostrarReportesCovidFechasPDF()	{
		
		$valor1 = date("Y-m-d", strtotime($this->fechaInicio));
		$valor2 = date("Y-m-d", strtotime($this->fechaFin));
		$valor3 = $this->resultado;

		/*=============================================
		USANDO LA LIBRERIA TCPDF
		=============================================*/

		// Extend the TCPDF class to create custom Header and Footer


		$pdf = new MYPDF('L', 'mm', 'letter', true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('CNS Potosí');
		$pdf->SetTitle('reporte-'.$valor1.'-'.$valor2.'-'.$valor3);
		$pdf->SetSubject('Reporte Resultados Covid CNS');
		$pdf->SetKeywords('TCPDF, PDF, CNS, Reporte, CovidCNS');

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(5, 22, 5, 5);
		$pdf->SetAutoPageBreak(true, 25); 
		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(5);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('Helvetica', '', 6);

		// add a page
		$pdf->AddPage();

		$respuesta = ControladorReportesCovid::ctrMostrarReportesCovidFechas($valor1, $valor2, $valor3);

		$valor1 = date("d/m/Y", strtotime($valor1));
		$valor2 = date("d/m/Y", strtotime($valor2));

		$content = '';

		if ($valor3 == "TODO") {

			$content .= '
				<div class="row">
				
		        	<div class="col-md-12">
						
						<h1 style="text-align:center;">Reporte: Resultados Covid</h1>
		            	<h3 style="text-align:center;">Desde '.$valor1.' hasta: '.$valor2.'</h3>';
			
		} else {

			$content .= '
				<div class="row">
				
		        	<div class="col-md-12">
						
						<h1 style="text-align:center;">Reporte: Resultados Covid '.$valor3.'</h1>
		            	<h3 style="text-align:center;">Desde '.$valor1.' hasta: '.$valor2.'</h3>';	

		}


		    $content .= '

		    <table border="1" cellpadding="5">
		        <thead>
		          	<tr bgcolor="#E5E5E5">
			            <th width="50px" align="center">COD. LAB.</th>
	                    <th width="70px" align="center">COD. ASEGURADO</th>
	                    <th width="100px" align="center">APELLIDOS Y NOMBRES</th>
	                    <th width="50px" align="center">CI</th>
	                    <th width="110px" align="center">NOMBRE EMPLEADOR</th>
	                    <th width="60px" align="center">FECHA MUESTRA</th>
	                    <th width="60px" align="center">FECHA RECEPCIÓN</th>
	                    <th width="50px" align="center">MUESTRA CONTROL</th>
	                    <th width="50px" align="center">DEPTO.</th>
	                    <th width="80px" align="center">ESTABL.</th>
	                    <th width="40px" align="center">SEXO</th>
	                    <th width="40px" align="center">EDAD</th>
	                    <th width="60px" align="center">TEL/CEL</th>
	                    <th width="60px" align="center">FECHA RESULTADO</th>
	                    <th width="60px" align="center">RESULTADO</th>
	                    <th width="70px" align="center">OBS.</th>
		          	</tr>
		        </thead>
			';

			foreach ($respuesta as $key => $value) {
					
				$content .= '
					<tr nobr="true">
			            <td width="50px" align="center">'.$value["cod_laboratorio"].'</td>
			            <td width="70px">'.$value["cod_asegurado"].'</td>
			            <td width="100px">'.$value["nombre_completo"].'</td>
			            <td width="50px">'.$value["documento_ci"].'</td>
			            <td width="110px">'.$value["nombre_empleador"].'</td>
			            <td width="60px">'.date("d/m/Y", strtotime($value["fecha_muestra"])).'</td>
			            <td width="60px">'.date("d/m/Y", strtotime($value["fecha_recepcion"])).'</td>
			            <td width="50px" align="center">'.$value["muestra_control"].'</td>
			            <td width="50px">'.$value["nombre_depto"].'</td>
			            <td width="80px">'.$value["abreviatura_establecimiento"].'</td>
			            <td width="40px" align="center">'.$value["sexo"].'</td>
			            <td width="40px" align="center">'.$value["edad"].'</td>
			            <td width="60px" align="center">'.$value["telefono"].'</td>
			            <td width="60px">'.date("d/m/Y", strtotime($value["fecha_resultado"])).'</td>
			            <td width="60px"><b>'.$value["resultado"].'</b></td>
			            <td width="70px">'.$value["observaciones"].'</td>
			        </tr>
				';

			}

			$content .= '</table>';

			$content .= '</br>
					<h3 style="text-align: left; padding-top: 10px;">Reporte Generado por el Usuario: '.$this->nombre_usuario.'</h3>
					<h3 style="text-align: left; padding-top: 10px;">Reporte Generado en fecha: '.date("d/m/Y H:i:s").'</h3>
				</div>
				
		    </div>';

			
		//CONSULTA

		$pdf->writeHTML($content, true, 0, true, 0);

		$pdf->lastPage();

		$pdf->output(__DIR__ . '/temp/reporte-'.$this->fechaInicio.'-'.$this->fechaFin.'-'.$valor3.'.pdf', 'F');

	}

	/*=============================================
	ELIMINADO REPORTE PDF GENERADO
	=============================================*/
	
	public $file;

	public function ajaxEliminarReportePDF()	{
		
		$file = $this->file;

		unlink('../'.$file);

	}

	/*=============================================
	MOSTRAR REPORTE GENERADO EN PDF POR PERSONA ASEGURADA
	=============================================*/

	public $idCovidResultado;

	public function ajaxMostrarReportesCovidPersonalPDF()	{

		/*=============================================
		TRAEMOS LOS DATOS DEL AFILIADO CON RESULTADOS COVID
		=============================================*/

		$item = "id";
        $valor = $this->idCovidResultado;
        $covid_respuesta = ControladorReportesCovid::ctrMostrarReportesCovidPersonal($item, $valor); 

        /*=============================================
        TRAEMOS LOS DATOS DE DEPARTAMENTO
        =============================================*/
        
        $valor_depto = $covid_respuesta["id_departamento"];
        $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor_depto);

        /*=============================================
        TRAEMOS LOS DATOS DE ESTABLECIMIENTO
        =============================================*/

        $valor_est = $covid_respuesta["id_establecimiento"];
        $establecimientos = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor_est);

        /*=============================================
        TRAEMOS LOS DATOS DE LOCALIDAD
        =============================================*/

        $valor_local = $covid_respuesta["id_localidad"];
        $localidades = ControladorLocalidades::ctrMostrarLocalidades($item, $valor_local);



		// Extend the TCPDF class to create custom Header and Footer


		$pdf = new MYPDF('P', 'mm', 'letter', true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('CNS Potosí');
		$pdf->SetTitle('reporte-'.$valor);
		$pdf->SetSubject('Reporte Resultados Covid CNS');
		$pdf->SetKeywords('TCPDF, PDF, CNS, Reporte, CovidCNS');

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(2, 15, 2, 5);
		$pdf->SetAutoPageBreak(true, 5); 
		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(5);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('Helvetica', '', 8);

		$pdf->SetPrintFooter(false);

		// add a page
		$pdf->AddPage();

		/*=============================================
		PRIMERA SECCION DATOS ASEGURADO FORMULARIO RESULTADO COVID-19
		=============================================*/
		$pdf->SetFillColor(220, 220, 220);
		$pdf->SetTextColor(0,0,0);

		$pdf->SetFont('Helvetica', 'B', 10);

		$pdf->MultiCell(206, 6, 'DATOS PERSONALES', 1, 'C', 1, 0, '',24, true, 1);

		$pdf->SetFont('Helvetica', '', 10);

		$left_column = '
		<style>	

			table {

			  line-height: 18px;

			}

		</style>
		<table>
			<tr>
				<td width="50%"><b>APELLIDO. PATERNO: </b></td>
				<td>'.$covid_respuesta["paterno"].'</td>
			</tr>
			<tr>
				<td width="50%"><b>APELLIDO. MATERNO: </b></td>
				<td>'.$covid_respuesta["materno"].'</td>
			</tr>
			<tr>
				<td width="50%"><b>NOMBRE(S): </b></td>
				<td>'.$covid_respuesta["nombre"].'</td>
			</tr>
			<tr>
				<td width="50%"><b>NRO. CI: </b></td>
				<td>'.$covid_respuesta["documento_ci"].'</td>
			</tr>
			<tr>
				<td width="50%"><b>SEXO: </b></td>
				<td>'.$covid_respuesta["sexo"].'</td>
			</tr>
			<tr>
				<td width="50%"><b>FECHA NACIMIENTO: </b></td>
				<td>'.date("d/m/Y", strtotime($covid_respuesta["fecha_nacimiento"])).'</td>
			</tr>
		</table>';

		$right_column = '
		<style>	

			table {

			  line-height: 18px;

			}

		</style>
		<table>
			<tr>
				<td width="40%"><b>NRO. ASEGURADO: </b></td>
				<td>'.$covid_respuesta["cod_asegurado"].'</td>
			</tr>
			<tr>
				<td width="40%"><b>DEPARTAMENTO: </b></td>
				<td>'.$departamentos["nombre_depto"].'</td>
			</tr>
			<tr>
				<td width="40%"><b>LOCALIDAD: </b></td>
				<td>'.$localidades["nombre_localidad"].'</td>
			</tr>
			<tr>
				<td width="40%"><b>ZONA: </b></td>
				<td>'.$covid_respuesta["zona"].'</td>
			</tr>
			<tr>
				<td width="40%"><b>DIRECCIÓN: </b></td>
				<td>'.$covid_respuesta["calle"].' #'.$covid_respuesta["nro_calle"].'</td>
			</tr>
			<tr>
				<td width="40%"><b>TELF. / CEL.: </b></td>
				<td>'.$covid_respuesta["telefono"].'</td>
			</tr>
		</table>';

		// // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

		// get current vertical position
		$y = $pdf->getY();


		// write the first column
		$pdf->writeHTMLCell(103, '', '', 30 + $n, $left_column, 1, 0, 0, true, 'J', true);

		$pdf->writeHTMLCell(103, '', 105, '', $right_column, 1, 1, 0, true, 'J', true);


		$pdf->SetFont('Helvetica', 'B', 10);

		$pdf->MultiCell(154, 6, 'NOMBRE O RAZÓN SOCIAL DEL EMPLEADOR', 1, 'C', 1, 0, '', 60.5, true, 0);
		$pdf->MultiCell(52, 6, 'NÚMERO EMPLEADOR', 1, 'C', 1, 1, 156, '', true);

		$pdf->SetFont('Helvetica', '', 10);

		$pdf->MultiCell(154, 6, $covid_respuesta["nombre_empleador"], 1, 'C', 0, 0, '', 66.5, true, 0);
		$pdf->MultiCell(52, 6, $covid_respuesta["cod_empleador"], 1, 'C', 0, 1, 156, '', true);

		// $pdf->MultiCell(50, 6, 'AP. PATERNO', 1, 'C', 1, 0, '',24, true, 1);
		// $pdf->MultiCell(52, 6, 'AP. MATERNO', 1, 'C', 1, 0, 52, '', true, 1);
		// $pdf->MultiCell(52, 6, 'NOMBRE', 1, 'C', 1, 0, 104, '', true, 0);
		// $pdf->MultiCell(52, 6, 'NRO. ASEGURADO', 1, 'C', 1, 1, 156, '', true);

		// $pdf->SetFont('Helvetica', '', 10);

		// $pdf->MultiCell(50, 6, $covid_respuesta["paterno"], 1, 'C', 0, 0, '', 30, true, 0);
		// $pdf->MultiCell(52, 6, $covid_respuesta["materno"], 1, 'C', 0, 0, 52, '', true, 0);
		// $pdf->MultiCell(52, 6, $covid_respuesta["nombre"], 1, 'C', 0, 0, 104, '', true, 0);
		// $pdf->MultiCell(52, 6, $covid_respuesta["cod_asegurado"], 1, 'C', 0, 1, 156, '', true);

		// $pdf->SetFont('Helvetica', 'B', 10);

		// $pdf->MultiCell(50, 6, 'NRO. CI', 1, 'C', 1, 0, '',36, true, 1);
		// $pdf->MultiCell(52, 6, 'SEXO', 1, 'C', 1, 0, 52, '', true, 1);
		// $pdf->MultiCell(52, 6, 'FECHA NACIMIENTO', 1, 'C', 1, 0, 104, '', true, 0);
		// $pdf->MultiCell(52, 6, 'DEPARTAMENTO', 1, 'C', 1, 1, 156, '', true);

		// $pdf->SetFont('Helvetica', '', 10);

		// $pdf->MultiCell(50, 6, $covid_respuesta["documento_ci"], 1, 'C', 0, 0, '', 42, true, 0);
		// $pdf->MultiCell(52, 6, $covid_respuesta["sexo"], 1, 'C', 0, 0, 52, '', true, 0);
		// $pdf->MultiCell(52, 6, date("d/m/Y", strtotime($covid_respuesta["fecha_nacimiento"])), 1, 'C', 0, 0, 104, '',true, 0);
		// $pdf->MultiCell(52, 6, $departamentos["nombre_depto"], 1, 'C', 0, 1, 156, '', true);

		// $pdf->SetFont('Helvetica', 'B', 10);

		// $pdf->MultiCell(50, 6, 'LOCALIDAD', 1, 'C', 1, 0, '',48, true, 1);
		// $pdf->MultiCell(52, 6, 'ZONA', 1, 'C', 1, 0, 52, '', true, 1);
		// $pdf->MultiCell(52, 6, 'DIRECCIÓN', 1, 'C', 1, 0, 104, '', true, 0);
		// $pdf->MultiCell(52, 6, 'TELF. / CEL.', 1, 'C', 1, 1, 156, '', true);

		// $pdf->SetFont('Helvetica', '', 10);

		// $pdf->MultiCell(50, 6, $localidades["nombre_localidad"], 1, 'C', 0, 0, '', 54, true, 0);
		// $pdf->MultiCell(52, 6, $covid_respuesta["zona"], 1, 'C', 0, 0, 52, '', true, 0);
		// $pdf->MultiCell(52, 6, $covid_respuesta["calle"].' #'.$covid_respuesta["nro_calle"], 1, 'C', 0, 0, 104, '',true, 0);
		// $pdf->MultiCell(52, 6, $covid_respuesta["telefono"], 1, 'C', 0, 1, 156, '', true);

		// $pdf->SetFont('Helvetica', 'B', 10);

		// $pdf->MultiCell(154, 6, 'NOMBRE O RAZÓN SOCIAL DEL EMPLEADOR', 1, 'C', 1, 0, '', 60, true, 0);
		// $pdf->MultiCell(52, 6, 'NÚMERO EMPLEADOR', 1, 'C', 1, 1, 156, '', true);

		// $pdf->SetFont('Helvetica', '', 10);

		// $pdf->MultiCell(154, 6, $covid_respuesta["nombre_empleador"], 1, 'C', 0, 0, '', 66, true, 0);
		// $pdf->MultiCell(52, 6, $covid_respuesta["cod_empleador"], 1, 'C', 0, 1, 156, '', true);

		/*=============================================
		SEGUNDA SECCION FORMULARIO RESULTADO COVID-19
		=============================================*/

		$pdf->SetFont('Helvetica', 'B', 10);

		$pdf->MultiCell(206, 6, 'DATOS RESULTADO LABORATORIO', 1, 'C', 1, 0, '', 72.5, true, 0);

		$pdf->SetFont('Helvetica', '', 10);

		$left_column2 = '
		<style>	

			table {

			  line-height: 18px;

			}

		</style>
		<table>
			<tr>
				<td width="55%"><b>FECHA TOMA DE MUESTRA: </b></td>
				<td>'.date("d/m/Y", strtotime($covid_respuesta["fecha_muestra"])).'</td>
			</tr>
			<tr>
				<td width="55%"><b>FECHA RECEPCIÓN: </b></td>
				<td>'.date("d/m/Y", strtotime($covid_respuesta["fecha_recepcion"])).'</td>
			</tr>
			<tr>
				<td width="55%"><b>COD LABORATORIO: </b></td>
				<td>'.$covid_respuesta["cod_laboratorio"].'</td>
			</tr>
			<tr>
				<td width="55%"><b>RESULTADO LABORATORIO: </b></td>
				<td><b>'.$covid_respuesta["resultado"].'</b></td>
			</tr>
			<tr>
				<td width="55%"><b>MÉTODO DIAGNOSTICO: </b></td>
				<td>'.$covid_respuesta["metodo_diagnostico"].'</td>
			</tr>
		</table>';

		$right_column2 = '
		<style>	

			table {

			  line-height: 18px;

			}

		</style>
		<table>
			<tr>
				<td width="50%"><b>MUESTRA DE CONTROL: </b></td>
				<td>'.$covid_respuesta["muestra_control"].'</td>
			</tr>
			<tr>
				<td width="50%"><b>TIPO DE MUESTRA: </b></td>
				<td>'.$covid_respuesta["tipo_muestra"].'</td>
			</tr>
			<tr>
				<td width="50%"><b>ESTABLECIMIENTO: </b></td>
				<td>'.$establecimientos["abreviatura_establecimiento"].'</td>
			</tr>
			<tr>
				<td width="50%"><b>FECHA RESULTADO: </b></td>
				<td>'.date("d/m/Y", strtotime($covid_respuesta["fecha_resultado"])).'</td>
			</tr>
			<tr>
				<td width="55%"></td>
				<td></td>
			</tr>
		</table>';

		// // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

		// get current vertical position
		$y = $pdf->getY();


		// write the first column
		$pdf->writeHTMLCell(103, '', '', 78.5 + $n, $left_column2, 1, 0, 0, true, 'J', true);

		$pdf->writeHTMLCell(103, '', 105, '', $right_column2, 1, 1, 0, true, 'J', true);

		/*=============================================
		TERCERA SECCION FORMULARIO RESULTADO COVID-19
		=============================================*/

		$left_column3 = '
		<table>
			<tr>
				<td><br><br><b>REPORTE GENERADO POR EL USUARIO:</b> '.$this->nombre_usuario.'</td>
			</tr>
			<tr>
				<td><b>REPORTE GENERADO EN FECHA:</b> '.date("d/m/Y H:i:s").'</td>
			</tr>
		</table>';

		// // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

		// get current vertical position
		$y = $pdf->getY();

		$pdf->SetFont('Helvetica', '', 8);


		// write the first column
		$pdf->writeHTMLCell(206, 15, '', 104 + $n, $left_column3, 1, 0, 0, true, 'J', true);

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
		$codeContents = 'NRO. ASEGURADO: '.$covid_respuesta["cod_asegurado"]."\n";

		// insertando el código QR
		$pdf->write2DBarcode($codeContents, 'QRCODE,L', 187, 4, 20, 20, $style, 'N');	

		$pdf->lastPage();

		$pdf->output(__DIR__ . '/temp/reporte-'.$valor.'.pdf', 'F');

	}

}

/*=============================================
MOSTRAR REPORTE POR FECHAS DE RESULTADO COVID
=============================================*/

if (isset($_POST["reporte"])) {

	$reportesCovid = new AjaxReportesCovid();
	$reportesCovid -> fechaInicio = $_POST["fechaInicio"];
	$reportesCovid -> fechaFin = $_POST["fechaFin"];
	$reportesCovid -> resultado = $_POST["resultado"];
	$reportesCovid -> ajaxMostrarReportesCovidFechas();

}

/*=============================================
MOSTRAR REPORTE PDF POR FECHA DE RESULTADO Y TIPO DE RESULTADO COVID EN PDF
=============================================*/

if (isset($_POST["reportePDF"])) {

	$reportesCovid = new AjaxReportesCovid();
	$reportesCovid -> fechaInicio = $_POST["fechaInicio"];
	$reportesCovid -> fechaFin = $_POST["fechaFin"];
	$reportesCovid -> resultado = $_POST["resultado"];
	$reportesCovid -> nombre_usuario = $_POST["nombre_usuario"];
	$reportesCovid -> ajaxMostrarReportesCovidFechasPDF();

}

/*=============================================
ELIMINAR EL PDF TEMPORAL DE RESULTADO COVID
=============================================*/

if (isset($_POST["eliminarPDF"])) {

	$reportesCovid = new AjaxReportesCovid();
	$reportesCovid -> file = $_POST["url"];
	$reportesCovid -> ajaxEliminarReportePDF();

}

/*=============================================
MOSTRAR REPORTE PDF POR FECHA DE RESULTADO Y TIPO DE RESULTADO COVID EN PDF
=============================================*/

if (isset($_POST["reportePersonalPDF"])) {

	$reportesCovid = new AjaxReportesCovid();
	$reportesCovid -> idCovidResultado = $_POST["idCovidResultado"];
	$reportesCovid -> nombre_usuario = $_POST["nombre_usuario"];
	$reportesCovid -> ajaxMostrarReportesCovidPersonalPDF();

}