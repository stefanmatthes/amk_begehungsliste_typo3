Extension manual hhdev_fpdi
=================================

A regular manual will follow.
The following example should only show how to start.

"Simple Introduction Demo of FPDI" example from setasign.com
-----------

The file "PdfDocument.pdf" needs to be present at the document root.

.. code-block:: php

	// initiate FPDI
	/** @var \HeikoHardt\HhdevFpdi\Fpdi $pdf */
	$pdf = new \HeikoHardt\HhdevFpdi\Fpdi();
	// add a page
	$pdf->AddPage();
	// set the source file
	$pdf->setSourceFile("PdfDocument.pdf");
	// import page 1
	$tplIdx = $pdf->importPage(1);
	// use the imported page and place it at point 10,10 with a width of 100 mm
	$pdf->useTemplate($tplIdx, 10, 10, 100);

	// now write some text above the imported page
	$pdf->SetFont('Helvetica');
	$pdf->SetTextColor(255, 0, 0);
	$pdf->SetXY(30, 30);
	$pdf->Write(0, 'This is just a simple text');

	$pdf->Output();
