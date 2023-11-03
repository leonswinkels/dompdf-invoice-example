<?php

//PDF renderer
use Dompdf\Dompdf;
use Dompdf\Options;

require __DIR__ . '/vendor/autoload.php';

$PREFIX = '';
require_once($PREFIX . 'shared/utils.php');

/**
 * Summary of PDFFromTemplate
 * @param mixed $template
 * @param mixed $replace
 * @return void
 */

function PDFStringFromTemplate($template, $replace): string
{

	$options = new Options();
	$options->set('isRemoteEnabled', true);
	$options->set('isHtml5ParserEnabled', true);
	$dompdf = new Dompdf($options);

	//Change template to file by replacing vars
	$file = file_get_contents($template);
	foreach ($replace as $k => $v) {
		$file = str_replace('[[' . $k . ']]', $v, $file);
	}

	//Initialize DOMPDF with the $file string
	$dompdf->loadHtml($file);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'portrait');

	// Render the HTML as PDF
	$dompdf->render();

	// Do NOT perform if you want to output to string for attachment or such
	//$dompdf->stream("Invoice-NUMBER.pdf", array("Attachment" => false));
	return $dompdf->output();
}

// instantiate and use the dompdf class

//Replace the $replaceMe with data from your process or database
$replaceMe = [
	'FirstName' => 'Jan',
	'LastName' => 'KorteAchternaam',
	'Company' => 'Bedrijfsnaam',
	'Address' => 'Straat 2',
	'City' => 'DorpOfStad',
	'PostalCode' => '1234 AB',
	'PaymentDate' => '4-oct-2023',
	'PackageName' => 'Package Name',
	'Amount' => '100,00',
	'VATPerc' => '21',
	'VATAmount' => '21,00',
	'Total' => '121,00',
    'Currency' => 'EUR',
	'Description' => 'A one hundred euro package',
	'Qty' => '1'
];

$invoicePDFString = PDFStringFromTemplate('invoice.html', $replaceMe);

	//Exmaple for PHPMailer -- add string to email as attachment:
	//$mail->addStringAttachment($invoicePDFString, 'invoice.pdf'); //Optional name

?>