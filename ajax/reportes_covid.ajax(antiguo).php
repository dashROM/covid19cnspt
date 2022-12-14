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
        $this->Cell(0, 0, 'CAJA  NACIONAL  DE  SALUD          ', 0, 1, 'C', 0, '', 1);
        // Set font
        $this->SetFont('helvetica', 'B', 10);
        // Subtitulo
        $this->Cell(0, 0, 'LABORATORIO HOSPITAL OBRERO', 0, 1, 'C', 0, '', 1);

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
		$pdf->SetAuthor('CNS Potos??');
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
	                    <th width="60px" align="center">FECHA RECEPCI??N</th>
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
		$pdf->SetAuthor('CNS Potos??');
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

		$content = '';


		    $content .= '

		    <div>

		    	<p><b>Matricula Asegurado: </b>'.$covid_respuesta["cod_asegurado"].'</p>
	            <p><b>Nombre o Raz??n Social del Empleador: </b>'.$covid_respuesta["nombre_empleador"].'</p>
	            <p><b>Nro. Empleador: </b>'.$covid_respuesta["cod_empleador"].'</p>

		    	<table width="800px" cellspacing="1" cellpadding="4" border="1">
					<tr bgcolor="#E5E5E5">
					    <td align="center" width="205px"><b>Fecha Toma de Muestra</b></td>
					    <td align="center" width="105px"><b>Muestra de Control</b></td>
					    <td align="center" width="205px"><b>Tipo de Muestra</b></td>					    
					    <td align="center" width="205px"><b>Fecha Recepci??n</b></td>
					</tr>
					<tr>
					    <td align="center" width="205px">'.date("d/m/Y", strtotime($covid_respuesta["fecha_muestra"])).'</td>
					    <td align="center" width="105px">'.$covid_respuesta["muestra_control"].'</td>				    
					    <td align="center" width="205px">'.$covid_respuesta["tipo_muestra"].'</td>
					    <td align="center" width="205px">'.date("d/m/Y", strtotime($covid_respuesta["fecha_recepcion"])).'</td>
					</tr>

					<tr bgcolor="#E5E5E5">
					    <td align="center" width="205px"><b>C??digo Laboratorio</b></td>
					    <td align="center" width="105px"><b>Nombre Laboratorio</b></td>
					    <td align="center" width="205px"><b>Departamento</b></td>
					    <td align="center" width="205px"><b>Establecimiento</b></td>
					</tr>
					<tr>
					    <td align="center" width="205px">'.$covid_respuesta["cod_laboratorio"].'</td>
					    <td align="center" width="105px">'.$covid_respuesta["nombre_laboratorio"].'</td>
					    <td align="center" width="205px">'.$departamentos["nombre_depto"].'</td>
					    <td align="center" width="205px">'.$establecimientos["nombre_establecimiento"].'</td>
					</tr>

					<tr bgcolor="#E5E5E5">
					    <td align="center" width="205px"><b>Apellido(s) y Nombre(s)</b></td>
					    <td align="center" width="205px"><b>Documento CI</b></td>
					    <td align="center" width="105px"><b>Sexo</b></td>
					    <td align="center" width="205px"><b>Fecha Nacimiento</b></td>
					</tr>
					<tr>
					    <td align="center" width="205px">'.$covid_respuesta["paterno"].' '.$covid_respuesta["materno"].' '.$covid_respuesta["nombre"].'</td>
					    <td align="center" width="205px">'.$covid_respuesta["documento_ci"].'</td>
					    <td align="center" width="105px">'.$covid_respuesta["sexo"].'</td>
					    <td align="center" width="205px">'.date("d/m/Y", strtotime($covid_respuesta["fecha_nacimiento"])).'</td>
					</tr>

					<tr bgcolor="#E5E5E5">
					    <td align="center" width="205px"><b>Localidad</b></td>
					    <td align="center" width="205px"><b>Zona</b></td>
					    <td align="center" width="205px"><b>Direcci??n</b></td>
					    <td align="center" width="105px"><b>Tel??fono / Celular</b></td>
					</tr>
					<tr>
					    <td align="center" width="205px">'.$localidades["nombre_localidad"].'</td>
					    <td align="center" width="205px">'.$covid_respuesta["zona"].'</td>
					    <td align="center" width="205px">'.$covid_respuesta["calle"].' #'.$covid_respuesta["nro_calle"].'</td>
					    <td align="center" width="105px">'.$covid_respuesta["telefono"].'</td>
					</tr>

					<tr bgcolor="#E5E5E5">
					    <td align="center" width="205px"><b>Fecha Resultado</b></td>
					    <td align="center" width="205px"><b>Resultado</b></td>
					    <td align="center" width="311px"><b>Observaciones</b></td>
					</tr>
					<tr>
					    <td align="center" width="205px">'.date("d/m/Y", strtotime($covid_respuesta["fecha_resultado"])).'</td>
					    <td align="center" width="205px"><b>'.$covid_respuesta["resultado"].'</b></td>
					    <td align="center" width="311px">'.$covid_respuesta["observaciones"].'</td>
					</tr>

				</table>

			';

			$content .= '</br>
					<h3 style="text-align: left; padding-top: 10px;">Reporte Generado por el Usuario: '.$this->nombre_usuario.'</h3>
					<h3 style="text-align: left; padding-top: 10px;">Reporte Generado en fecha: '.date("d/m/Y H:i:s").'</h3>		
		    </div>';

			
		//CONSULTA

		$pdf->writeHTML($content, true, 0, true, 0);

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