# dompdf-invoice-example
Example implementation of basic PDF invoice generation from HTML template using PHP &amp; DOMPDF

## prerequisites 
This example implementation uses composer to manage libraries / vendor libraries needed such as DOMPDF itself.
Other dependencies are not needed. Support files are:
* template.html - the html based template to be used in converting to a (downloadable) PDF document
* pdfgen.php - a php file containing needed entries for the template and the code to generate the stream or PDF attachment

## templating engine   
Just kidding - there is no templating engine. Template ' fields' cam ne recogised by the double-square-bracket notation. Example below, feel free to select another notation if it suits your needs better:
```
Hello, [[FirstName]]!
```

## download or stream?
PDFs can be generated in two main ways by DOMPDF. Always look at the official DOMPDF documentation if you want to learn more, but basically:
1. Output the PDF directly to stream --> like open in browser
2. Output the PDF to string --> like to add as email attachment

Two examples are programmed, see the code examples below:
```
//Code to generate stream in browser
$dompdf->stream("Invoice-NUMBER.pdf", array("Attachment" => false));

//Code to generate output string
$dompdf->output()
```