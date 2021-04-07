<?php 
$Nivel = "";
include($Nivel . "includes/PHP/funciones.php");

session_start();

$SISTEMA_SIGLA = $_SESSION['SISTEMA_SIGLA'];

$LOGIN = $_SESSION[$SISTEMA_SIGLA . 'LOGIN'];
$RAZON_SOCIAL = $_SESSION[$SISTEMA_SIGLA . 'RAZON_SOCIAL'];
$NB_ROL = $_SESSION[$SISTEMA_SIGLA . 'NB_ROL'];
$FH_REGISTRO = $_SESSION[$SISTEMA_SIGLA . 'FH_REGISTRO'];
$E_MAILU = $_SESSION[$SISTEMA_SIGLA . 'E_MAILU'];

ValidarSesion($Nivel);


?>
<!DOCTYPE html>
<html>

<head>
    <title>Sistema Multimoneda BP</title>

	<meta charset="utf-8">

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!-- Icono Logo Sistema -->
	<link href="Includes/Imagenes/LogoSistema.ico" type="image/x-icon" rel="icon">
	<!-- Loading -->
	<link href="Includes/CSS/Loading.css" rel="stylesheet">
	<!-- DataTables -->
	<link href="Includes/Plugins/inspinia/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<!-- bootstrap -->
    <link href="Includes/Plugins/inspinia/css/bootstrap.min.css" rel="stylesheet">
	<!-- font-awesome -->
    <link href="Includes/Plugins/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="Includes/Plugins/toastr-master/toastr.css" rel="stylesheet">
    <!-- daterangepicker -->
	<link href="Includes/Plugins/inspinia/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <!-- datapicker -->
	<link href="Includes/Plugins/inspinia/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <!-- clockpicker -->
	<link href="Includes/Plugins/inspinia/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <!-- pace -->
	<link href="Includes/Plugins/inspinia/css/plugins/pace/pace.css" rel="stylesheet">
	<!-- dropzone -->
    <link href="Includes/Plugins/inspinia/css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="Includes/Plugins/inspinia/css/plugins/dropzone/dropzone.css" rel="stylesheet">
    <!-- Sweet Alert -->
	<link href="Includes/Plugins/inspinia/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <!-- select2 -->
	<link href="Includes/Plugins/inspinia/css/plugins/select2/select2.min.css" rel="stylesheet">
    <!-- tablesaw -->
	<link rel="stylesheet" href="Includes/Plugins/tablesaw-master/dist/tablesaw.css">
	<!-- inspinia animate -->
    <link href="Includes/Plugins/inspinia/css/animate.css" rel="stylesheet">
	<!-- inspinia style -->
	<link href="Includes/Plugins/inspinia/css/style.css" rel="stylesheet">

	<style>
		/*#side-menu>li>a{
			padding-left:10px;
			padding-right:10px;
		}

		#side-menu li>a>span{
			display: inline-block;
		}

		#side-menu>li>a>.tituloMenu{
			overflow		: hidden;
			white-space		: nowrap;
			text-overflow	: ellipsis;
			width: 170px;
			float:left;
		}

		#side-menu>li>ul>li>a{
			padding-left:20px;
			padding-right:10px;
		}

		#side-menu>li>ul>li>a>.tituloMenu{
			overflow		: hidden;
			white-space		: nowrap;
			text-overflow	: ellipsis;
			width: 160px;
			float:left;
		}

		#side-menu>li>ul>li>ul>li>a{
			padding-left:30px;
			padding-right:10px;
		}

		#side-menu>li>ul>li>ul>li>a>.tituloMenu{
			overflow		: hidden;
			white-space		: nowrap;
			text-overflow	: ellipsis;
			width: 145px;
			float:left;
		}*/

		
	</style>
</head>

