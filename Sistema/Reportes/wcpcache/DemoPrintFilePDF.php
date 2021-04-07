<?php 
  ob_start();
  session_start();
  
  include 'WebClientPrint.php';
  use Neodynamic\SDK\Web\WebClientPrint;
  use Neodynamic\SDK\Web\Utils;

  $title = 'WebClientPrint 4.0 for PHP - Advanced PDF Printing';
  
  $style = '.glyphicon-refresh-animate {
            -animation: spin .7s infinite linear;
            -webkit-animation: spin2 .7s infinite linear;
        }

        @-webkit-keyframes spin2 {
            from {
                -webkit-transform: rotate(0deg);
            }

            to {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            from {
                transform: scale(1) rotate(0deg);
            }

            to {
                transform: scale(1) rotate(360deg);
            }
        }';
  
?>

<input type="hidden" id="sid" name="sid" value="<?php echo session_id(); ?>" />

<div class="container">
      <div class="row">

            <div class="col-md-12">
                <h3>Advanced PDF Printing</h3>
                <p>
                    With <strong>WebClientPrint for PHP</strong> solution you can <strong>print PDF files</strong> right to any installed printer at the client side with advanced settings.
                </p>

                <div class="form-group well">
                    <h4>Click on <strong>"Get Printers Info"</strong> button to get Printers Name, Supported Papers and Trays</h4>
                    <div class="row">

                        <div class="col-md-3">
                            <a onclick="javascript:jsWebClientPrint.getPrintersInfo(); $('#spinner').css('visibility', 'visible');" class="btn btn-success">Get Printers Info...</a>
                        </div>
                        <div class="col-md-9">
                            <h3 id="spinner" style="visibility: hidden"><span class="label label-info"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>Please wait a few seconds...</span></h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="lstPrinters">Printers:</label>
                            <select name="lstPrinters" id="lstPrinters" onchange="showSelectedPrinterInfo();" class="form-control"></select>
                        </div>
                        <div class="col-md-3">
                            <label for="lstPrinterTrays">Supported Trays:</label>
                            <select name="lstPrinterTrays" id="lstPrinterTrays" class="form-control"></select>
                        </div>
                        <div class="col-md-3">
                            <label for="lstPrinterPapers">Supported Papers:</label>
                            <select name="lstPrinterPapers" id="lstPrinterPapers" class="form-control"></select>
                        </div>
                        <div class="col-md-3">
                            <label for="lstPrintRotation">Print Rotation (Clockwise):</label>
                            <select name="lstPrintRotation" id="lstPrintRotation" class="form-control">
                                <option>None</option>
                                <option>Rot90</option>
                                <option>Rot180</option>
                                <option>Rot270</option>
                            </select>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-3">
                            <label for="txtPagesRange">Pages Range: [e.g. 1,2,3,10-15]</label>
                            <input type="text" class="form-control" id="txtPagesRange">
                        </div>
                        <div class="col-md-3">
                             <div class="checkbox">
                              <label><input id="chkPrintInReverseOrder" type="checkbox" value="">Print In Reverse Order?</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="checkbox">
                              <label><input id="chkPrintAnnotations" type="checkbox" value="">Print Annotations? <span class="label label-info">Windows Only</span></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="checkbox">
                              <label><input id="chkPrintAsGrayscale" type="checkbox" value="">Print As Grayscale? <span class="label label-info">Windows Only</span></label>
                            </div>
                        </div>
                        
                    </div>
                    <hr />
                    <div class="row">
                        
                        <div class="col-md-12">
                             <a class="btn btn-success btn-lg pull-right" onclick="javascript:jsWebClientPrint.print('printerName=' + encodeURIComponent($('#lstPrinters').val()) + '&trayName=' + encodeURIComponent($('#lstPrinterTrays').val()) + '&paperName=' + encodeURIComponent($('#lstPrinterPapers').val()) + '&printRotation=' + $('#lstPrintRotation').val() + '&pagesRange=' + encodeURIComponent($('#txtPagesRange').val()) + '&printAnnotations=' + $('#chkPrintAnnotations').prop('checked') + '&printAsGrayscale=' + $('#chkPrintAsGrayscale').prop('checked') + '&printInReverseOrder=' + $('#chkPrintInReverseOrder').prop('checked'));"><strong>Print PDF...</strong></a>
                        </div>
                    </div>
                    <hr />
                    <h4>PDF File Sample Preview - <strong>15 Pages</strong></h4>
                    <iframe id="ifPreview" style="width: 100%; height: 500px;" frameborder="0" src="//docs.google.com/gview?url=http://webclientprint.azurewebsites.net/files/GuidingPrinciplesBusinessHR_EN.pdf&embedded=true"></iframe>

                </div>

            </div>


        </div>

</div>

    <script type="text/javascript">

        var clientPrinters = null;

        var wcppGetPrintersTimeout_ms = 10000; //10 sec
        var wcppGetPrintersTimeoutStep_ms = 500; //0.5 sec
        function wcpGetPrintersOnSuccess() {
            $('#spinner').css('visibility', 'hidden');
            // Display client installed printers
            if (arguments[0].length > 0) {
                if (JSON) {
                    try {
                        clientPrinters = JSON.parse(arguments[0]);
                        if (clientPrinters.error) {
                            alert(clientPrinters.error)
                        } else {
                            var options = '';
                            for (var i = 0; i < clientPrinters.length; i++) {
                                options += '<option>' + clientPrinters[i].name + '</option>';
                            }
                            $('#lstPrinters').html(options);
                            $('#lstPrinters').focus();

                            showSelectedPrinterInfo();
                        }
                    } catch (e) {
                        alert(e.message)
                    }
                }


            } else {
                alert("No printers are installed in your system.");
            }
        }
        function wcpGetPrintersOnFailure() {
            $('#spinner').css('visibility', 'hidden');
            // Do something if printers cannot be got from the client
            alert("No printers are installed in your system.");
        }


        function showSelectedPrinterInfo() {
            // get selected printer index
            var idx = $("#lstPrinters")[0].selectedIndex;
            // get supported trays
            var options = '';
            for (var i = 0; i < clientPrinters[idx].trays.length; i++) {
                options += '<option>' + clientPrinters[idx].trays[i] + '</option>';
            }
            $('#lstPrinterTrays').html(options);
            // get supported papers
            options = '';
            for (var i = 0; i < clientPrinters[idx].papers.length; i++) {
                options += '<option>' + clientPrinters[idx].papers[i] + '</option>';
            }
            $('#lstPrinterPapers').html(options);
        }

    </script>

    
<?php
  $content = ob_get_contents();
  ob_clean();
?>    


<?php
  
    //Get Absolute URL of this page
    $currentAbsoluteURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
    $currentAbsoluteURL .= $_SERVER["SERVER_NAME"];
    if($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443")
    {
        $currentAbsoluteURL .= ":".$_SERVER["SERVER_PORT"];
    } 
    $currentAbsoluteURL .= $_SERVER["REQUEST_URI"];
    
    //WebClientPrinController.php is at the same page level as WebClientPrint.php
    $webClientPrintControllerAbsoluteURL = substr($currentAbsoluteURL, 0, strrpos($currentAbsoluteURL, '/')).'/WebClientPrintController.php';
    
    //DemoPrintFilePDFProcess.php is at the same page level as WebClientPrint.php
    $demoPrintFilePDFProcessAbsoluteURL = substr($currentAbsoluteURL, 0, strrpos($currentAbsoluteURL, '/')).'/DemoPrintFilePDFProcess.php';
    
    //Specify the ABSOLUTE URL to the WebClientPrintController.php and to the file that will create the ClientPrintJob object
    echo WebClientPrint::createScript($webClientPrintControllerAbsoluteURL, $demoPrintFilePDFProcessAbsoluteURL, session_id());
?>

<script type="text/javascript">
    $("#ddlFileType").change(function () {
        var s = $("#ddlFileType option:selected").text();
        if (s == 'PDF') $("#ifPreview").attr("src", "//docs.google.com/gview?url=http://webclientprintphp.azurewebsites.net/files/LoremIpsum.pdf&embedded=true");
        if (s == 'TXT') $("#ifPreview").attr("src", "//docs.google.com/gview?url=http://webclientprintphp.azurewebsites.net/files/LoremIpsum.txt&embedded=true");
        if (s == 'TIF') $("#ifPreview").attr("src", "//docs.google.com/gview?url=http://webclientprintphp.azurewebsites.net/files/patent2pages.tif&embedded=true");
        if (s == 'XLS') $("#ifPreview").attr("src", "//docs.google.com/gview?url=http://webclientprintphp.azurewebsites.net/files/SampleSheet.xls&embedded=true");
        if (s == 'DOC') $("#ifPreview").attr("src", "//docs.google.com/gview?url=http://webclientprintphp.azurewebsites.net/files/LoremIpsum.doc&embedded=true");
        if (s == 'JPG') $("#ifPreview").attr("src", "//webclientprintphp.azurewebsites.net/files/penguins300dpi.jpg");
        if (s == 'PNG') $("#ifPreview").attr("src", "//webclientprintphp.azurewebsites.net/files/SamplePngImage.png");
    }).change();
</script>

<?php
  $script = ob_get_contents();
  ob_clean();
  
  
  include("template.php");
?>