<?php
  function creerPdf($tab) {
    require("./fpdf/fpdf.php");

    // Instanciation de la classe d�riv�e
    $pdf = new FPDF();

    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);

        $pdf->Cell(50,50,$tab->getPersonNom(),0,1);
        $pdf->Cell(50,50,$tab->getPersonPrenom(),0,1);
        $pdf->Cell(50,50,$tab->getPayee(),0,1);
        $pdf->Cell(50,50,$tab->getIdCours(),0,1);
        

    ob_clean();
    $pdf->Output();

  }
?>