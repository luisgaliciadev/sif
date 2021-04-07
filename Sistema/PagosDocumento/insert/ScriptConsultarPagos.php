<?php
$Nivel="../../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();	

$RIF=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'RIF'];
$USUARIO_CRE_WEB=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'LOGIN'];	

$documento = $_POST["documento"];


	$vSQL="EXEC [dbo].[SP_CONSULTA_PAGOS_POR_DOCUMENTO] '$documento'";
	
	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ResultadoEjecutar["CONEXION"];

	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$resultado=$ResultadoEjecutar["RESULTADO"];

    $tabla ="
        <table class='table table-bordered table-hover'>
            <thead>
                <tr>
                    <th>Nro.</th>
                    <th>Tipo Mov.</th>
                    <th>Banco</th>
                    <th>Cuenta</th>
                    <th>Moneda</th>
                    <th>Referencia</th>
                    <th>F. Emision</th>
                    <th>Monto</th>
                    <th>Saldo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>    
    ";
    if($CONEXION=="SI" and $ERROR=="NO")
	{		
		while (odbc_fetch_array($resultado))
        {		
            
            $res_pago[]=array(
                "id_documento" => utf8_encode(odbc_result($resultado,'ID_DOCUMENTO')),
                "id_documento_pago" => utf8_encode(odbc_result($resultado,'ID_DOCUMENTO_PAGO')),
                "id_movimiento_pago" => utf8_encode(odbc_result($resultado,'ID_MOVIMIENTO_PAGO')),   
                "nb_tp_movimiento" => utf8_encode(odbc_result($resultado,'NB_TP_MOVIMIENTO')),
                "nb_banco" => utf8_encode(odbc_result($resultado,'NB_BANCO')),   
                "nro_cuenta" => utf8_encode(odbc_result($resultado,'NRO_CUENTA')),
                "nb_moneda" => utf8_encode(odbc_result($resultado,'NB_MONEDA')),   
                "referencia" => utf8_encode(odbc_result($resultado,'REFERENCIA')), 
                "f_emision" => FechaNormal(utf8_encode(odbc_result($resultado,'F_EMISION'))),                      
                "monto" => number_format(utf8_encode(odbc_result($resultado,'MONTO')), 2, ",", "."),  
                "valor_base" => number_format(utf8_encode(odbc_result($resultado,'VALOR_BASE')), 2, ",", "."),      
                "monto_aplicado" => number_format(utf8_encode(odbc_result($resultado,'MONTO_APLICADO')), 2, ",", "."), 
                "monto_aplicado2" => utf8_encode(odbc_result($resultado,'MONTO_APLICADO')),     
                "saldo" => number_format(utf8_encode(odbc_result($resultado,'SALDO')), 2, ",", "."),   
                "procesado" => utf8_encode(odbc_result($resultado,'PROCESADO')),    
                "nro" => utf8_encode(odbc_result($resultado,'nro')),  
                "equivalente"=> utf8_encode(odbc_result($resultado,'EQUIVALENTE')),                     
                "error"=> 0,
                "txt"=> '',
                "titulo"=> ''
            );  
            
            $id_movimiento = utf8_encode(odbc_result($resultPrin,'ID_MOVIMIENTO_PAGO'));
            $tabla .="
                <tr>
                    <td>".utf8_encode(odbc_result($resultPrin,'NRO'))."</td>
                    <td>".utf8_encode(odbc_result($resultPrin,'NB_TP_MOVIMIENTO'))."</td>
                    <td>".utf8_encode(odbc_result($resultPrin,'NB_BANCO'))."</td>
                    <td>".utf8_encode(odbc_result($resultPrin,'CUENTA'))."</td>
                    <td>".utf8_encode(odbc_result($resultPrin,'NB_MONEDA'))."</td>
                    <td>".utf8_encode(odbc_result($resultPrin,'F_EMISION'))."</td>
                    <td>".utf8_encode(odbc_result($resultPrin,'MONTO'))."</td>
                    <td>".utf8_encode(odbc_result($resultPrin,'SALDO'))."</td>";
            $tabla .="<td>    <button type='button' class='btn btn-danger btn-xs' onClick='eliminarpago('".$id_movimiento."');' data-placement='top' data-toggle='tooltip' data-original-title='Eliminar'>
                <i class='fa fa-trash'></i>
            </button></td>";
             
       }
       $tabla .="</tbody></table>";
       $Arreglo["DATOS"]	=$tabla;
       $Arreglo["JSON"]	=$res_pago;
       $Arreglo["CONEXION"]=$CONEXION;
       $Arreglo["ERROR"]=$ERROR;
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