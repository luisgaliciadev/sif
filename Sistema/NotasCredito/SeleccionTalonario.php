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
                    <label>Seleccion de numero de nota de credito y Control</label>
                    <select class="form-control" id="talonario" name="TALONARIO" required>
                    <option value="">Selecione...</option>   
                    <?php 
                       $vSQL="exec dbo.[SP_TB_TALONARIO_LISTADO]  $ID_USER,'9b7a7ef6-3070-487c-9870-18ecee4dc3a8',$ID_LOCALIDAD";
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

                <div class="form-group col-md-6" >
                    <label>Motivo</label>
                    <textarea class="form-control" rows="3" id="motivo" ></textarea>
                </div>

            </div>   
        </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelar_talon">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="guardar_nota">Guardar</button>
                </div>
        
<script>
    $(document).ready(function(e) 
    {				
        window.parent.Cargando(0);
        $('#guardar_nota').click(function() {
            var talonario = $('#talonario').val()
            if (talonario == ''){
                MostrarMensaje("Rojo", "Disculpe, debe seleccionar un numero de control, intente nuevamente");
                return false 
            }else{
                swal({
                    title: "Desea Guardar la Nota de Credito?",
                    text: "¿Desea Generar la Nota de Credito? en caso de ser afirmativo este proceso no podra ser revertido",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "OK",
                    closeOnConfirm: false
                    },
                    function(){                
                        guardar_nota_credito() 
                });
            }
        });
    
    });
        </script>
    </body>
</html>