<?php
$Nivel="../../";
include($Nivel."includes/PHP/funciones.php");
$Conector=Conectar();
session_start();	

$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
$ID_LOCALIDAD=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_LOCALIDAD'];	
$ID_DOCUMENTO = $_POST["ID"];
$ID_USER=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_USUARIO'];
$MOTIVO=$_POST["MOTIVO"];

$vSQL="EXEC [dbo].[SP_ANULAR_FACTURA] '$ID_DOCUMENTO', $ID_USER, '$MOTIVO',$ID_LOCALIDAD";
$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
$CONEXION=$ResultadoEjecutar["CONEXION"];
$ERROR=$ResultadoEjecutar["ERROR"];
$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
$resultado=$ResultadoEjecutar["RESULTADO"];

if($CONEXION=="SI" and $ERROR=="NO")
{		
		while (odbc_fetch_array($resultado))
        {		
			$ID=odbc_result($resultado,'ID');
			$MENSAJE=odbc_result($resultado,'MENSAJE');
			if($ID<>0)
			{
				$AVISO=odbc_result($resultado,'AVISO');
			}
			else
			{
				$AVISO=0;
			}
			
    	}
        
        $Arreglo["ID"]	=  $ID;
		$Arreglo["MENSAJE"]	=  $MENSAJE;
		$Arreglo["AVISO"]	=  $AVISO;
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