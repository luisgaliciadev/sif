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
            <div class="form-group">
                <label for="BANCO">ENTIDAD BANCARIA:</label>
                <input id="NB_BANCO" type="text" class="form-control" required>
                
                 <label for="RECAUDADOR">ESTE BANCO ES RECAUDADOR:</label>
                   <select id="FG_RECAUDADOR" class="form-control" >
						<option value=""></option>                       
                        <option value="0">NO</option>
                        <option value="1">SI</option>
                    </select>
                 <label for="INTERMEDIARIO">ESTE BANCO ES INTERMEDIARIO:</label>
                   <select id="FG_INTERMEDIARIO" class="form-control" >
                        <option value=""></option>
                        <option value="0">NO</option>
                        <option value="1">SI</option>
                    </select>
                
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
				var	NB_BANCO=$("#NB_BANCO").val();
				var FG_RECAUDADOR=$("#FG_RECAUDADOR"). val();
				var FG_INTERMEDIARIO=$("#FG_INTERMEDIARIO"). val();
				
				Parametros="NB_BANCO="+NB_BANCO+"&FG_RECAUDADOR="+FG_RECAUDADOR+"&FG_INTERMEDIARIO="+FG_INTERMEDIARIO;;
				
				
				//alert(Parametros);
				
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/Banco/ScriptGuardar.PHP",			
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
								
								window.parent.MostrarMensaje("Verde", "Operaci&oacuten realizada exit&oacutesamente!");
							}
						}		
					}						
				});
			}
        </script>
    </body>
</html>