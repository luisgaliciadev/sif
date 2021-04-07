<?php 
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
    $SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
    $ID_LOCALIDAD=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_LOCALIDAD'];	
	$id_moneda = $_GET["id_moneda"];
    ValidarSesion($Nivel);
   
    $id = $_GET["ID"];
    
	
	$Nivel="";
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
    	<form id="vForm">
            <div class="row">               
                <input id="id" type="hidden" class="form-control" value="<?php echo $id; ?>" disabled>
                <div class="form-group col-md-6" >
                    <label>Cod. Tarifa</label>
                    <input id="cod_tarifa" type="text" class="form-control" disabled>
                </div>

                <div class="form-group col-md-6" >
                    <label>Descripcion</label>
                    <textarea class="form-control" rows="3" id="descripcion" disabled></textarea>
                </div>

                <div class=" form-group col-md-6" >
                    <label>BASE CALCULO</label>
                    <input id="base_calculo" type="text" class="form-control" disabled>
                </div>

                <div class=" form-group col-md-6" id="div_cambio">
                    <label>VALOR CALCULO</label>
                    <input id="valor_calculo" type="text" class="form-control"  disabled>
                </div>

                <div class=" form-group col-md-6" id="div_mto_pagar">
                    <label >TASA / TARIFA</label>
                    <input id="tasa_tarifa" type="text" class="form-control"  disabled>
                </div>

                <div class=" form-group col-md-6" id="div_fecha">
                    <label>% DESC.</label>
                    <input id="porc_descuento" type="text" class="form-control" disabled>
                </div>

                <div class=" form-group col-md-6" id="div_monto">
                    <label>MONTO</label>
                    <input id="monto" type="text" class="form-control" disabled>
                </div>

                <div class=" form-group col-md-6" id="div_monto_usado">
                    <label>TOTAL</label>
                    <input id="total" type="text" class="form-control" disabled>
                </div>

                <div class=" form-group col-md-6" id="div_monto_equivalente">
                    <label>AJUSTE</label>
                    <input id="ajuste" type="text" class="form-control" required  maxlength="20"  >
                </div>

                <div class=" form-group col-md-6" id="div_transaccion">
                    <label>SALDO</label>
                    <input id="saldo" type="text" class="form-control" required  maxlength="20" disabled>
                </div>
                
            </div>   
        </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelar">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="guardar_ajuste">Guardar</button>
                </div>
        
<script>
    $(document).ready(function(e) 
    {				
        window.parent.Cargando(0);
        $('#saldo').inputmask('999.999.999.999,99', { numericInput: true });  
        $('#ajuste').inputmask('999.999.999.999,99', { numericInput: true }); 
        id_det = parseInt($('#id').val())    
        
        $('#cod_tarifa').val(detalles[id_det].cod_tarifa)
        $('#descripcion').val(detalles[id_det].ds_tarifa); 
        $('#base_calculo').val(detalles[id_det].base_calculo)
        $('#valor_calculo').val(detalles[id_det].valor_calculo); 
        $('#tasa_tarifa').val(detalles[id_det].tasa_tarifa)
        $('#porc_descuento').val(detalles[id_det].porc_desc); 

        $('#monto').val(detalles[id_det].mto_item)
        $('#total').val(detalles[id_det].total_item); 

        $('#saldo').val(detalles[id_det].saldo)
        $('#ajuste').val(detalles[id_det].afectado); 

        $('#ajuste').focusout(function() { 
           aux_ajuste =  retornar_num_mask($('#ajuste').val())
           aux_saldo =  retornar_num_mask($('#saldo').val())

           aux_ajuste = parseFloat(aux_ajuste);
           aux_saldo = parseFloat(aux_saldo);

           if (aux_ajuste > aux_saldo){
                MostrarMensaje("Rojo", "Disculpe, el monto a ajustar es mayor al saldo de la tarifa o tasa, intente nuevamente");
                return false
           }
        });

        $('#guardar_ajuste').click(function() { 
            aux_ajuste =  retornar_num_mask($('#ajuste').val())
           aux_saldo =  retornar_num_mask($('#saldo').val())

           aux_ajuste = parseFloat(aux_ajuste);
           aux_saldo = parseFloat(aux_saldo);

           if (aux_ajuste > aux_saldo){
                MostrarMensaje("Rojo", "Disculpe, el monto a ajustar es mayor al saldo de la tarifa o tasa, intente nuevamente");
                return false
           }
           var options = new JsNumberFormatter.formatNumberOptions();
           mto_ajuste = JsNumberFormatter.formatNumber(parseFloat(aux_ajuste), options, true)
            formato =  mto_ajuste.split(".")  
            if (formato.length < 2 ){
                aux_mto_ajuste = formato[0]+".00"
            }else{
               if (formato[1].length < 2){
                aux_mto_ajuste = formato[0]+"."+formato[1]+"0"
               }else{
                aux_mto_ajuste = mto_ajuste
               }
               
            }
            detalles[id_det].afectado = aux_mto_ajuste
            $('#detalle').html(crear_tabla(detalles))
            $('#cancelar').click()
        });
    });
        </script>
    </body>
</html>