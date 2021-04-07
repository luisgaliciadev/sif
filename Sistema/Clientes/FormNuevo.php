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
                <label>Razon Social:</label>
                <input id="NB_CLIENTE" type="text" class="form-control" required>
            </div>
			
			<div class="form-group">
                <label>RIF:</label>
                <input id="RIF" type="text" class="form-control" required>
            </div>

			<div class="form-group">
                <label>DIRECCION FISCAL:</label>
                <input id="DIRECCION" type="text" class="form-control" required>
            </div>

			<div class="form-group">
                <label>DIAS DE CREDITO:</label>
                <input id="DIAS_CREDITO" type="number" class="form-control">
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

				$('#RIF').keyup(function(event) 
			{
				var keycode = (event.keyCode ? event.keyCode : event.which);

				if(keycode == '13') 
				{
					$('#btnIngresar').click();
				}
			});

			$('#RIF').blur(function(event) 
			{
				if($(this).val().length!=10 && $(this).val().length>0)
				{
					window.parent.MostrarMensaje("Rojo", "Disculpe, Ingrese un RIF valido.");
					$("#RIF").focus();
					return;					
				}
			});

			$('#RIF').keydown(function (e)
			{
				if (e.shiftKey == 1) 
				{
					return false
				}

				var code = e.which;
				var key;

				//alert(code);

				key = String.fromCharCode(code);

				switch(true)
				{
					//Tipo de personas
					case code == 86 || code == 69 || code == 71 || code == 74 || code == 80:
					//Keyboard numbers
					case code >= 48 && code <= 57:
					//Keypad numbers
					case code >= 96 && code <= 105:
					//Negative sign
					case code == 189 || code == 109:
					// 37 (Left Arrow), 39 (Right Arrow), 8 (Backspace) , 46 (Delete), 36 (Home), 35 (End), 
					case code == 37 || code == 39 || code == 8 || code == 46 || code == 35 || code == 36 || code == 9:
						return;
					break;
				}

				e.preventDefault();
			});

			$("#RIF").inputmask("a9{1,9}",{"placeholder": ""});



				$('#vForm').on('submit', function(e) 
				{
					e.preventDefault();
					
					Guardar();
				});
            });
			
			function Guardar()
			{	                					
				var	NB_CLIENTE=$("#NB_CLIENTE").val();
				var	RIF=$("#RIF").val();
				var	DIRECCION=$("#DIRECCION").val();
				var	DIAS_CREDITO=$("#DIAS_CREDITO").val();
				
				
				Parametros="NB_CLIENTE="+NB_CLIENTE+"&RIF="+RIF+"&DIRECCION="+DIRECCION+"&DIAS_CREDITO="+DIAS_CREDITO;
				
				//alert(Parametros);
				//return
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/clientes/ScriptGuardar.PHP",			
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
							//alert(EXISTE)
							if(EXISTE=="SI")
							{
								window.parent.Cargando(0);
								
								window.parent.MostrarMensaje("Amarillo", "Disculpe, Ya se encuentra registrado!");
								
								$("#NB_SERVICIO").focus();
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