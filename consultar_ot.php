<?php 
	include("librerias.php");
		session_start();
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
                              <li><a href="Agregar_OT.php"><i class="icon-pencil"></i> Agregar</a></li>
                              <li><a href="Orden_Trabajo.php?p=1"><i class="icon-list-alt"></i> Listar</a></li>
                              <li><a href="consultar_ot.php"><i class="icon-search"></i> Consultar</a></li>
                              <li><a href="index.php"><i class="icon-pencil"></i>Cerrar Sesion</a></li>
							</ul>
    					</div>  				
					</div>
					<?php
						
						if(isset($_POST['b_modificar'])){
								$ced=$_POST["sel_ced"];
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
                    <caption><h3 align="center">Consultar Orden</h3></caption>
					  <form class="form-horizontal" method="post" action="#">
	  						<div class="control-group">
								<label class="control-label" for="inputCedula" >Cedula Solicitante</label>
							  <div class="controls">
								  <input type="text" name="input_orden" id="input_orden" value="Ingrese Cedula de solicitante" onClick="this.value='';">
								  <!--<input type="text" id="inputCedula" placeholder="V-00003300">-->
					      	    <button type="submit" name="b_consultar" class="btn-primary">Consultar</button>
                              </div>
							</div>
						  <div class="control-group">
                              <table class="table table-striped" style="width: 100%; height: 15">
  							<caption>
  							<h4>Lista de Ordenes De Trabajo Registradas</h4>
  							</caption>
  							<thead>
    							<tr>
      								<th>Id</th>
      								<th>Descripcion</th>
      								<th>Cedula</th>
    							</tr>
  							</thead>
  							<tbody>
                                                    <?php
	if(isset($_POST['b_consultar'])){
							$consulta="SELECT id, desc_ot,ced_sol FROM orden_trabajo WHERE ced_sol LIKE '%".$_POST["input_orden"]."%'";
							$res=consultar($consulta);
							
						

				                    while($row=mysql_fetch_array($res))
				                    {
				                      echo " <tr>
				                              <td name='id' align='right'> <a  href=\"Orden_Trabajo_Aministrador_Gestionar.php?id=$row[id]\">$row[id]</a> </td>
                                                                   <td><a  href=\"Orden_Trabajo_Aministrador_Gestionar.php?id=$row[id]\"> $row[desc_ot] </td>
                                                                   <td><a  href=\"Orden_Trabajo_Aministrador_Gestionar.php?id=$row[id]\"> $row[ced_sol] </td>
				                            </tr>";
				                    }
	}
				                  ?>
  							</tbody>
						</table>
						</div>
							<?php
								
								if(isset($_POST["b_eliminar"])){
									$eliminar="DELETE FROM usuario WHERE ced_usu='".$_POST["sel_ced"]."'";
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