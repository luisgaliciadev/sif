<?php
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
		
	date_default_timezone_set('America/Caracas');
	
	$Conector=Conectar();

	$vSQL='SELECT NB, ID, FG_ACT_TP_MONEDA, F_REG, LOGIN_USER, SIMBOLO, FG_BASE FROM VIEW_TB_TP_MONEDA_LISTADO';
								
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
							MONEDA
						</th>
                        <th>
							SIMBOLO MONEDA
						</th>
                        <th>
							MONEDA BASE
						</th>
						<th>
							ESTATUS
						</th>
						<th>
							ULTIMO USUARIO QUE MODIFICO
						</th>
						<th>
							FECHA ULTIMA MODIFICACIÓN
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
				$SIMBOLO 			= utf8_decode(odbc_result($resultPrin,"SIMBOLO"));
				$FG_BASE 			= odbc_result($resultPrin,"FG_BASE");
				$FG_ACT_TP_MONEDA 	= odbc_result($resultPrin,"FG_ACT_TP_MONEDA");
				$LOGIN_USER 		= odbc_result($resultPrin,"LOGIN_USER");
				$F_REG         	    = odbc_result($resultPrin,"F_REG");
				$ID 				= odbc_result($resultPrin,"ID");
			

				if($FG_ACT_TP_MONEDA==1)
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
						<td width="20">
							<?php echo $NB;?>
						</td>
						<td width="20">
							<?php echo $SIMBOLO;?>
						</td>
                        <td width="20">
							<?php echo $FG_BASE;?>
						</td>
                        <td width="25">
							<?php echo $DS_ESTATUS;?>
						</td>
						<td width="10">
							<?php echo $LOGIN_USER;?>
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