<?php
 
include 'WebClientPrint.php';
 
use Neodynamic\SDK\Web\WebClientPrint;
use Neodynamic\SDK\Web\DefaultPrinter;
use Neodynamic\SDK\Web\InstalledPrinter;
use Neodynamic\SDK\Web\ClientPrintJob;
 
// Process request
// Generate ClientPrintJob? only if clientPrint param is in the query string
$urlParts = parse_url($_SERVER['REQUEST_URI']);
 
if (isset($urlParts['query'])) {
    $rawQuery = $urlParts['query'];
    parse_str($rawQuery, $qs);
    if (isset($qs[WebClientPrint::CLIENT_PRINT_JOB])) {
 
        $useDefaultPrinter = ($qs['useDefaultPrinter'] === 'checked');
        $printerName = urldecode($qs['printerName']);
 
        //Create ESC/POS commands for sample receipt
        $esc = '0x1B'; //ESC byte in hex notation
        $newLine = '0x0A'; //LF byte in hex notation
         
        $cmds = '';
        $cmds = $esc . "@"; //Initializes the printer (ESC @)
        $cmds .= $esc . '!' . '0x38'; //Emphasized + Double-height + Double-width mode selected (ESC ! (8 + 16 + 32)) 56 dec => 38 hex
        $cmds .= 'BEST DEAL STORES'; //text to print
        $cmds .= $newLine . $newLine;
        $cmds .= $esc . '!' . '0x00'; //Character font A selected (ESC ! 0)
        $cmds .= 'COOKIES                   5.00'; 
        $cmds .= $newLine;
        $cmds .= 'MILK 65 Fl oz             3.78';
        $cmds .= $newLine . $newLine;
        $cmds .= 'SUBTOTAL                  8.78';
        $cmds .= $newLine;
        $cmds .= 'TAX 5%                    0.44';
        $cmds .= $newLine;
        $cmds .= 'TOTAL                     9.22';
        $cmds .= $newLine;
        $cmds .= 'CASH TEND                10.00';
        $cmds .= $newLine;
        $cmds .= 'CASH DUE                  0.78';
        $cmds .= $newLine . $newLine;
        $cmds .= $esc . '!' . '0x18'; //Emphasized + Double-height mode selected (ESC ! (16 + 8)) 24 dec => 18 hex
        $cmds .= '# ITEMS SOLD 2';
        $cmds .= $esc . '!' . '0x00'; //Character font A selected (ESC ! 0)
        $cmds .= $newLine . $newLine;
        $cmds .= '11/03/13  19:53:17';
 
        //Create a ClientPrintJob obj that will be processed at the client side by the WCPP
        $cpj = new ClientPrintJob();
        //set ESCPOS commands to print...
        $cpj->printerCommands = $cmds;
        $cpj->formatHexValues = true;
         
        if ($useDefaultPrinter || $printerName === 'null') {
            $cpj->clientPrinter = new DefaultPrinter();
        } else {
            $cpj->clientPrinter = new InstalledPrinter($printerName);
        }
 
        //Send ClientPrintJob back to the client
        ob_start();
        ob_clean();
        header('Content-type: application/octet-stream');
        echo $cpj->sendToClient();
        ob_end_flush();
        exit();
         
    }
}