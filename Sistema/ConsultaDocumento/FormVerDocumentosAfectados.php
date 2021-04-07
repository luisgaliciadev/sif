<?php 
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
    $SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
    $ID_LOCALIDAD=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_LOCALIDAD'];	
	$ID_DOCUMENTO = $_GET["ID"];

?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
    	<form id="vForm">
            <div class="row">
                <div class="form-group col-md-12" >
                    <label>Ver Documentos</label>
                       <div class="col-lg-12">
                      <table class="table">
                      
                        <thead>
                        	 <td>Nro.
                        	  </td>
                        	  <td>Tipo Documento
                        	  </td>
                        	  <td>Moneda
                        	  </td>
                        	  <td>Nro. Documento
                        	  </td>
                        	  <td>Nro. Control
                        	  </td>
                        	   <td>F. Emisi&oacute;n
                        	  </td>
                        	   <td>F. Anulaci&oacute;n
                        	  </td>
                        	   <td>Valor Cambio.
                        	  </td>
                        	  <td>Sub Total
                        	  </td>
                        	  <td>Monto Gravado
                        	  </td>
                        	  <td>Monto No Gravado
                        	  </td>
                        	  <td>Monto Iva
                        	  </td>
                        	  <td>Porc Iva
                        	  </td>
                        	  <td>Total
                        	  </td>
                        	  <td>Estado
                        	  </td>
                        	  <td>Usuario
                        	  </td>
                        </thead>
                        <tbody>
                       
                                  
                    <?php 
                        $vSQL="exec dbo.[SP_CONSULTA_DOCUMENTOS_AFECTADOS] '$ID_DOCUMENTO'";
                        $ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
                        
                        $CONEXION=$ResultadoEjecutar["CONEXION"];						
                        $ERROR=$ResultadoEjecutar["ERROR"];
                        $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
                        $result=$ResultadoEjecutar["RESULTADO"];
                    	$ite=0;
                        if($CONEXION=="SI" and $ERROR=="NO")
                        {		
                            while ($registro=odbc_fetch_array($result))
                            {   
                              $ite=$ite+1;
								$tabla=' 
                            <tr>
                            <td>
                                <div>
                               '.$ite.'
                                </div>
                            </td>
										<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'NB_DOCUMENTO')).'
                                </div>
                            </td>
							
							
							<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'NB_MONEDA')).'
                                </div>
                            </td>
							
							<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'NRO_DOCUMENTO')).'
                                </div>
                            </td>
							<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'NRO_CONTROL')).'
                                </div>
                            </td>
							<td>
                                <div>
                               '.FechaNormal(odbc_result($result,'F_EMISION')).'
                                </div>
                            </td>
							<td>
                                <div>
                               '.FechaNormal(odbc_result($result,'F_ANULACION')).'
                                </div>
                            </td>
							<td>
                                <div>
                               '.number_format((odbc_result($result,'VALOR_CAMBIO')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                                <div>
                               '.number_format((odbc_result($result,'SUB_TOTAL')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                                <div>
                               '.number_format((odbc_result($result,'MTO_GRAVADO')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                                <div>
                               '.number_format((odbc_result($result,'MTO_NOGRAVADO')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                                <div>
                               '.number_format((odbc_result($result,'MTO_IVA')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                                <div>
                               '.number_format((odbc_result($result,'PORC_IVA')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                                <div>
                               '.number_format((odbc_result($result,'MTO_TOTAL')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'DS_ESTATUS')).'
                                </div>
                            </td>
							<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'USUARIO_GENERA')).'
                                </div>
                            </td>
							
                              </tr>';
                           }
                        }
                    echo $tabla;
                    ?>
                 </tbody>
                </table>
               </div>
            </div>
          </div>   
        </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    
                </div>
        
<script>
    $(document).ready(function(e) 
    {				
        window.parent.Cargando(0);
        
		
        
    });
	
	
        </script>
    </body>
</html>