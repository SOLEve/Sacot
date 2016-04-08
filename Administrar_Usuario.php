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
								<li><a href="Agregar_Usuario.php"><i class="icon-pencil"></i> Agregar</a></li>
								<li><a href="Usuarios.php"><i class="icon-list-alt"></i> Listar</a></li>
								<li><a href="#"><i class="icon-edit"></i> Administrar</a></li>
                                <li><a href="index.php"><i class="icon-pencil"></i>Cerrar Sesion</a></li>
							</ul>
    					</div>  				
					</div>
					<?php
						if(isset($_POST['b_consultar'])){
							$consulta="SELECT * FROM usuario WHERE ced_usu='".$_POST["sel_ced"]."'";
							$res=consultar($consulta);
							$fila=mysql_fetch_array($res);
							$_POST["inputCedula"]  	    =$fila[ced_usu];
							$_POST["inputNombre"]   =$fila[nombre];
							$_POST["inputApellido"] =$fila[apellido];
							$_POST["inputUsuario"]  =$fila[login];
							$_POST["inputPassword"] =$fila[clave];
							$_POST["inputDpto"]     =$fila[departamento_id_dpto];
							$_POST["inputRol"]      =$fila[rol_id_rol];
						}
						if(isset($_POST['b_modificar'])){
								$ced=$_POST["inputCedula"];
								$nom=$_POST["inputNombre"];
								$ape=$_POST["inputApellido"];
								$usu=$_POST["inputUsuario"];
								$pas=$_POST["inputPassword"];
								$dpt=$_POST["inputDpto"];
								$rol=$_POST["inputRol"];
								$act="UPDATE usuario SET nombre='$nom',rol_id_rol=$rol,departamento_id_dpto=$dpt,apellido='$ape',login='$usu',clave='$pas' WHERE ced_usu='$ced'";
								actualizar_bd($act);
						}
					?>
    				<div class="span8 well" style="background:#FFFFFF">
  						<form class="form-horizontal" method="post" action="#">
	  						<div class="control-group">
								<label class="control-label" for="inputCedula">Cedula a Consultar</label>
								<div class="controls">
									<select name="sel_ced" value="">
									<?php
    									$consulta="SELECT * FROM usuario";
										$res=consultar($consulta);
	    								while($row=mysql_fetch_array($res))
	    								{
	    									echo "<option value=\"$row[ced_usu]\">$row[ced_usu]</option>";
	    								}
    								?>	
    								</select>
									<!--<input type="text" id="inputCedula" placeholder="V-00003300">-->
							      	<button type="submit" name="b_consultar" class="btn-primary">Consultar</button>
							   	</div>
							</div>
							<hr></hr>
							<div class="control-group">
                            <label class="control-label" for="inputCedula">Cedula</label>
                  
    							<div class="controls">
      								<input name="inputCedula" type="text" id="inputCedula"  value="<?php echo $_POST["inputCedula"];?>" readonly>
   							  </div>
						  </div>
							<div class="control-group">
	              <label class="control-label" for="inputCedula">Nombre</label>
                  
						  <div class="controls">
   								<input type="text" name="inputNombre"  value="<?php echo $_POST["inputNombre"];?>">
    							</div>
  							</div>
							<div class="control-group">
								<label class="control-label" for="inputApellido">Apellido</label>
							    <div class="controls">
							    	<input type="text" name="inputApellido" value="<?php echo $_POST["inputApellido"];?>">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="inputUsuario">Nombre de Usuario</label>
							    <div class="controls">
							    	<input type="text" name="inputUsuario" value="<?php echo $_POST["inputUsuario"];?>">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="inputPassword">Contrasena</label>
							    <div class="controls">
							    	<input type="password" name="inputPassword" value="<?php echo $_POST["inputPassword"];?>">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input">Departamento</label>
							    <div class="controls">
							    	<input type="text" name="inputDpto" value="<?php echo $_POST["inputDpto"];?>">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="inputRol">Rol</label>
								<div class="controls">
							    	<input type="text" name="inputRol" value="<?php echo $_POST["inputRol"];?>">
							    	<hr></hr>
							      	<button type="submit" name="b_modificar" class="btn-primary">Modificar</button>
							      	<button type="submit" name="b_eliminar" class="btn-primary">Eliminar</button>
							   	</div>
							</div>
							<?php
								
								if(isset($_POST["b_eliminar"])){
									$eliminar="DELETE FROM usuario WHERE ced_usu='".$_POST["inputCedula"]."'";
									actualizar_bd($eliminar);
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