<?php 
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	ValidarSesion($Nivel);
	
	$ID=$_GET['ID'];

	$vSQL="SELECT * FROM VIEW_CLIENTE_LISTADO WHERE ID='$ID'";

	$ArregloResultado=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ArregloResultado["CONEXION"];
	
	if($CONEXION=="SI")
	{
		$ERROR=$ArregloResultado["ERROR"];
		
		if($ERROR=="NO")
		{
			$result=$ArregloResultado["RESULTADO"];
			
			$RIF_CLIENTE=odbc_result($result,"RIF_CLIENTE");		
			$NB_CLIENTE=odbc_result($result,"NB_CLIENTE");
			$DIRECCION_FISCAL=odbc_result($result,"DIRECCION_FISCAL");
			$DIAS_CREDITO=odbc_result($result,"DIAS_CREDITO");
		
			
		}
		else
		{
			$MSJ_ERROR=$ArregloResultado["MSJ_ERROR"];		
			
			echo $MSJ_ERROR;
		}
	}
	else
	{
		$MSJ_ERROR=$ArregloResultado["MSJ_ERROR"];		
		
		echo $MSJ_ERROR;
	}
	
	$Conector->Cerrar();
	
	$Nivel="";
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    	<form id="vForm">
        	<input id="ID" type="hidden" value="<?php echo $ID;?>">
			
            
			 <div class="form-group">
                <label>Razon Social:</label>
                <input id="NB_CLIENTE" type="text" class="form-control" required value="<?php echo $NB_CLIENTE;?>">
            </div>
			
			<div class="form-group">
                <label>RIF:</label>
                <input id="RIF" type="text" class="form-control" required value="<?php echo $RIF_CLIENTE;?>" readonly>
            </div>

			<div class="form-group">
                <label>DIRECCION FISCAL:</label>
                <input id="DIRECCION" type="text" class="form-control" required value="<?php echo $DIRECCION_FISCAL;?>">
            </div>

			<div class="form-group">
                <label>DIAS DE CREDITO:</label>
                <input id="DIAS_CREDITO" type="number" class="form-control" value="<?php echo $DIAS_CREDITO;?>">
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
				var	ID=$("#ID").val();
				var	RIF_CLIENTE=$("#RIF").val();
				var	NB_CLIENTE=$("#NB_CLIENTE").val();
				var	DIRECCION_FISCAL=$("#DIRECCION").val();
				var	DIAS_CREDITO=$("#DIAS_CREDITO").val();			
				
				Parametros="ID="+ID+"&RIF_CLIENTE="+RIF_CLIENTE+"&NB_CLIENTE="+NB_CLIENTE+"&DIRECCION_FISCAL="+DIRECCION_FISCAL+"&DIAS_CREDITO="+DIAS_CREDITO;
				
				//alert(Parametros);
				//return
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/clientes/ScriptModificar.PHP",			
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