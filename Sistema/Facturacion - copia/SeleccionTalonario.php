<?php 
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
    $SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
    $ID_LOCALIDAD=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_LOCALIDAD'];	
    $ID_USER=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_USUARIO'];
	$id_moneda = $_GET["id_moneda"];
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
                <div class="form-group col-md-12" >
                    <label>Tipo de movimiento</label>
                    <select class="form-control" id="talonario" name="TALONARIO" required>
                    <option value="">Selecione...</option>   
                    <?php 
                        $vSQL="exec dbo.[SP_TB_TALONARIO_LISTADO]  $ID_USER,'b3d59c5c-d757-44c3-b4da-954141d296a4'";
                        $ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
                        
                        $CONEXION=$ResultadoEjecutar["CONEXION"];						
                        $ERROR=$ResultadoEjecutar["ERROR"];
                        $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
                        $result=$ResultadoEjecutar["RESULTADO"];
                    
                        if($CONEXION=="SI" and $ERROR=="NO")
                        {		
                            while ($registro=odbc_fetch_array($result))
                            {   
                                $ID=odbc_result($result,'ID_TALONARIO');
                                $NB=odbc_result($result,'NB');
                                echo "<option value=".$ID.">$NB</option>";
                                
                            }
                        }
                    
                    ?>
                    </select>             
                    </select>
                </div>               
            </div>   
        </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="guardar_factura">Guardar</button>
                </div>
        
<script>
    $(document).ready(function(e) 
    {				
        window.parent.Cargando(0);
        $('#guardar_factura').click(function() {
            
            swal({
                title: "Desea Guardar la Factura?",
                text: "mensaje para el ususario que la puede ca...",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "OK",
                closeOnConfirm: false
              },
              function(){
                swal("Guardado", "Su factura, ha sido guardado con exito.", "success");
                console.log("guardar")
                guardar_factura()
              });
        });
    
    });
        </script>
    </body>
</html>