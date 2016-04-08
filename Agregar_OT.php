<?php 
	include("librerias.php");
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
	
	<div style="background:#000033">
			
		<div class="container-fluid">
    		
    		<div class="row">
				<!--Logo de la Alcaldia en el Banner-->
				<div class="span3">
					<div class="bs-docs-example bs-docs-example-images">
						<img class="img-rounded" src="imagenes/logo.png">
					</div>
				</div>
				<!--Titulo del banner-->
				<div class="span9">
					<hr></hr>
					<h1 align="center" style="font-size:70px; font-style: inherit; color:#0000FF" >SACOT</h1>
					<h2 align="center" >Sistema de Administracion y Control de Ordenes de Trabajo</h2>
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
								<li class="active"><a href="index_administrador.php"><i class="icon-home"></i> Inicio</a></li>
								<li><a href="#"><i class="icon-pencil"></i> Agregar</a></li>
								<li><a href="Orden_Trabajo.php?p=1"><i class="icon-list-alt"></i> Listar</a></li>
								<li><a href="consultar_ot.php"><i class="icon-search"></i> Consultar</a></li>
                                <li><a href="index.php"><i class="icon-pencil"></i>Cerrar Sesion</a></li>
							</ul>
    					</div>  				
					</div>
								

    							<div class="span8 well" style="background:#FFFFFF">
                                <caption><h2>Agregar Orden</h2></caption>
    								<form action="#" method="post" class="form-horizontal">
  												<div class="span6">
  														<label>Ordenado Por:</label>
                                                        <select name="dirigido">
                                                        <option value="Despacho">Despacho</option>
                                                        <option value="Alcalde">Alcalde</option>
                                                        </select>
                                                </div>
                                                <div class="control-group">
                                                	<label class="control-label" for="inputDep">Ordenado A:</label>
                                                <div class="controls">
											<select class="span6" name = "lista_a">
                                                        <option value="1">Ingenieria Municipal</option>
                                                        <option value="2">Servicios Generales</option>
                                                        <option value="3">Hacienda</option>
                                                        <option value="4">Catastro</option>
                                                        <option value="5">Recaudacion</option>
                                                        <option value="6">Sindicatura Municipal</option>
                                                        <option value="7">Recursos Humanos</option>
                                                        <option value="8">Registro Civil</option>
											</select>
								</div>
								</div>
                                                 <div class="control-group">
								<label class="control-label" for="inputCedula">Cedula</label>
							    <div class="controls">
							    	<input type="text" name="inputCedula" placeholder="V-00003300">
								</div>
							</div>
						
                                <div class="control-group">
									<label class="control-label" for="inputdesc">Descripcion del Trabajo</label>
							    <div class="controls">
							    	<textarea class="span10" rows="5" name="inputdesc" placeholder="escriba aqui"></textarea>
								</div>
						</div>



						<button type="submit" name="b_agregar" class="btn-primary">Registrar</button>
  					</div>

  				</div>
                                  <?php
                                                                if(isset($_POST["b_agregar"])){
                                                                $descr=$_POST["inputdesc"];
                                                                $ced=$_POST["inputCedula"];
                                                                $dep= $_POST["lista_a"];
																$dirigido_a= $_POST["dirigido"];
                                                                $insertar="INSERT INTO orden_trabajo(`id`, `fe_sol`, `desc_ot`,`ced_sol`,`departamento_id_dpto`,`ordenado_por`,`ejecutada`) VALUES(NULL, NOW(), '$descr','$ced','$dep','$dirigido_a','0')";

							if(actualizar_bd($insertar)){
																	$consulta="SELECT * FROM  `orden_trabajo` WHERE id = (SELECT MAX( id ) FROM  `orden_trabajo`)";
																	$res=consultar($consulta);
																	$fila=mysql_fetch_array($res);
																	mkdir("fotos/".$fila[id]);
																}else{
																	echo "Error";
																}
				}
					?>
					</form>
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
</body>
</html>
