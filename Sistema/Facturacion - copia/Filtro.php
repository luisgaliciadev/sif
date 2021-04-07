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
        <div class="modal-dialog modal-lg">
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
                        <h5>Nueva Factura</h5>
					</div>
					<div class="ibox-content">					
                        <form role="form" id="form_sm" >
                            <div class="row">
                                <div class="form-group col-md-4" >
                                    <label>Tipo de Servicio</label>
                                    <select class="form-control" id="tipo_serv" name="TIPO DE SOLICITUD" required>
                                    <option value="">Selecione...</option>
                                    <?php 
                                        $vSQL="exec dbo.[SP_SERVICIO_LISTADOP]";
                                        $ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
                                        
                                        $CONEXION=$ResultadoEjecutar["CONEXION"];						
                                        $ERROR=$ResultadoEjecutar["ERROR"];
                                        $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
                                        $result=$ResultadoEjecutar["RESULTADO"];
                                    
                                        if($CONEXION=="SI" and $ERROR=="NO")
                                        {		
                                            while ($registro=odbc_fetch_array($result))
                                            {   
                                                $ID_SISTEMA=odbc_result($result,'ID_SISTEMA');
                                                $ID_TP_SERVICIO=odbc_result($result,'ID_TP_SERVICIO');
                                                $FG_BUSQUEDA_SECUN=odbc_result($result,'FG_BUSQUEDA_SECUN');
                                                $NB_TP_SERVICIO=utf8_encode(odbc_result($result,'NB_TP_SERVICIO'));
                                                echo "<option value=".$ID_TP_SERVICIO."%%".$ID_SISTEMA."%%".$FG_BUSQUEDA_SECUN.">$NB_TP_SERVICIO</option>";
                                                
                                            }
                                        }
                                    
                                    ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-3" >
                                    <label>Categoria del Servicio</label>
                                    <select class="form-control" id="cat_serv" name="Categoria del Servicio" required>
                                    <option value="">Selecione...</option>                                    
                                    </select>
                                </div>

                                <div class="form-group col-md-1" >
                                    <label> Año</label>
                                    <input type="text" class="form-control" id="anio" name="anio" required>
                                </div>

                                <div class="form-group col-md-2" >
                                    <label>Nº. Preliquidacion</label>
                                    <input type="text" class="form-control" id="pre" name="PRELIQUIDACION" required>    
                                </div>

                                <div class="form-group col-md-2" style="padding-top: 1.8%;">
                                    <button class=" form-control btn btn-primary" type="button" id="btn-buscar">Buscar</button>
                                    
                                </div>
                                
                            </div>
                        </form>   
                        <div id="cabecera" class="row"> </div>    
                        <br> 
                        <div id="detalle" > </div>                        
                        
                        <div class="row"> 
                            <div id="botones" class="col-md-6 " >
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Condici&oacute;n de pago</label>
                                        <select class="form-control" id="condicion_pago" name="CONDICION DE PAGO" required>
                                        <option value="">Selecione...</option>
                                        <?php 
                                            $vSQL="exec dbo.[SP_CONDICION_LISTADO]";
                                            $ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
                                            
                                            $CONEXION=$ResultadoEjecutar["CONEXION"];						
                                            $ERROR=$ResultadoEjecutar["ERROR"];
                                            $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
                                            $result=$ResultadoEjecutar["RESULTADO"];
                                        
                                            if($CONEXION=="SI" and $ERROR=="NO")
                                            {		
                                                while ($registro=odbc_fetch_array($result))
                                                {   
                                                    $ID=odbc_result($result,'ID');
                                                    $NB=utf8_encode(odbc_result($result,'NB'));
                                                    $FG=utf8_encode(odbc_result($result,'FG'));
                                                    echo "<option value=".$ID."%%".$FG.">$NB</option>";
                                                }
                                            }
                                        
                                        ?>
                                        </select> 
                                    </div> 
                                    <br>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary  btn-lg btn-outline dim" type="button" id="agre_pago"><i class="fa fa-money"></i></button>
                                        <button class="btn btn-warning btn-lg btn-outline dim" type="button" id="agre_reten"><i class="fa fa-paste"></i></button>
                                        <button class="btn btn-info btn-lg btn-outline dim" type="button" id="visualizar"><i class="fa fa-binoculars"></i></button>
                                        <button class="btn btn-success btn-lg btn-outline dim" type="button" id="factura"><i class="fa fa-check"></i> Generar Factura</button>
                                    </div>
                                </div>                                
                            </div>   

                            <div  class="col-md-6">
                                <table class="table table-bordered table-hover" style="width:50%; float:right;">
                                    <tr>
                                        <td align="right"><strong>Sub-Total:</strong></td>
                                        <td id="sub_total" align="right"></td>
                                    </tr>
                                    <tr>
                                        <td align="right"><strong>Base Imponible</strong></td>
                                        <td id="base_imponible" align="right"></td>
                                    </tr>
                                    <tr>
                                        <td align="right"><strong>Monto Exento</strong></td>
                                        <td id="exento" align="right"></td>
                                    </tr>
                                    <tr>
                                        <td align="right"><strong>IVA</strong></td>
                                        <td id="iva" align="right"></td>
                                    </tr>
                                    <tr>
                                        <td align="right"><strong>TOTAL</strong></td>
                                        <td id="total" align="right"></td>
                                    </tr>
                                    <tr>
                                        <td align="right"><strong>Saldo Abonado</strong></td>
                                        <td id="abonado" align="right"></td>
                                    </tr>
                                    <tr>
                                        <td align="right"><strong>Saldo Restante</strong></td>
                                        <td id="saldoss" align="right"></td>
                                    </tr>
                                    <tr>
                                        <td align="right"><strong>Saldo a Favor</strong></td>
                                        <td id="afavor" align="right"></td>
                                    </tr>
                                </table>
                            
                            </div> 
                        </div> 
                        <div id="detalle_pagos" > </div>                  
                    </div>
                    
                </div>
                
            </div>
            
		</div>
	</div>
    <script src="sistema/facturacion/js/pagos.js"></script>
    <script src="sistema/facturacion/js/consultas.js"></script>
    <script src="sistema/facturacion/js/validaciones.js"></script>
    <script src="sistema/facturacion/js/insert.js"></script>
    <script>		
        $(document).ready(function(e) 
        {   var limpiar = 0;
            window.parent.parent.Cargando(0);
            var totales = {}
            var pagos = {}
            var saldo = 0; 
            var afavor = 0;               
            
            $('#agre_pago').prop("disabled",true)
            $('#agre_reten').prop("disabled",true)
            $('#visualizar').prop("disabled",true)
            $('#factura').prop("disabled",true)

            $('#agre_pago').click(function() {
                agregar_pagos()                    
            });

            $('#agre_reten').click(function() {
                agregar_reten()                    
            });
            

            FiltroConsulta(1);

            $('#factura').click(function() {

                vModal('Sistema/facturacion/selecciontalonario.php?', 'Seleccionar Talonario');
            
            });
            
            $('#tipo_serv').change(function() {

                buscar_categoria_serv()
            });

            $('#condicion_pago').change(function() {
                condicion_pago = $('#condicion_pago').val().split('%%')
                if(condicion_pago[1]== 1){
                    $('#agre_pago').prop("disabled",false)
                    console.log(totales)
                    //if(totales[0].fg_base == 1){
                        $('#agre_reten').prop("disabled",false)
                    //}
                    saldos()
                }else{
                    $('#agre_pago').prop("disabled",true)
                    $('#agre_reten').prop("disabled",true)
                    $('#factura').prop("disabled",false)
                    $('#visualizar').prop("disabled",false)                    
                    $('#saldoss').html(0.00)
                    $('#afavor').html(0.00)
                    saldo = 0
                    afavor = 0; 
                }
            });

            $('#visualizar').click(function() {
                visualizar_factura()
            });
            $('#btn-buscar').click(function() {  
                
                if (limpiar == 0){

                    limpiar = 1;
                    $('#btn-buscar').html("Cancelar")
                    $("#btn-buscar").removeClass("btn-default");
                    $("#btn-buscar").addClass("btn-danger");
                    buscarpre()

                }else{
                    $('#tipo_serv').val('')
                    $('#tipo_serv').change()
                    $('#anio').val('')
                    $('#pre').val('')
                    $('#btn-buscar').html("Buscar")
                    $('#cabecera').html('')	
                    $("#btn-buscar").removeClass("btn-danger");
                    $("#btn-buscar").addClass("btn-default");
                    $('#cabecera').html('')	
                    $('#detalle').html('')	
                    $('#sub_total').html(0)
                    $('#base_imponible').html(0)
                    $('#exento').html(0)
                    $('#iva').html(0)
                    $('#total').html(0)
                    $('#saldos').html(0)
                    $('#detalle_pagos').html('')
                    pagos = {}
                    saldo = 0
                    
                    limpiar = 0;
                    
                }
            
            });
        });

        function FiltroConsulta(PagActual)
        {				
            var Parametros="";
        }

        function agregar_pagos()
        {
            window.parent.Cargando(1);				
            vModal('Sistema/facturacion/AgregarPagos.php?id_moneda='+totales[0].id_moneda, 'Registrar pagos');
        }

        function agregar_reten()
        {
            window.parent.Cargando(1);				
            vModal('Sistema/facturacion/AgregarReten.php?id_moneda='+totales[0].id_moneda, 'Registrar Retenciones');
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