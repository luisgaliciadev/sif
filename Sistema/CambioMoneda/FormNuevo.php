<?php 
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	ValidarSesion($Nivel);
	
	$Nivel="";
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
    	<form id="vForm">
		<div class="row">  
			<div class="col-lg-12">  

			<div class="form-group">
			<label>Moneda:</label>
                    <select class="form-control" required name="ID_MONEDA" id="ID_MONEDA">
                    	<option value="" disabled selected>Seleccione...</option>
<?php 
						$Conector=Conectar();	

                        $vSQL='EXEC dbo.SP_CONSULTA_MONEDA_BASE 0';
						$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
                        
                        $CONEXION=$ResultadoEjecutar["CONEXION"];						
                        $ERROR=$ResultadoEjecutar["ERROR"];
                        $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
                        $result=$ResultadoEjecutar["RESULTADO"];
                        
                        if($CONEXION=="SI" and $ERROR=="NO")
                        {		
                            while ($registro=odbc_fetch_array($result))
                            {			
                                $ID_MONEDA=odbc_result($result,'ID_MONEDA');
                                $NB_MONEDA=utf8_encode(odbc_result($result,'NB_MONEDA'));								
                                        
                                echo "<option value='$ID_MONEDA'>$NB_MONEDA</option>";
                            }
                        }
                        else
                        {	
                            echo $MSJ_ERROR;
                            exit;
                        }
                        
                        $Conector->Cerrar();
?>           
					</select>
            </div>

			<div class="form-group">
			<label>Moneda Base:</label>
                    <select class="form-control" required name="ID_MONEDA_BASE" id="ID_MONEDA_BASE">
                    	<option value="" disabled selected>Seleccione...</option>
<?php 
						$Conector=Conectar();	

                        $vSQL='EXEC dbo.SP_CONSULTA_MONEDA';
						$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
                        
                        $CONEXION=$ResultadoEjecutar["CONEXION"];						
                        $ERROR=$ResultadoEjecutar["ERROR"];
                        $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
                        $result=$ResultadoEjecutar["RESULTADO"];
                        
                        if($CONEXION=="SI" and $ERROR=="NO")
                        {		
                            while ($registro=odbc_fetch_array($result))
                            {			
                                $ID_MONEDA=odbc_result($result,'ID_MONEDA');
                                $NB_MONEDA=utf8_encode(odbc_result($result,'NB_MONEDA'));								
                                        
                                echo "<option value='$ID_MONEDA'>$NB_MONEDA</option>";
                            }
                        }
                        else
                        {	
                            echo $MSJ_ERROR;
                            exit;
                        }
                        
                        $Conector->Cerrar();
?>           
					</select>
            </div>
			

			<div class="form-group" id="div_evento">
			<label>Moneda Referencia:</label>
                    <select class="form-control"  name="ID_MONEDA_REF" id="ID_MONEDA_REF">
                    	<option value="" disabled selected>Seleccione...</option>						
<?php 
						$Conector=Conectar();	

                        $vSQL='EXEC dbo.SP_CONSULTA_TB_MONEDA_REF';
						$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
                        
                        $CONEXION=$ResultadoEjecutar["CONEXION"];						
                        $ERROR=$ResultadoEjecutar["ERROR"];
                        $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
                        $result=$ResultadoEjecutar["RESULTADO"];
                        
                        if($CONEXION=="SI" and $ERROR=="NO")
                        {		
                            while ($registro=odbc_fetch_array($result))
                            {			
                                $ID_MONEDA_REF=odbc_result($result,'ID_MONEDA_REF');
                                $NB_MONEDA_REF=utf8_encode(odbc_result($result,'NB_MONEDA_REF'));								
                                        
                                echo "<option value='$ID_MONEDA_REF'>$NB_MONEDA_REF</option>";
                            }
                        }
                        else
                        {	
                            echo $MSJ_ERROR;
                            exit;
                        }
                        
                        $Conector->Cerrar();
