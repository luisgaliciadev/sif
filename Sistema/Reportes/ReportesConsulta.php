<?php
	$Nivel="../../";	
	include($Nivel."includes/PHP/funciones.php");
	
	$conector=Conectar();
	
	session_start();
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	$ID_ROL = $_SESSION[$SISTEMA_SIGLA."ID_ROL"];
	$ID_USUARIO=$_SESSION[$SISTEMA_SIGLA.'ID_USUARIO'];
	$ID_LOCALIDAD=$_SESSION[$SISTEMA_SIGLA.'ID_LOCALIDAD'];

	
	$id_reporte=$_POST['id_reporte'];
	
	$vSQL="SELECT  * FROM VIEW_REPORTES
WHERE        (ID_REPORTE = $id_reporte) and fg_activo = 1 and id_rol = $ID_ROL ORDER BY ARGUMENTO ASC";
					
	
	$ResultadoEjecutar=$conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ResultadoEjecutar["CONEXION"];						
	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$result=$ResultadoEjecutar["RESULTADO"];
	
	?> 

<table>

<?php
	if($CONEXION=="SI" and $ERROR=="NO")
	{				
		$Conector_aux=Conectar();	
		while ($registro=odbc_fetch_array($result))
		{
			$ite++;
			
		  	
			$ARGUMENTO=odbc_result($result,'ARGUMENTO');
			
			$NB_HOJA=odbc_result($result,'NB_HOJA');
			$NB_REPORTE=odbc_result($result,'NB_REPORTE');
			$DS_REPORTE=utf8_encode(odbc_result($result,'DS_REPORTE'));
						
			
			
			if($ite==1)
			{	
				echo '<div class="form-group col-md-12" >
					<label> Descripción del reporte:</label>
					<textarea id="des" class="form-control" DISABLED>'.$DS_REPORTE.'</textarea>
				</DIV>';
          		echo '<input type="hidden" name="NB_HOJA" id="NB_HOJA" value="'.$NB_HOJA.'">';
          		echo '<input type="hidden" name="NB_REPORTE" id="NB_REPORTE" value="'.$NB_REPORTE.'">';
			}
			
			// CAMBIO A CONTORL IF.. POR ERROR EN SWICTH,  27/03/2018
			
			
			 
			switch($ARGUMENTO)
			{
			 
			  
			  case "f_desde":
				?>
			  <tr id="trf_desde">
				<td align="right" style="padding-bottom:15px;">Desde:</td>
				<td style="padding-bottom:15px; padding-left:10px;">
				  <input type="text" id="f_desde" class='form-control' readonly  title="No debe estar vacio"/>
				</td>
			  </tr>
			  <?php
			  break;
			  
			  case "f_hasta":
				?>
			  <tr id="trf_hasta">
				<td align="right" style="padding-bottom:15px;">Hasta:</td>
				<td style="padding-bottom:15px; padding-left:10px;">
				<input type="text" id="f_hasta" class='form-control' readonly title="No debe estar vacio"/>
				
				</td>
			  </tr>
			  <?php
			  break;
								
				case "RangoFecha":
				?>
			  <tr id="trrango">
				<td align="right" style="padding-bottom:15px;">Seleccione:</td>
				<td style="padding-bottom:15px; padding-left:10px;">
					<div class="form-group col-md-12">
						<label> Desde - Hasta</label> 
						<div class="input-group" >
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
							<input type="text" class="form-control pull-right" id="RangoFecha" name="RANGO DE FECHA" required>
						</div>
					</div>
				
				</td>
			  </tr>
			  <?php
			  break;

			 
			
			case "Rif":
				?>	
				<tr id="trRif">
					<td align="right" style="padding-bottom:15px; padding-left:10px;"><label>Rif Cliente:</label></td>
			  		<td style="padding-bottom:15px; padding-left:10px;">
			  		<select class="form-control" required name="rif" id="rif">
				  		<option value="" disabled selected>Seleccione...</option>
					</select>
					</td>
			  	</tr>
			  	 <?php
				  break;
					
			case "Codigo":
				?>	
				<tr id="trCodigo">
					<td align="right" style="padding-bottom:15px; padding-left:10px;"><label>TASA / TARIFA:</label></td>
			  		<td style="padding-bottom:15px; padding-left:10px;">
			  		<select class="form-control" required name="Codigo" id="Codigo">
				  		<option value="" disabled selected>Seleccione...</option>
					</select>
					</td>
			  	</tr>
			  	 <?php
				  break;
				  
			case "NroDocument":
				  ?>
				<tr id="trNroDocument">
				  <td align="right" style="padding-bottom:15px;">Nro. Documento:</td>
				  <td style="padding-bottom:15px; padding-left:10px;">
				  <input type="text" id="nro_documento" class="form-control" name="nro_documento" style="float:left; width:100%;"  title="No debe estar vacio" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>
				  
					</td>
				</tr>
				<?php
				break;

			case "NroControl":
				?>
			  <tr id="trNroControl">
				<td align="right" style="padding-bottom:15px;">Nro. Control:</td>
				<td style="padding-bottom:15px; padding-left:10px;"><input type="text" id="nro_control" class="form-control" name="solicitud" style="float:left; width:100%;"  title="No debe estar vacio" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>
				
				  </td>
			  </tr>
			  <?php
			  break;
		  

		  case "tipo_mov":
				
			  ?>
			<tr id="trtipo_mov">
			
			<TD align="right" style="padding-bottom:15px; padding-left:10px;"><label>Tipo Movimiento:</label></TD>
			<td style="padding-bottom:15px; padding-left:10px;">
			<select class="form-control" required name="tipo_mov" id="tipo_mov">
				<option value="" disabled selected>Seleccione...</option>
<?php 
				

				$vSQL='SELECT ID_TP_MOVIMIENTO AS ID, NB_TP_MOVIMIENTO AS NB, PORC_TP_MOVIMIENTO AS PORC FROM TB_TP_MOVIMIENTO WHERE FG_ACT_TP_MOVIMIENTO=1 AND FG_AVISO=1';
			  				
				$ResultadoEjecutar=$Conector_aux->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
				
				$CONEXION=$ResultadoEjecutar["CONEXION"];						
				$ERROR=$ResultadoEjecutar["ERROR"];
				$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
				$result_aux=$ResultadoEjecutar["RESULTADO"];
				
				if($CONEXION=="SI" and $ERROR=="NO")
				{		
					while ($registro_aux=odbc_fetch_array($result_aux))
					{			
						$ID_TP_MOVIMIENTO=odbc_result($result_aux,'ID');
						$NB_TP_MOVIMIENTO=utf8_encode(odbc_result($result_aux,'NB'));								
								
						echo "<option value='$ID_TP_MOVIMIENTO'>$NB_TP_MOVIMIENTO</option>";
					}
				}
				else
				{	
					echo $MSJ_ERROR;
					exit;
				}
				
				
?>           
			</select>
			</td>
			</tr>
			
			<?php
		  break;
			  
		  
			case "CLASIF_PAGO":
			  ?>
			<tr id="trCLASIF_PAGO">
			<td align="right" style="padding-bottom:15px; padding-left:10px;"><label>Clasificacion Pago:</label></td>
			<td style="padding-bottom:15px; padding-left:10px;"><select class="form-control" required name="CLASIF_PAGO" id="CLASIF_PAGO">
				<option value="" disabled selected>Seleccione...</option>
<?php 
				$vSQL='SELECT ID_CLASIF_TP_PAGO AS ID,  NB_CLASIF_TP_PAGO AS NB FROM TB_CLASIF_TP_PAGO	WHERE FG_RET=0 AND FG_ACT_CLASIF_TP_PAGO=1';
			  				
				$ResultadoEjecutar=$Conector_aux->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
				
				$CONEXION=$ResultadoEjecutar["CONEXION"];						
				$ERROR=$ResultadoEjecutar["ERROR"];
				$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
				$result=$ResultadoEjecutar["RESULTADO"];
				
				if($CONEXION=="SI" and $ERROR=="NO")
				{		
					while ($registro_aux=odbc_fetch_array($result_aux))
					{			
						$ID_CLASIF_TP_PAGO=odbc_result($result_aux,'ID');
						$NB_CLASIF_TP_PAGO=utf8_encode(odbc_result($result_aux,'NB'));								
								
						echo "<option value='$ID_CLASIF_TP_PAGO'>$NB_CLASIF_TP_PAGO</option>";
					}
				}
				else
				{	
					echo $MSJ_ERROR;
					exit;
				}
				
?>           
			</select>
				</td>
			</tr>
			
			<?php
		  break;

		  case "TIPO_SERV":
		  ?>
		<tr id="trTIPO_SERV">
			<td align="right" style="padding-bottom:15px; padding-left:10px;"><label>Tipo Servicio:</label></td>
			<td style="padding-bottom:15px; padding-left:10px;">
			<select class="form-control" required name="TIPO_SERV" id="TIPO_SERV">
			<option value="" disabled selected>Seleccione...</option>
<?php 
			
			$vSQL='SELECT ID_TP_SERVICIO, NB_TP_SERVICIO, [FG_BUSQUEDA_SECUN], [ID_TB_SIST_OPER] AS ID_SISTEMA FROM [dbo].[TB_TP_SERVICIO]	WHERE[FG_ACT_TP_SERVICIO]=1';
						  
			$ResultadoEjecutar=$Conector_aux->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
			
			$CONEXION=$ResultadoEjecutar["CONEXION"];						
			$ERROR=$ResultadoEjecutar["ERROR"];
			$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
			$result_aux=$ResultadoEjecutar["RESULTADO"];
			
			if($CONEXION=="SI" and $ERROR=="NO")
			{		
				while ($registro_aux=odbc_fetch_array($result_aux))
				{			
					$ID_TP_SERVICIO=odbc_result($result_aux,'ID_TP_SERVICIO');
					$NB_TP_SERVICIO=utf8_encode(odbc_result($result_aux,'NB_TP_SERVICIO'));								
							
					echo "<option value='$ID_TP_SERVICIO'>$NB_TP_SERVICIO</option>";
				}
			}
			else
			{	
				echo $MSJ_ERROR;
				exit;
			}
	
?>           
		</select>
		</td>
		</tr>
		
		<?php
	  break;

	  case "SISTEMA":
	  ?>
	<tr id="trSISTEMA">
	<td  align="right" style="padding-bottom:15px; padding-left:10px;"><label>Tipo Servicio:</label></td>
	<td style="padding-bottom:15px; padding-left:10px;">
	<select class="form-control" required name="SISTEMA" id="SISTEMA">
		<option value="" disabled selected>Seleccione...</option>
<?php 
		
		$vSQL='EXEC dbo.SP_TB_SIST_OPER';
					  
		$ResultadoEjecutar=$Conector_aux->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
		
		$CONEXION=$ResultadoEjecutar["CONEXION"];						
		$ERROR=$ResultadoEjecutar["ERROR"];
		$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
		$result_aux=$ResultadoEjecutar["RESULTADO"];
		
		if($CONEXION=="SI" and $ERROR=="NO")
		{		
			while ($registro_aux=odbc_fetch_array($result_aux))
			{			
				$ID_TB_SIST_OPER=odbc_result($result_aux,'ID_TB_SIST_OPER');
				$NB_SIST_OPER=utf8_encode(odbc_result($result_aux,'NB_SIST_OPER'));								
						
				echo "<option value='$ID_TB_SIST_OPER'>$NB_SIST_OPER</option>";
			}
		}
		else
		{	
			echo $MSJ_ERROR;
			exit;
		}
	
?>           
	</select>
		</td>
	</tr>
	
	<?php
  break;
		 case "Localidad":
				?>
			  <tr id="trpuerto">
			  <td align="right" style="padding-bottom:15px; padding-left:10px;"><label>Localidad:</label></td>
			 <td style="padding-bottom:15px; padding-left:10px;"><select class="form-control" required name="puerto" id="puerto">
				  <option value="" disabled selected>Seleccione...</option>
<?php 
				  // Localidades por rol 
				if($ID_ROL==1 or $ID_ROL==5 )// ADMINISTRADOR O INGRESOS SEDE CENTRAL 
				{
					$vSQL='SELECT DISTINCT ID_LOCALIDAD,NB_LOCALIDAD FROM VIEW_LOCALIDAD ORDER BY NB_LOCALIDAD ASC';
				}
				else
				{
					 $vSQL='SELECT DISTINCT ID_LOCALIDAD,NB_LOCALIDAD FROM VIEW_LOCALIDAD WHERE ID_LOCALIDAD='.$ID_LOCALIDAD.' ORDER BY NB_LOCALIDAD ASC';
				}
						
				  $ResultadoEjecutar=$Conector_aux->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
				  
				  $CONEXION=$ResultadoEjecutar["CONEXION"];						
				  $ERROR=$ResultadoEjecutar["ERROR"];
				  $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
				  $result_aux=$ResultadoEjecutar["RESULTADO"];
				  
				  if($CONEXION=="SI" and $ERROR=="NO")
				  {		
					  while ($registro_aux=odbc_fetch_array($result_aux))
					  {			
						  $ID_LOCALIDAD=odbc_result($result_aux,'ID_LOCALIDAD');
						  $NB_LOCALIDAD=utf8_encode(odbc_result($result_aux,'NB_LOCALIDAD'));								
								  
						  echo "<option value='$ID_LOCALIDAD'>$NB_LOCALIDAD</option>";
					  }
				  }
				  else
				  {	
					  echo $MSJ_ERROR;
					  exit;
				  }
			
?>           
			  </select>
			  </td>
			  </tr>
			  
			  <?php
			break;			
					
					

			}
		}
	}
	else
	{
		echo $MSJ_ERROR;
		exit;
	}
	
	$conector->Cerrar();
	$Conector_aux->Cerrar();

	
