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
			<label>Localidad:</label>
                    <select class="form-control" required name="ID_LOCALIDAD" id="ID_LOCALIDAD" onChange="BuscarCentroFact();">
                    	<option value="" disabled selected>Seleccione...</option>
<?php 
						$Conector=Conectar();	

                        $vSQL='SELECT DISTINCT ID_LOCALIDAD,NB_LOCALIDAD FROM VIEW_LOCALIDAD ORDER BY NB_LOCALIDAD ASC';
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
                    <label>Centro de Facturacion:</label>
                    <select name="ID_CENTRO" id="ID_CENTRO" class="form-control" placeholder="Seleccione el centro facturacion" required >
                        <option value="" disabled selected>SELECCIONE CENTRO FACT...</option>
                    </select>
                </div> 
				
				<div class="form-group">
                    <label>Serie:</label>
                    <select name="ID_SERIE" id="ID_SERIE" class="form-control" placeholder="Seleccione el centro facturacion" required >
                        <option value="" disabled selected>SELECCIONE SERIE...</option>
                    </select>
                </div> 
				
				<div class="form-group">
			<label>Tipo Documento:</label>
                    <select class="form-control" required name="ID_DOCUMENTO" id="ID_DOCUMENTO" required>
                    	<option value="" disabled selected>Seleccione...</option>
<?php 
						$Conector=Conectar();	

                        $vSQL='exec dbo.SP_DOCUMENTO_LISTADO';
						$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
                        
                        $CONEXION=$ResultadoEjecutar["CONEXION"];						
                        $ERROR=$ResultadoEjecutar["ERROR"];
                        $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
                        $result=$ResultadoEjecutar["RESULTADO"];
                        
                        if($CONEXION=="SI" and $ERROR=="NO")
                        {		
                            while ($registro=odbc_fetch_array($result))
                            {			
                                $ID_DOCUMENTO=odbc_result($result,'ID');
                                $NB_DOCUMENTO=utf8_encode(odbc_result($result,'NB'));								
                                        
                                echo "<option value='$ID_DOCUMENTO'>$NB_DOCUMENTO</option>";
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

				<div class="form-group col-lg-6">
					<label for="DOC_DESDE">Nro. Documento Desde:</label>
					<input id="DOC_DESDE" type="number" class="form-control" type="number" required>
				</div>

				<div class="form-group col-lg-6">
					<label for="DOC_HASTA">Nro. Documento Hasta:</label>
					<input id="DOC_HASTA" type="number" class="form-control" type="number" required>
				</div>
				
				
				<div class="form-group col-lg-6">
					<label for="CONTROL_DESDE">Nro. Control Desde:</label>
					<input id="CONTROL_DESDE" type="number" class="form-control" type="number" required>
				</div>

				<div class="form-group col-lg-6">
					<label for="CONTROL_HASTA">Nro. Control Hasta:</label>
					<input id="CONTROL_HASTA" type="number" class="form-control"   required>
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
			    $('#vForm').on('submit', function(e) 
				{
					e.preventDefault();
					
					Guardar();
				});
            });
			
			function Guardar()
			{	                					
				var ID_SERIE=$("#ID_SERIE").val();
				var	ID_CENTRO=$("#ID_CENTRO").val();
				var	ID_DOCUMENTO=$("#ID_DOCUMENTO").val();
				var	DOC_DESDE=$("#DOC_DESDE").val();
				var	DOC_HASTA=$("#DOC_HASTA").val();
				var	CONTROL_DESDE=$("#CONTROL_DESDE").val();
				var	CONTROL_HASTA=$("#CONTROL_HASTA").val();
				
				
				
				Parametros="ID_SERIE="+ID_SERIE+"&ID_CENTRO="+ID_CENTRO+"&ID_DOCUMENTO="+ID_DOCUMENTO+"&DOC_DESDE="+DOC_DESDE+"&DOC_HASTA="+DOC_HASTA+"&CONTROL_DESDE="+CONTROL_DESDE+"&CONTROL_HASTA="+CONTROL_HASTA;
				//alert(Parametros);
				//return
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/Talonario/ScriptGuardar.PHP",			
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
							
							if(EXISTE=="SI")
							{
								window.parent.Cargando(0);
								
								window.parent.MostrarMensaje("Amarillo", "Disculpe, Ya se encuentra registrado!");
								
								$("#NB").focus();
							}
							else
							{		
								window.parent.FiltroConsulta(1);
								
								window.parent.$("#vModal").modal('toggle');	
								
								window.parent.MostrarMensaje("Verde", "Operaci&oacute;n realizada exit&oacute;samente.");
								
							}
						}		
					}						
				});
			}

			function BuscarCentroFact()
			{
				var ID_LOCALIDAD=$("#ID_LOCALIDAD").val();
				
				Parametros="ID_LOCALIDAD="+ID_LOCALIDAD;
				//alert(Parametros)
				//return
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/Talonario/BuscarSerie.PHP",			
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
								var a=Arreglo['a'];								
								//alert(option)
								//alert(a)
								//alert(option)
								$("#ID_SERIE").html(option);


									/////////////////
						var ID_LOCALIDAD=$("#ID_LOCALIDAD").val();
				
				Parametros="ID_LOCALIDAD="+ID_LOCALIDAD;
				//alert(Parametros)
				//return
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/Talonario/BuscarCentroFact.PHP",			
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
								window.parent.MostrarMensaje("Rojo", "Error de sentencia SQL, contacte al personal del departamento de sistemas.");
							}
							else
							{
								window.parent.Cargando(0);
								
								var option=Arreglo['option'];
														
								//alert(option)
								//alert(a)
								//alert(option)

								$("#ID_CENTRO").html(option);
							}
						}		
					}						
				});



						//////////////



							}
						}		
					}						
				});
			}	


        </script>
    </body>
</html>