<?php
  ob_start();
  
  $title = 'WebClientPrint 3.0 for PHP Demo';
?>

<h2>Available Samples</h2>

<table class="table table-bordered">
    <tr>
        <td><a href="DemoPrintCommands.php" class="btn btn-large btn-info" >Print Raw Commands</a></td>
        <td>In this demo you'll be able to specify the printer commands you want to send to a client printer. You must specify the commands that the target printer can handle. Common printer commands are ESC/P, PCL, ZPL, EPL, DPL, IPL, EZPL, and so on.</td>
    </tr>
    <tr>
        <td><a href="DemoPrintFile.php" class="btn btn-large btn-info" >Print Files</a></td>
        <td>In this demo you'll be able to specify a file like PDF, TXT, MS Word DOC, MS Excel XLS, JPG & PNG images, multipage TIF; that you want to print to a client printer <strong>without displaying any Print dialog!</strong>.</td>
    </tr>
    <tr>
        <td><a href="DemoPrintFilePDF.php" class="btn btn-large btn-info" >Advanced PDF Printing</a></td>
        <td>This demo shows you how to print PDF files specifying advanced settings like tray, paper source, print rotation, pages range and more!</td>
    </tr>
    <tr>
        <td><a href="PrintersInfo.php" class="btn btn-large btn-info" >Printers Info</a></td>
        <td>This demo shows you how to get many useful info from all the installed printers in the client machine.</td>
    </tr>
</table>

<?php
  $content = ob_get_contents();
  ob_clean();
  
  include("template.php");
?>