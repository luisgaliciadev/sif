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
        $id_moneda = "";
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
                <div class="form-group col-md-6" >
                <input id="documento" type="hidden" class="form-control" required value=<?php echo $id_documento; ?>>
                <input id="id_moneda" type="hidden" class="form-control" required value=<?php echo $id_moneda; ?>>
                    <label>Clasificaci&oacute;n de pago</label>
                    <select class="form-control" id="clasif" name="CLASIFICACION DE MONEDA" required>
                    <option value="">Selecione...</option>   
                    <?php 
                        $vSQL="exec dbo.[SP_CLASIF_PAGO_LISTADO]";
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
                    <label>Tipo de movimiento</label>
                    <select class="form-control" id="tp_mov" name="TIPO DE MOVIMIENTO" required>
                    <option value="">Selecione...</option>                      
                    </select>
                </div>

                <div class="form-group col-md-6" >
                    <label>Moneda</label>
                    <select class="form-control" id="moneda" name="MONEDA" required>
                    <option value="">Selecione...</option>                     
                    </select>
                </div>

                <div class=" form-group col-md-6" id="div_fecha_inter">
                    <label>Fecha Acreditacion</label>
                    <input id="fecha_inter" type="date" class="form-control" required>
                </div>

                <div class=" form-group col-md-6" id="div_cambio">
                    <label>Tasa de Cambio</label>
                    <input id="tasa_cambio" type="text" class="form-control" required disabled>
                </div>

                <div class=" form-group col-md-6" id="div_mto_pagar">
                    <label id="titulos">Total a Pagar en Moneda Extranjera</label>
                    <input id="mto_pagar" type="text" class="form-control" required disabled>
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

                <div class="form-group col-md-6" id="div_banco_inter_reca">
                    <label>Banco Recaudador</label>
                    <select class="form-control" id="banco_inter_reca" name="banco" required>
                    <option value="">Selecione...</option>                    
                    </select>
                </div>  

                <div class="form-group col-md-6" id="div_cta_inter_reca">
                    <label>Cuenta Recaudadora</label>
                    <select class="form-control" id="cta_recaudadora" name="banco" required>
                    <option value="">Selecione...</option>                    
                    </select>
                </div>

                <div class="form-group col-md-6" id="div_banco_interme">
                    <label>Banco intermediario</label>
                    <select class="form-control" id="banco_inter" name="banco" required>
                    <option value="">Selecione...</option>                    
                    </select>
                </div>  

                <div class="form-group col-md-6" id="div_cta_inter">
                    <label>Cuenta intermediaria</label>
                    <select class="form-control" id="cta_intermediaria" name="banco" required>
                    <option value="">Selecione...</option>                    
                    </select>
                </div>



                <div class="form-group col-md-6" id="div_banco_cheq">
                    <label>Banco</label>
                    <select class="form-control" id="banco_cheq" name="banco" required>
                    <option value="">Selecione...</option>
                    <?php 
                       $vSQL="EXEC dbo.[SP_BANCO_LISTADO_CHEQUE]";
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
                    <label>Referencia (Aviso de credito)</label>
                    <input id="referencia" type="text" class="form-control" required>
                    <button class="form-control btn yellow-bg" type="button" id="btn_aviso" onClick="consulta_aviso();" > <i class="fa fa-search"></i> Buscar Aviso.</button>
                      
                </div>

                <div class=" form-group col-md-6" id="div_fecha">
                    <label>Fecha Emision</label>
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

                <div class=" form-group col-md-6" id="div_monto_equivalente">
                    <label>Monto Equivalente a la moneda del Documento </label>
                    <input id="monto_equivalente" type="text" class="form-control" required  maxlength="20" disabled >
                </div>

                <div class=" form-group col-md-6" id="div_transaccion">
                    <label>Transaccion</label>
                    <input id="transaccion" type="text" class="form-control" required  maxlength="20">
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
                <div class=" form-group col-md-6" id="div_observacion">
                    <label>Observaci&oacute;n</label>
                    <textarea class="form-control" rows="3" id="observacion"></textarea>
                </div>
            </div>   
        </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelar_pagos">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="guardar_pago">Guardar</button>
                </div>
        
