<!doctype html>
<?php 
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	ValidarSesion($Nivel);
	
	$vNB_MODULO=$_POST["vNB_MODULO"];
	
	$Nivel="";

	$RIF=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'RIF'];
	$ID_ROL=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_ROL'];
?>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>

<link rel="stylesheet" href="Includes/Plugins/bootstrap-admin-templetes/AdminLTE-2.3.7/plugins/daterangepicker/daterangepicker.css">
       
</head>

<body>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2><?php echo $_POST["vNB_MODULO"];?></h2>
		<?php echo construirBreadcrumbs(substr($_POST["vID_MODULO"], 6, strlen($_POST["vID_MODULO"])));?>
	</div>
</div>    
	
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Reportes</h5>
					</div>
					<div class="ibox-content">
					<form role="form" id="form_sm" >
						
						<div class="form-group col-md-12 " >
							<label> Reportes:</label>
							<select class="form-control" id="reportes"  required>
								<option value="">Seleccione...</option>
								<?php 
									$vSQL="select DISTINCT ID_REPORTE, NB_REPORTE,DS_REPORTE from VIEW_REPORTES where  fg_activo=1  AND ID_ROL = $ID_ROL  order by nb_reporte asc";
									$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
							
									$CONEXION=$ResultadoEjecutar["CONEXION"];						
									$ERROR=$ResultadoEjecutar["ERROR"];
									$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
									$result=$ResultadoEjecutar["RESULTADO"];
									
									if($CONEXION=="SI" and $ERROR=="NO")
									{		
										while ($registro=odbc_fetch_array($result))
										{			
											$ID=odbc_result($result,'ID_REPORTE');
											$DES_SM=utf8_encode(odbc_result($result,'NB_REPORTE'));
											$DES=utf8_encode(odbc_result($result,'DS_REPORTE'));
											
											echo "<option value=".$ID.">$DES_SM</option>";
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

						
						<div id="info" style="float:right">
						</div>
                                  
						<div class="row">
							<div class="form-group col-md-12" >
								<button type="BUTTON" class="btn btn-warning" id="consultar">Consultar</button>		
							</div>	
						</div>	

						<div class="row">
							<div class="form-group col-md-12" >	
								<div  id="consulta"></div>
							</div>	

							<div class="row">
								<div class="form-group col-md-12" >	
									<div  id="consulta"></div>
								</div>
							</div>	
						</div>	
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>


<script src="Includes/Plugins/inspinia/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="Includes/Plugins/daterangepicker/daterangepicker.js"></script>
<script>
$( document ).ready(function() {
	window.parent.parent.Cargando(0);
	$(".detalle").hide()

	
	 
	
	
	
	$("#consultar" ).click(function() {
		$('#trrif').hide();
		$('#rif').val("");
		
		
		$('#trANO_REGISTRO').hide();
		$('#ANO_REGISTRO').val(0);
		
		$('#trano').hide();
		$('#ano').val(0);
		
		$('#trmes').hide();
		$('#mes').val(0);
		
		$('#trpuerto').hide();
		$('#puerto').val(0);
		
		$('#trf_desde').hide();
		$('#f_desde').datepicker('setDate', 'today');
		
		$('#trf_hasta').hide();
		$('#f_hasta').datepicker('setDate', 'today');
		
		$('#trcategoria').hide();
		$('#categoria').val(0);
		
		$('#trtipo_doc').hide();
		$('#tipo_doc').val(0);
		
		$('#trNroPreliquidacion').hide();
		$('#NroPreliquidacion').val('');
		
		$('#trAbogado').hide();
		$('#Abogado').val('');	
		
		$('#trAbogado').hide();
		$('#Abogado').val(0);	
		
		
		
		var id_reporte = 'id_reporte='+ $( "#reportes" ).val();
		
		
		$.ajax(
		{
			type: "POST",
			url: "Sistema/Reportes/ReportesConsulta.php",
			data: id_reporte,
			cache: false,
			beforeSend: function() 
			{			
				
			},
			success: function(html)
			{							
				
				$("#consulta").html(html);	
				

				
			}
		});
		
	});


	$("#visualizar" ).click(function() {
		impr_reporte()
	});

});

function impr_reporte()
{	
	if($('#reportes').val()!='0')
	{	
		aux=0;
		Parametros="";
	
		if($('#rif').is(':visible'))
		{
			if ($('#rif').val() == '')
			{
				window.parent.toastr.error("Disculpe, debe ingresar un RIF valido")
				return
			}
			else
			{
				if (aux == 0)
				{
					Parametros+="rif="+$('#rif').val()
					aux = 1
				}else
					Parametros+="&rif="+$('#rif').val()
			}
		}
		
		if($('#Codigo').is(':visible'))
		{
			if ($('#Codigo').val() == '')
			{
				window.parent.toastr.error("Disculpe, debe ingresar un Codigo valido")
				return
			}
			else
			{
				if (aux == 0)
				{
					Parametros+="Codigo="+$('#Codigo').val()
					aux = 1
				}else
					Parametros+="&Codigo="+$('#Codigo').val()
			}
		}
		
		if($('#tipo_mov').is(':visible'))
		{
			if ($('#tipo_mov').val() == '')
			{
				window.parent.toastr.error("Disculpe, debe ingresar el Tipo de Movimiento")
				return
			}
			else
			{
				if (aux == 0)
				{
					Parametros+="tipo_mov="+$('#tipo_mov').val()
					aux = 1
				}else
					Parametros+="&tipo_mov="+$('#tipo_mov').val()
			}
		}
	
		if($('#solicitud').is(':visible'))
		{
			if ($('#solicitud').val() == '')
			{
				window.parent.toastr.error("Disculpe, debe ingresar una solicitud valido")
				return
			}
			else
			{
				if (aux == 0)
				{
					Parametros+="solicitud="+$('#solicitud').val()
					aux = 1
				}else
					Parametros+="&solicitud="+$('#solicitud').val()
			}
		}		
		
		if ($('#nro_documento').is(':visible'))
		{
			if ($('#nro_documento').val() < 0)
			{
				window.parent.toastr.error("Disculpe, indicar el Nro")
				return
			}else{
				if (aux == 0){
					Parametros+="nro_documento="+$('#nro_documento').val()
					aux = 1
				}else
					Parametros+="&nro_documento="+$('#nro_documento').val()
			}
		}		
		
		if ($('#ano').is(':visible'))
		{
			if ($('#ano').val() < 0)
			{
				window.parent.toastr.error("Disculpe, debe seleccionar una período")
				return
			}else{
				if (aux == 0){
					Parametros+="ano="+$('#ano').val()
					aux = 1
				}else
					Parametros+="&ano="+$('#ano').val()
			}
		}		

		if ($('#nparametro').is(':visible'))
		{
			if ($('#nparametro').val() < 0)
			{
				window.parent.toastr.error("Disculpe, debe seleccionar una período")
				return
			}else{
				if (aux == 0){
					Parametros+="nparametro="+$('#nparametro').val()
					aux = 1
				}else
					Parametros+="&nparametro="+$('#nparametro').val()
			}
		}
		
		if ($('#mes').is(':visible'))
		{
			if ($('#mes').val() < 0)
			{
				window.parent.toastr.error("Disculpe, debe seleccionar una período")
				return
			}else{
				if (aux == 0){
					Parametros+="mes="+$('#mes').val()
					aux = 1
				}else
					Parametros+="&mes="+$('#mes').val()
			}
		}
		
		if ($('#f_desde').is(':visible'))
		{
			if ($('#f_desde').val() == '')
			{
				window.parent.toastr.error("Disculpe, debe ingresar una Fecha valida")
				return
			}else
				if ($('#f_desde').val() >  $('#f_hasta').val()){
					window.parent.toastr.error("Disculpe, la fecha desde no puede ser mayor que la fecha hasta")					
				}else{
					if (aux == 0){
						Parametros+="f_desde="+$('#f_desde').val()
						aux = 1	
					}else
						Parametros+="&f_desde="+$('#f_desde').val()										
				}
		}
		
		if ($('#f_hasta').is(':visible'))
		{
			if ($('#f_hasta').val() == ''){
				window.parent.toastr.error("Disculpe, debe ingresar una Fecha valida")
				return
			}else
				if ($('#f_hasta').val() <  $('#f_desde').val()){
					window.parent.toastr.error("Disculpe, la fecha hasta no puede ser menor que la fecha desde")
				}else{
					if (aux == 0){
						Parametros+="f_hasta="+$('#f_hasta').val()
						aux = 1
					}else
						Parametros+="&f_hasta="+$('#f_hasta').val()
				}
		}
		
		if ($('#categoria').is(':visible'))
		{
			if ($('#categoria').val() < 0)
			{
				window.parent.toastr.error("Disculpe, debe seleccionar una Categoría")
				return
			}else{
				if (aux == 0){
					Parametros+="categoria="+$('#categoria').val()
					aux = 1
				}else
					Parametros+="&categoria="+$('#categoria').val()
			}
		}
		
		if ($('#puerto').is(':visible'))
		{
			if (aux == 0)
			{
				Parametros+="puerto="+$('#puerto').val()
				aux = 1
			}else
				Parametros+="&puerto="+$('#puerto').val()				
		}
		
		if ($('#tipo_doc').is(':visible'))
		{
			if (aux == 0){
				Parametros+="tipo_acta="+$('#tipo_doc').val()
				aux = 1
			}else
				Parametros+="&tipo_acta="+$('#tipo_doc').val()		
		}
		
		if ($('#NroPreliquidacion').is(':visible'))
		{
			if ($('#NroPreliquidacion').val() == ''){
				window.parent.toastr.error("Disculpe, debe ingresar el nro de la preliquidacion")
				return
			}else
				if (aux == 0)
				{
					Parametros+="NroPreliquidacion="+$('#NroPreliquidacion').val()
					aux = 1
				}else
					Parametros+="&NroPreliquidacion="+$('#NroPreliquidacion').val()		
		}
		
		if ($('#status').is(':visible'))
		{
			if ($('#status').val() == ''){
				window.parent.toastr.error("Disculpe, debe seleccionar un estatus")
				return
			}else
				if (aux == 0)
				{
					Parametros+="status="+$('#status').val()
					aux = 1
				}else
					Parametros+="&status="+$('#status').val()		
		}

		if ($('#RangoFecha').is(':visible'))
		{
			if ($('#RangoFecha').val() == ''){
				window.parent.toastr.error("Disculpe, debe seleccionar un rango de fecha")
				return
			}else
				if (aux == 0)
				{
					Parametros+="RangoFecha="+$('#RangoFecha').val()
					aux = 1
				}else
					Parametros+="&RangoFecha="+$('#RangoFecha').val()		
		}
		

		ID_REPORTE=$("#reportes").val();
		NB_HOJA=$("#NB_HOJA").val();
		NB_REPORTE=$("#NB_REPORTE").val();
		//alert (Parametros);
		window.parent.$("#Loading").css("display","");			
		
		//parent.AbrirVentana(replaceAll(' ', '', NB_REPORTE), "REPORTE "+NB_REPORTE, "Sistema/Reportes/"+NB_HOJA, Parametros, 600, 1200, 0, 1, 1, 1, 1, 0);
		
		
		window.open("Sistema/Reportes/"+NB_HOJA+"?"+Parametros);
	}
}

    </script>
<script src="Sistema/Reportes/moment.min.js"></script>
</html>