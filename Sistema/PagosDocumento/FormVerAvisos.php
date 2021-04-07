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
                    <label>Avisos de Credito por Documento</label>
                       <div class="col-lg-12">
                      <table class="table">
                      
                        <thead>
                        	 <td>Nro.
                        	  </td>
                        	   
                        	   <td>Nro. Aviso
                        	  </td>
                        	  <td>Moneda
                        	  </td>
                        	  <td>Tipo de Aviso
                        	  </td>
                        	  <td>F. Emisi&oacute;n
                        	  </td>
                        	   <td>Monto Aviso
                        	  </td>
                        	  <td>Monto Cambio
                        	  </td>
                        	  <td>Saldo
                        	  </td>
                        	  <td>Saldo Cambio
                        	  </td>
                        	  <td>Estado
                        	   </td>
                        	  <td>Usuario
                        	  </td>
                        	  <td>Consultar Detalle
                        	  </td>
                        </thead>
                        <tbody>
                       
                                  
                    <?php 
                         $vSQL="exec dbo.[SP_CONSULTA_AVISOS_POR_DOCUMENTO] '$ID_DOCUMENTO'";
                        $tabla='';
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
                              
								$ID_DOCUMENTO_PAGO=odbc_result($result,'ID_MOVIMIENTO_PAGO');
								
								$ite=$ite+1;
							$tabla.=' 
                            <tr>
                            <td>
                                <div>
                               '.$ite.'
                                </div>
                            </td>
										<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'NRO_AVISO')).'
                                </div>
                            </td>
							
							<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'MONEDA_AVISO')).'
                                </div>
                            </td>
							<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'TIPO_MOVIMIENTO')).'
                                </div>
                            </td>
							<td>
                                <div>
                               '.FechaNormal(odbc_result($result,'F_EMISION')).'
                                </div>
                            </td>
							<td>
                                <div>
                               '.number_format((odbc_result($result,'MONTO')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                                <div>
                               '.number_format((odbc_result($result,'MONTO_BASE')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                                <div>
                               '.number_format((odbc_result($result,'SALDO')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                                <div>
                               '.number_format((odbc_result($result,'SALDO_BASE')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'DS_ESTATU_MOVIMIENTO')).'
                                </div>
                            </td>
							<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'NB_USER')).'
                                </div>
                            </td>
							<td>
                              	 <button class="btn btn-warning" type="button"  onclick="consultar_aviso(\''.$ID_DOCUMENTO_PAGO.'\');">Ver
									</button>
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