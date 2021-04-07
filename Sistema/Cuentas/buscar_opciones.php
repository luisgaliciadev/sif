<?php
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	$ID_MONEDA_BASE=$_POST['ID_MONEDA_BASE'];
	
	$vSQL="SELECT FG_BASE FROM dbo.TB_TP_MONEDA WHERE ID_MONEDA ='$ID_MONEDA_BASE'";
	
	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ResultadoEjecutar["CONEXION"];
	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$result=$ResultadoEjecutar["RESULTADO"];
	
	if($CONEXION=="SI" and $ERROR=="NO")
	{
		$Arreglo["CONEXION"]=$CONEXION;
		$Arreglo["ERROR"]=$ERROR;	
				
		
		while($registro=odbc_fetch_array($result))
		{			
			$FG_BASE=$registro["FG_BASE"];
			
			
		
		$Arreglo["COMBO"]	=$Arreglo["COMBO"]."<option value=".$RIF_OPERADOR.">$NB_PROVEED_BENEF </option>";
		$Arreglo["CONEXION"]=$CONEXION;
		$Arreglo["ERROR"]=$ERROR;
		$Arreglo["FG_BASE"]=$FG_BASE;		
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