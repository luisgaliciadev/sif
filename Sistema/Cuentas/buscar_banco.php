<?php
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	$ID_LOCALIDAD=$_POST['ID_LOCALIDAD'];
	$ID_MONEDA=$_POST['ID_MONEDA'];
	
	$vSQL="EXEC SP_BANCOM_LISTADO $ID_LOCALIDAD, '$ID_MONEDA'";
	//$vSQL="SELECT ID_BANCO AS ID,NB_BANCO AS NB FROM TB_BANCO WHERE FG_ACT_BANCO=1";
	
	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ResultadoEjecutar["CONEXION"];
	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$result=$ResultadoEjecutar["RESULTADO"];
	
	if($CONEXION=="SI" and $ERROR=="NO")
	{
		$Arreglo["CONEXION"]=$CONEXION;
		$Arreglo["ERROR"]=$ERROR;	
				
		$option.="<option value='0' disabled selected>SELECCIONE BANCO...</option>";
		while($registro=odbc_fetch_array($result))
		{					
			
			$ID=utf8_encode($registro["ID"]);
			$NB=utf8_encode($registro["NB"]);		
			$option.="<option value='$ID'>$NB</option>";			
		}			
		
		$Arreglo["CONEXION"]=$CONEXION;
		$Arreglo["ERROR"]=$ERROR;	
		$Arreglo["option"]=$option;				
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