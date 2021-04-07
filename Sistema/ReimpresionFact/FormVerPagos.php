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
                    <label>Pagos Asociados Por Documento</label>
                       <div class="col-lg-12">
                      <table class="table">
                      
                        <thead>
                        	 <td>Nro.
                        	  </td>
                        	   
                        	   <td>Tipo Documento
                        	  </td>
                        	  <td>Banco
                        	  </td>
                        	  <td>Cuenta
                        	  </td>
                        	  <td>Moneda
                        	  </td>
                        	   <td>Referencia
                        	  </td>
                        	   <td>F. Emisi&oacute;n
                        	  </td>
                        	   <td>Monto Mov.
                        	  </td>
                        	  <td>Monto Usado
                        	  </td>
                        	  <td>Status
                        	  </td>
                        	  <td>Retencion
                        	  </td>
                        	  <td>Saldo
                        	  </td>
                        	  <td>Estado
                        	  </td>
                        </thead>
                        <tbody>
                       
                                  
                    <?php 
                        $vSQL="exec dbo.[SP_CONSULTA_PAGOS_POR_DOCUMENTO] '$ID_DOCUMENTO'";
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
								$tabla.=' 
                            <tr>
                            <td>
                                <div>
                               '.$ite.'
                                </div>
                            </td>
										<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'NB_TP_MOVIMIENTO')).'
                                </div>
                            </td>
							
							<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'NB_BANCO')).'
                                </div>
                            </td>
							<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'NRO_CUENTA')).'
                                </div>
                            </td>
							<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'NB_MONEDA')).'
                                </div>
                            </td>
							<td>
                                <div>
                               '.utf8_encode(odbc_result($result,'REFERENCIA')).'
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
                               '.number_format((odbc_result($result,'MONTO_APLICADO')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                                <div>
                               '.odbc_result($result,'STATU').'
                                </div>
                            </td>
							<td>
                                <div>
                               '.odbc_result($result,'RETENCION').'
                                </div>
                            </td>
							<td>
                                <div>
                               '.number_format((odbc_result($result,'SALDO')), 2, ",", ".").'
                                </div>
                            </td>
							<td>
                                <div>
                               '.odbc_result($result,'DS_ESTATU_MOVIMIENTO').'
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
                    <button type="button" class="btn btn-warning" id="descargar" onClick="descargar();">Descargar Excel</button>
                </div>
        
<script>
    $(document).ready(function(e) 
    {				
        window.parent.Cargando(0);
        
		
        
    });
	
	
        </script>
    </body>
</html>