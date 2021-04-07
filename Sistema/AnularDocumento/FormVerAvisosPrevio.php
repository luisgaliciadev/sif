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
                   
                       <div class="col-lg-12">
                      <table class="table">
                      
                        <thead>
                        	 <td>Nro.
                        	  </td>
                        	   
                        	  <td>Tipo de Aviso
                        	  </td>
                        	  <td>Moneda
                        	  </td>
                        	  <td>Cliente
                        	  </td>
                        	  <td>Nombre Cliente
                        	  </td>
                        	   <td>Localidad
                        	  </td>
                        	  <td>Monto
                        	  </td>
                        	 
                        </thead>
                        <tbody>
                       
                                  
                    <?php 
                        $vSQL="SELECT * FROM [dbo].[FN_AVISOS_POR_FACTURA] (
   '$ID_DOCUMENTO')";
                        $tabla='';
						$mensaje='Movimientos de Pago no asociados';
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
                              	$mensaje='';
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
								   '.utf8_encode(odbc_result($result,'NB_MONEDA')).'
									</div>
								</td>
								<td>
									<div>
								   '.utf8_encode(odbc_result($result,'RIF_CLIENTE')).'
									</div>
								</td>
								<td>
									<div>
								   '.utf8_encode(odbc_result($result,'NB_CLIENTE')).'
									</div>
								</td>
								<td>
									<div>
								   '.utf8_encode(odbc_result($result,'NB_LOCALIDAD')).'
									</div>
								</td>
								<td>
									<div>
								   '.number_format((odbc_result($result,'SUM_MONTO')), 2, ",", ".").'
									</div>
								</td>

							</tr>';
                           }
                        }
                    echo $tabla;
                    ?>
                 </tbody>
                  <label><?php echo $mensaje;?></label>
                </table>
               </div>
                <div class=" form-group col-md-12" id="div_referencia">
                    <label>Motivo:</label>
                    <input id="motivo" type="text" class="form-control" required>
                </div>
            </div>
          </div>   
        </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrar_anula">Cancelar</button>
                    <button type="button" class="btn btn-warning" id="btn-anular" onClick="anular_factura();">Anular Factura</button>  
                </div>
        
<script>
    $(document).ready(function(e) 
    {				
        window.parent.Cargando(0);
        
		
        
    });
	
	
        </script>
    </body>
</html>