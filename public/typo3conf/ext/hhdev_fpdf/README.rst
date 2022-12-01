Extension manual hhdev_fpdf
=================================

A regular manual will follow.
The following example should only show how to start. 

"Minimal example" example from FPDF.org
-----------

.. code-block:: php

	/** @var \HeikoHardt\HhdevFpdf\Fpdf $pdf */
	$pdf = new \HeikoHardt\HhdevFpdf\Fpdf();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(40,10,'Hello World!');
	$pdf->Output();

