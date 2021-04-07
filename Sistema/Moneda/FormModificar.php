<?php 
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	ValidarSesion($Nivel);
	
	$ID=$_GET['ID'];
	$SIMBOLO=$_POST ['SIMBOLO'];
	$FG_BASE=$_POST ['FG_BASE'];
		
	$vSQL="SELECT  NB, SIMBOLO, FG_BASE  FROM  VIEW_TB_TP_MONEDA_LISTADO WHERE ID='$ID'";	
	
	$ArregloResultado=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', 		     $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ArregloResultado["CONEXION"];
	
	if($CONEXION=="SI")
	{
		$ERROR=$ArregloResultado["ERROR"];
		
		if($ERROR=="NO")
		{
			$result=$ArregloResultado["RESULTADO"];
			
			$NB=odbc_result($result,"NB");		
		
			
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
                <label for="NB_MONEDA">Nombre:</label>
                <input id="NB" type="text" class="form-control" required value="<?php echo $NB;?>">
            	
                <label for="SIMBOLO">SIMBOLO:</label>
                <input id="SIMBOLO" type="text" class="form-control" required value="<?php echo $SIMBOLO;?>">
                
                <label for="MONEDA_BASE">ESTA MONEDA ES BASE:</label>
                    <select id="FG_BASE" class="form-control" >
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
				var	NB=$("#NB").val();
				var FG_BASE=$("#FG_BASE"). val();
				var SIMBOLO=$("#SIMBOLO"). val();
				
				Parametros="NB="+NB+"&ID="+ID+"&FG_BASE="+FG_BASE+"&SIMBOLO="+SIMBOLO;
				
				//alert(Parametros);
				
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/Moneda/ScriptModificar.PHP",			
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