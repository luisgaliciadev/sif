<?php
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
		
	date_default_timezone_set('America/Caracas');
	
	$Conector=Conectar();

	$vSQL='SELECT * FROM VIEW_TB_CUENTA_LISTADO';
								
	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="NO", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ResultadoEjecutar["CONEXION"];

	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$resultPrin=$ResultadoEjecutar["RESULTADO"];

	if($CONEXION=="SI" and $ERROR=="NO")
	{			
?>
	<div class="row">
		<div class="col-lg-12">
			<table class="table table-bordered table-hover" role="grid" id="tablaCuentas">
				<thead>
					<tr>							
						<th>
							NRO. CUENTA
						</th>						
						<th>
							BANCO
						</th>
						<th>
							MONEDA
						</th>
						<th>
							CODIGO SWIFT
						</th>
						<th>
							CODIGO IBAM
						</th>	
						<th>
							LOCALIDAD
						</th>
						<th>
							BENEFICIARIO
						</th>
						<th>
							USUARIO REGISTRO
						</th>					
												
						<th class="text-center">
							<button type="button" class="btn btn-success btn-xs"onClick="callFormRegistrar();" data-placement="top" data-toggle="tooltip" data-original-title="Agregar" style=" cursor: pointer;">
								<i class="fa fa-plus"></i>
							</button>
						</th>
					</tr>
				</thead>
				<tbody>
<?php
			while (odbc_fetch_row($resultPrin))  
			{
				$Ite++;
				
				$NRO_CUENTA 	= odbc_result($resultPrin,"NRO_CUENTA");
				$NB_BANCO 		= odbc_result($resultPrin,"NB_BANCO");
				$NB_MONEDA 	    = odbc_result($resultPrin,"NB_MONEDA");
				$CODIGO_SWIFT 	= odbc_result($resultPrin,"CODIGO_SWIFT");
				$CODIGO_IBAN 	= odbc_result($resultPrin,"CODIGO_IBAN");	
				$NB_LOCALIDAD 	= odbc_result($resultPrin,"NB_LOCALIDAD");	
				$BENEFICIARIO 	= odbc_result($resultPrin,"BENEFICIARIO");			
				$LOGIN_USER 	= odbc_result($resultPrin,"LOGIN_USER");
				$ID 			= odbc_result($resultPrin,"ID_CUENTA");
			
				$Modificar='
					<button type="button" class="btn btn-primary btn-xs" data-placement="top" data-toggle="tooltip" data-original-title="Modificar" style=" cursor: pointer;" onClick="callFormModificar(\''.$ID.'\');">
						<i class="fa fa-pencil"></i>
					</button>';
				
				$Eliminar='
					<button type="button" class="btn btn-danger btn-xs" data-placement="top" data-toggle="tooltip" data-original-title="Anular" style=" cursor: pointer;" onClick="anular(\''.$ID.'\');">
						<i class="fa fa-trash"></i>
					</button>';
?>
					<tr>	
						<td width="25">
							<?php echo $NRO_CUENTA;?>
						</td>
						<td width="25">
							<?php echo $NB_BANCO;?>
						</td>
						<td width="25">
							<?php echo $NB_MONEDA;?>
						</td>
						<td width="25">
							<?php echo $CODIGO_SWIFT;?>
						</td>	
						<td width="25">
							<?php echo $CODIGO_IBAN;?>
						</td>	
						<td width="25">
							<?php echo $NB_LOCALIDAD;?>
						</td>	
						<td width="25">
							<?php echo $NB_LOCALIDAD;?>
						</td>	
						<td width="25">
							<?php echo $BENEFICIARIO;?>
						</td>	
						<td width="25">		
																	
							<?php echo $Eliminar;?>
						</td>												
					</tr>
<?php
			}
?>
				</tbody>
			</table>
		</div>
	</div>
    <hr>
<?php
	}
	else
	{
		echo $vSQL;
	}
	
	$Conector->Cerrar();
?>