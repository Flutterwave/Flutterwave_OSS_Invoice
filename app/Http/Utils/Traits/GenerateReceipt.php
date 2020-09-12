<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16-Apr-18
 * Time: 01:26 PM
 */

namespace App\Http\Utils\Traits;


use App\Http\Utils\Misc\CustomPDF;

trait GenerateReceipt
{

    /**
     * @param $intro
     * @param $deets
     * @param $amount
     * @param $curr
     * @param $name
     * Generate Receipts
     */
    function generateReceipt($intro, $deets, $amount, $curr, $name) {

        $pdf = new CustomPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Helvetica','',15);
        $pdf->Cell(190,10,$intro,0,0,'C');
        $pdf->Ln(20);
        $pdf->SetFont('Helvetica','',12);

        for ($i = 0; $i < count($deets); $i++) {
            $row = $deets[$i];
            $deet = $row[0];
            $value = $row[1];
            $pdf->Ln(10);
            $pdf->Cell(65,10,$deet,1,0,'C');
            $pdf->Cell(125,10,$value,1,0,'C');
        }

        $pdf->Ln(15);
        $pdf->SetFont('Helvetica','B',15);
        $pdf->Cell(65,10,'Total',1,0,'C');
        $pdf->Cell(125,10,$curr.' '.$amount,1,0,'C');

        $pdf->Ln(30);
        $pdf->SetFont('Helvetica','',10);
        $pdf->Cell(190,10,'Thank You For Your Business!',0,0,'C');
        $pdf->Ln(10);
        $pdf->Cell(190,10,'support@fint.ng',0,0,'C');
        $pdf->Output('F', __DIR__.'/../views/pdfs/'.$name);

    }
}