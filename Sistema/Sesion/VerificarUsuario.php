<?php
	session_start();	
	
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	$SISTEMA_MODO_PRUEBA=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'SISTEMA_MODO_PRUEBA'];
	
	date_default_timezone_set('America/Caracas');

	$ID_LOCALIDAD=$_POST['ID_LOCALIDAD'];	
	$UsuarioAD=$_POST['LOGIN'];
	$ClaveAD=$_POST['CLAVE'];
	
	$Arreglo["NB_USUARIO"]=$UsuarioAD;

	$vSQL="EXEC SP_SESION_INICIAR_SESION '$UsuarioAD', '$ClaveAD', $ID_LOCALIDAD, $SISTEMA_MODO_PRUEBA;";	

	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');

	$CONEXION=$ResultadoEjecutar["CONEXION"];
	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$result=$ResultadoEjecutar["RESULTADO"];

	if($CONEXION=="SI" and $ERROR=="NO")
	{
		$RESULTADO=odbc_result($result,"RESULTADO");

		if($RESULTADO==-3)
		{
			$Arreglo["RESULTADO"]=-3;
		}
		else
		{
			if($RESULTADO==-2)
			{
				$Arreglo["RESULTADO"]=-2;
			}
			else
			{
				if($RESULTADO==-1)
				{
					$Arreglo["RESULTADO"]=-1;
					$COUNT_CLAV_ERRA=odbc_result($result,"COUNT_CLAV_ERRA");
					$Arreglo["COUNT_CLAV_ERRA"]=$COUNT_CLAV_ERRA;
				}
				else
				{
					if($RESULTADO==0)
					{
						$Arreglo["RESULTADO"]=0;
					}
					else
					{
						if($RESULTADO==1)
						{
							$_SESSION[$SISTEMA_SIGLA.'TIEMPO_INICIAL']=time();
							
							
							$_SESSION[$SISTEMA_SIGLA.'ID_USUARIO']=odbc_result($result,"ID_EMPRESA_USER");	
							$_SESSION[$SISTEMA_SIGLA.'ID_LOCALIDAD']=$ID_LOCALIDAD;	
							$_SESSION[$SISTEMA_SIGLA.'NB_LOCALIDAD']=odbc_result($result,"NB_LOCALIDAD");				
							$_SESSION[$SISTEMA_SIGLA.'ID_ROL']=odbc_result($result,"ID_ROL");				
							$_SESSION[$SISTEMA_SIGLA.'NB_ROL']=odbc_result($result,"NB_ROL");				
							$_SESSION[$SISTEMA_SIGLA.'NB_USUARIO']=odbc_result($result,"NB_USUARIO");	
							$_SESSION[$SISTEMA_SIGLA.'E_MAILU']=odbc_result($result,"E_MAILU");		
							$_SESSION[$SISTEMA_SIGLA.'TELEFU']=odbc_result($result,"TELEFU");
							$_SESSION[$SISTEMA_SIGLA.'LOGIN']=odbc_result($result,"LOGIN");	
							$_SESSION[$SISTEMA_SIGLA.'CEDULA']=odbc_result($result,"RIF");		

							
							$_SESSION[$SISTEMA_SIGLA.'BLOQUEADO']='NO';		
		
							$Arreglo["RESULTADO"]=1;
						}
					}
				}
			}
		}
	}
	else
	{			
		$Arreglo["CONEXION"]=$CONEXION;
		$Arreglo["ERROR"]=$ERROR;
		$Arreglo["MSJ_ERROR"]=$ResultadoEjecutar["MSJ_ERROR"];
	}
	
	echo json_encode($Arreglo);
	
	$Conector->Cerrar();
?>