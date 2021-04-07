<?php
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
		
	date_default_timezone_set('America/Caracas');
	
	$Conector=Conectar();

	$vSQL='SELECT * FROM VIEW_TB_TALONARIO_LISTADO';
								
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
			<table class="table table-bordered table-hover" role="grid" id="tablaUsuarios">
				<thead>
					<tr>							
						<th>
							NRO. SERIE
						</th>						
						<th>
							NRO. DOCUMENTO DESDE
						</th>
						<th>
							NRO. DOCUMENTO HASTA
						</th>
						<th>
							NRO. DOCUMENTO ACTUAL
						</th>						
						<th>
							NRO. CONTROL DESDE
						</th>
						<th>
							NRO. CONTROL HASTA
						</th>
						<th>
							NRO. CONTROL ACTUAL
						</th>
						<th>
							CENTRO FACTURACION
						</th>
						<th>
							LOCALIDAD
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
				
				$NB_SERIE 				= odbc_result($resultPrin,"NB_SERIE");
				$NRO_DESDE_DOC 				= odbc_result($resultPrin,"NRO_DESDE_DOC");
				$NRO_HASTA_DOC 	= odbc_result($resultPrin,"NRO_HASTA_DOC");
				$NRO_ACTUAL_DOC 		= odbc_result($resultPrin,"NRO_ACTUAL_DOC");
				$NRO_DESDE_CONTROL 	= odbc_result($resultPrin,"NRO_DESDE_CONTROL");
				$NRO_HASTA_CONTROL 		= odbc_result($resultPrin,"NRO_HASTA_CONTROL");
				$NRO_ACTUAL_CONTROL 		= odbc_result($resultPrin,"NRO_ACTUAL_CONTROL");
				$NB_CTRO_FACTURACION         	    = odbc_result($resultPrin,"NB_CTRO_FACTURACION");
				$NB_LOCALIDAD 				= odbc_result($resultPrin,"NB_LOCALIDAD");
				$FG_ACT_TALONARIO 				= odbc_result($resultPrin,"FG_ACT_TALONARIO");
				$ID 				= odbc_result($resultPrin,"ID");
			

				if($FG_ACT_TALONARIO==1)
				{
					$DS_ESTATUS="ACTIVO";
				}

				/*if ($ID_LOCALIDAD) {
					$NB_LOCALIDAD = utf8_encode(odbc_result($resultPrin,"NB_LOCALIDAD"));
				} else {
					$NB_LOCALIDAD = "TODOS LOS PUERTOS";
				} */					
				
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
							<?php echo $NB_SERIE;?>
						</td>
						<td width="25">
							<?php echo $NRO_DESDE_DOC;?>
						</td>
						<td width="25">
							<?php echo $NRO_HASTA_DOC;?>
						</td>
						<td width="25">
							<?php echo $NRO_ACTUAL_DOC;?>
						</td>						
						<td width="25">
							<?php echo $NRO_DESDE_CONTROL;?>
						</td>
						<td width="25">
							<?php echo $NRO_HASTA_CONTROL;?>
						</td>
						<td width="25">
							<?php echo $NRO_ACTUAL_CONTROL;?>
						</td>
						<td width="25">
							<?php echo $NB_CTRO_FACTURACION;?>
						</td>
						<td width="25">
							<?php echo $NB_LOCALIDAD;?>
						</td>
						
						<td width="25">
							<?php /*echo $Modificar;*/?>
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