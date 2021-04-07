<?php
$Nivel="../../../";
    include($Nivel."includes/PHP/funciones.php");
    include("../formato_1.php");
	
	$Conector=Conectar();
	
	session_start();	

$RIF=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'RIF'];
$USUARIO_CRE_WEB=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'LOGIN'];	
$ID_LOCALIDAD=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_LOCALIDAD'];	

$cat_serv = $_POST["cat_serv"];
$pre = $_POST["pre"];
$anio = $_POST["anio"];
$id_sistema = $_POST["id_sistema"];


	$vSQL="EXEC [dbo].[SP_PRELIQUIDACION_BUSQUEDA] '$cat_serv',$pre,$anio,$id_sistema,$ID_LOCALIDAD";
	
	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ResultadoEjecutar["CONEXION"];

	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$resultado=$ResultadoEjecutar["RESULTADO"];

	if($CONEXION=="SI" and $ERROR=="NO")
	{		
		while (odbc_fetch_array($resultado))
        {		
			            
            $res[]=array(
                "sub_total" => number_format(utf8_encode(odbc_result($resultado,'SUB_TOTAL')), 2, ",", "."),
                "monto_gravado" => number_format(utf8_encode(odbc_result($resultado,'MONTO_GRAVADO')), 2, ",", "."),   
                "monto_nogravado" => number_format(utf8_encode(odbc_result($resultado,'MONTO_NOGRAVADO')), 2, ",", "."),
                "porc_iva" => number_format(utf8_encode(odbc_result($resultado,'PORC_IVA')), 2, ",", "."),   
                "iva" => number_format(utf8_encode(odbc_result($resultado,'IVA')), 2, ",", "."),
                "monto_iva" => number_format(utf8_encode(odbc_result($resultado,'MONTO_IVA')), 2, ",", "."),   
                "total" => utf8_encode(odbc_result($resultado,'TOTAL')), 
                "total2" => number_format(utf8_encode(odbc_result($resultado,'TOTAL')), 2, ",", "."), 
                "id_tipo_moneda" => utf8_encode(odbc_result($resultado,'ID_TIPO_MONEDA')),     
                "cambio_moneda" => utf8_encode(odbc_result($resultado,'CAMBIO_MONEDA')),  
                "fecha_cambio" => utf8_encode(odbc_result($resultado,'FECHA_CAMBIO')),      
                "id_moneda" => utf8_encode(odbc_result($resultado,'ID_MONEDA')),     
                "nb_moneda" => utf8_encode(odbc_result($resultado,'NB_MONEDA')),   
                "rif_cliente" => utf8_encode(odbc_result($resultado,'RIF_CLIENTE')),  
                "id_preliquidacion" => utf8_encode(odbc_result($resultado,'ID_PRELIQUIDACION')),    
                "fg_base" => utf8_encode(odbc_result($resultado,'FG_BASE')),                       
                "error"=> 0,
                "txt"=> '',
                "titulo"=> ''
            );

            $res2[]=array(
                "id_preliquidacion" => utf8_encode(odbc_result($resultado,'ID_PRELIQUIDACION')),
                "id_localidad" => utf8_encode(odbc_result($resultado,'ID_LOCALIDAD')),   
                "id_preliqu" => utf8_encode(odbc_result($resultado,'ID_PRELIQU')),
                "ano_liq" => utf8_encode(odbc_result($resultado,'ANO_LIQ')),   
                "tipo_liq" => utf8_encode(odbc_result($resultado,'TIPO_LIQ')),
                "nro_liq" => utf8_encode(odbc_result($resultado,'NRO_LIQ')),   
                "rif_cliente" => utf8_encode(odbc_result($resultado,'RIF_CLIENTE')), 
                
                "nb_cliente" => utf8_encode(odbc_result($resultado,'NB_CLIENTE')),
                "direccion_fiscal" => utf8_encode(odbc_result($resultado,'DIRECCION_FISCAL')),   
                "rif_cliente_secun" => utf8_encode(odbc_result($resultado,'RIF_CLIENTE_SECUN')),
                "nb_cliente_secun" => utf8_encode(odbc_result($resultado,'NB_CLIENTE_SECUN')),   
                "ano_solic" => utf8_encode(odbc_result($resultado,'ANO_SOLIC')),
                "nro_solic" => utf8_encode(odbc_result($resultado,'NRO_SOLIC')),   
                "ano_expediente" => utf8_encode(odbc_result($resultado,'ANO_EXPEDIENTE')),  
                "tipo_xpediente" => utf8_encode(odbc_result($resultado,'TIPO_EXPEDIENTE')),
                "nro_expediente" => utf8_encode(odbc_result($resultado,'NRO_EXPEDIENTE')),   
                "nb_buque" => utf8_encode(odbc_result($resultado,'NB_BUQUE')),
                "tipo_buque" => utf8_encode(odbc_result($resultado,'TIPO_BUQUE')),   
                "eslora" => utf8_encode(odbc_result($resultado,'ESLORA')),
                "trb" => utf8_encode(odbc_result($resultado,'TRB')),   
                "nacionalidad" => utf8_encode(odbc_result($resultado,'NACIONALIDAD')),  
                "renave" => utf8_encode(odbc_result($resultado,'RENAVE')),
                "bl" => utf8_encode(odbc_result($resultado,'BL')),   
                "producto" => utf8_encode(odbc_result($resultado,'PRODUCTO')),
                "fecha_atraque" => odbc_result($resultado,'FECHA_ATRAQUE'),   
                "fecha_zarpe" => odbc_result($resultado,'FECHA_ZARPE'),
                "fecha_inicio_operaciones" => odbc_result($resultado,'FECHA_INICIO_OPERACIONES'),   
                "fecha_fin_operaciones" => odbc_result($resultado,'FECHA_FIN_OPERACIONES'), 
                "fecha_cambio" => odbc_result($resultado,'FECHA_CAMBIO'), 
                "nb_moneda" => utf8_encode(odbc_result($resultado,'NB_MONEDA')),
                "rif_cliente_tercero" => odbc_result($resultado,'RIF_CLIENTE_TERCERO'), 
                "nb_cliente_tercero" => odbc_result($resultado,'NB_CLIENTE_TERCERO'), 
                "tipo_operacion" => utf8_encode(odbc_result($resultado,'TIPO_OPERACION')),   
                "id_formato_serv" => utf8_encode(odbc_result($resultado,'ID_FORMATO_SERV')),      
                "error"=> 0,
                "txt"=> '',
                "titulo"=> ''
            );
        }
        
        
        
        if($res2[0]["id_formato_serv"] == strtoupper ('2e7f99c0-976d-4603-b891-ee2f84a84be0')){
            $respuesta = formato_1($res2);
        }

        if($res2[0]["id_formato_serv"] == 'A55D9CA4-B600-4DD0-9E12-5E8396C02E49'){
            $respuesta = formato_2($res2);
        }

        if($res2[0]["id_formato_serv"] == strtoupper ('b084a8a8-df2d-42c3-9128-6cd2341debea')){
            //$respuesta = formato_2($res2);
        }

        if($res2[0]["id_formato_serv"] == strtoupper ('d4dbb066-f275-43b2-bb17-cd32adf47491')){
            $respuesta = formato_3($res2);
        }

        if($res2[0]["id_formato_serv"] == strtoupper ('778f2337-2268-49f8-8fb1-1e6f582af04c')){
            //$respuesta = formato_2($res2);
        }

        $Arreglo["DATOS"]	=  $respuesta;
        $Arreglo["CABECERA"]	= $res2;
        $Arreglo["TOTALES"]	= $res;
        $Arreglo["CONEXION"]=$CONEXION;
        $Arreglo["ERROR"]=$ERROR;
        
        $sql_detalle = "EXEC [dbo].[SP_PRELIQUIDACION_BUSQUEDA_DET] '".$res2[0]["id_preliquidacion"]."' ";
        $ResultadoEjecutar=$Conector->Ejecutar($sql_detalle, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
        
        $CONEXION=$ResultadoEjecutar["CONEXION"];
    
        $ERROR=$ResultadoEjecutar["ERROR"];
        $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
        $detalles=$ResultadoEjecutar["RESULTADO"];
        $detalle ="<table class='table table-bordered table-hover' role='grid' >
                    <thead>
                        <tr>
                            <th>COD. TARIFA</th>
                            <th>DESCRIPCION</th>
                            <th>BASE CALCULO</th>
                            <th>VALOR CALCULO</th>
                            <th>TASA / TARIFA</th>
                            <th>% DESC.</th>
                            <th>MONTO</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                ";
        if($CONEXION=="SI" and $ERROR=="NO")
        {
            while (odbc_fetch_array($detalles))
            {
                $detalle .="<tr>
                                <td>".utf8_encode(odbc_result($detalles,'COD_TARIFA'))."</td>
                                <td>".utf8_encode(odbc_result($detalles,'DS_TARIFA'))."</td>
                                <td>".odbc_result($detalles,'BASE_CALCULO')."</td>
                                <td>".number_format(odbc_result($detalles,'VALOR_CALCULO'), 2, ",", ".")."</td>
                                <td>".number_format(odbc_result($detalles,'TASA_TARIFA'), 2, ",", ".")."</td>
                                <td>".number_format(odbc_result($detalles,'PORC_DESC'), 2, ",", ".")."</td>
                                <td>".number_format(odbc_result($detalles,'MTO_ITEM'), 2, ",", ".")."</td>
                                <td>".number_format(odbc_result($detalles,'TOTAL_ITEM'), 2, ",", ".")."</td>
                </tr>";
            }

            $detalle .="</tbody></table>";
            $Arreglo["DETALLE"]	=  $detalle;
        }
	}
	else
	{
		$Arreglo["CONEXION"]=$CONEXION;
		$Arreglo["ERROR"]=$ERROR;
		$Arreglo["MSJ_ERROR"]=$MSJ_ERROR;
	}
		
	echo json_encode($Arreglo);
	
	$Conector->Cerrar();


?>