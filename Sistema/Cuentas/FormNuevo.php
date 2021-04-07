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

                        $vSQL='EXEC dbo.SP_TB_TP_MONEDA';
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
			<label>Localidad:</label>
                    <select class="form-control" required name="ID_LOCALIDAD" id="ID_LOCALIDAD" onChange="BuscarBanco();">
                    	<option value="" disabled selected>Seleccione...</option>
<?php 
						$Conector=Conectar();	

                        $vSQL="SELECT ID_LOCALIDAD, NB_LOCALIDAD FROM TB_LOCALIDAD WHERE FG_ACT_LOCALIDAD=1 ORDER BY NB_LOCALIDAD ASC";
						$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
                        
                        $CONEXION=$ResultadoEjecutar["CONEXION"];						
                        $ERROR=$ResultadoEjecutar["ERROR"];
                        $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
                        $result=$ResultadoEjecutar["RESULTADO"];
                        
                        if($CONEXION=="SI" and $ERROR=="NO")
                        {		
                            while ($registro=odbc_fetch_array($result))
                            {			
                                $ID_LOCALIDAD=odbc_result($result,'ID_LOCALIDAD');
                                $NB_LOCALIDAD=utf8_encode(odbc_result($result,'NB_LOCALIDAD'));								
                                        
                                echo "<option value='$ID_LOCALIDAD'>$NB_LOCALIDAD</option>";
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
					<label for="ID_BANCO">Banco:</label>
					<select id="ID_BANCO" class="form-control">
						<option value="0" disabled selected>SELECCIONE BANCO...</option>						
					</select>
           	</div>		


			<div class="form-group">
				<label for="NRO_CUENTA">Numero Cuenta:</label>
				<input id="NRO_CUENTA" type="text" class="form-control"   required>
			</div>

			
			<div id="div_internacional">
				<div class="form-group">
					<label for="CODIGO_SWIF">Codigo Swif:</label>
					<input id="CODIGO_SWIF" type="text" class="form-control">
				</div>

				<div class="form-group">
					<label for="CODIGO_IBAN">Codigo Iban:</label>
					<input id="CODIGO_IBAN" type="text" class="form-control">
				</div>

				<div class="form-group">
					<label for="BENEFICIARIO">Nombre Beneficiario:</label>
					<input id="BENEFICIARIO" type="text" class="form-control">
				</div>
			</div>

			
			
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
			

			$('#div_internacional').hide();
				
			$( "#ID_MONEDA" ).change(function() {
				$('#div_internacional').hide();				
				
				
				if ($("#ID_MONEDA").val() == '')
					return false
				
				
				var ID_MONEDA = $("#ID_MONEDA").val();				
				Parametros="ID_MONEDA="+ID_MONEDA;
				//alert(Parametros)	
				//return 			 
				$.ajax(
					{
					type: "POST",
					dataType:"html",
					url: "Sistema/Cuentas/buscar_base.PHP",			
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
								if (FG_BASE==0)	
								{
																							
									$('#div_internacional').val('1');									
									$('#div_internacional').show();									
								}
								else
								{
									$('#div_internacional').val('0');
									//$('#ID_MONEDA').val('');
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
				var	ID_LOCALIDAD=$("#ID_LOCALIDAD").val();
				var	ID_BANCO=$("#ID_BANCO").val();
				var	NRO_CUENTA=$("#NRO_CUENTA").val();	
				var	CODIGO_SWIF=$("#CODIGO_SWIF").val();	
				var	CODIGO_IBAN=$("#CODIGO_IBAN").val();
				var	BENEFICIARIO=$("#BENEFICIARIO").val();
				var	div_internacional=$("#div_internacional").val();				
				
				//return 		
				 
				if(div_internacional=='1')					
				{					
					if(CODIGO_SWIF=='')						{
						window.parent.MostrarMensaje("Rojo", "Disculpe, debe ingresar un CODIGO SWIF");						
						return 	
					}

					if(CODIGO_IBAN=='')						{
						window.parent.MostrarMensaje("Rojo", "Disculpe, debe ingresar un CODIGO IBAN");						
						return 	
					}

					if(BENEFICIARIO=='')						{
						window.parent.MostrarMensaje("Rojo", "Disculpe, debe ingresar un Nombre de Beneficiario");						
						return 	
					}
					
					//ID_BANCO=''
								
				}
			
				//return 	
						
				
				Parametros="ID_MONEDA="+ID_MONEDA+"&ID_LOCALIDAD="+ID_LOCALIDAD+"&ID_BANCO="+ID_BANCO+"&NRO_CUENTA="+NRO_CUENTA+"&CODIGO_SWIF="+CODIGO_SWIF+"&CODIGO_IBAN="+CODIGO_IBAN+"&BENEFICIARIO="+BENEFICIARIO;
				
				//return
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/Cuentas/ScriptGuardar.PHP",			
					data: Parametros,	
					beforeSend: function() 
					{
						window.parent.Cargando(1);
					},												
					cache: false,			
					success: function(Resultado)
					{
						alert(Resultado);
						
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
								window.parent.MostrarMensaje("Verde", "Operaci&oacute;n realizada exit&oacute;samente.");
								
							}
						}		
					}						
				});
			}

	
	function BuscarBase()
			{
				var ID_MONEDA=$("#ID_MONEDA").val();
				
				Parametros="ID_MONEDA="+ID_MONEDA;
				//alert(Parametros)
				//return
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/Cuentas/Buscar_base.PHP",			
					data: Parametros,	
					beforeSend: function() 
					{
						window.parent.Cargando(1);
					},												
					cache: false,			
					success: function(Resultado)
					{
					
						//alert(Resultado);
											
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
							window.parent.MostrarMensaje("Rojo", "Error, No se puedo conectar con el servidor, contacte al personal del Departamento de Sistemas.");
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
								window.parent.MostrarMensaje("Rojo", "Error de sentencia SQL, contacte al personal del Departamento de Sistemas.");
							}
							else
							{
								window.parent.Cargando(0);
								
								var FG_BASE=Arreglo['FG_BASE'];								
								$("#FG_BASE").val(FG_BASE);
								//alert(FG_BASE)
								//alert('hola')

							}
						}		
					}						
				});
			}	
	
		
	function BuscarBanco()
			{
				var ID_LOCALIDAD=$("#ID_LOCALIDAD").val();
				var ID_MONEDA=$("#ID_MONEDA").val();
				if(ID_MONEDA==null)	
				{
					window.parent.MostrarMensaje("Rojo", "Debe seleccionar una Localidad");
					return 	
				}			
			
				Parametros="ID_LOCALIDAD="+ID_LOCALIDAD+"&ID_MONEDA="+ID_MONEDA;
				//alert(Parametros)
				////return
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/Cuentas/Buscar_banco.PHP",			
					data: Parametros,	
					beforeSend: function() 
					{
						window.parent.Cargando(1);
					},												
					cache: false,			
					success: function(Resultado)
					{
					
						//alert(Resultado);
											
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
							window.parent.MostrarMensaje("Rojo", "Error, No se puedo conectar con el servidor, contacte al personal del Departamento de Sistemas.");
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
								window.parent.MostrarMensaje("Rojo", "Error de sentencia SQL, contacte al personal del Departamento de Sistemas.");
							}
							else
							{
								window.parent.Cargando(0);
								
								var option=Arreglo['option'];														
								$("#ID_BANCO").html(option);
								

							}
						}		
					}						
				});
			}	

			
        </script>
    </body>
</html>