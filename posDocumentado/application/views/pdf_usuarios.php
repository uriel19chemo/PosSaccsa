<?php

include("../libraries/fonts/times.php"); //tcpdf
include("../libraries/config/lang/spa.php"); //tcpdf
$this->load->library('tcpdf'); //Carga de libreria tcpdf

ob_end_clean(); //rompimiento y limpia de pagina

//Creacion de nuevo PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// informacion del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('SOFTWARE-CREAM');
$pdf->SetTitle('codigoweblibre.comli.co - codigoweblibre.wordpress.com');
$pdf->SetSubject('PDF');
$pdf->SetKeywords('Reporte, ESTUDIANTES');

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//margenes
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//establecimiento de saltos de pagina automatico
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//factor de escale de imagen
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//Establecer algunas cadenas que dependen del idioma
//$pdf->setLanguageArray($l);

// ---------------------------------------------------------
// modo de subconjuntos de fuentes establecido por defecto
$pdf->setFontSubsetting(true);

$pdf->SetFont('helvetica', '', 10, '', true);

// Añadir una pagina
// This method has several options, check the source code documentation for more information.
$pdf->setPrintHeader(true); // imprime la linea de cabecera  
$pdf->setPrintFooter(true); // imprime la linea de pie de pagina y numeracion
$pdf->AddPage();

$i = 0;
$tipo_documento = "";
$style = "";
$html = "";
//Estilo Titulo del pdf
$html = '<h2 style="text-align:center"><font color="#FF0000">Reporte de Usuarios Registrados</font></h2>';
$html .= '<table border="0">';//Inicia Tabla
//Estilo fila de encabezados
$html .='<tr style="background-color:#FF3; color:#000; text-align: center;">
    <th>ID</th>
    <th>Nombre - Apellidos</th>    
    <th>Email</th>
    <th>Fecha Resgistro</th>
    <th>Estatus</th>
    </tr>';

// ---------------------------------------------------------
//Volcado de informacion de la tabla usuarios mediante un Foreach

foreach ($usuarios as $valor) {
    $i++;    
    if (($i % 2) == 0) {
        $style = 'style="background-color:#9BA9CF; text-align: center; "';//Estilo lineas pares de pdf
    } else {
        $style = 'style="background-color:#FFFFFF; text-align: center; "';//Estilo lineas impares de pdf
    }
    //Atributos de la tabla
    $html .= '<tr ' . $style . '><td>' . $valor->ID . '</td>';
    $html .= '<td>' . ucwords($valor->NOMBRE . ' ' . $valor->APELLIDOS) . '</td>';
    $html .= '<td>' . $valor->EMAIL . '</td>';
    $html .= '<td>' . ucwords($valor->FECHA_REGISTRO) . '</td>';
    $html .= '<td>' . ucwords($valor->ESTATUS) . '</td></tr>';    
}
$html .= '</table>';//Termina Tabla
$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
$pdf->Output('Reporte.pdf', 'I');//Nombre predeterminado del pdf
?>