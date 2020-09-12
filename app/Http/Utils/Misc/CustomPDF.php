<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16-Apr-18
 * Time: 02:35 PM
 */

namespace App\Http\Utils\Misc;

class CustomPDF extends \FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image(__DIR__ . '/../../../../public/img/fint_logo.png',7,5,17);
        // Arial bold 15
        $this->SetFont('Helvetica','',20);
        // Move to the right
        $this->Cell(30);
        // Title
        $this->Cell(30,10,'FINT Receipt');
        // Line break
        $this->Ln(50);
    }

// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}