<script>
    $(document).ready(function(e) 
    {				
        window.parent.Cargando(0);
        $('#monto').inputmask('999.999.999.999,99', { numericInput: true });  
        $('#monto_usado').inputmask('999.999.999.999,99', { numericInput: true });  
        $('#tasa_cambio').inputmask('999.999,99', { numericInput: true });  
        $('#mto_pagar').inputmask('999.999,99', { numericInput: true });   
        $('#monto_equivalente').inputmask('999.999,99', { numericInput: true });   
        $('#btn_aviso').hide()
        id_movimiento = ''
       

        limpiar_div()
        $('#clasif').change(function() {
            clasif = $('#clasif').val();
            
            
            if (($('#fg_base').val()== 0) && (clasif == '05433D2B-1B69-4BD8-9826-5B77C2ABB8FE')){
                MostrarMensaje("Rojo", "Disculpe no puede realizar pagos en moneda nacional, intente nuevamente");    
                $('#clasif').val('')                    
                return false 
            }
            if (clasif == ''){
                $('#tp_mov').html('');
                $('#moneda').html('');
            }else{
                tipo_mov_listado(clasif)
            }
        });

        $('#tp_mov').change(function() {
            limpiar_div()
            tp_mov = $('#tp_mov').val();

            

            if ((tp_mov == '78508F43-530F-419E-B538-7D4D7E104718') || (tp_mov == '63DC4DEA-0D04-4BC2-9234-8EAB418764F3')){
                $('#div_referencia').show()
            }

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

            if (tp_mov == '1CF73FDF-6178-4AB7-96F2-BD433FCF8195'){
                $('#div_fecha_inter').show()
            } 

        });

        $('#referencia').change(function() {
            tp_mov = $('#tp_mov').val();
            if ((tp_mov == '78508F43-530F-419E-B538-7D4D7E104718') || (tp_mov == '63DC4DEA-0D04-4BC2-9234-8EAB418764F3')){
                if ($('#referencia').val()== ''){
                    $('#btn_aviso').hide()
                    $('#div_monto').hide()
                    $('#div_monto_usado').hide()
                    $('#monto').val('')
                    $('#monto_usado').val('')
                }else{
                    $('#btn_aviso').show()
                }
                
            }else{
                $('#btn_aviso').hide()
            }
        });
       
        $('#monto').focusout(function() {           
            monto = retornar_num_mask($('#monto').val())
            tp_mov = $('#tp_mov').val();
            
            if ($('#documento').val() == ''){
                
                aux_saldo = $('#saldoss').html();
                if (tp_mov == '1CF73FDF-6178-4AB7-96F2-BD433FCF8195'){
                    aux_saldo =  retornar_num_mask($('#mto_pagar').val())
                } 
                
                if (aux_saldo == ''){
                    aux_saldo = totales[0].total2.replace(/\./g, '');
                    aux_saldo = aux_saldo.replace(',', '.');
                }

                
            }else{
                aux_saldo = $('#saldoss').html();
                if (tp_mov == '1CF73FDF-6178-4AB7-96F2-BD433FCF8195'){
                    aux_saldo =  retornar_num_mask($('#mto_pagar').val())
                } else{
                    if (aux_saldo == ''){
                        aux_saldo = $('#totalf').html().replace(/\./g, '');
                        aux_saldo = aux_saldo.replace(',', '.');
                    }
                }

            }

           
            var aux_saldos = parseFloat(aux_saldo);
            var aux_monto = parseFloat(monto);
           
            if (aux_monto > aux_saldos){
                $('#monto_usado').val(aux_saldo)
               
            }else{
                $('#monto_usado').val('')
                $('#monto_usado').val($('#monto').val())
            }

            if (tp_mov == '1CF73FDF-6178-4AB7-96F2-BD433FCF8195'){
                mto_equivalente = parseFloat(retornar_num_mask($('#monto_usado').val()) / retornar_num_mask($('#tasa_cambio').val())).toFixed(2)
                $('#monto_equivalente').val(mto_equivalente)
                $('#div_monto_equivalente').show()
            }
           
        });

        $('#monto_usado').focusout(function() {           
            monto_usado = retornar_num_mask($('#monto_usado').val())
            tp_mov = $('#tp_mov').val();
            
            if ($('#documento').val() == ''){
                aux_saldo = $('#saldoss').val();
                if (tp_mov == '1CF73FDF-6178-4AB7-96F2-BD433FCF8195'){
                    aux_saldo =  retornar_num_mask($('#mto_pagar').val())
                } 
                if (aux_saldo == ''){
                    aux_saldo = totales[0].total2.replace(/\./g, '');
                    aux_saldo = aux_saldo.replace(',', '.');
                }
            }else{
                aux_saldo = $('#saldoss').html();
                if (tp_mov == '1CF73FDF-6178-4AB7-96F2-BD433FCF8195'){
                    aux_saldo =  retornar_num_mask($('#mto_pagar').val())
                }else{ 
                    if (aux_saldo == ''){
                        aux_saldo = $('#totalf').html().replace(/\./g, '');
                        aux_saldo = aux_saldo.replace(',', '.');
                    }else{
                        //aux_saldo = aux_saldo.replace(/\./g, '');
                        //aux_saldo = aux_saldo.replace(',', '.');
                    }
                } 
            }
            
            var aux_saldos = parseFloat(aux_saldo);
            var aux_monto = parseFloat(monto_usado);

            if (aux_monto > aux_saldo){
               MostrarMensaje("Rojo", "Disculpe, el monto a usar es mayor al saldo restante de la factura");
               $('#monto').focusout()
               return false
            }

            if (tp_mov == '1CF73FDF-6178-4AB7-96F2-BD433FCF8195'){
                mto_equivalente = parseFloat(retornar_num_mask($('#monto_usado').val()) / retornar_num_mask($('#tasa_cambio').val())).toFixed(2)
                $('#monto_equivalente').val(mto_equivalente)
                $('#div_monto_equivalente').show()
            }

        });
       
        
        $('#guardar_pago').click(function() {
            
            tp_mov = $('#tp_mov').val();
            if (tp_mov == ''){
                MostrarMensaje("Rojo", "Disculpe, debe seleccionar un tipo de movimiento bancario valido");
                return false 
            }

            if ($('#documento').val() == ''){
                if (saldo == 0){
                    MostrarMensaje("Rojo", "Disculpe, no se pueden agregar nuevos pagos, debido a que  el saldo es igual 0");
                    return false 
                }
            }else{
                var saldos = $('#saldoss').html()
                if (saldos <= 0){
                    MostrarMensaje("Rojo", "Disculpe, no se pueden agregar nuevos pagos, debido a que el saldo es igual 0");
                    return false 
                }
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
                aux_saldo = $('#saldoss').html();
            
                

                if ($('#documento').val() == ''){
                    
                    if (aux_saldo == ''){
                        aux_saldo = totales[0].total2.replace(/\./g, '');
                        aux_saldo = aux_saldo.replace(',', '.');
                    }
                   
                    if (parseFloat(monto_usado) > parseFloat(aux_saldo)){
                        MostrarMensaje("Rojo", "Disculpe, el monto a usar es mayor al saldo restante de la factura");
                        return false
                    }
                    
                    Parametros = 'nro_cheque='+nro_cheque+'&cta_banc_cheq='+cta_banc_cheq+'&fecha='+fecha+'&monto='+monto+'&monto_usado='+monto_usado+'&banco='+banco+'&responsable='+responsable+'&id_moneda='+totales[0].id_moneda+'&id_preliquidacion='+totales[0].id_preliquidacion+"&tp_mov="+tp_mov;                
                }else{
                    documento = $('#documento').val()
                    id_moneda = $('#id_moneda').val()
                    Parametros = 'nro_cheque='+nro_cheque+'&cta_banc_cheq='+cta_banc_cheq+'&fecha='+fecha+'&monto='+monto+'&monto_usado='+monto_usado+'&banco='+banco+'&responsable='+responsable+'&id_moneda='+id_moneda+'&documento='+documento+"&tp_mov="+tp_mov;               
                
                }
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
                aux_saldo = $('#saldoss').val();
            
                if ($('#documento').val() == ''){
                    if (aux_saldo == ''){
                        aux_saldo = totales[0].total2.replace(/\./g, '');
                        aux_saldo = aux_saldo.replace(',', '.');
                    }
                    
                    
                    if (parseFloat(monto_usado) > parseFloat(aux_saldo)){
                        MostrarMensaje("Rojo", "Disculpe, el monto usado no debe ser mayor al saldo restante de la factura");
                        return false
                    }
                
                    Parametros = 'transaccion='+transaccion+'&cuenta='+cuenta+'&fecha='+fecha+'&monto='+monto+'&monto_usado='+monto_usado+'&banco='+banco+'&id_moneda='+totales[0].id_moneda+'&id_preliquidacion='+totales[0].id_preliquidacion+"&tp_mov="+tp_mov;
                }else{
                    documento = $('#documento').val()
                    id_moneda = $('#id_moneda').val()
                    Parametros = 'transaccion='+transaccion+'&cuenta='+cuenta+'&fecha='+fecha+'&monto='+monto+'&monto_usado='+monto_usado+'&banco='+banco+'&id_moneda='+id_moneda+'&documento='+documento+"&tp_mov="+tp_mov;
                   
                }
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
                if ($('#documento').val() == ''){
                    
                    Parametros = 'referencia='+referencia+'&cuenta='+cuenta+'&fecha='+fecha+'&monto='+monto+'&rif='+totales[0].rif_cliente+'&banco='+banco+'&id_moneda='+totales[0].id_moneda+'&id_preliquidacion='+totales[0].id_preliquidacion+"&tp_mov="+tp_mov;
                }else{
                    documento = $('#documento').val()
                    id_moneda = $('#id_moneda').val()
                    rif_cliente = $('#rif_cliente').val()
                    Parametros = 'referencia='+referencia+'&cuenta='+cuenta+'&fecha='+fecha+'&monto='+monto+'&rif='+rif_cliente+'&banco='+banco+'&id_moneda='+id_moneda+'&documento='+documento+"&tp_mov="+tp_mov;
                    
                }

                guardar_trans_dep(Parametros)
            }

           // transferencia internacional
           if (tp_mov == '1CF73FDF-6178-4AB7-96F2-BD433FCF8195'){                        
                var flag_validar = validar_campos_pagos() 
                if (flag_validar== 1){
                    return false                            
                }
                

                var fecha = $('#fecha').val()
                var monto = retornar_num_mask($('#monto').val())
                var monto_usado = retornar_num_mask($('#monto_usado').val()) 
                var observacion = $('#observacion').val()
                var cta_intermediaria = $('#cta_intermediaria').val()
                var cta_recaudadora = $('#cta_recaudadora').val()
                var fecha_inter = $('#fecha_inter').val()
                var moneda = $('#moneda').val()
                var referencia = $('#referencia').val()
                aux_saldo = $('#saldoss').val();
            
                if ($('#documento').val() == ''){
                    if (aux_saldo == ''){
                        aux_saldo = totales[0].total2.replace(/\./g, '');
                        aux_saldo = aux_saldo.replace(',', '.');
                    }

                    

                    aux_saldo = parseFloat(aux_saldo);
                    monto_usado = parseFloat(monto_usado);
                    if (monto_usado > aux_saldo){
                        MostrarMensaje("Rojo", "Disculpe, el monto a usar es mayor al saldo restante de la factura");
                        return false
                    }

                
                    
                    Parametros = 'fecha='+fecha+'&monto='+monto+'&monto_usado='+monto_usado+'&observacion='+observacion+'&cta_intermediaria='+cta_intermediaria+'&cta_recaudadora='+cta_recaudadora+'&fecha_inter='+fecha_inter+'&id_moneda='+totales[0].id_moneda+'&id_preliquidacion='+totales[0].id_preliquidacion+"&tp_mov="+tp_mov+"&moneda="+moneda+"&referencia="+referencia;
                }else{
                    documento = $('#documento').val()
                    id_moneda = $('#id_moneda').val()
                    rif_cliente = $('#rif_cliente').val()
                    Parametros = 'fecha='+fecha+'&monto='+monto+'&monto_usado='+monto_usado+'&observacion='+observacion+'&cta_intermediaria='+cta_intermediaria+'&cta_recaudadora='+cta_recaudadora+'&fecha_inter='+fecha_inter+'&id_moneda='+id_moneda+'&documento='+documento+"&tp_mov="+tp_mov+"&moneda="+moneda+"&referencia="+referencia;
                    
                }
                transferencia_internacional(Parametros)
            }

            //INSERTAR AVISO DE CREDITO
            if ((tp_mov == '78508F43-530F-419E-B538-7D4D7E104718') || (tp_mov == '63DC4DEA-0D04-4BC2-9234-8EAB418764F3')){
                var flag_validar = validar_campos_pagos() 
                if (flag_validar== 1){
                    return false                            
                }

                if (aux_saldo == ''){
                    aux_saldo = totales[0].total2.replace(/\./g, '');
                    aux_saldo = aux_saldo.replace(',', '.');
                }
                if (monto_usado > aux_saldo){
                    MostrarMensaje("Rojo", "Disculpe, el monto a usar es mayor al saldo restante de la factura");
                    return false
                }

                var monto_usado = retornar_num_mask($('#monto_usado').val()) 
                var referencia = $('#referencia').val() 
                
                if ($('#documento').val() == ''){
                    Parametros = 'monto_usado='+monto_usado+'&id_moneda='+totales[0].id_moneda+'&id_preliquidacion='+totales[0].id_preliquidacion+"&tp_mov="+tp_mov+"&id_movimiento="+id_movimiento+"&referencia="+referencia;
                }else{
                    documento = $('#documento').val()
                    id_moneda = $('#id_moneda').val()
                    rif_cliente = $('#rif_cliente').val()
                    Parametros = 'monto_usado='+monto_usado+'&id_moneda='+id_moneda+'&documento='+documento+"&tp_mov="+tp_mov+"&id_movimiento="+id_movimiento+"&referencia="+referencia;
                }
                    guardar_aviso(Parametros)
            }
            


        });

        $('#banco').change(function() {
            buscar_cta_rec()
        });

        $('#banco_inter_reca').change(function() {
            buscar_cta_rec_inter()
        });

        $('#moneda').change(function() {
            
            
            buscar_banco_rec_inter()
        });
    
        $('#banco_inter').change(function() {
            buscar_cta_interme()
        });

        $('#fecha_inter').change(function() {
            consulta_moneda()
        });
    });
        </script>
    </body>
</html>