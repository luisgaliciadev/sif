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


			<div class="form-group">
				<label for="MONEDA_REF">Nombre Moneda Referencia:</label>
				<input id="MONEDA_REF" type="text" class="form-control"   required>
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
				var ID_MONEDA=$("#ID_MONEDA").val();
				var	MONEDA_REF=$("#MONEDA_REF").val();
				
				
				
				
				Parametros="ID_MONEDA="+ID_MONEDA+"&MONEDA_REF="+MONEDA_REF;
				//alert(Parametros);
				//return
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/MonedaRef/ScriptGuardar.PHP",			
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

			
        </script>
    </body>
</html>