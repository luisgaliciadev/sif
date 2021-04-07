<?php 
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	$ID_LOCALIDAD=$_SESSION [$SISTEMA_SIGLA.'ID_LOCALIDAD'];
	
	ValidarSesion($Nivel);
	
	$Nivel="";

?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
    	<form id="vForm">
			<div class="form-group">
                    <label>Localidad:</label>
                    <select name="ID_LOCALIDAD" id="ID_LOCALIDAD" class="form-control" placeholder="Seleccione el puerto" required  >
                        <option value="" disabled selected>SELECCIONE EL PUERTO...</option>
						<?php 
						$Conector=Conectar();	

					   if($ID_LOCALIDAD==8)
					   {
							$vSQL="SELECT ID_LOCALIDAD, NB_LOCALIDAD FROM TB_LOCALIDAD WHERE ID_LOCALIDAD!=7 ID_LOCALIDAD!=8 and  AND FG_ACT_LOCALIDAD=1 ORDER BY NB_LOCALIDAD ASC";
					   }
					   else
					   {
							$vSQL="SELECT ID_LOCALIDAD, NB_LOCALIDAD FROM TB_LOCALIDAD WHERE ID_LOCALIDAD=$ID_LOCALIDAD AND FG_ACT_LOCALIDAD=1 ORDER BY NB_LOCALIDAD ASC";
					   }
						
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
                <label for="NB_CENTROS">NOMBRE DEL CENTRO DE FACTURACION:</label>
                <input id="NB" type="text" class="form-control" required>
            </div>
           
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
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
				var	NB=$("#NB").val();
				var	ID_LOCALIDAD=$("#ID_LOCALIDAD").val();
								
				
				Parametros="NB="+NB+"&ID_LOCALIDAD="+ID_LOCALIDAD;
				
				//alert(Parametros);
				//return
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/Centro_Facturacion/ScriptGuardar.PHP",			
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
								
								window.parent.MostrarMensaje("Verde", "Operacion realizada exitósamente!");
							}
						}		
					}						
				});
			}



        </script>
    </body>
</html>