?>           
					</select>
            </div>


			<div class="form-group">
				<label for="VALOR_CAMBIO">Valor Cambio:</label>
				<input id="VALOR_CAMBIO" type="text" class="form-control"   required>
			</div>

			<tr id="trf_cambio">
				<td align="right" style="padding-bottom:15px;">Desde:</td>
				<td style="padding-bottom:15px; padding-left:10px;">
				  <input type="text" id="f_cambio" class='form-control' readonly  title="No debe estar vacio"/>
				</td>
			</tr>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			</div>
		</div>		
		</div>
		</form>
		
        
        <script>
			$(document).ready(function(e) 
			{				
               window.parent.Cargando(0);
			$('#VALOR_CAMBIO').inputmask('999.999.999.999,99999', { numericInput: true });  

			$( "#f_cambio" ).datepicker(
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
					
				});				
				//$('#f_cambio').datepicker('setDate', 'today');


			$('#div_evento').hide();
				
			$( "#ID_MONEDA_BASE" ).change(function() {
				$('#div_evento').hide();				
				
				
				if ($("#ID_MONEDA_BASE").val() == '')
					return false
				
				
				var ID_MONEDA_BASE = $("#ID_MONEDA_BASE").val();				
				Parametros="ID_MONEDA_BASE="+ID_MONEDA_BASE;
				//alert(Parametros)	
				//return 			 
				$.ajax(
					{
					type: "POST",
					dataType:"html",
					url: "Sistema/CambioMoneda/buscar_moneda.PHP",			
					data: Parametros,	
					beforeSend: function() 
					{
						window.parent.Cargando(1);
					},												
					cache: false,			
					success: function(Resultado)
					{
					//	alert(Resultado);
											
						var Arreglo=jQuery.parseJSON(Resultado);
					
						var CONEXION=Arreglo['CONEXION'];
						
						if(CONEXION=="NO")
						{		
							window.parent.Cargando(0);
									
							var MSJ_ERROR=Arreglo['MSJ_ERROR'];	
<?php
							if(IpServidor()=="10.10.30.52")
							{
?>	
								alert(MSJ_ERROR);
<?php
							}
?>
							window.parent.MostrarMensaje("Rojo", "Error, No se puedo conectar con el servidor, contacte al personal del departamento de sistemas.");
						}
						else
						{
							var ERROR=Arreglo['ERROR'];
						
							if(ERROR=="SI")
							{		
								window.parent.Cargando(0);
										
								var MSJ_ERROR=Arreglo['MSJ_ERROR'];	
	<?php
								if(IpServidor()=="10.10.30.52")
								{
	?>	
									alert(MSJ_ERROR);
	<?php
								}
	?>								
								//alert('hola ERROR')								
								window.parent.MostrarMensaje("Rojo", "Error de sentencia SQL, contacte al personal del departamento de sistemas.");
								
							}
							else
							{
								window.parent.Cargando(0);	
													
								var FG_BASE = Arreglo['FG_BASE'];	
								if (FG_BASE==1)	
								{
																							
									$('#div_evento').val('1');									
									$('#div_evento').show();									
								}
								else
								{
									$('#div_evento').val('0');
									$('#ID_MONEDA_REF').val('');
								}
												
							}
						}		
					}						
				});	
			});

			
			    $('#vForm').on('submit', function(e) 
				{
					e.preventDefault();
					
					Guardar();
				});
            });
			
			function Guardar()
			{	                					
				var ID_MONEDA=$("#ID_MONEDA").val();
				var	ID_MONEDA_BASE=$("#ID_MONEDA_BASE").val();
				var	ID_MONEDA_REF=$("#ID_MONEDA_REF").val();
				var	div_evento=$("#div_evento").val();				
				//alert(div_evento)

				if(ID_MONEDA==ID_MONEDA_BASE)
				{
					window.parent.MostrarMensaje("Rojo", "Disculpe, debe seleccionar monedas diferentes");
					return 	
				}
				 
				if(ID_MONEDA_REF==null)					
				{					
					if(div_evento=='1')						{
						window.parent.MostrarMensaje("Rojo", "Disculpe, debe Seleccionar una Moneda Referencia");						
						return 	
					}
					else
					{
						var	ID_MONEDA_REF='0';						
					}				
				}
				//alert(ID_MONEDA_REF)
			//	return 				
				
				
				var	VALOR_CAMBIO=retornar_num_mask($("#VALOR_CAMBIO").val());

				//alert(VALOR_CAMBIO)
				//return 
				var	f_cambio=$("#f_cambio").val();						
				if(f_cambio=='')
				{
					window.parent.MostrarMensaje("Rojo", "Disculpe, debe ingresar una fecha de cambio");
					return 	
				}
				var	f_cambio2 = f_cambio.split('/');
				var fecha_cambio=f_cambio2[0]+'-'+f_cambio2[1]+'-'+f_cambio2[2];
				//alert(fecha_cambio)
				//return 



				
				Parametros="ID_MONEDA="+ID_MONEDA+"&ID_MONEDA_BASE="+ID_MONEDA_BASE+"&ID_MONEDA_REF="+ID_MONEDA_REF+"&VALOR_CAMBIO="+VALOR_CAMBIO+"&fecha_cambio="+fecha_cambio;
				//alert(Parametros);
				//return
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/CambioMoneda/ScriptGuardar.PHP",			
					data: Parametros,	
					beforeSend: function() 
					{
						window.parent.Cargando(1);
					},												
					cache: false,			
					success: function(Resultado)
					{
						//alert(Resultado);
						
						if(window.parent.ValidarConexionError(Resultado)==1)
						{
							var Arreglo=jQuery.parseJSON(Resultado);
							
							var EXISTE=Arreglo['EXISTE'];
							//var fecha_final=Arreglo['fecha_final'];
							//var HOLA=Arreglo['HOLA'];
							//alert(HOLA)
						//	var vSQL=Arreglo['vSQL'];
							//alert(vSQL)
							//alert(fecha_final)

							if(EXISTE=="SI")
							{
								window.parent.Cargando(0);
								
								window.parent.MostrarMensaje("Amarillo", "Disculpe, Ya se encuentra registrado!");
								
								$("#NB").focus();
							}
							else
							{		
								//var ID=Arreglo['ID'];	
								//alert(ID)
								window.parent.FiltroConsulta(1);								
								window.parent.$("#vModal").modal('toggle');	
								$('#div_evento').hide();							
								window.parent.MostrarMensaje("Verde", "Operaci&oacute;n realizada exit&oacute;samente.");
								
							}
						}		
					}						
				});
			}

function retornar_num_mask(monto) {

	var monto_aux = monto.split(',')
	var new_monto = monto_aux[0].replace(/\./g, '');
	new_monto = new_monto.replace(/\_/g, '');
	return new_monto + "." + monto_aux[1]

}

			
        </script>
    </body>
</html>