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
                    <label>Conceptos por Documento</label>
                       <div class="col-lg-12">
                      <table class="table">
                      
                        <thead>
                        	 <td>Nro.
                        	  </td>
                        	   
                        	   <td>Codigo
                        	  </td>
                        	  <td>Descripci&oacute;n
                        	  </td>
                        	  <td>Base Calculo
                        	  </td>
                        	  <td>Valor
                        	  </td>
                        	   <td>Tasa / Tarifa
                        	  </td>
                        	   <td>% Descuento
                        	  </td>
                        	   <td>Monto Item
                        	  </td>
                        	  <td>Monto Desc
                        	  </td>
                        	  <td>Monto Iva
                        	  </td>
                        	  <td>Total
                        	  </td>
                        	  <td>Monto Cambio
                        	  </td>
                        	  <td>Total Cambio
                        	  </td>
                        </thead>
                        <tbody>
                       
                                  
                    <?php 
                        $vSQL="exec dbo.[SP_CONSULTA_DETALLE_DOCUMENTO] '$ID_DOCUMENTO'";
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
                               '.utf8_encode(odbc_result($result,'COD_TARIFA')).'
                                </div>
                            </td>
							
							<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'DS_TARIFA')).'
                                </div>
                            </td>
							<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'BASE_CALCULO')).'
                                </div>
                            </td>
							<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'VALOR_CALCULO')).'
                                </div>
                            </td>
							<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'TASA_TARIFA')).'
                                </div>
                            </td>
							<td>
                                <div>
                               '.number_format((odbc_result($result,'PORC_DESC')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                                <div>
                               '.number_format((odbc_result($result,'MTO_ITEM')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                                <div>
                               '.number_format((odbc_result($result,'MTO_DESC')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                                 <div>
                               '.number_format((odbc_result($result,'MTO_IVA_ITEM')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                                 <div>
                               '.number_format((odbc_result($result,'TOTAL_ITEM')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                               <div>
                               '.number_format((odbc_result($result,'MTO_ITEM_BASE')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                                <div>
                               '.number_format((odbc_result($result,'TOTAL_ITEM_BASE')), 2, ",", ".").'
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