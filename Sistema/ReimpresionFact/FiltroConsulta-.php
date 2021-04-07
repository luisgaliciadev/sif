<?php
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	date_default_timezone_set('America/Caracas');
	
	$Conector=Conectar();
	$NRO=$_POST['NRO'];
	$CONTROL=$_POST['CONTROL'];
	
	$vSQL='EXEC [dbo].[SP_CONSULTA_DOCUMENTO] $NRO, $CONTROL';
								
	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="NO", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ResultadoEjecutar["CONEXION"];

	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$resultPrin=$ResultadoEjecutar["RESULTADO"];

	if($CONEXION=="SI" and $ERROR=="NO")
	{	
		
		$MENSAJE=odbc_result($resultPrin,"MENSAJE");
		$ID=odbc_result($resultPrin,"ID");
		
		$Arreglo["MENSAJE"]=$MENSAJE;
		$Arreglo["ID"]=$ID;
		$Arreglo["ERROR"]=$ERROR;
		
		if($ID==0)
		{
			$Arreglo["FORM"]='';
		}
		else
		{
			$Arreglo["FORM"]='
			
			<div class="row">
              	<div class="form-group col-md-6">
					<label for="LNRO">NUMERO:</label>
					<input id="nro" type="text" class="form-control" required>
				</div>
				<div class="form-group col-md-6">
					<label for="LNRO">NUMERO:</label>
					<input id="nro" type="text" class="form-control" required>
				</div>
				<div class="form-group col-md-6">
					<label for="LNRO">NUMERO:</label>
					<input id="nro" type="text" class="form-control" required>
				</div>
			
				</div>
			</div>
			';
		}
	}
	else
	{
		$Arreglo["CONEXION"]=$CONEXION;
		$Arreglo["ERROR"]=$ERROR;
		$Arreglo["MENSAJE"]=$MSJ_ERROR;
		$Arreglo["ID"]=0;
		$Arreglo["FORM"]=0;
	}
	
	echo json_encode($Arreglo);
	
	$Conector->Cerrar();
?>