<?php
$Nivel="../../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();	

$RIF=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'RIF'];
$USUARIO_CRE_WEB=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'LOGIN'];	
$ID_LOCALIDAD=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_LOCALIDAD'];	

$referencia = $_POST["referencia"];
$id_cliente = $_POST["id_cliente"];
$moneda = $_POST["moneda"];
$tp_mov = $_POST["tp_mov"];


 $vSQL="EXEC [dbo].[SP_BUSQUEDA_AVISO_CREDITO] $ID_LOCALIDAD,'$id_cliente',$referencia,'$moneda','$tp_mov'";
	
	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ResultadoEjecutar["CONEXION"];

	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$resultado=$ResultadoEjecutar["RESULTADO"];
	
	if($CONEXION=="SI" and $ERROR=="NO")
	{		
		while (odbc_fetch_array($resultado))
        {		
			$ID	=	utf8_encode(odbc_result($resultado,'ID'));;
            $MENSAJE = utf8_encode(odbc_result($resultado,'MENSAJE'));
            $res[]=array(
                "id" => utf8_encode(odbc_result($resultado,'ID')),
                "id_moneda" => utf8_encode(odbc_result($resultado,'ID_MONEDA')),   
                "nb_moneda" => utf8_encode(odbc_result($resultado,'NB_MONEDA')),
                "id_tp_movimiento" => utf8_encode(odbc_result($resultado,'ID_TP_MOVIMIENTO')),   
                "nb_tp_movimiento" => utf8_encode(odbc_result($resultado,'NB_TP_MOVIMIENTO')),
                "nro_documento" => utf8_encode(odbc_result($resultado,'NRO_DOCUMENTO')),   
                "f_emision" => utf8_encode(odbc_result($resultado,'F_EMISION')), 
                
                "monto" => utf8_encode(odbc_result($resultado,'MONTO')),
                "saldo" => utf8_encode(odbc_result($resultado,'SALDO')),   
                "localidad" => utf8_encode(odbc_result($resultado,'LOCALIDAD')),
                "rif_cliente" => utf8_encode(odbc_result($resultado,'RIF_CLIENTE')),   
                "nb_cliente" => utf8_encode(odbc_result($resultado,'NB_CLIENTE')),
                "mensaje" => utf8_encode(odbc_result($resultado,'MENSAJE')),                        
                "error"=> 0,
                "txt"=> '',
                "titulo"=> ''
            );
		
			$Arreglo["DATOS"]=$res;
			$Arreglo["CONEXION"]=$CONEXION;
			$Arreglo["ERROR"]=$ERROR;
			
		}
	}
	else
	{
		$Arreglo["CONEXION"]=$CONEXION;
		$Arreglo["ERROR"]=$ERROR;
		$Arreglo["MSJ_ERROR"]=$MSJ_ERROR;
	}
	
	$Arreglo["ID"]=$ID;
	$Arreglo["MENSAJE"]=$MENSAJE;
	echo json_encode($Arreglo);
	
	$Conector->Cerrar();


?>