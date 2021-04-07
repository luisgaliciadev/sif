<?php
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	date_default_timezone_set('America/Caracas');
	
	$Conector=Conectar();

	$vSQL='SELECT  NB_BANCO, NB_CORTO, F_REG, FG_RECAUDADOR, FG_INTERMEDIARIO, LOGIN_USER FROM  VIEW_TB_BANCO_LISTADO';
								
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
							ENTIDAD BANCARIA
						</th>
						<th>
							NOMBRE CORTO
						</th>
						<th>
							FECHA REGISTRO
						</th>
						<th>
							BANCO RECAUDADOR
						</th>
						<th>
							BANCO INTERMEDIARIO
						</th>
						<th>
							CREADO POR
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
				
				$NB_BANCO 				= odbc_result($resultPrin,"NB_BANCO");
				$NB_CORTO		 		= odbc_result($resultPrin,"NB_CORTO");
				$F_REG			 		= FechaHoraNormal (odbc_result($resultPrin,"F_REG"));
				$FG_RECAUDADOR 			= odbc_result($resultPrin,"FG_RECAUDADOR");
				$FG_INTERMEDIARIO		= odbc_result($resultPrin,"FG_INTERMEDIARIO");
				$LOGIN_USER 			= odbc_result($resultPrin,"LOGIN_USER");
				$ID						= odbc_result($resultPrin,"ID");

								
				
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
						<td width="30">
							<?php echo $NB_BANCO;?>
						</td>
						<td width="10">
							<?php echo $NB_CORTO;?>
						</td>
						<td width="10">
							<?php echo $F_REG;?>
						</td>
						<td width="10">
							<?php echo $FG_RECAUDADOR;?>
						</td>
						<td width="10">
							<?php echo $FG_INTERMEDIARIO;?>
                            </td>
                         <td width="10">
							<?php echo $LOGIN_USER;?>
						  
											
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