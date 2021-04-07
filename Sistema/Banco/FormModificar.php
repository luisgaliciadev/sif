<?php 
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	ValidarSesion($Nivel);
	
	$ID=$_GET['ID'];
	$NB_BANCO=$_POST['NB_BANCO'];
	$NB_CORTO=$_POST ['NB_CORTO'];
	$FG_RECAUDADOR=$_POST ['FG_RECAUDADOR'];
	$FG_INTERMEDIARIO=$_POST ['FG_INTERMEDIARIO'];
	
	
	$vSQL="SELECT NB_BANCO, NB_CORTO, F_REG, FG_RECAUDADOR, FG_INTERMEDIARIO FROM VIEW_TB_BANCO_LISTADO WHERE ID='$ID'";	
	
	$ArregloResultado=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ArregloResultado["CONEXION"];
	
	if($CONEXION=="SI")
	{
		$ERROR=$ArregloResultado["ERROR"];
		
		if($ERROR=="NO")
		{
			$result=$ArregloResultado["RESULTADO"];
			
			$NB_BANCO=odbc_result($result,"NB_BANCO");
			//$ID_LOCALIDAD=odbc_result($result,"ID_LOCALIDAD");		
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
                <label for="BANCO">ENTIDAD BANCARIA:</label>
                <input id="NB_BANCO" type="text" class="form-control" required value="<?php echo $NB_BANCO;?>">
                
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
				var	FG_INTERMEDIARIO=$("#FG_INTERMEDIARIO").val();
				var	FG_RECAUDADOR=$("#FG_RECAUDADOR").val();
				
				Parametros="NB_BANCO="+NB_BANCO+"&FG_INTERMEDIARIO="+FG_INTERMEDIARIO+"&FG_RECAUDADOR="+FG_RECAUDADOR;
				
				//alert(Parametros);
				
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/Banco/ScriptModificar.PHP",			
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
								
								$("#NB_BANCO").focus();
							}
							else
							{		
								window.parent.FiltroConsulta(1);
								
								window.parent.$("#vModal").modal('toggle');			
								
								window.parent.MostrarMensaje("Verde", "Operacion realizada exitosamente!");
							}
						}		
					}						
				});
			}
        </script>
    </body>
</html>