<?php 
	$Nivel="../../";
	include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	ValidarSesion($Nivel);
	
	$vNB_MODULO=$_POST["vNB_MODULO"];	
	
	$Nivel="";
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	$RIF=$_SESSION[$SISTEMA_SIGLA.'RIF'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Inicio</title>
    <style type="text/css">
    .wrapper.wrapper-content.animated.fadeInRight .row .col-lg-12 .ibox.float-e-margins .ibox-title h5 {
	font-weight: bold;
	font-size: 18px;
}
    .wrapper.wrapper-content.animated.fadeInRight .row .col-lg-12 .ibox.float-e-margins .ibox-content {
	font-size: 18px;
	text-align: justify;
}
    </style>
	</head>
	<body>    
		<div class="row wrapper border-bottom white-bg page-heading">
			<div class="col-lg-10">
				<h2><?php echo $vNB_MODULO;?></h2>
				<ol class="breadcrumb">
					<li>
						<a href="./">
							<i class="fa fa-home"></i> 
							<strong>Inicio</strong>
						</a>
					</li>
				</ol>
			</div>
		</div>
		   
		
		<div class="wrapper wrapper-content animated fadeInRight">
			<div class="row">
				<div class="col-lg-12">
					<div class="ibox float-e-margins">				
						<div class="ibox-content">
							<div class="row">
								<div class="col-lg-12" >
									<h2><strong>Sistema de Facturacion Multimoneda Bolipuertos S.A</strong></h2>
									<table class="table">
                       <div class="col-lg-6">
                        <tbody>
                        <tr>
                            <td>
                                <div class="col-xs-10 col-lg-12" >
                                <button type="button" class="btn btn-warning m-r-sm"><i class="fa fa  fa-user-circle-o fa-5x"></i></button>
                                Centralizacion de Clientes
                                </div>
                            </td>
                              
                              
                             
                               
                            <td>
                                 <div class="col-xs-10 col-lg-12" >
                                <button type="button" class="btn btn-warning m-r-sm"><i class="fa fa fa-money fa-5x"></i></button> Tasas Portuarias
                              	</div>
                            </td>
                       
                        </tr>
                        <tr>
								 <td>
								   <div class="col-xs-10 col-lg-12" >
									<button type="button" class="btn btn-warning m-r-sm">
									<i class="fa fa fa-legal fa-5x"></i></button>
									Regimen Tarifario
									</div>
								</td>
								<td>
									 <div class="col-xs-10 col-lg-12" >
									<button type="button" class="btn btn-warning m-r-sm"> <i class="fa fa  fa-calculator fa-5x"></i></button>Reportes Centralizados
									</div>
								</td>
                        </tr>
                        <tr>
                            <td>
                                 <div class="col-xs-10 col-lg-12" >
                                <button type="button" class="btn btn-warning m-r-sm"><i class="fa fa fa-cogs fa-5x"></i></button>Parametrizacion Centralizada
                                </div>
                            </td>
                             <td>
                               <div class="col-xs-10 col-lg-12" >
                                 <button type="button" class="btn btn-warning m-r-sm"><i class="fa fa fa-table fa-5x"></i></button>
                                Facturacion Integrada
                                </div>
                            </td>
                             
                            
                        </tr>
                                  </tbody>
                                  </div>
                    </table>
									
					
								</div>
							</div>						
						</div>
					</div>
				</div> 
			</div>
		</div>
        <script>
			$(document).ready(function(e) 
			{
				window.parent.Cargando(0);	
			
            });			
        </script>
	</body>
</html>
