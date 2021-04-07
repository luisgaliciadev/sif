<?php 
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
    $SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
    $ID_LOCALIDAD=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_LOCALIDAD'];	
	$id_moneda = $_GET["id_moneda"];
	ValidarSesion($Nivel);
	if (isset($_GET["ID"])){
        $id_documento = $_GET["ID"];
        $id_moneda = $_GET["ID_MONEDA"];
    }else{
        $id_documento ="";
        $id_moneda = $_GET["id_moneda"];
    }

	$Nivel="";
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
    	<form id="vForm">
            <div class="row">
                <input id="documento" type="hidden" class="form-control" required value=<?php echo $id_documento; ?>>
                <input id="id_moneda" type="hidden" class="form-control" required value=<?php echo $id_moneda; ?>>
                
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

                <div class=" form-group col-md-6" >
                    <label>Monto a Retener</label>
                    <input id="mto_reten" type="text" class="form-control" required maxlength="20" onkeypress="return NumCheck(event, this)">
                </div>
                <?php 
                if ($id_documento != ''){ ?>
                    <div class=" form-group col-md-6" >
                        <label>Fecha de afectacion</label>
                        <input id="fecha" type="date" class="form-control" required maxlength="20" >
                    </div>
                <?php } ?>
                
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
            $('#mto_reten').val('')
            if (tp_reten == ''){
                
            }else{
                if(tp_reten == 'D33AEF74-A4F3-4851-B979-34280B836036'){
                    if ($('#documento').val() == ''){
                        $('#base_retencion').val($('#base_imponible').html())
                    }else{

                        $('#base_retencion').val($('#gravado').val())
                    }
                }  else{   
                    if ($('#documento').val() == ''){
                        $('#base_retencion').val(totales[0].monto_iva)
                    }else{
                        $('#base_retencion').val($('#iva').val())
                    }                 
                   
                }                                  
                consultar_porce(tp_reten)
            }          

        });

        $('#porc').change(function() {
            base_reten = retornar_num_mask($('#base_retencion').val())
            porcent = $('#porc').val().split("%%")
            monto = (base_reten * (porcent[1] / 100)).toFixed(2)
            aux_monto = monto.toString().split(".")
            if (aux_monto.length  == 1){
                monto = monto +"00"
            }
            
            $('#mto_reten').val(monto)
        });

        $('#guardar_reten').click(function() {
            if ($('#documento').val() == ''){
                var saldo_rest = parseFloat($('#saldoss').html())
            }else{
                var saldo_rest = $('#saldoss').html().replace(/\./g, '');
                saldo_rest = saldo_rest.replace(',', '.');
                saldo_rest = parseFloat(saldo_rest)
            }
            var base_reten = retornar_num_mask($('#base_retencion').val())
            base_reten = parseFloat(base_reten)
            if($('#mto_reten').val() == ''){
                MostrarMensaje("Rojo", "Disculpe, debe ingresar un monto a retener valido, intente nuevamente");
                return false
            }

            var monto_retenido = retornar_num_mask($('#mto_reten').val())
            monto_retenido = parseFloat(monto_retenido)
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
            base_reten = parseFloat(base_reten)
            if(base_reten  == 0 ){
                MostrarMensaje("Rojo", "Disculpe, la base de retencion debe ser mayor a 0, intente nuevamente");
                return false
            }

            if(base_reten >  saldo_rest ){
                MostrarMensaje("Rojo", "Disculpe, la base de retencion no debe ser mayor al saldo actual de la factura");
                return false
            }

            
            if(monto_retenido > base_reten){
                MostrarMensaje("Rojo", "Disculpe, el monto retenido no puede ser mayor a la base de calculo");
                return false
            }

            porcent = $('#porc').val().split("%%")
            var comprobante = $('#comprobante').val();
            
            if ($('#documento').val() == ''){
                Parametros = "porcen="+porcent[0]+"&comprobante="+comprobante+"&monto_retenido="+monto_retenido+"&base_reten="+base_reten+"&id_preliquidacion=" + totales[0].id_preliquidacion+"&id_moneda=" + totales[0].id_moneda
            }else{
                documento = $('#documento').val()
                id_moneda = $('#id_moneda').val()
                if ($('#fecha').val() == ''){
                    
                    MostrarMensaje("Rojo", "Disculpe, debe ingresar una fecha");
                    return false
                }else{
                    fecha = $('#fecha').val()
                    Parametros = "porcen="+porcent[0]+"&comprobante="+comprobante+"&monto_retenido="+monto_retenido+"&base_reten="+base_reten+"&documento=" + documento+"&id_moneda=" + id_moneda+"&fecha="+fecha
           
                }
                
            }
                guardar_retenciones(Parametros)
        });
        
    });
        </script>
    </body>
</html>