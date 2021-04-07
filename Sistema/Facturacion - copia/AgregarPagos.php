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
                    <label>Tipo de movimiento</label>
                    <select class="form-control" id="tp_mov" name="TIPO DE MOVIMIENTO" required>
                    <option value="">Selecione...</option>   
                    <?php 
                        $vSQL="exec dbo.[SP_TIPO_MOV_LISTADO] '4c00aa6e-5a55-4d1a-826e-4dbba19470ed'";
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

                <div class="form-group col-md-6" id="div_banco">
                    <label>Banco</label>
                    <select class="form-control" id="banco" name="banco" required>
                    <option value="">Selecione...</option>
                    <?php 
                        $vSQL="EXEC SP_BANCO_LISTADO $ID_LOCALIDAD,'$id_moneda'";
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
                </div> 

                <div class="form-group col-md-6" id="div_banco_cheq">
                    <label>Banco</label>
                    <select class="form-control" id="banco_cheq" name="banco" required>
                    <option value="">Selecione...</option>
                    <?php 
                        echo $vSQL="EXEC dbo.[SP_BANCO_LISTADO_CHEQUE]";
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
                                $NB=utf8_encode(odbc_result($result,'NB'));
                                echo "<option value=".$ID.">$NB</option>";
                                
                            }
                        }
                    
                    ?>
                    </select>
                </div>                

                <div class=" form-group col-md-6" id="div_cta">
                    <label>Cuenta</label>
                    <select class="form-control" id="cuenta" name="Cuenta" required>
                    <option value="">Selecione...</option>                
                    </select>
                </div>

                <div class=" form-group col-md-6" id="div_referencia">
                    <label>Referencia</label>
                    <input id="referencia" type="text" class="form-control" required>
                </div>

                <div class=" form-group col-md-6" id="div_fecha">
                    <label>Fecha</label>
                    <input id="fecha" type="date" class="form-control" required>
                </div>

                <div class=" form-group col-md-6" id="div_monto">
                    <label>Monto</label>
                    <input id="monto" type="text" class="form-control" required onkeypress="return NumCheck(event, this)" maxlength="20">
                </div>

                <div class=" form-group col-md-6" id="div_monto_usado">
                    <label>Monto a Usar</label>
                    <input id="monto_usado" type="text" class="form-control" required onkeypress="return NumCheck(event, this)" maxlength="20">
                </div>

                <div class=" form-group col-md-6" id="div_transaccion">
                    <label>Transaccion</label>
                    <input id="transaccion" type="text" class="form-control" required onkeypress="return justNumbers(event);" maxlength="20">
                </div>

                <div class=" form-group col-md-6" id="div_cheque">
                    <label>Nro. Cheque</label>
                    <input id="cheque" type="text" class="form-control" required onkeypress="return justNumbers(event);"  maxlength="20">
                </div>

                <div class=" form-group col-md-6" id="div_cta_cheq">
                    <label>Cta. Bancaria Cheque</label>
                    <input id="cta_banc_cheq" type="text" class="form-control" required  onkeypress="return justNumbers(event);"  maxlength="20">
                </div>

                <div class=" form-group col-md-6" id="div_responsable">
                    <label>Responsable de la Cuenta</label>
                    <input id="responsable" type="text" class="form-control" required >
                </div>

                <div class=" form-group col-md-6" id="div_rif">
                    <label>RIF del Cliente</label>
                    <input id="rif" type="text" class="form-control" required >
                </div>
            </div>   
        </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="guardar_pago">Guardar</button>
                </div>
        
