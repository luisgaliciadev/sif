<?php 

function formato_1($res2){
    $respuesta = '
    <div class="box-body" >
        <div class=" ">
            <div class="col-sm-3">
                <h4>Nro.Documento: <strong>'.$res2[0]["id_preliqu"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>Buque: <strong>'.$res2[0]["nb_buque"].'</strong></h4>
            </div>
            <div class="col-sm-4">
                <h4>Nacionalidad: <strong>'.$res2[0]["nacionalidad"].'</strong></h4>
            </div>
            <div class="col-sm-2">
                <h4>Moneda: <strong>'.$res2[0]["nb_moneda"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>Cliente: <strong>'.$res2[0]["rif_cliente"].' - '.$res2[0]["nb_cliente"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>Atraque: <strong>'.$res2[0]["fecha_atraque"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>Fecha Calculo: <strong>'.$res2[0]["fecha_cambio"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>Nro. Expediente: <strong>'.$res2[0]["nro_expediente"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>Nro. Solicitud: <strong>'.$res2[0]["nro_solic"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>F/H Zarpe: <strong>'.$res2[0]["fecha_zarpe"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>F/H Inicio Op: <strong>'.$res2[0]["fecha_inicio_operaciones"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>F/H Fin Op: <strong>'.$res2[0]["fecha_fin_operaciones"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>Tipo de Operaci&oacute;n: <strong>'.$res2[0]["tipo_operacion"].'</strong></h4>
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
                <td colspan="2">Nro. Documento: <strong>'.$res2[0]["id_preliqu"].'</strong></td>
                <td colspan="2">Buque: <strong>'.$res2[0]["nb_buque"].'</strong></td>            
            </tr>
            <tr>
                <td colspan="2">Cliente: <strong>'.$res2[0]["rif_cliente"].' - '.$res2[0]["nb_cliente"].'</strong></h4></td>
                <td colspan="2">Atraque: <strong>'.$res2[0]["fecha_atraque"].'</strong></td>            
            </tr>
            <tr>
                <td colspan="2">Fecha Calculo: <strong>'.$res2[0]["fecha_cambio"].'</strong></td>
                <td colspan="2">Nro. Expediente: <strong>'.$res2[0]["nro_expediente"].'</strong></td>            
            </tr>
            <tr>
                <td colspan="2">Nro. Solicitud: <strong>'.$res2[0]["nro_solic"].'</strong></td>
                <td colspan="2">F/H Zarpe: <strong>'.$res2[0]["fecha_zarpe"].'</strong></td> 
            </tr>
            <tr>
                <td colspan="2">F/H Inicio Op: <strong>'.$res2[0]["fecha_inicio_operaciones"].'</strong></td>
                <td colspan="2">F/H Fin Op: <strong>'.$res2[0]["fecha_fin_operaciones"].'</strong></td>            
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
                <h4>Nro.Documento: <strong>'.$res2[0]["id_preliqu"].'</strong></h4>
            </div>
            <div class="col-sm-4">
                <h4>Buque: <strong>'.$res2[0]["nb_buque"].'</strong></h4>
            </div>
            <div class="col-sm-2">
                <h4>Moneda: <strong>'.$res2[0]["nb_moneda"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>Cliente: <strong>'.$res2[0]["rif_cliente"].' - '.$res2[0]["nb_cliente"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>Atraque: <strong>'.$res2[0]["fecha_atraque"].'</strong></h4>
            </div>
            <div class="col-sm-12">
                <h4>Direcci&oacute;n: <strong>'.$res2[0]["direccion_fiscal"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>Nro. Expediente: <strong>'.$res2[0]["nro_expediente"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>Fecha Calculo: <strong>'.$res2[0]["fecha_cambio"].'</strong></h4>
            </div>            
            <div class="col-sm-3">
                <h4>Nro. Solicitud: <strong>'.$res2[0]["ano_solic"].'-'.$res2[0]["nro_solic"].'</strong></h4>
            </div>
            
            <div class="col-sm-3">
                <h4>Eslora: <strong>'.$res2[0]["eslora"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>TRB: <strong>'.$res2[0]["trb"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>F/H Zarpe: <strong>'.$res2[0]["fecha_zarpe"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>Renave: <strong>'.$res2[0]["renave"].'</strong></h4>
            </div>
            
            <div class="col-sm-3">
                <h4>Nacionalidad: <strong>'.$res2[0]["nacionalidad"].'</strong></h4>
            </div>
            <div class="col-sm-3">
                <h4>Tipo Operaci&oacute;n: <strong>'.$res2[0]["tipo_operacion"].'</strong></h4>
            </div>

        </div>
    </div>
    ';

    return $respuesta;
}


//SOE REPARACION
function formato_3($res2){
    $respuesta = '
    <div class="box-body" >
        <div class=" ">
            <div class="col-sm-6">
                <h4>Nro.Documento: <strong>'.$res2[0]["id_preliqu"].'</strong></h4>
            </div>
            <div class="col-sm-2">
                <h4>Moneda: <strong>'.$res2[0]["nb_moneda"].'</strong></h4>
            </div>
            <div class="col-sm-6">
                <h4>Cliente: <strong>'.$res2[0]["rif_cliente"].' - '.$res2[0]["nb_cliente"].'</strong></h4>
            </div>  
            <div class="col-sm-12">
                <h4>Direcci&oacute;n: <strong>'.$res2[0]["direccion_fiscal"].'</strong></h4>
            </div>        
        </div>
    </div>
    ';

    return $respuesta;
}

?>