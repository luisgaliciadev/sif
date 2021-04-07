<?php
$Nivel="../../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();	

$RIF=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'RIF'];
$USUARIO_CRE_WEB=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'LOGIN'];	

$id_preliquidacion = $_POST["id_preliquidacion"];


	$vSQL="EXEC [dbo].[SP_CONSULTA_MOVIMIENTO_BANC_PRELIQ] '$id_preliquidacion'";
	
	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ResultadoEjecutar["CONEXION"];

	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$resultPrin=$ResultadoEjecutar["RESULTADO"];

    $tabla ="
        <table class='table table-bordered table-hover'>
            <thead>
                <tr>
                    <th>Nro.</th>
                    <th>Tipo Mov.</th>
                    <th>Banco</th>
                    <th>Cuenta</th>
                    <th>Moneda</th>
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
		while (odbc_fetch_array($resultPrin))
        {		
            
            $res[]=array(
                "id_movimiento_pago" => utf8_encode(odbc_result($resultPrin,'ID_MOVIMIENTO_PAGO')),
                "nro" => utf8_encode(odbc_result($resultPrin,'NRO')),
                "nb_tipo_pago" => utf8_encode(odbc_result($resultPrin,'NB_TP_PAGO')),
                "nb_tp_movimiento" => utf8_encode(odbc_result($resultPrin,'NB_TP_MOVIMIENTO')),
                "nb_banco" => utf8_encode(odbc_result($resultPrin,'NB_BANCO')),
                "cuenta"=> utf8_encode(odbc_result($resultPrin,'CUENTA')),
                "nb_moneda"=> utf8_encode(odbc_result($resultPrin,'NB_MONEDA')),
                "ref_pago"=> utf8_encode(odbc_result($resultPrin,'REF_PAGO')),
                "f_emision"=> utf8_encode(odbc_result($resultPrin,'F_EMISION')),
                "monto"=> utf8_encode(odbc_result($resultPrin,'MONTO_USADO')),
                "saldo"=> utf8_encode(odbc_result($resultPrin,'SALDO')),
                "monto_usado"=> number_format(utf8_encode(odbc_result($resultPrin,'MONTO_USADO')), 2, ",", "."),
                "monto2"=> number_format(utf8_encode(odbc_result($resultPrin,'MONTO')), 2, ",", "."),
                "saldo2"=> number_format(utf8_encode(odbc_result($resultPrin,'SALDO')), 2, ",", "."),
                "id_preliquidacion"=> utf8_encode(odbc_result($resultPrin,'ID_PRELIQUIDACION')),
                "equivalente"=> utf8_encode(odbc_result($resultPrin,'EQUIVALENTE')),
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
       $Arreglo["JSON"]	=$res;
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