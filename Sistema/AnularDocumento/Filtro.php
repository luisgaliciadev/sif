<?php 
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();	
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	$RIF=$_SESSION[$SISTEMA_SIGLA."RIF"];
	
	ValidarSesion($Nivel);
	
	$vNB_MODULO=$_POST["vNB_MODULO"];	
?>
<!DOCTYPE html>
<html >
	<head>
        <script>	
        </script>
	</head>
	<body>	
            
    <input type="hidden" id="MODULO" value="vID_MODULO"/>
    <input type="hidden" id="AscDesc" value="DESC"/>
    
    <!-- Content Header (Page header) -->
    
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2><?php echo $vNB_MODULO;?></h2>
			<?php echo construirBreadcrumbs(substr($_POST["vID_MODULO"], 6, strlen($_POST["vID_MODULO"])));?>
		</div>
	</div>   
    
    <!-- Modal -->
     <div class="modal fade" id="vModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="width:95% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="vModalTitulo"></h4>
                </div>
                <div class="modal-body" id="vModalContenido">
                </div>
            </div>
        </div>
    </div>	
    
    <!-- Modal Diccionario -->
    <div class="modal fade" id="vModalDiccionario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:95% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="vModalTituloDiccionario"></h4>
                </div>
                <div class="modal-body" id="vModalContenidoDiccionario">
                </div>
            </div>
        </div>
    </div>	
    
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Consultar Documento</h5>
					</div>
					<div class="ibox-content">					
                        <form role="form" id="form_sm" >
                            <div class="row">
                                <div class="form-group col-md-3">
											<label for="LNRO">NUMERO:</label>
											<input id="nro" type="text" class="form-control" required>
									</div>
									<div class="form-group col-md-3">
											<label for="LCONTROL">CONTROL:</label>
											<input id="control" type="text" class="form-control" required>
											<input id="id_documento" type="hidden">
											<input id="formato" type="hidden">
									</div>
									<div class="form-group col-md-3" style="padding-top: 0.5%;">
									 <label ></label>
									 <button class="form-control btn btn-primary" type="button" id="btn-buscar">Buscar</button>
									</div>
                            </div>
                        </form>   
                        <div id="cabecera" class="row"> </div>    
                        <br> 
                        <div id="detalle" > </div>                        
          				<div id="opciones" class="row">
								<div  class="form-group col-md-2">
									 <button class="form-control btn default-bg" type="button" id="btn-ver-doc" onClick="ver();" >Ver</button>
								</div> 
                      			 <div  class="form-group col-md-2">
                       			 <button class="form-control btn navy-bg" type="button" id="btn-ver-pagos" onClick="ver_pagos();" >Ver Pagos</button>
                       		</div> 
							<div  class="form-group col-md-2">
									 <button class="form-control btn red-bg" type="button" id="btn-ver-detalle" onClick="ver_detalle();" >Ver Detalle</button>
							</div> 
							<div  class="form-group col-md-2">
									 <button class="form-control btn yellow-bg" type="button" id="btn-buscar-afectados" onClick="ver_documentos();" >Doc. Afectados</button>
							</div> 
							<div  class="form-group col-md-2">
									 <button class="form-control btn blue-bg" type="button" id="btn-buscar-aviso" onClick="ver_avisos();">Avisos de Credito</button>
							</div> 	
							<div  class="form-group col-md-2">
									 <button class="form-control btn red-bg" type="button" id="btn-ver-anular" onClick="ver_aviso_previo();" >Anular Factura</button>
							</div> 	 
						</div> 
                   </div>                  
                    </div>
                    
                </div>
                
            </div>
            
		</div>

   
    <script>		
        $(document).ready(function(e) 
        {   var limpiar = 0;
            window.parent.parent.Cargando(0);
            var totales = {}
            var pagos = {}
            var saldo = 0; 
            var afavor = 0;               
            $('#btn-ver-pagos').prop("disabled",true);
			$('#btn-ver-detalle').prop("disabled",true);
		    $('#btn-buscar-afectados').prop("disabled",true);
		    $('#btn-buscar-aviso').prop("disabled",true);
 			$('#btn-ver-doc').prop("disabled",true);
		 	$('#btn-ver-anular').prop("disabled",true);
            
		 
		 
            $('#btn-buscar').click(function()
			{  
                
               		var nro = $('#nro').val()
					var control = $('#control').val()
					
					
					$('#btn-buscar').html("Cancelar")
                    $("#btn-buscar").removeClass("btn-default");
                    $("#btn-buscar").addClass("bg-success");
					
					Parametros = "nro=" + nro + "&control=" + control;
					$.ajax({
					type: "POST",
					dataType: "html",
					url: "Sistema/AnularDocumento/ScriptConsultarDoc.php",
					data: Parametros,
					beforeSend: function() {
						window.parent.parent.Cargando(1);
					},
					cache: false,
					success: function(result) {
						window.parent.parent.Cargando(0);

						var Arreglo = jQuery.parseJSON(result);

						var CONEXION = Arreglo['CONEXION'];

						if (CONEXION == "NO") 
						{
							window.parent.Cargando(0);

							var MSJ_ERROR = Arreglo['MSJ_ERROR'];
							window.parent.Cargando(0);
							MostrarMensaje("Rojo", "Error, No se puede conectar con el servidor, contacte al personal del departamento de sistemas.");
						} 
						else 
						{
							var ERROR = Arreglo['ERROR'];

							if (ERROR == "SI") 
							{
								window.parent.Cargando(0);
								var MSJ_ERROR = Arreglo['MSJ_ERROR'];
								window.parent.Cargando(0);
								MostrarMensaje("Rojo", "Error de sentencia SQL, contacte al personal del departamento de sistemas.");
							} else 
							{
								var id=Arreglo['ID'];
								var mensaje=Arreglo['MENSAJE'];
								
								if(id==0)
								{
										MostrarMensaje("Rojo", mensaje);
								}
								else
								{
									var ID_DOCUMENTO=Arreglo['ID_DOCUMENTO'];
									var FORMATO=Arreglo['FORMATO'];
									$('#id_documento').val(ID_DOCUMENTO);
									$('#formato').val(FORMATO);
									$('#btn-ver-pagos').prop("disabled",false);
									$('#btn-ver-detalle').prop("disabled",false);
									$('#btn-buscar-afectados').prop("disabled",false);
									$('#btn-buscar-aviso').prop("disabled",false);
									$('#btn-ver-doc').prop("disabled",false);
									$('#btn-ver-anular').prop("disabled",false);
									MostrarMensaje("Verde", mensaje);	
								}
								
								
								$('#cabecera').html(Arreglo['DATOS'])
								
							}
						}
					}
				});
				            
            });
        });

        function FiltroConsulta(PagActual)
        {				
            var Parametros="";
        }
		
		function ver_detalle()
        {
            ID=$('#id_documento').val();
			window.parent.Cargando(1);				
            vModal('Sistema/AnularDocumento/FormVerDetalle.php?ID='+ID, 'Ver Conceptos Documento');
        }
		function ver()
        {
            formato=$('#formato').val();
			ID=$('#id_documento').val();
			window.open(formato+'?ID_DOCUMENTO='+ID);
        }
		
		
		
		
		$('#btn-anular').click(function() {
            
            swal({
                title: "Desea Anular la Factura?",
                text: "¿Desea Anular la Factura? en caso de ser afirmativo este proceso no podra ser revertido",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "OK",
                closeOnConfirm: false
              },
              function(){                
                anular_factura() 
                         
                
              });
		
		});
		function anular_factura()
        {
            ID=$('#id_documento').val();
			MOTIVO=$('#motivo').val();
			
			
			Parametros = "MOTIVO=" + MOTIVO + "&ID=" + ID;
					$.ajax({
					type: "POST",
					dataType: "html",
					url: "Sistema/AnularDocumento/ScriptAnularFactura.php",
					data: Parametros,
					beforeSend: function() {
						window.parent.parent.Cargando(1);
					},
					cache: false,
					success: function(result) {
						window.parent.parent.Cargando(0);

						var Arreglo = jQuery.parseJSON(result);

						var CONEXION = Arreglo['CONEXION'];

						if (CONEXION == "NO") 
						{
							window.parent.Cargando(0);

							var MSJ_ERROR = Arreglo['MSJ_ERROR'];
							window.parent.Cargando(0);
							MostrarMensaje("Rojo", "Error, No se puede conectar con el servidor, contacte al personal del departamento de sistemas.");
						} 
						else 
						{
							var ERROR = Arreglo['ERROR'];

							if (ERROR == "SI") 
							{
								window.parent.Cargando(0);
								var MSJ_ERROR = Arreglo['MSJ_ERROR'];
								window.parent.Cargando(0);
								MostrarMensaje("Rojo", "Error de sentencia SQL, contacte al personal del departamento de sistemas.");
							} else 
							{
								var id=Arreglo['ID'];
								var mensaje=Arreglo['MENSAJE'];
								if(id==0)
								{
										MostrarMensaje("Rojo", mensaje);
								}
								else
								{
									formato=$('#formato').val();
									ID=$('#id_documento').val();
									$('#btn-anular').prop("disabled",false);
									$('#btn-ver-anular').prop("disabled",false);
									window.open(formato+'?ID_DOCUMENTO='+ID);
									$('#btn-anular').click();
									
									
								}
							}
						}
					}
				});
		
        }
		
		function ver_aviso_previo()
        {
            ID=$('#id_documento').val();
			vModal('Sistema/AnularDocumento/FormVerAvisosPrevio.php?ID='+ID, 'Ver Avisos Afectados');
        }
		
		

       function ver_pagos()
        {
            ID=$('#id_documento').val();
			window.parent.Cargando(1);				
            vModal('Sistema/AnularDocumento/FormVerPagos.php?ID='+ID, 'Ver Pagos Asociados');
        }
		
		function ver_avisos()
        {
            ID=$('#id_documento').val();
			window.parent.Cargando(1);				
            vModal('Sistema/AnularDocumento/FormVerAvisos.php?ID='+ID, 'Ver Avisos Generados');
        }
		
		function ver_documentos()
        {
            ID=$('#id_documento').val();
			window.parent.Cargando(1);				
            vModal('Sistema/AnularDocumento/FormVerDocumentosAfectados.php?ID='+ID, 'Ver Documentos Asociados');
        }

		
		function consultar_aviso(ID_AVISO)
        {   Parametros = "ID_AVISO="+ID_AVISO
            window.open("sistema/reportes/RptAvisoCredito.php?" + Parametros)
        }
		
		function descargar()
        {
            ID=$('#id_documento').val();
			//window.parent.Cargando(1);				
            window.open('Sistema/Reportes/DETALLE_DE_PAGO_DOCUMENTO.php?ID='+ID);
        }
        function vModal(URl, Titulo)
        {
            $("#vModalTitulo").html("");
            $("#vModalContenido").html("");				
            $("#vModalTitulo").html(Titulo);
            $("#vModalContenido").load(URl);
            $("#vModal").modal();
        }
    </script>
	</body>
</html>