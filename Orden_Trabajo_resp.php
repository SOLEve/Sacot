<?php 
	include("librerias.php");
	session_start(); 
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
					<h1 align="center" style="font-size:70px; font-style: inherit; color:#0000FF" >SACOT</h1>
					<h2 align="center" >Sistema de Administracion y Control de Ordenes de Trabajo</h2>
                    <hr></hr>
				</div>
				
			</div>
			<hr></hr>
			<div class="container-fluid">

				<div class="row-fluid">
					<br></br>
    				<div class="span4 well" style="background:#FFFFFF">
    					<div class="well">	
    						<!--Menu Principal en el cuerpo de la pagina-->
    						<form action="Eliminar_Usuario.php" method="post" name="formulario">
	    						<ul class="nav nav-pills  nav-stacked">
									<li class="active"><a href="index_resp.php"><i class="icon-home"></i> Inicio</a></li>
                                    <li><a href="index.php"><i class="icon-pencil"></i>Cerrar Sesion</a></li>
								</ul>
							</form>
    					</div>  				
					</div>

    				<div class="span7 well" style="background:#FFFFFF">
    					
    					<table class="table table-striped" >
  							<caption>Lista de Ordenes de Trabajo</caption>
  							<thead>
    							<tr>
      								<th>Id</th>
      								<th>Descripcion</th>
      								<th>Cedula</th>
    							</tr>
  							</thead>
  							<tbody>
  							<?php
    							$consulta="SELECT id,desc_ot,ced_sol FROM orden_trabajo WHERE responsable ='".$_SESSION["login"]."' and ejecutada = 0";
								$res=consultar($consulta);
    							while($row=mysql_fetch_array($res))
    							{
								echo "<tr>
								    	<td align=\"right\"><a href=\"seguimiento_ot.php?id=$row[id]\"> $row[id]</a> </td>
								        <td><a href=\"seguimiento_ot_resp.php?id=$row[id]\"> $row[desc_ot] </a> </td>
								        <td><a href=\"seguimiento_ot_resp.php?id=$row[id]\">  $row[ced_sol] </a> </td>
								   	</tr>";
								}
							?>
  							</tbody>
						</table>	
  					
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