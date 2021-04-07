<?php 
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
    $SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
    $ID_LOCALIDAD=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_LOCALIDAD'];	
	$id_moneda = $_GET["id_moneda"];
	ValidarSesion($Nivel);
	
	$Nivel="";
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
    	<form id="vForm">
            <div class="row">
                <div class="form-group col-md-6" >
                    <label>Tipo de retencion</label>
                    <select class="form-control" id="tp_reten" name="TIPO DE RETENCION" required>
                    <option value="">Selecione...</option>   
                    <?php 
                        $vSQL="exec dbo.[SP_TP_RETENCION_LISTADO]";
                        $ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
                        
                        $CONEXION=$ResultadoEjecutar["CONEXION"];						
                        $ERROR=$ResultadoEjecutar["ERROR"];
                        $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
                        $result=$ResultadoEjecutar["RESULTADO"];
                    
                        if($CONEXION=="SI" and $ERROR=="NO")
                        {		
                            while ($registro=odbc_fetch_array($result))
                            {   
                                $ID=odbc_result($result,'ID');
                                $NB=odbc_result($result,'NB');
                                echo "<option value=".$ID.">$NB</option>";
                                
                            }
                        }
                    
                    ?>
                    </select>             
                    </select>
                </div>

                <div class="form-group col-md-6" >
                    <label>Porcentaje</label>
                    <select class="form-control" id="porc" name="PORCENTAJE" required>
                    <option value="">Selecione...</option>                    
                    </select>
                </div> 

                 

                <div class=" form-group col-md-6" >
                    <label>Nro. Comprobante</label>
                    <input id="comprobante" type="text" class="form-control" required>
                </div>

                <div class=" form-group col-md-6" >
                    <label>Base Retenci&oacute;n</label>
                    <input id="base_retencion" type="text" class="form-control" required>
                </div>

                <div class=" form-group col-md-6" id="div_fecha">
                    <label>Monto a Retener</label>
                    <input id="mto_reten" type="text" class="form-control" required maxlength="20" onkeypress="return NumCheck(event, this)">
                </div>
                
            </div>   
        </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="guardar_reten">Guardar</button>
                </div>
        
<script>
    $(document).ready(function(e) 
    {				
        window.parent.Cargando(0);
        $('#mto_reten').inputmask('999.999.999,99', { numericInput: true });  
        $('#base_retencion').inputmask('999.999.999,99', { numericInput: true });  

        $('#tp_reten').change(function() {
            
            tp_reten = $('#tp_reten').val();
            if (tp_reten == ''){
                
            }else{
                                                    
                consultar_porce(tp_reten)
            }          

        });

        $('#guardar_reten').click(function() {
            var saldo_rest = parseFloat($('#saldoss').html())
            var base_reten = retornar_num_mask($('#base_retencion').val())

            if($('#mto_reten').val() == ''){
                MostrarMensaje("Rojo", "Disculpe, debe ingresar un monto a retner valido, intente nuevamente");
                return false
            }

            var monto_retenido = retornar_num_mask($('#mto_reten').val())

            if(monto_retenido  == 0 ){
                MostrarMensaje("Rojo", "Disculpe, el monto retenido debe ser mayor a 0, intente nuevamente");
                return false
            }

            if(monto_retenido  >  saldo_rest ){
                MostrarMensaje("Rojo", "Disculpe, el monto retenido no debe ser mayor al saldo actual de la factura");
                return false
            }

            if($('#base_retencion').val() == '' ){
                MostrarMensaje("Rojo", "Disculpe, debe ingresar una base de retencion valida, intente nuevamente");
                return false
            }

            var base_reten = retornar_num_mask($('#base_retencion').val())

            if(base_reten  == 0 ){
                MostrarMensaje("Rojo", "Disculpe, la base de retencion debe ser mayor a 0, intente nuevamente");
                return false
            }

            if(base_reten >  saldo_rest ){
                MostrarMensaje("Rojo", "Disculpe, la base de retencion no debe ser mayor al saldo actual de la factura");
                return false
            }

            if(monto_retenido >  base_reten){
                MostrarMensaje("Rojo", "Disculpe, la base de retencion no debe ser mayor al saldo actual de la factura");
                return false
            }

            var porcen = $('#porc').val();
            var comprobante = $('#comprobante').val();
            Parametros = "porcen="+porcen+"&comprobante="+comprobante+"&monto_retenido="+monto_retenido+"&base_reten="+base_reten+"&id_preliquidacion=" + totales[0].id_preliquidacion+"&id_moneda=" + totales[0].id_moneda
            guardar_retenciones(Parametros)
            console.log(monto_retenido)
            console.log(base_reten)
        });
        
    });
        </script>
    </body>
</html>