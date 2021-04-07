<?php
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	date_default_timezone_set('America/Caracas');
	
	$Conector=Conectar();

	$vSQL='SELECT    ID, NB, FG_ACTIVO, LOGIN_USER, F_REG, NB_LOCALIDAD	 FROM  VIEW_TB_CTRO_FACTURACION_LISTADO';
								
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
							NOMBRE CENTRO DE FACTURACION
						</th>
						<th>
							USUARIO
						</th>
						<th>
							LOCALIDAD
						</th>
						<th>
							ESTATUS
						</th>
						<th>
							ULTIMA MODIFICACION
						</th>
						
												
						<th class="text-center">
							<button type="button" class="btn btn-success btn-xs" onClick="callFormRegistrar();" data-placement="top" data-toggle="tooltip" data-original-title="Agregar" style=" cursor: pointer;">
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
				
				$NB 				= odbc_result($resultPrin,"NB");
				$LOGIN_USER 		= odbc_result($resultPrin,"LOGIN_USER");
				$NB_LOCALIDAD 		= odbc_result($resultPrin,"NB_LOCALIDAD");
				$FG_ACTIVO 			= odbc_result($resultPrin,"FG_ACTIVO");
				$F_REG 				= odbc_result($resultPrin,"F_REG");
				$ID 				= odbc_result($resultPrin,"ID");


				if($FG_ACTIVO==1)
				{
					$DS_ESTATUS="ACTIVO";
				}

//$ID_LOCALIDAD 		= odbc_result($resultPrin,"ID_LOCALIDAD");

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
						<td width="20">
							<?php echo $NB;?>
						</td>
						<td width="10">
							<?php echo $LOGIN_USER;?>
						</td>
						<td width="25">
							<?php echo $NB_LOCALIDAD;?>
						</td>
						<td width="10">
							<?php echo $DS_ESTATUS;?>
						</td>
						<td width="10">
							<?php echo $F_REG;?>
						</td>
							
						<td width="10">
							<?php echo $Modificar;?>
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