?>
<tr>
		<td colspan="2">
		<button type="BUTTON" class="btn btn-warning" id="visualizar">Visualizar Reporte</button>		
		</td>
</tr>
</table>


<script>
$( document ).ready(function() {
	
	$("#visualizar" ).click(function() {
		impr_reporte()
	});

	$("#rif").select2({
				language: "es",
                placeholder: "Seleccione un Cliente",
                allowClear: true,
                minimumInputLength: 0,
                ajax: 
                {
                    url: "Sistema/Reportes/BuscarComboCliente.php",
                    dataType: 'json',
                    type: "POST",
                    delay: 250,
                    data: (term) => {
                        let valor = term.term;

                        if(!valor)
                        {
                            valor = "";
                        }

                        return {
                            buscar : valor
                        };
                    },
                    beforeSend: (xhr) => {
                        //xhr.setRequestHeader("Authorization", this.token);
                    },
                    processResults: (data) => {
                        var myResults = [];
                        $.each(data.json, (index, item) => {
                            myResults.push({
                            'id': item.id,
                            'text': item.text
                            });
                        });
                        return {
                            results: myResults
                        };
                    }
                }
            });

	$("#Codigo").select2({
				language: "es",
                placeholder: "Seleccione un Codigo TASA / TARIFA",
                allowClear: true,
                minimumInputLength: 0,
                ajax: 
                {
                    url: "Sistema/Reportes/BuscarComboTarifa.php",
                    dataType: 'json',
                    type: "POST",
                    delay: 250,
                    data: (term) => {
                        let valor = term.term;

                        if(!valor)
                        {
                            valor = "";
                        }

                        return {
                            buscar : valor
                        };
                    },
                    beforeSend: (xhr) => {
                        //xhr.setRequestHeader("Authorization", this.token);
                    },
                    processResults: (data) => {
                        var myResults = [];
                        $.each(data.json, (index, item) => {
                            myResults.push({
                            'id': item.id,
                            'text': item.text
                            });
                        });
                        return {
                            results: myResults
                        };
                    }
                }
            });
	
	$( "#f_desde" ).datepicker(
				{
					defaultDate: "+1w",
					changeYear: true,
					changeMonth: true,
					yearRange: '-100:+1',
					numberOfMonths: 1,
					monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
					monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
					monthStatus: 'Ver otro mes', 
					yearStatus: 'Ver otro año',
					dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
					dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
					dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
					onClose: function( selectedDate ) 
					{
						$( "#f_hasta" ).datepicker( "option", "minDate", selectedDate );
					}
				});				
				
				$( "#f_hasta" ).datepicker(
				{
					defaultDate: "+1w",
					changeYear: true,
					changeMonth: true,
					yearRange: '-100:+1',
					numberOfMonths: 1,
					dateFormat: 'dd/mm/yy',
					monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
					monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
					monthStatus: 'Ver otro mes', 
					yearStatus: 'Ver otro año',
					dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
					dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
					dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
					onClose: function( selectedDate ) 
					{
						$( "#f_desde" ).datepicker( "option", "maxDate", selectedDate );
					}
				});
				
				$('#f_hasta').datepicker('setDate', 'today');				
				$('#f_desde').datepicker('setDate', 'today');	

				var today = new Date(); 
				var dd = today.getDate(); 
				var mm = today.getMonth()+1; //January is 0! 
				var yyyy = today.getFullYear(); 
				var HH = today.getHours(); 
				var MM = today.getSeconds(); 
				var HHEND =  today.getHours() + 2 ; 
				if(dd<10){ dd='0'+dd } 
				if(mm<10){ mm='0'+mm } 
				var today = dd+'/'+mm+'/'+yyyy; 

            

				
				$('#RangoFecha').daterangepicker(
				{
					timePicker : false,
					timePicker24Hour: false,
					timePickerIncrement: 10,	
					endDate: moment().add(2, 'hours'),			
					"locale": 
					{
						"format": "DD/MM/YYYY",
						"separator": " - ",
						"applyLabel": "Aplicar",
						"cancelLabel": "Cancelar",
						"fromLabel": "Desde",
						"toLabel": "Hasta",
						"customRangeLabel": "Custom",
						"daysOfWeek": [
							"Do",
							"Lu",
							"Ma",
							"Mi",
							"Ju",
							"Vi",
							"Sa"
						],
						"monthNames": [
							"Enero",
							"Febrero",
							"Marzo",
							"Abril",
							"Mayo",
							"Junio",
							"julio",
							"Agosto",
							"Septiembre",
							"Octubre",
							"Noviembre",
							"Diciembre"
						],
						"firstDay": 1
					}				
            	});
				

});

</script>



