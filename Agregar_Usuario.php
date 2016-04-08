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
			
		<div class="container well" style="background:#FFFFFF">
    		
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
								<li><a href="Usuarios.php"><i class="icon-list-alt"></i> Listar</a></li>
								<li><a href="Administrar_Usuario.php"><i class="icon-edit"></i> Administrar</a></li>
                                <li><a href="index.php"><i class="icon-pencil"></i>Cerrar Sesion</a></li>

							</ul>
    					</div>  				
					</div>


    				<div class="span8 well" style="background:#FFFFFF">
                    	<caption><h3 align="center">Ingrese datos de usuario</h3></caption>
                    	<hr></hr>
  						<form action="#" method="post" class="form-horizontal">
  							<div class="control-group">
								<label class="control-label" for="inputCedula">Cedula</label>
							<div class="controls">
							    <input type="text" name="inputCedula" placeholder="V-00003300">
							</div>
							</div>
  							<div class="control-group">
    							<label class="control-label" for="inputNombre">Nombre</label>
    							<div class="controls">
      								<input type="text" name="inputNombre" placeholder="Nombre">
    							</div>
  							</div>
							<div class="control-group">
								<label class="control-label" for="inputApellido">Apellido</label>
							    <div class="controls">
							    	<input type="text" name="inputApellido" placeholder="Apellido">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="inputUsuario">Nombre de Usuario</label>
							    <div class="controls">
							    	<input type="text" name="inputUsuario" placeholder="Loggin">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="inputPassword">Contrasena</label>
							    <div class="controls">
							    	<input type="password" name="inputPassword" placeholder="Password">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="inputDep">Departamento</label>
								<div class="controls">
							    	<select name="sel_dpto">
							    	<?php
    									$consulta="SELECT * FROM departamento";
										$res=consultar($consulta);
    									while($row=mysql_fetch_array($res))
    									{
    										echo "<option value=\"$row[id_dpto]\">$row[nombre]</option>";
    									}
    								?>	
  									</select>
							   	</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="inputRol">Rol</label>
								<div class="controls">
							    	<select name="sel_rol">
							    	<?php
    									$consulta="SELECT * FROM rol";
										$res=consultar($consulta);
    									while($row=mysql_fetch_array($res))
    									{
    										echo "<option value=\"$row[id_rol]\">$row[nombre]</option>";
    									}
    								?>	
  									</select>
  									<hr></hr>
							      	<button type="submit" name="b_agregar" class="btn-primary">Registrar</button>
							   	</div>
							</div>
							<?php
								if(isset($_POST["b_agregar"])){
									$cedula=$_POST["inputCedula"];
									$nombre=$_POST["inputNombre"];
									$apellido=$_POST["inputApellido"];
									$login=$_POST["inputUsuario"];
									$clave=$_POST["inputPassword"];
									$id_rol=$_POST["sel_rol"];
									$id_dep=$_POST["sel_dpto"];									
									$insertar="INSERT INTO usuario VALUES('$cedula','$nombre',$id_rol,$id_dep,'$apellido','$login','$clave')";
									
									//echo "El usuario ".$nombre." ha sido creado exitosamente!";
									if (!actualizar_bd($insertar)) {
    										
											echo "<div class=\"alert alert-error\">";
  												echo "Error el usuario no se ha podido crear!";
											echo "</div>";
									}else{
										echo "<div class=\"alert alert-success\">";
  												echo "El usuario ".$nombre." ha sido creado exitosamente!";
											echo "</div>";
									

									}
								}
							?>
						</form>
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
</body>
</html>