<body class=" skin-3  <?php echo $_SESSION[$_SESSION['SISTEMA_SIGLA'] . 'SISTEMA_NO_CONFIG']; ?>  <?php echo $_SESSION[$_SESSION['SISTEMA_SIGLA'] . 'SISTEMA_BOXED']; ?> fixed-footer">
	<div id="LoadingGB" class="LoadingGB" style="display:none;">
	
		<div class="LoadingGB2" ></div>
		<div class="sk-cube-grid">
			<div class="sk-cube sk-cube1"></div>
			<div class="sk-cube sk-cube2"></div>
			<div class="sk-cube sk-cube3"></div>
			<div class="sk-cube sk-cube4"></div>
			<div class="sk-cube sk-cube5"></div>
			<div class="sk-cube sk-cube6"></div>
			<div class="sk-cube sk-cube7"></div>
			<div class="sk-cube sk-cube8"></div>
			<div class="sk-cube sk-cube9"></div>
		</div>
         <div id="Cargando">Cargando...</div>
    </div>
	
	<div id="paginaPrincipal" style="display:none;">
		<div id="wrapper">
			<nav class="navbar-default navbar-static-side" role="navigation">
				<div class="sidebar-collapse">
					<ul class="nav metismenu" id="side-menu">
					</ul>
				</div>
			</nav>

			<div id="page-wrapper" class="gray-bg">
				<div class="row border-bottom">
					<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
						<div class="navbar-header">
							<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
						</div>
						<ul class="nav navbar-top-links navbar-left">
							<li style="padding-top:20px;">
								<span class="text-white">
									<strong>SIF <?php echo $cadUsuVentas;?></strong>
								</span>
							</li>
						</ul>
						<ul class="nav navbar-top-links navbar-right">
							<li>
								<a href="javascript:" onClick="CerrarSesion();">
									<i class="fa fa-sign-out"></i> Salir
								</a>
							</li>
						</ul>
					</nav>
				</div>
				
				<div id="ContenidoNuevo"></div>
				
				<div class="footer">
					<div class="pull-right"></div>
					<div>
						<strong>Copyright &copy; <?php if (date("Y") == 2017) {
																															echo "" . date("Y");
																														} else {
																															echo "2017-" . date("Y");
																														} ?>. SOLUCIONES INTEGRALES SICA 9000 C.A.,
					</div>
				</div>
			</div>
		</div>
	</div>
    
    <!-- Modal3 -->
    <div class="modal fade" id="vModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="vModalTitulo3"></h4>
                </div>
                <div class="modal-body" id="vModalContenido3">
                </div>
            </div>
        </div>
    </div>

    <!-- jquery -->
    <script src="Includes/Plugins/inspinia/js/jquery-2.1.1.js"></script>
    <!-- bootstrap -->
    <script src="Includes/Plugins/inspinia/js/bootstrap.min.js"></script>
    <!-- Toastr -->
	<script src="Includes/Plugins/toastr-master/toastr.js"></script>	
	 <!-- Date range use moment.js same as full calendar plugin -->
	 <script src="Includes/Plugins/inspinia/js/plugins/fullcalendar/moment.min.js"></script>
	 <script src="Includes/Plugins/jqueryprice_format18.js"></script>
    <!-- Date range picker -->
	<script src="Includes/Plugins/inspinia/js/plugins/daterangepicker/daterangepicker.js"></script>	
	<!-- Data picker -->
	<script src="Includes/Plugins/inspinia/js/plugins/datapicker/bootstrap-datepicker.js"></script>    
     <!-- DataTables -->
	<script src="Includes/Plugins/inspinia/js/plugins/dataTables/datatables.min.js"></script>
	<!-- inputmask -->
	<script src="Includes/Plugins/jquery.inputmask-3.x/js/inputmask.js" type="text/javascript"></script>
	<script src="Includes/Plugins/jquery.inputmask-3.x/js/jquery.inputmask.js" type="text/javascript"></script>
	<!-- Clock picker -->
    <script src="Includes/Plugins/inspinia/js/plugins/clockpicker/clockpicker.js"></script>	
	<!-- DROPZONE -->
	<script src="Includes/Plugins/inspinia/js/plugins/dropzone/dropzone.js"></script>
	<!-- js-xlsx-master -->
	<script src="Includes/Plugins/js-xlsx-master/dist/xlsx.core2.min.js"></script>
    <!-- Sweet alert -->
    <script src="Includes/Plugins/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>
	<!--jasny -->
	<script src="Includes/Plugins/inspinia/js/plugins/jasny/jasny-bootstrap.min"></script>
    <!-- tablesaw -->
    <script src="Includes/Plugins/tablesaw-master/dist/tablesaw.jquery.js"></script>
    <!-- <script src="Includes/Plugins/tablesaw-master/dist/tablesaw-init.js"></script> -->
    <!-- Select2 -->
    <script src="Includes/Plugins/inspinia/js/plugins/select2/select2.full.min.js"></script>
	<script src="Includes/Plugins/inspinia/js/plugins/select2/select2.es.js"></script>

	<script src="Includes/Plugins/jsNumberFormatter/jsnumberformatter.js"></script>
		<script src="Includes/Plugins/jsNumberFormatter/jsnumberformatter.locale.js"></script>
		<script src="Includes/Plugins/src/jquery.mask.js"></script>
    
    <script>
		$(document).ready(function(e) 
		{
			VerificarTiempoSesion();

			playWorker();

			ConstruirMenu();

			AbrirModulo("MenDes33", 'Inicio', "Sistema/Inicio/Inicio.php");
			
		});

		
		
		function iniciarSesionVenta(){
			Parametros='';
			$.ajax(
			{
				type: "POST",
				url: "Sistema/SesionAgentes/IniciarSesionVenta.php",
				data: Parametros,
				async: false,
				beforeSend: function()
				{
					Cargando(1);
				},
				success: function(Resultado)
				{
					if(window.parent.ValidarConexionError(Resultado)==1)
					{
						var Arreglo=jQuery.parseJSON(Resultado);

						var RESULTADO=Arreglo['RESULTADO'];

						if(RESULTADO==-3)
						{
							window.parent.Cargando(0);

							window.parent.MostrarMensaje("Rojo", "Disculpe, Usuario no se encuentra registrado!");
						}
						else
						{
							if(RESULTADO==-2)
							{
								window.parent.Cargando(0);

								window.parent.MostrarMensaje("Rojo", "Disculpe, su usuario se encuentra bloqueado por superar los 10 intentos fallidos!");
							}
							else
							{
								if(RESULTADO==-1)
								{
									var COUNT_CLAV_ERRA=Arreglo['COUNT_CLAV_ERRA'];

									COUNT_CLAV_ERRA=10-COUNT_CLAV_ERRA;

									window.parent.Cargando(0);

									if(COUNT_CLAV_ERRA>0)
									{
										window.parent.MostrarMensaje("Amarillo", "Disculpe, clave errada!, Le quedan "+COUNT_CLAV_ERRA+" Intentos.");

										swal("Disculpe", "clave errada!, Le quedan "+COUNT_CLAV_ERRA+" intentos", "error" );

									}
									else
									{
										window.parent.MostrarMensaje("Rojo", "Disculpe, su usuario se encuentra bloqueado por superar los 10 intentos fallidos!");
									}

								}
								else
								{
									if(RESULTADO==0)
									{
										window.parent.Cargando(0);

										window.parent.MostrarMensaje("Amarillo", "Disculpe, su usuario ha sido deshabilitado!");
									}
									else
									{
										if(RESULTADO==1)
										{
											window.location.href='Principal.php';
										}
									}
								}
							}
						}
					}
				}
			});
		}

		function vModal3(URl, Titulo)
		{
			Cargando(1);

			$("#vModalTitulo3").html("");
			$("#vModalContenido3").html("");

			$("#vModalTitulo3").html(Titulo);
			$("#vModalContenido3").load(URl);
			$("#vModal3").modal();
		}

		function ConstruirMenu()
		{
			Parametros="";
			$.ajax(
			{
				type: "POST",
				url: "Sistema/Sesion/ConstruirMenu.php",
				data: Parametros,
				async: false,
				beforeSend: function()
				{
					//Cargando(1);
				},
				success: function(Resultado)
				{
					//Cargando(0);

					if(ValidarConexionError(Resultado)==1)
					{
						var Arreglo=jQuery.parseJSON(Resultado);

						var Menu=Arreglo['Menu'];	

						$('#side-menu').html(Menu);

						$('#side-menu a').each(function(indice, elemento) 
						{
							$(this).attr('title', $(this).text().trim());
						});

						$('#paginaPrincipal').show();
					}
				}
			});
		}
		
		function VerificarTiempoSesion()
		{		
			Parametros="";
			
			$.ajax(
			{
				type: "POST",
				url: "VerificarTiempoSesion.php",
				data: Parametros,
				success: function(Resultado)
				{
					//alert(Resultado);

					var Arreglo =jQuery.parseJSON(Resultado);
						
					var Sesion=Arreglo["Sesion"];
					
					if(Sesion==1)
					{
						window.location.href = "PantallaBloqueado.php";	
					}
				}
			});
		}		
			   
		function playWorker()
		{			
			if (typeof(Worker)=="undefined")
			{
				document.getElementById("mensajeWK").innerHTML = "<b style='color:red'>" +
				"Workers no soportado</b>";
			} 
			else 
			{
				Worker = new Worker("Worker.js");
				
				Worker.addEventListener
				(
					"message",
					function(event)
					{
						var Arreglo =jQuery.parseJSON(event.data.msg);
						
						var Sesion=Arreglo["Sesion"];
						var FHActual=Arreglo["FHActual"];
						var FHMaxima=Arreglo["FHMaxima"];
						
						//console.log(FHActual+">"+FHMaxima+"="+Sesion);	
						
						if(Sesion==1)
						{
							window.location.href = "PantallaBloqueado.php";	
						}
					},
					false
				);
			}
			
			if (Worker)
			{
				Worker.postMessage(
				{
					"msg": ""
				});
			}
		}
		
		function stopWorker()
		{
			if (Worker)
			{
				Worker.terminate();
			}
		}
		
		function AbrirModulo(vID_MODULO, vNB_MODULO, hojaPHP)
		{					
			
			if(hojaPHP)
			{
				Cargando(1);
					
				$("#ContenidoNuevo").load(hojaPHP, {vID_MODULO:vID_MODULO, vNB_MODULO:vNB_MODULO})		 
				
				ActivarMenu(vID_MODULO);
			}
		}
		
		
            
		function ActivarMenu(ID_MODULO)
		{
			
			
			$('#side-menu a').each(function(indice, elemento) 
			{
				$(elemento).parent().removeClass("active");
			});	
			
			$('#side-menu ul').each(function(indice, elemento) 
			{
				$(elemento).removeClass("in");
				$(elemento).css("display","");
				$(elemento).attr("aria-expanded", "false");
			});
			
			var ClassNivelActual=$("#"+ID_MODULO).parent().attr("class");
			
			var PosI=ClassNivelActual.search("MenuNivel")+9;
			var PosF=ClassNivelActual.lengt;
						
			NroNivelActual=ClassNivelActual.substring(PosI, PosF);
					
			Padre=$("#"+ID_MODULO).parent();
			
			do
			{				
				if(parseInt(Padre.attr("class").search("MenuNivel"+NroNivelActual))>=0)
				{
					//alert("MenuNivel"+NroNivelActual);
					NroNivelActual--;

					Padre.addClass("active");	
					Padre.parent().addClass("in");				
					//Padre.parent().css("display","block");
					
					Padre=Padre.parent();
				}
				else
				{					
					Padre=Padre.parent();					
				}
				
				if(NroNivelActual<0)
				{
					break;
				}
				
			}while(true)
		}
						
		function CerrarSesion()
		{
			$.ajax(
			{
				type: "POST",
				dataType:"html",
				url: "Sistema/Sesion/CerrarSesion.php",			
				data: "",									
				cache: false,
				beforeSend: function(){
					parent.Cargando(1);
				},				
				success: function(result)
				{		
					window.location.href = "index.php"
				}
			});	
		}
						
		function Bloqueo()
		{
			window.location.href = "PantallaBloqueado.php";
		}
					
		function Cargando(Op, descripcion)
		{
			if (descripcion) {
				$("#Cargando").html(descripcion);
			} else {
				$("#Cargando").html('Cargando...');
			}

			if(Op)
			{
				$("#LoadingGB").css("display","");
			}
			else
			{
				$("#LoadingGB").css("display","none");
			}
		}

		function MostrarMensaje(Tipo, Mensaje)
		{
			toastr.options = {
				closeButton: true,
				progressBar: true,
				showMethod: 'slideDown',
				timeOut: 4000,
				positionClass: "toast-bottom-center",
			};
			
			switch(Tipo)
			{					
				case "Verde":
					toastr.success(Mensaje, "Procesado");	
				break;

				case "Amarillo":
					toastr.warning(Mensaje, "Alerta");	
				break;

				case "Rojo":
					toastr.error(Mensaje, "Error");	
				break;

				case "Azul":
					toastr.info(Mensaje, "Informacion");	
				break;
			}
		}
			
		function ValidarConexionError(Resultado)
		{			
			var Arreglo=jQuery.parseJSON(Resultado);
				
			var CONEXION=Arreglo['CONEXION'];
			
			if(CONEXION=="NO")
			{		
				Cargando(0);
						
				var MSJ_ERROR=Arreglo['MSJ_ERROR'];	
<?php
//if (IpServidor() == "10.10.30.52") {
	if (1) {
	?>	
					alert(MSJ_ERROR);
<?php

}
?>
				MostrarMensaje("Rojo", "Error, No se puedo conectar con el servidor.");
				
				Cargando(0);

				return 0;
			}
			else
			{
				var ERROR=Arreglo['ERROR'];
				
				if(ERROR=="SI")
				{		
					Cargando(0);
							
					var MSJ_ERROR=Arreglo['MSJ_ERROR'];	
<?php
//if (IpServidor() == "10.10.30.52") {
	if (1) {
	?>	
						alert(MSJ_ERROR);
<?php

}
?>
					MostrarMensaje("Rojo", "Error de ejecución.");
					
					Cargando(0);

					return 0;
				}
				else
				{
					Cargando(0);

					return 1;
				}
			}
		}	

		function ValidarEntradaTeclado(ID, Tipo)
		{
			switch(true)
			{
				case Tipo == 'SoloLetras':	
					$('#'+ID).keydown(function (e)
					{
						if (e.shiftKey == 1) 
						{
							return true;
						}

						var code = e.which;
						var key;

						//alert(tlf.length+" "+code);

						key = String.fromCharCode(code);

						switch(true)
						{
							///Letas del teclado
							case code >= 65 && code <= 90:
							// 37 (Flecha izquierda), 39 (Flecha derecha), 8 (Borrar) , 46 (Suprimir), 36 (Inicio), 35 (Fin), 32 (Espacio), 
							case code == 37 || code == 39 || code == 8 || code == 46 || code == 35 || code == 36 || code == 9 || code == 32:
								return true;
							break;
						}

						e.preventDefault();
					});
				break;

				case Tipo == 'SoloNumeros':	
					$('#'+ID).keydown(function (e)
					{
						if (e.shiftKey == 1) 
						{
							return true;
						}

						var code = e.which;
						var key;

						//alert(tlf.length+" "+code);

						key = String.fromCharCode(code);

						switch(true)
						{
							//Numeros del teclado
							case code >= 48 && code <= 57:
							//Numpad
							case code >= 96 && code <= 105:
							// 37 (Flecha izquierda), 39 (Flecha derecha), 8 (Borrar) , 46 (Suprimir), 36 (Inicio), 35 (Fin), 32 (Espacio), 
							case code == 37 || code == 39 || code == 8 || code == 46 || code == 35 || code == 36 || code == 9 || code == 32:
								return true;
							break;
						}

						e.preventDefault();
					});
				break;

				case Tipo == 'SoloLetrasNumeros':	
					$('#'+ID).keydown(function (e)
					{
						if (e.shiftKey == 1) 
						{
							return true;
						}

						var code = e.which;
						var key;

						//alert(tlf.length+" "+code);

						key = String.fromCharCode(code);

						switch(true)
						{
							///Letas del teclado
							case code >= 65 && code <= 90:
							//Numeros del teclado
							case code >= 48 && code <= 57:
							//Numpad
							case code >= 96 && code <= 105:
							// 37 (Flecha izquierda), 39 (Flecha derecha), 8 (Borrar) , 46 (Suprimir), 36 (Inicio), 35 (Fin), 32 (Espacio), 
							case code == 37 || code == 39 || code == 8 || code == 46 || code == 35 || code == 36 || code == 9 || code == 32:
								return true;
							break;
						}

						e.preventDefault();
					});
				break;

				case Tipo == 'RIF':					
					$('#'+ID).inputmask("a99999999-9",{"placeholder": "V########-#"});

					$('#'+ID).keydown(function (e)
					{
						if (e.shiftKey == 1) 
						{
							return true;
						}

						var code = e.which;
						var key;

						key = String.fromCharCode(code);

						var tlf	=	$(this).val();

						//alert(tlf);							

						switch(true)
						{
							//Tipo de personas 86 (V), 69 (E), 71 (G), 74 (J), 80 (P) 
							case code == 86 || code == 69 || code == 71 || code == 74 || code == 80:
							//Numeros del teclado
							case code >= 48 && code <= 57:
							//Numpad
							case code >= 96 && code <= 105:
							// 37 (Flecha izquierda), 39 (Flecha derecha), 8 (Borrar) , 46 (Suprimir), 36 (Inicio), 35 (Fin)
							case code == 37 || code == 39 || code == 8 || code == 46 || code == 35 || code == 36 || code == 9:
								return true;
							break;
						}

						e.preventDefault();
					});
				break;

				case Tipo == 'CI':				
					$('#'+ID).inputmask("a99999999",{"placeholder": "V########"});

					$('#'+ID).keydown(function (e)
					{
						if (e.shiftKey == 1) 
						{
							return true;
						}

						var code = e.which;
						var key;

						var tlf	=	$(this).val();

						//alert(tlf.length+" "+code);

						switch(true)
						{
							//Tipo de personas 86 (V), 69 (E)
							case code == 86 || code == 69:
							//Numeros del teclado
							case code >= 48 && code <= 57:
							//Numpad
							case code >= 96 && code <= 105:
							// 37 (Flecha izquierda), 39 (Flecha derecha), 8 (Borrar) , 46 (Suprimir), 36 (Inicio), 35 (Fin)
							case code == 37 || code == 39 || code == 8 || code == 46 || code == 35 || code == 36 || code == 9:
								return true;
							break;
						}

						e.preventDefault();
					});
				break;

				case Tipo == 'TLFCelular':	
					$('#'+ID).inputmask("9999-9999999",{"placeholder": "####-#######"});

					$('#'+ID).keydown(function (e)
					{
						if (e.shiftKey == 1) 
						{
							return false
						}

						var code 		=	e.which;
						var key	 		=	String.fromCharCode(code);

						var tlf			=	$(this).val().split("#").join("");
						var Longitud 	= 	tlf.length;

						//alert(Longitud+" "+code);	

						switch(true)
						{
							case Longitud == 0 || Longitud == 1:
								switch(true)
								{
									//Numeros del teclado
									case code == 48:
									//Numpad
									case code == 96:
									// 37 (Flecha izquierda), 39 (Flecha derecha), 8 (Borrar) , 46 (Suprimir), 36 (Inicio), 35 (Fin), 
									case code == 37 || code == 39 || code == 8 || code == 46 || code == 35 || code == 36 || code == 9:						
										return true;
									break;
								}
							break;

							case Longitud == 2:
								switch(true)
								{
									//Numeros del teclado
									case code == 52:
									//Numpad
									case code == 100:
									// 37 (Flecha izquierda), 39 (Flecha derecha), 8 (Borrar) , 46 (Suprimir), 36 (Inicio), 35 (Fin), 
									case code == 37 || code == 39 || code == 8 || code == 46 || code == 35 || code == 36 || code == 9:						
										return true;
									break;
								}
							break;

							case Longitud == 3:
								switch(true)
								{
									//Numeros del teclado
									case code == 49 || code == 50:
									//Numpad
									case code == 97 || code == 98:
									// 37 (Flecha izquierda), 39 (Flecha derecha), 8 (Borrar) , 46 (Suprimir), 36 (Inicio), 35 (Fin), 
									case code == 37 || code == 39 || code == 8 || code == 46 || code == 35 || code == 36 || code == 9:						
										return true;
									break;
								}
							break;

							case Longitud == 4:
								switch(true)
								{
									//Numeros del teclado
									case code == 50 || code == 52 || code == 54:
									//Numpad
									case code == 98 || code == 100 || code == 102:
									// 37 (Flecha izquierda), 39 (Flecha derecha), 8 (Borrar) , 46 (Suprimir), 36 (Inicio), 35 (Fin), 
									case code == 37 || code == 39 || code == 8 || code == 46 || code == 35 || code == 36 || code == 9:						
										return true;
									break;
								}
							break;

							case Longitud > 4:
								switch(true)
								{
									//Numeros del teclado
									case code >= 48 && code <= 57:
									//Numpad
									case code >= 96 && code <= 105:
									// 37 (Flecha izquierda), 39 (Flecha derecha), 8 (Borrar) , 46 (Suprimir), 36 (Inicio), 35 (Fin), 
									case code == 37 || code == 39 || code == 8 || code == 46 || code == 35 || code == 36 || code == 9:						
										return true;
									break;
								}
							break;
						}

						e.preventDefault();
					});
				break;

				case Tipo == 'TLFFijo':
				break;
			}
		}
	</script>
   
    <script src="Includes/Plugins/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="Includes/Plugins/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="Includes/Plugins/inspinia/js/inspinia.js"></script>
    <script src="Includes/Plugins/inspinia/js/plugins/pace/pace.min.js"></script>
</body>

</html>