<script>
    $(document).ready(function(e) 
    {				
        window.parent.Cargando(0);
        $('#monto').inputmask('999.999.999.999,99', { numericInput: true });  
        $('#monto_usado').inputmask('999.999.999.999,99', { numericInput: true });  

        limpiar_div()

        $('#tp_mov').change(function() {
            limpiar_div()
            tp_mov = $('#tp_mov').val();
            if (tp_mov == 'CED8782D-A683-4F64-8A8E-91A583502EC0'){
                $('#div_banco').show()
                $('#div_cta').show()
                $('#div_monto').show()
                $('#div_transaccion').show()
                $('#div_monto_usado').show()
                $('#div_fecha').show()
            }

            if (tp_mov == '9D1546A3-81F5-46B9-8118-A2284A109760'){
                $('#div_banco_cheq').show()
                $('#div_monto').show()
                $('#div_cheque').show()
                $('#div_cta_cheq').show()
                $('#div_responsable').show()
                $('#div_fecha').show()
                $('#div_monto_usado').show()
            }

            

            if ((tp_mov == '715F0607-F367-43E7-B916-B0066A5F5D87')||(tp_mov == 'BB4FC26C-A195-4160-98A7-F3CE5E96384C')) {   
                $('#div_banco').show()
                $('#div_fecha').show()
                $('#div_cta').show()
                $('#div_referencia').show()
            }

        });
        
        $('#guardar_pago').click(function() {
            
            tp_mov = $('#tp_mov').val();
            if (tp_mov == ''){
                MostrarMensaje("Rojo", "Disculpe, debe seleccionar un tipo de movimiento bancario valido");
                return false 
            }

            if (saldo == 0){
                MostrarMensaje("Rojo", "Disculpe, no se pueden agregar nuevos pagos, debido a que la el saldo es igual 0");
                return false 
            }
            
            // INSERTAR CHEQUES DE GERENCIA
            if (tp_mov == '9D1546A3-81F5-46B9-8118-A2284A109760'){                        
                var flag_validar = validar_campos_pagos() 
                if (flag_validar== 1){
                    return false                            
                }
                var nro_cheque = $('#cheque').val()
                var cta_banc_cheq = $('#cta_banc_cheq').val()
                var fecha = $('#fecha').val()
                var monto = retornar_num_mask($('#monto').val())
                var monto_usado = retornar_num_mask($('#monto_usado').val()) 
                var banco = $('#banco_cheq').val()
                var responsable = $('#responsable').val()
                Parametros = 'nro_cheque='+nro_cheque+'&cta_banc_cheq='+cta_banc_cheq+'&fecha='+fecha+'&monto='+monto+'&monto_usado='+monto_usado+'&banco='+banco+'&responsable='+responsable+'&id_moneda='+totales[0].id_moneda+'&id_preliquidacion='+totales[0].id_preliquidacion+"&tp_mov="+tp_mov;
                insert_cheq(Parametros)
            }
            // INSERTAR PUNTO DE VENTAS
            if (tp_mov == 'CED8782D-A683-4F64-8A8E-91A583502EC0'){                        
                var flag_validar = validar_campos_pagos() 
                if (flag_validar== 1){
                    return false                            
                }
                var transaccion = $('#transaccion').val()
                var cuenta = $('#cuenta').val()
                var fecha = $('#fecha').val()
                var monto = retornar_num_mask($('#monto').val())
                var monto_usado = retornar_num_mask($('#monto_usado').val()) 
                var banco = $('#banco').val()
                Parametros = 'transaccion='+transaccion+'&cuenta='+cuenta+'&fecha='+fecha+'&monto='+monto+'&monto_usado='+monto_usado+'&banco='+banco+'&id_moneda='+totales[0].id_moneda+'&id_preliquidacion='+totales[0].id_preliquidacion+"&tp_mov="+tp_mov;
                insert_pdv(Parametros)
            }

            if ((tp_mov == '715F0607-F367-43E7-B916-B0066A5F5D87')||(tp_mov == 'BB4FC26C-A195-4160-98A7-F3CE5E96384C')) {                        
                var flag_validar = validar_campos_pagos() 
                if (flag_validar== 1){
                    return false                            
                }
                var referencia = $('#referencia').val()
                var cuenta = $('#cuenta').val()
                var fecha = $('#fecha').val()
                var banco = $('#banco').val()
                Parametros = 'referencia='+referencia+'&cuenta='+cuenta+'&fecha='+fecha+'&monto='+monto+'&rif='+totales[0].rif_cliente+'&banco='+banco+'&id_moneda='+totales[0].id_moneda+'&id_preliquidacion='+totales[0].id_preliquidacion+"&tp_mov="+tp_mov;
                guardar_trans_dep(Parametros)
            }


        });

        $('#banco').change(function() {
            buscar_cta_rec()
        });
    
    });
        </script>
    </body>
</html>