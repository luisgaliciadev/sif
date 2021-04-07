<?php 

function formato_1($res2){
    $respuesta = '
    <div class="box-body" >
        <div class=" ">
            <div class="col-sm-3">
                <h4>NRO. DOCUMENTO: '.$res2[0]["id_preliqu"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>BUQUE: '.$res2[0]["nb_buque"].'</strong></h4>
            </div>
            <div class="col-sm-4">
                <h4>NACIONALIDAD: '.$res2[0]["nacionalidad"].'</strong></h4>
            </div>
            <div class="col-sm-2">
                <h4>MONEDA: '.$res2[0]["nb_moneda"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>CLIENTE: '.$res2[0]["rif_cliente"].' - '.$res2[0]["nb_cliente"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>ATRAQUE: '.$res2[0]["fecha_atraque"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>FECHA CALCULO: '.$res2[0]["fecha_cambio"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>NRO. EXPEDIENTE: '.$res2[0]["nro_expediente"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>NRO. SOLICITUD: '.$res2[0]["nro_solic"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>F/H ZARPE: '.$res2[0]["fecha_zarpe"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>F/H INICIO OP: '.$res2[0]["fecha_inicio_operaciones"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>F/H FIN OP: '.$res2[0]["fecha_fin_operaciones"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>TIPO DE OPERACIi&Oacute;N: '.$res2[0]["tipo_operacion"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>VALOR CAMBIO:  '.$res2[0]["cambio_moneda"].'</strong></h4>
            </div>

        </div>
    </div>
    ';

    return $respuesta;
}

function formato_1_pdf($res2){
    $respuesta = '
        <table width="100%" class="cabecera" style="font-size:13px;">
            <tr>
                <td colspan="4">BUQUE: '.$res2[0]["nb_buque"].'</strong></td>            
            </tr>
            <tr>
                <td colspan="2">CLIENTE: '.$res2[0]["rif_cliente"].' - '.$res2[0]["nb_cliente"].'</strong></h4></td>
                <td colspan="2">ATRAQUE: '.$res2[0]["fecha_atraque"].'</strong></td>            
            </tr>
            <tr>
                <td colspan="2">FECHA CALCULO: '.$res2[0]["fecha_cambio"].'</strong></td>
                <td colspan="2">NRO. EXPEDIENTE: '.$res2[0]["nro_expediente"].'</strong></td>            
            </tr>
            <tr>
                <td colspan="2">NRO. SOLICITUD: '.$res2[0]["nro_solic"].'</strong></td>
                <td colspan="2">F/H ZARPE: '.$res2[0]["fecha_zarpe"].'</strong></td> 
            </tr>
            <tr>
                <td colspan="2">F/H INICIO OP: '.$res2[0]["fecha_inicio_operaciones"].'</strong></td>
                <td colspan="2">F/H FIN OP: '.$res2[0]["fecha_fin_operaciones"].'</strong></td>            
            </tr>
        </table>
    
    ';
    return $respuesta;
}

//SERVICIO PORTUARIO
function formato_2($res2){
    $respuesta = '
    <div class="box-body" >
        <div class=" ">
            <div class="col-sm-6">
                <h4>NRO. DOCUMENTO: '.$res2[0]["id_preliqu"].'</strong></h4>
            </div>
            <div class="col-sm-4">
                <h4>BUQUE: '.$res2[0]["nb_buque"].'</strong></h4>
            </div>
            <div class="col-sm-2">
                <h4>MONEDA: '.$res2[0]["nb_moneda"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>CLIENTE: '.$res2[0]["rif_cliente"].' - '.$res2[0]["nb_cliente"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>F/H  ATRAQUE: '.$res2[0]["fecha_atraque"].'</strong></h4>
            </div>
            <div class="col-sm-12">
                <h4>Direcci&oacute;n: '.$res2[0]["direccion_fiscal"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>NRO. EXPEDIENTE: '.$res2[0]["nro_expediente"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>FECHA CALCULO: '.$res2[0]["fecha_cambio"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>MUELLE: '.$res2[0]["muelle"].'</strong></h4>
            </div>            
            <div class="col-sm-3">
                <h4>NRO. SOLICITUD: '.$res2[0]["nro_solic"].'</strong></h4>
            </div>
            
            <div class="col-sm-3">
                <h4>ESLORA: '.$res2[0]["eslora"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>TRB: '.$res2[0]["trb"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>F/H ZARPE: '.$res2[0]["fecha_zarpe"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>RENAVE: '.$res2[0]["renave"].'</strong></h4>
            </div>
            
            <div class="col-sm-3">
                <h4>NACIONALIDAD: '.$res2[0]["nacionalidad"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>TIPO OPERACI&Oacute;N: '.$res2[0]["tipo_operacion"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>VALOR CAMBIO:  '.$res2[0]["cambio_moneda"].'</strong></h4>
            </div>

        </div>
    </div>
    ';

    return $respuesta;
}


//SERVICIO PORTUARIO
function formato_2_pdf($res2){

    $respuesta = '
    <table width="100%" class="cabecera" style="font-size:13px;">
        <tr>
            <td colspan="3">BUQUE: '.$res2[0]["nb_buque"].'</td>
            <td colspan="3">MONEDA: '.$res2[0]["nb_moneda"].'</td>            
        </tr>
        <tr>
            <td colspan="4">CLIENTE: '.$res2[0]["rif_cliente"].' - '.$res2[0]["nb_cliente"].'</h4></td>
            <td colspan="2">ATRAQUE: '.$res2[0]["fecha_atraque"].'</td>            
        </tr>
        <tr>
            <td colspan="6">Direcci&oacute;n: '.$res2[0]["direccion_fiscal"].'</td>           
        </tr>
        <tr>
            <td colspan="2">NRO. EXPEDIENTE: '.$res2[0]["nro_expediente"].'</td> 
            <td colspan="2">FECHA CALCULO: '.$res2[0]["fecha_cambio"].'</td>    
            <td colspan="2">MUELLE: '.$res2[0]["muelle"].'</td>                       
        </tr>
        <tr>
            <td colspan="2">NRO. SOLICITUD: '.$res2[0]["nro_solic"].'</td>
            <td colspan="1">ESLORA: '.$res2[0]["eslora"].'</td> 
            <td colspan="1">Trb: '.$res2[0]["trb"].'</td> 
            <td colspan="2">F/H ZARPE: '.$res2[0]["fecha_zarpe"].'</td> 
        </tr>
        <tr>
            <td colspan="2">RENAVE: '.$res2[0]["renave"].'</td>
            <td colspan="2">NACIONALIDAD: '.$res2[0]["nacionalidad"].'</td>
            <td colspan="2">TIPO OPERACI&Oacute;N: '.$res2[0]["tipo_operacion"].'</td>            
        </tr>
    </table>

';


    return $respuesta;
}


//SOE REPARACION
function formato_3($res2){

    $respuesta = '
    <div class="box-body" >
        <div class=" ">
            <div class="col-sm-6">
                <h4>NRO. DOCUMENTO: '.$res2[0]["id_preliqu"].'</strong></h4>
            </div>
            <div class="col-sm-2">
                <h4>MONEDA: '.$res2[0]["nb_moneda"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>CLIENTE: '.$res2[0]["rif_cliente"].' - '.$res2[0]["nb_cliente"].'</strong></h4>
            </div>  
            <div class="col-sm-12">
                <h4>DIRECCI&Oacute;N: '.$res2[0]["direccion_fiscal"].'</strong></h4>
            </div>   
            <div class="col-sm-3">
                <h4>VALOR CAMBIO:  '.$res2[0]["cambio_moneda"].'</strong></h4>
            </div>     
        </div>
    </div>
    ';

    return $respuesta;
}

//SOE REPARACION
function formato_3_pdf($res2){

    $respuesta = '
    <table width="100%" class="cabecera" style="font-size:13px;">
        <tr>
            <td colspan="6">MONEDA: '.$res2[0]["nb_moneda"].'</strong></td>            
        </tr>
        <tr>
            <td colspan="6">CLIENTE: '.$res2[0]["rif_cliente"].' - '.$res2[0]["nb_cliente"].'</strong></h4></td>            
        </tr>
        <tr>
            <td colspan="6">DIRECCI&Oacute;N: '.$res2[0]["direccion_fiscal"].'</strong></td>           
        </tr>
       
    </table>

';
    

    return $respuesta;
}

//FORMATO SBS
function formato_4($res2){
    $respuesta = '
    <div  >
        <div class=" ">
            <div class="col-sm-3">
                <h4>NRO. DOCUMENTO: '.$res2[0]["id_preliqu"].'</h4>
            </div>
            <div class="col-sm-3">
                <h4>BUQUE: '.$res2[0]["nb_buque"].'</h4>
            </div>
            <div class="col-sm-4">
                <h4>NACIONALIDAD: '.$res2[0]["nacionalidad"].'</h4>
            </div>
            <div class="col-sm-2">
                <h4>MONEDA: '.$res2[0]["nb_moneda"].'</h4>
            </div>
            <div class="col-sm-6">
                <h4>CLIENTE: '.$res2[0]["rif_cliente"].' - '.$res2[0]["nb_cliente"].'</h4>
            </div>            
            <div class="col-sm-6">
                <h4>ATRAQUE: '.$res2[0]["fecha_atraque"].'</h4>
            </div>   
            <div class="col-sm-12">
                <h4>DIRECCI&Oacute;N: '.$res2[0]["direccion_fiscal"].'  </h4>       
            </div>         
            <div class="col-sm-6">
                <h4>AGENTE ADUANAL:'.$res2[0]["rif_cliente_secun"].' - '.$res2[0]["nb_cliente_secun"].'</h4>
            </div>
            <div class="col-sm-6">
                <h4>Linea Naviera:'.$res2[0]["rif_cliente_tercero"].' - '.$res2[0]["nb_cliente_tercero"].'</h4>
            </div>
            <div class="col-sm-2">
                <h4>BL: '.$res2[0]["bl"].'</h4>
            </div>
            <div class="col-sm-3">
                <h4>PRODUCTO: '.$res2[0]["producto"].'</h4>
            </div>
            <div class="col-sm-4">
                <h4>FECHA CALCULO:'.$res2[0]["fecha_cambio"].'</h4>
            </div>    
            <div class="col-sm-3">
                <h4>VALOR CAMBIO:'.$res2[0]["cambio_moneda"].'</h4>
            </div>   

        </div>
    </div>
    ';

    return $respuesta;
}


//FORMATO SBS
function formato_4_pdf($res2){
    $respuesta = '
    <table width="100%" class="cabecera" style="font-size:13px;">
        <tr>
            <td colspan="4">BUQUE: '.$res2[0]["nb_buque"].'</td>            
        </tr>
        <tr>
            <td colspan="2">CLIENTE: '.$res2[0]["rif_cliente"].' - '.$res2[0]["nb_cliente"].'</h4></td>
            <td colspan="2">ATRAQUE: '.$res2[0]["fecha_atraque"].'</td>            
        </tr>
        <tr>
            <td colspan="4">DIRECCI&Oacute;N: '.$res2[0]["direccion_fiscal"].'</td>           
        </tr>
        <tr>
            <td colspan="2">AGENTE ADUANAL: '.$res2[0]["rif_cliente_secun"].' - '.$res2[0]["nb_cliente_secun"].'</h4></td>
            <td colspan="2">LINEA NAVIERA: '.$res2[0]["rif_cliente_tercero"].' - '.$res2[0]["nb_cliente_tercero"].'</td>            
        </tr>
        <tr>
            <td>BL: '.$res2[0]["bl"].'</td>
            <td>PRODUCTO: '.$res2[0]["producto"].'</td>
            <td colspan="2">FECHA CALCULO: '.$res2[0]["fecha_cambio"].'</td>            
        </tr>
    </table>

';
return $respuesta;
}


//USO DE SUPERFICIE
function formato_5($res2){
    $respuesta = '
    <div class="box-body" >
        <div class=" ">
            <div class="col-sm-6">
                <h4>NRO. DOCUMENTO: '.$res2[0]["id_preliqu"].'</strong></h4>
            </div>
            <div class="col-sm-4">
                <h4>BUQUE: '.$res2[0]["nb_buque"].'</strong></h4>
            </div>
            <div class="col-sm-2">
                <h4>MONEDA: '.$res2[0]["nb_moneda"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>CLIENTE: '.$res2[0]["rif_cliente"].' - '.$res2[0]["nb_cliente"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>F/H  ATRAQUE: '.$res2[0]["fecha_atraque"].'</strong></h4>
            </div>
            <div class="col-sm-12">
                <h4>Direcci&oacute;n: '.$res2[0]["direccion_fiscal"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>NRO. EXPEDIENTE: '.$res2[0]["nro_expediente"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>FECHA CALCULO: '.$res2[0]["fecha_cambio"].'</strong></h4>
            </div>            
            <div class="col-sm-3">
                <h4>NRO. SOLICITUD: '.$res2[0]["nro_solic"].'</strong></h4>
            </div>
            
            <div class="col-sm-3">
                <h4>ESLORA: '.$res2[0]["eslora"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>TRB: '.$res2[0]["trb"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>F/H ZARPE: '.$res2[0]["fecha_zarpe"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>RENAVE: '.$res2[0]["renave"].'</strong></h4>
            </div>
            
            <div class="col-sm-3">
                <h4>NACIONALIDAD: '.$res2[0]["nacionalidad"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>TIPO OPERACI&Oacute;N: '.$res2[0]["tipo_operacion"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>VALOR CAMBIO:  '.$res2[0]["cambio_moneda"].'</strong></h4>
            </div>

        </div>
    </div>
    ';

    return $respuesta;
}


//SERVICIO PORTUARIO
function formato_5_pdf($res2){

    $respuesta = '
    <table width="100%" class="cabecera" style="font-size:13px;">
        <tr>
            <td colspan="3">BUQUE: '.$res2[0]["nb_buque"].'</td>
            <td colspan="3">MONEDA: '.$res2[0]["nb_moneda"].'</td>            
        </tr>
        <tr>
            <td colspan="4">CLIENTE: '.$res2[0]["rif_cliente"].' - '.$res2[0]["nb_cliente"].'</h4></td>
            <td colspan="2">ATRAQUE: '.$res2[0]["fecha_atraque"].'</td>            
        </tr>
        <tr>
            <td colspan="6">Direcci&oacute;n: '.$res2[0]["direccion_fiscal"].'</td>           
        </tr>
        <tr>
            <td colspan="3">NRO. EXPEDIENTE: '.$res2[0]["nro_expediente"].'</td> 
            <td colspan="3">FECHA CALCULO: '.$res2[0]["fecha_cambio"].'</td>                       
        </tr>
        <tr>
            <td colspan="2">NRO. SOLICITUD: '.$res2[0]["nro_solic"].'</td>
            <td colspan="1">ESLORA: '.$res2[0]["eslora"].'</td> 
            <td colspan="1">Trb: '.$res2[0]["trb"].'</td> 
            <td colspan="2">F/H ZARPE: '.$res2[0]["fecha_zarpe"].'</td> 
        </tr>
        <tr>
            <td colspan="2">RENAVE: '.$res2[0]["renave"].'</td>
            <td colspan="2">NACIONALIDAD: '.$res2[0]["nacionalidad"].'</td>
            <td colspan="2">TIPO OPERACI&Oacute;N: '.$res2[0]["tipo_operacion"].'</td>            
        </tr>
    </table>

';


    return $respuesta;
}


?>