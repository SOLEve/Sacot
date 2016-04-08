<?php 
session_start(); 
	include("Librerias.php");
	
	
	if(isset($_SESSION["conex"]))
	{
		if($_SESSION["conex"]==0)
		{
		echo '<script language="JavaScript" type="text/javascript">
				document.location= "index.php";
				</script>';
		}	
	}

?>
<!doctype html>
<html lang="en">
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Sistema Ordenes de Trabajo</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>
	
	<div >
			
		<div class="container-fluid" >
    		
    		<div class="row" >
				<!--Logo de la Alcaldia en el Banner-->
				<div class="span3">
					<div class="bs-docs-example bs-docs-example-images">
						<img class="img-rounded" src="imagenes/logo.png">
					</div>
				</div>
				<!--Titulo del banner-->
				<div class="span11">
					<hr></hr>
					<h1 align="center" style="font-size:70px; font-style: inherit; color:#0000FF">SACOT</h1>
					<h2 align="center" >Sistema de Administracion y Control de Ordenes de Trabajo</h2>
                    <hr></hr>
				</div>
				
			</div>
			<hr></hr>
			<div class="container-fluid">
					<br></br>
				<div class="row-fluid">

    				<div class="span4 well" style="background:#FFFFFF">
    					<div class="well">	
    						<!--Menu Principal en el cuerpo de la pagina-->
							<ul class="nav nav-pills  nav-stacked">
								<li class="active"><a href="#">Inicio</a></li>
								<li><a href="Orden_Trabajo_resp.php">Ordenes de Trabajo</a></li>
								<li><a href="index.php">Cerrar Sesion</a></li>
							</ul>
    					</div>  				
					</div>


    				<div class="span8 well" style="background:#FFFFFF">
						<!--Slider del cuerpo de la pagina-->
						<div id="myCarousel" class="carousel slide">
  							<!-- Carousel items -->
  							<div class="carousel-inner">

								<div class="item active">
									<img alt="" src="imagenes/slider-img1.png"></img>
										<div class="carousel-caption">
											<h4>Sistema SACOT</h4>
											<p>Este es un sistema que permite la creaciÃ³n de las Ordenes de Trabajo que se solicitan en la alcaldÃ­a del municipio CÃ³rdoba.</p>
										</div>
								</div>
								
								<div class="item">
									<img alt="" src="imagenes/slider-img2.png"></img>
										<div class="carousel-caption">
											<h4>Ordenes de Trabajo</h4>
											<p>Es un documentos generado para poder ejecutar una obra de reparaciÃ³n solicitada ante la alcaldÃ­a por los ciudadanos del Municipio</p>
										</div>
								</div>


								<div class="item">
									<img alt="" src="imagenes/slider-img3.png"></img>
										<div class="carousel-caption">
											<h4>Funcionalidades</h4>
											<p>El sistema permite modificar la orden de trabajo, la eliminaciÃ³n de las ordenes creadas de manera incorrecta, ayuda a un mejor seguimiento de la ejecucion de las ordenes de trabajo.</p>
										</div>
								</div>
							
  							</div>
  							<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  							<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
  						</div>
  					
  					</div>
  				</div>
  				<div class="row-fluid">
					<div class="span12">
						<hr></hr>
				    	<p align="center">Universidad Nacional Experimental del Tachira &copy; 2012 </p>
						<p align="center"> Servicio Comunitario</p>
				  		<hr></hr>
				  	</div>
				</div>
  			</div>
			
		</div>
	</div>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>