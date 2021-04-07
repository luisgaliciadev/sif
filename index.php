<?php
$Nivel = "";
include($Nivel . "includes/PHP/funciones.php");

session_start();

$SISTEMA_SIGLA = $_SESSION['SISTEMA_SIGLA'];

if (isset($_SESSION[$SISTEMA_SIGLA . 'LOGIN'])) {
	echo '
			<script language="javascript">
				self.location= "Principal.php"
			</script>';

	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>SIF</title>

		<meta charset="utf-8">

		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

		<link href="Includes/Imagenes/LogoSistema.ico" type="image/x-icon" rel="icon">

		<link href="Includes/CSS/Loading.css" rel="stylesheet">

		<link href="Includes/Plugins/inspinia/css/bootstrap.min.css" rel="stylesheet">
		<link href="Includes/Plugins/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

		<!-- Toastr style -->
		<link href="Includes/Plugins/inspinia/css/plugins/toastr/toastr.min.css" rel="stylesheet">
		<!-- Sweet Alert -->
		<link href="Includes/Plugins/inspinia/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

		<link href="Includes/Plugins/inspinia/css/animate.css" rel="stylesheet">
		<link href="Includes/Plugins/inspinia/css/style.css" rel="stylesheet">

		<style>
			body
			{
				margin-top:0px;
				border: 1px solid rgba(0, 0, 0, 0);
			}

			#FondoInicioSesion
			{
				background:url(Includes/Imagenes/FondoInicioSesion.jpg) no-repeat center fixed;
				background-size:cover;
				height:100%;
				width:100%;
				z-index:-1;
				position:fixed;
			}
		</style>
	</head>
	<body class="gray-bg">
		<div id="FondoInicioSesion"></div>
		<div id="LoadingGB" class="LoadingGB" style="display:none;">
			<!-- <div class="spinner">
			<div class="rect1"></div>
			<div class="rect2"></div>
			<div class="rect3"></div>
			<div class="rect4"></div>
			<div class="rect5"></div>
			</div> -->
			<!-- <div class="sk-folding-cube">
				<div class="sk-cube1 sk-cube"></div>
				<div class="sk-cube2 sk-cube"></div>
				<div class="sk-cube4 sk-cube"></div>
				<div class="sk-cube3 sk-cube"></div>
			</div> -->
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
		
		<div class="loginColumns animated fadeInDown">
			<div class="row">
				
				<div class="col-md-6 col-md-offset-3">
				<h1 class="title">Iniciar Sesion</h1>
					<div class="ibox-content">
						<form class="m-t" role="form" id="FromInicioSesion">
						
							<div class="form-group">
								<select name="ID_LOCALIDAD" id="ID_LOCALIDAD" class="form-control" placeholder="Seleccione el puerto" required >
									<option value="" disabled selected>SELECCIONE EL PUERTO...</option>
									<?php
										$Conector = Conectar();

										$vSQL = 'SELECT distinct ID_LOCALIDAD,NB_LOCALIDAD  FROM VIEW_LOCALIDAD ';

										$ResultadoEjecutar = $Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA = "NO", $SP_BITACORA = 'NO', $SP_ACCION = '', $SP_NB_TABLA = '', $SP_VALOR_CAMPO_ID = '');

										$CONEXION = $ResultadoEjecutar["CONEXION"];

										$ERROR = $ResultadoEjecutar["ERROR"];
										$MSJ_ERROR = $ResultadoEjecutar["MSJ_ERROR"];
										$resultPrin = $ResultadoEjecutar["RESULTADO"];

										if ($CONEXION == "SI" and $ERROR == "NO") {
											while (odbc_fetch_row($resultPrin)) {
												$ID_LOCALIDAD = odbc_result($resultPrin, "ID_LOCALIDAD");
												$NB_LOCALIDAD = odbc_result($resultPrin, "NB_LOCALIDAD");
												?>
																					<option value="<?php echo $ID_LOCALIDAD; ?>"><?php echo $NB_LOCALIDAD; ?></option>
										<?php

										}
										} else {
											echo $MSJ_ERROR;
										}

										$Conector->Cerrar();
									?>
								</select>
							</div>
							<div class="form-group">
								<input name="LOGIN" type="text" required class="form-control" id="LOGIN" placeholder="RIF - Ej.: J00000000" style="text-transform:uppercase;" autocomplete="off" value="">
							</div>
							<div class="form-group">
								<input type="password" class="form-control" placeholder="Password" required id="CLAVE" name="CLAVE" value="">
							</div>

							<button type="submit" class="btn btn-warning block full-width m-b">Ingresar</button>

							

							
						</form>
					</div>
				</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<strong>Copyright &copy; <?php if (date("Y") == 2017) {
																													} ?>. SOLUCIONES INTEGRALES SICA 9000 C.A.,
				</div>
			</div>
		</div>

		<!-- Mainly scripts -->
		<script src="Includes/Plugins/inspinia/js/jquery-2.1.1.js"></script>
		<script src="Includes/Plugins/inspinia/js/bootstrap.min.js"></script>

		<!-- Toastr -->
		<script src="Includes/Plugins/inspinia/js/plugins/toastr/toastr.min.js"></script>

		<script src="Includes/Plugins/jquery.inputmask-3.x/js/inputmask.js" type="text/javascript"></script>
		<script src="Includes/Plugins/jquery.inputmask-3.x/js/jquery.inputmask.js" type="text/javascript"></script>
		<!-- Sweet alert -->
		<script src="Includes/Plugins/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>

		

		<script>
			$(document).ready(function(e)
			{
				$('#LOGIN').focus();

				$('.close').on('click', function()
				{
					$('.container').stop().removeClass('active');
				});

				$('#FromInicioSesion').on('submit', function(e)
				{
					e.preventDefault();

					VerificarUsuario();
				});

				$('#formRecuperarClave').on('submit', function(e) 
				{
					e.preventDefault();

					recuperarClave();
				});

				$('#FormGuardarSolicitudUsuario').on('submit', function(e) 
				{
					e.preventDefault();

					GuardarSolicitudUsuario();
				});

				$('#CLAVE').keyup(function(event) 
				{
					var keycode = (event.keyCode ? event.keyCode : event.which);

					if(keycode == '13')
					{
						$('#btnIngresar').click();
					}
				});

				$('#LOGIN').blur(function(event)
				{
					if($(this).val().length!=10 && $(this).val().length>0)
					{
						window.parent.MostrarMensaje("Rojo", "Disculpe, Ingrese un RIF valido.");
						$("#LOGIN").focus();
						return;
					}
				});

				$('#LOGIN').keyup(function(event)
				{
					var keycode = (event.keyCode ? event.keyCode : event.which);

					if(keycode == '13')
					{
						$('#btnIngresar').click();
					}
				});

				$('#LOGIN').keydown(function (e)
				{
					if (e.shiftKey == 1)
					{
						return false
					}

					var code = e.which;
					var key;

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

				$("#LOGIN").inputmask("a9{1,9}",{"placeholder": ""});
			});

			function VerificarUsuario()
			{
				var ID_LOCALIDAD=$("#ID_LOCALIDAD").val();
				var	LOGIN=$("#LOGIN").val();
				var CLAVE=$("#CLAVE").val();

				if($('#LOGIN').val().length!=10)
				{
					window.parent.MostrarMensaje("Rojo", "Disculpe, Ingrese un RIF valido.");
					$("#LOGIN").focus();
					return;
				}

				VarCaptcha=VerificarCaptcha();

				if(VarCaptcha==0)
				{
					window.parent.MostrarMensaje("Rojo", "Disculpe, Disculpe, el Captcha ingresado no es correcto.");
					$("#TxtCaptcha").focus();
					return;
				}

				Parametros="&ID_LOCALIDAD="+ID_LOCALIDAD+"&LOGIN="+LOGIN+"&CLAVE="+CLAVE;

				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/Sesion/VerificarUsuario.PHP",
					data: Parametros,
					beforeSend: function()
					{
						window.parent.Cargando(1);
					},
					cache: false,
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

								$("#LOGIN").focus();
							}
							else
							{
								if(RESULTADO==-2)
								{
									window.parent.Cargando(0);

									window.parent.MostrarMensaje("Rojo", "Disculpe, su usuario se encuentra bloqueado por superar los 10 intentos fallidos!");

									$("#LOGIN").focus();
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

			function VerificarCaptcha()
			{
				return 1;
				var VarCaptcha=0;
				var TxtCaptcha = $('#TxtCaptcha').val();

				parametros='TxtCaptcha='+TxtCaptcha;

				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Includes/Plugins/cool-php-captcha-0.3.1/verificar.php",
					data: parametros,
					async: false,
					beforeSend: function()
					{
						window.parent.Cargando(1);
					},
					success: function(result)
					{
						if(result==0)
						{
							VarCaptcha=result;

							window.parent.Cargando(0);
						}
						else
						{
							VarCaptcha=result;
						}
					}
				});

				return VarCaptcha;
			}

			function RecargarCaptcha()
			{
				document.getElementById('captcha').src='Includes/Plugins/cool-php-captcha-0.3.1/captcha.php?'+Math.random();
				$('#TxtCaptcha').val('');
				$('#TxtCaptcha').focus();
			}

			function Cargando(Op)
			{
				if(Op)
				{
					if(!$("#LoadingGB").is(':visible'))
					{
						window.parent.$("#LoadingGB").css("display","");
					}
				}
				else
				{
					if($("#LoadingGB").is(':visible'))
					{
						window.parent.$("#LoadingGB").css("display","none");
					}
				}
			}

			function MostrarMensaje(Tipo, Mensaje)
			{
				toastr.options = {
					closeButton: true,
					progressBar: true,
					showMethod: 'slideDown',
					timeOut: 4000,
					positionClass: "toast-bottom-center"
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
					window.parent.Cargando(0);

					var MSJ_ERROR=Arreglo['MSJ_ERROR'];
	<?php
if (IpServidor() == "10.10.30.52") {
	?>
						alert(MSJ_ERROR);
	<?php

}
?>
					window.parent.MostrarMensaje("Rojo", "Error, No se puedo conectar con el servidor, por favor notificar al correo ssp@bolipuertos.gob.ve, envie captura de pantalla.");

					return 0;
				}
				else
				{
					var ERROR=Arreglo['ERROR'];

					if(ERROR=="SI")
					{
						window.parent.Cargando(0);

						var MSJ_ERROR=Arreglo['MSJ_ERROR'];
	<?php
if (IpServidor() == "10.10.30.52") {
	?>
							alert(MSJ_ERROR);
	<?php

}
?>
						window.parent.MostrarMensaje("Rojo", "Error de ejecución, por favor notificar al correo ssp@bolipuertos.gob.ve, envie captura de pantalla.");

						return 0;
					}
					else
					{
						return 1;
					}
				}
			}
		</script>
	</body>
</html>
