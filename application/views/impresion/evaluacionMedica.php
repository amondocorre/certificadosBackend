<?php 

class MYPDF extends TCPDF
{
  public function Header(){}
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('dejavusans', 'I', 8);
    }
}
$data = json_decode($json);
$pageLayout = [216, 279];
$pdf = new MYPDF('P', 'mm', $pageLayout, true, 'UTF-8', false);
//$pdf->SetAutoPageBreak(true, 10); 
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Chuñitos');
$pdf->SetTitle('nota venta');
$pdf->SetSubject('nota venta');
$pdf->SetKeywords('TCPDF, CodeIgniter, PDF, Voucher');
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetHeaderMargin(5);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
  require_once(dirname(__FILE__) . '/lang/eng.php');
  $pdf->setLanguageArray($l);
}
$pdf->setFontSubsetting(true);
$pdf->SetMargins(25, 20, 20);
$pdf->SetAutoPageBreak(TRUE, 10);

$margen=1 ;
$pdf->AddPage();
  $logoWidth = 26;
  $logoX = $pdf->GetX();
  $logoY = $pdf->GetY();
  $pdf->Image($data->foto, $logoX-10, $logoY-10, $logoWidth, '', 'PNG');
  $pdf->SetFont('helvetica', 'B', 14);
  $afterLogoY = $logoY + $logoWidth + 2;
  $pdf->SetXY($pdf->getMargins()['left']-10,$afterLogoY-12);
    
  //nombre completo
  $pdf->SetFont('helvetica', 'N', 10);
  $pdf->Cell(5, 5, "", $margen, 0, 'C');
  $pdf->Cell(35, 5, $data->ap_paterno, $margen, 0, 'C');
  $pdf->Cell(7, 5, "", $margen, 0, 'C');
  $pdf->Cell(35, 5, $data->ap_materno, $margen, 0, 'C');
  $pdf->Cell(7, 5, "", $margen, 0, 'C');
  $pdf->Cell(45, 5, $data->nombre, $margen, 1, 'C');
  //ci
  $pdf->Cell(5, 11, "", $margen, 1, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(30, 5, $data->ci, $margen, 0, 'C');
  $pdf->Cell(8, 5, "", $margen, 0, 'C');
  //edad
  $pdf->Cell(10, 5, $data->edad, $margen, 0, 'C');
  $pdf->Cell(15, 5, "", $margen, 0, 'C');
  //sexo
  $pdf->Cell(10, 5, $data->sexo, $margen, 0, 'C');
  $pdf->Cell(5, 5, "", $margen, 0, 'C');
  $pdf->Cell(29, 5, "COCHABAMBA, ", $margen, 0, 'R');
  //fecha
  $pdf->Cell(20, 5, $data->fecha, $margen, 1, 'L');
  //antecedentes_rc
  $pdf->Cell(5, 18, "", $margen, 1, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(45, 5, "", $margen, 0, 'C');
  $pdf->MultiCell(110, 10, utf8_decode($data->antecendentes_rc), $margen, 'L');
  //antecedentes_pp
  //$pdf->Cell(5, 5, "", $margen, 1, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(45, 5, "", $margen, 0, 'C');
  $pdf->MultiCell(110, 10, utf8_decode($data->antecendentes_pp), $margen, 'L');
  $pdf->SetXY($pdf->GetX(), $pdf->GetY()+2); // asegura posición
  switch (trim($data->bebe)) {
    case 'Nunca':
        $pdf->Cell(35, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 1, 'C');
        break;
    case 'Ocasionalmente':
        $pdf->Cell(73, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 1, 'C');
        break;
    case 'Una o más a la semana':
        $pdf->Cell(136, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 1, 'C');
        break;
    
  }
  //fuma
  $pdf->SetXY($pdf->GetX(), $pdf->GetY()+5); // asegura posición
  switch (trim($data->fuma)) {
    case 'Nunca':
        $pdf->Cell(34, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 1, 'C');
        break;
    case 'Ocasionalmente':
        $pdf->Cell(73, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 1, 'C');
        break;
    case 'Una o más a la semana':
        $pdf->Cell(136, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 1, 'C');
        break;
    default:
        $pdf->Cell(44, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 0, 'C');
        $pdf->Cell(33, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 0, 'C');
        $pdf->Cell(49, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 0, 'C');
        break;
  }
  
  $pdf->SetXY($pdf->GetX(), $pdf->GetY()+7); // asegura posición
  switch (trim($data->f_amarilla)) {
    case 'SI':
        $pdf->Cell(43, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 0, 'C');
        $pdf->Cell(15, 5, "", $margen, 0, 'C');
        break;
    case 'NO':
        $pdf->Cell(58, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 0, 'C');
        break;
   
  }
  
  switch (trim($data->antitetanica)) {
    case 'SI':
        $pdf->Cell(62, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 1, 'C');
        break;
    case 'NO':
        $pdf->Cell(77, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 1, 'C');
        break;
  }
  //grupo sanguineo
  $pdf->SetXY($pdf->GetX(), $pdf->GetY()+7); // asegura posición
  $pdf->Cell(70, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(35, 5, $data->grupo_sanguineo, $margen, 1, 'C');
  //temperatura
  $pdf->Cell(5, 5, "", $margen, 1, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(40, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(20, 5, $data->temperatura, $margen, 0, 'C');
  //presion arterial
  $pdf->Cell(35, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $presion = str_replace("/", "  ", $data->presion_arterial);
  $pdf->Cell(30, 5, $presion, $margen, 1, 'C');
  //frecuencia_cardiaca
  $pdf->SetXY($pdf->GetX(), $pdf->GetY()+4); // asegura posición
  $pdf->Cell(25, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(20, 5, $data->frecuencia_cardiaca, $margen, 0, 'C');
  //frecuencia_respiratoria
  $pdf->Cell(70, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(30, 5, $data->frecuencia_respiratoria, $margen, 1, 'C');
  //talla
  $pdf->SetXY($pdf->GetX(), $pdf->GetY()+3); // asegura posición
  $pdf->Cell(35, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(25, 5, $data->talla, $margen, 0, 'C');
  //peso
  $pdf->Cell(25, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(20, 5, $data->peso, $margen, 1, 'C');
  //cabeza
  $pdf->SetXY($pdf->GetX(), $pdf->GetY()+18); // asegura posición
  $pdf->Cell(10, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $pdf->SetXY($pdf->GetX(), $pdf->GetY()); // asegura posición
  $pdf->MultiCell(150, 5, utf8_decode($data->cabeza), $margen, 'L');
  //cara
  $pdf->SetXY($pdf->GetX(), $pdf->GetY()+1); // asegura posición
  $pdf->Cell(10, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $pdf->SetXY($pdf->GetX(), $pdf->GetY()); // asegura posición
  $pdf->MultiCell(150, 5, utf8_decode($data->cara), $margen, 'L');
  //cuello
    $pdf->SetXY($pdf->GetX(), $pdf->GetY()+1); // asegura posición
  $pdf->Cell(10, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $pdf->SetXY($pdf->GetX(), $pdf->GetY()); // asegura posición
  $pdf->MultiCell(150, 5, utf8_decode($data->cuello), $margen, 'L');
  
  //ex_general_ojos
  $pdf->SetXY($pdf->GetX(), $pdf->GetY()+4); // asegura posición
  $pdf->Cell(80, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(70, 5, $data->ex_general_ojos, $margen, 1, 'L');
  //movimiento_oculares
  $pdf->SetXY($pdf->GetX(), $pdf->GetY()+1); // asegura posición
  $pdf->Cell(80, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(70, 5, $data->movimiento_oculares, $margen, 1, 'L');
  //reflejo_luminoso_corneal
  $pdf->SetXY($pdf->GetX(), $pdf->GetY()+1); // asegura posición
  $pdf->Cell(80, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(70, 5, $data->reflejo_luminoso_corneal, $margen, 1, 'L');
  //estrabismo
   $pdf->SetXY($pdf->GetX(), $pdf->GetY()+1); // asegura posición

  switch (trim($data->estrabismo)) {
    case 'SI':
        $pdf->Cell(73, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 1, 'C');
        break;
    case 'NO':
        $pdf->Cell(112, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 1, 'C');
        break;
  }
  //USA LENTES
  $pdf->SetXY($pdf->GetX(), $pdf->GetY()+1); // asegura posición
  switch (trim($data->usa_lentes)) {
    case 'SI':
        $pdf->Cell(73, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 0, 'C');
        $pdf->Cell(50, 5, "", $margen, 0, 'C');
        $pdf->Cell(40, 5, $data->tipo_lentes, $margen, 1, 'L');
        break;
    case 'NO':
        $pdf->Cell(112, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 0, 'C');
        $pdf->Cell(13, 5, "", $margen, 0, 'C');
        $pdf->Cell(30, 5, $data->tipo_lentes, $margen, 1, 'L');
        break;
  }
    //cirugia
 $pdf->SetXY($pdf->GetX(), $pdf->GetY()+3); // asegura posición
  switch (trim($data->cirugia)) {
    case 'SI':
        $pdf->Cell(73, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 1, 'C');
        break;
    case 'NO':
        $pdf->Cell(112, 5, "", $margen, 0, 'C');
        $pdf->Cell(8, 5, "X", $margen, 1, 'C');
        break;
  }
  //CAPIMETRIA
  $pdf->SetXY($pdf->GetX(), $pdf->GetY()+3); // asegura posición
  $pdf->Cell(67, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(30, 5, $data->campimetria, $margen, 0, 'L');
  $pdf->Cell(31, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(30, 5, $data->colorimetria, $margen, 1, 'L');
  //od od
  $pdf->SetXY($pdf->GetX(), $pdf->GetY()+6); // asegura posición
  //$pdf->Cell(5, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(17, 5, $data->od_con_lentes, $margen, 0, 'C');
  $pdf->Cell(17, 5, $data->od_sin_lentes, $margen, 0, 'C');
  $pdf->Cell(17, 5, $data->od_correccion, $margen, 0, 'C');
  $pdf->Cell(40, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(35, 5, $data->vision_profunda, $margen, 1, 'l');
  //oi od
  $pdf->SetXY($pdf->GetX(), $pdf->GetY()+1); // asegura posición
  //$pdf->Cell(5, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(17, 5, $data->oi_con_lentes, $margen, 0, 'C');
  $pdf->Cell(17, 5, $data->oi_sin_lentes, $margen, 0, 'C');
  $pdf->Cell(17, 5, $data->oi_correccion, $margen, 0, 'C');
  $pdf->Cell(53, 5, "", $margen, 0, 'C'); // SALTO DE LINEA ANCHO
  $pdf->Cell(40, 5, $data->dx_lampara_hendidura, $margen, 1, 'l');
  

















  $pdf->SetFont('helvetica', '', 10);

$pdf->Output('movimiento_caja.pdf', 'I');
?>