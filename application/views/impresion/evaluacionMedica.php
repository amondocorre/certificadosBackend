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

  $pdf->AddPage();
  $logoWidth = 25;
  $logoX = $pdf->GetX();
  $logoY = $pdf->GetY();
  $pdf->Image($data->foto, $logoX-10, $logoY-10, $logoWidth, '', 'PNG');
  $pdf->SetFont('helvetica', 'B', 14);
  $afterLogoY = $logoY + $logoWidth + 2;
  $pdf->SetXY($pdf->getMargins()['left']-10,$afterLogoY-10);

  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->Cell(106, 5, "Detalle", 1, 0, 'C');
  $pdf->Cell(20, 5, "Cantidad", 'TRB', 0, 'C');
  $pdf->Cell(20, 5, "P. unit.", 'TRB', 0, 'C');
  $pdf->Cell(20, 5, "P. Total", 'TRB', 1, 'C');
  $pdf->SetFont('helvetica', '', 10);

$pdf->Output('movimiento_caja.pdf', 'I');
?>