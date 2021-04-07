<?php
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	$RIF=$_SESSION[$SISTEMA_SIGLA."RIF"];
	
	date_default_timezone_set('America/Caracas');
	
	$Conector=Conectar();

	$vSQL='SELECT * FROM VIEW_CLIENTE_LISTADO ORDER BY NB_CLIENTE';
								
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
			<table class="table table-bordered table-hover" role="grid" id="tablaClientes">
				<thead>
					<tr>							
						<th>
							RAZON SOCIAL
						</th>
						<th>
						    RIF
						</th>
						<th>
						    DIAS DE CREDITO
						</th>
						<th>
						   ESTATUS
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
				
				$NB_CLIENTE 		= odbc_result($resultPrin,"NB_CLIENTE");
				$RIF_CLIENTE 	= odbc_result($resultPrin,"RIF_CLIENTE");
				$DIAS_CREDITO = utf8_encode(odbc_result($resultPrin,"DIAS_CREDITO"));
				$ESTATUS_CLIENTE 		= utf8_encode(odbc_result($resultPrin,"ESTATUS_CLIENTE"));
				$ID 		= utf8_encode(odbc_result($resultPrin,"ID"));
				
				
				

				if ($ESTATUS_CLIENTE=='ACTIVO') 
				{
				$Modificar='
					<button type="button" class="btn btn-primary btn-xs" data-placement="top" data-toggle="tooltip" data-original-title="Modificar"  style=" cursor: pointer;" onClick="callFormModificar(\''.$ID.'\');">
				 		<i class="fa fa-pencil"></i>
				 	</button>';
				
				$Eliminar='
				 	<button type="button" class="btn btn-danger btn-xs" data-placement="top" data-toggle="tooltip" data-original-title="Anular" style=" cursor: pointer;" onClick="anular(\''.$ID.'\');">
				 		<i class="fa fa-trash"></i>
					 </button>';

				$Activar='
					 <button type="button" class="btn btn-primary btn-xs" data-placement="top" data-toggle="tooltip" data-original-title="Activar" disabled style=" cursor: pointer;" onClick="activar(\''.$ID.'\');">
						  <i class="fa fa-check"></i>
					  </button>';					
				} 
				 else 
				{
				 $Modificar='
				 	<button type="button" class="btn btn-primary btn-xs" data-placement="top" data-toggle="tooltip" data-original-title="Modificar" disabled  style=" cursor: pointer;" onClick="callFormModificar(\''.$ID.'\');">
				 		<i class="fa fa-pencil"></i>
				 	</button>';
				
				$Eliminar='
					<button type="button" class="btn btn-danger btn-xs" data-placement="top" data-toggle="tooltip" data-original-title="Anular" disabled style=" cursor: pointer;" onClick="anular(\''.$ID.'\');">
				 		<i class="fa fa-trash"></i>
					 </button>';
				
				$Activar='
					 <button type="button" class="btn btn-primary btn-xs" data-placement="top" data-toggle="tooltip" data-original-title="Activar" style=" cursor: pointer;" onClick="activar(\''.$ID.'\');">
						  <i class="fa fa-check"></i>
					  </button>';	
											
				}		
							
				
			
?>
					<tr>	
						<td width="10">
							<?php echo $NB_CLIENTE;?>
						</td>
						<td width="10">
							<?php echo $RIF_CLIENTE;?>
						</td>
						<td width="10">
							<?php echo $DIAS_CREDITO;?>
						</td>	
						<td width="10">
							<?php echo $ESTATUS_CLIENTE;?>
						</td>
						<td width="10">
							<?php echo $Modificar;?>
							<?php echo $Eliminar;?>
							<?php echo $Activar;?>
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