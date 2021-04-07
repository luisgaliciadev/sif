<?php
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	$ID_LOCALIDAD=$_POST['ID_LOCALIDAD'];
	
	//$vSQL="SP_CONSULTA_CTRO_FACT $ID_LOCALIDAD";
	$vSQL="SELECT * FROM TB_SERIE WHERE ID_LOCALIDAD=$ID_LOCALIDAD AND FG_ACT_SERIE=1";
	
	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ResultadoEjecutar["CONEXION"];
	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$result=$ResultadoEjecutar["RESULTADO"];
	
	if($CONEXION=="SI" and $ERROR=="NO")
	{
		$Arreglo["CONEXION"]=$CONEXION;
		$Arreglo["ERROR"]=$ERROR;	
		
		$option.="<option value='0' disabled selected>SELECCIONE SERIE...</option>";
		
		while($registro=odbc_fetch_array($result))
		{			
			//$ID_CTRO_FACTURACION=$registro["ID_CTRO_FACTURACION"];
			$ID_SERIE=utf8_encode($registro["ID_SERIE"]);
			$NB_SERIE=utf8_encode($registro["NB_SERIE"]);
						
			$option.="<option value='$ID_SERIE'>$NB_SERIE</option>";
			//$a='hola';
		}
		
		$Arreglo["CONEXION"]=$CONEXION;
		$Arreglo["ERROR"]=$ERROR;
		$Arreglo["option"]=$option;
		$Arreglo["a"]=$a;
	}
	else
	{		
		//$a='hola';
		$Arreglo["CONEXION"]=$CONEXION;
		$Arreglo["ERROR"]=$ERROR;
		$Arreglo["MSJ_ERROR"]=$MSJ_ERROR;
		//$Arreglo["a"]=$a;
	}
	
	echo json_encode($Arreglo);
	
	$Conector->Cerrar();
?>