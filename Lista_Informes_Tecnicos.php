<?php 
	session_start();
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
<?php 
							echo "
								<li ><a href=\"index_jefe.php?id=$_GET[id]\"><i class=\"icon-home\"></i> Inicio</a></li>
								<li ><a href=\"presupuestos.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Presupuesto</a></li>
								<li class=\"active\"><a href=\"Lista_Informes_Tecnicos.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Informe Tecnico</a></li>
								<li><a href=\"oficio_catastro.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Oficio de Catastro</a></li>
								<li><a href=\"Informe_Inspeccion_ot.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Informe de Inspeccion</a></li>
								<li><a href=\"Maquinaria.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Maquinaria</a></li>
								<li><a href=\"Informe_Inspeccion.php?id=$_GET[id]]\"><i class=\"icon-pencil\"></i> Inspeccion Sindicatura</a></li>
								<li ><a href=\"imagen.php?id=$_GET[id] \"><i class=\"icon-pencil\"></i> Anexos</a></li>
								<li><a href=\"Orden_Trabajo_jefe.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Atras</a></li>
								<li><a href=\"index.php\"><i class=\"icon-pencil\"></i>Cerrar Sesion</a></li>
							";
							?>
							</ul>
    					</div>  				
					</div>
					
    				<div class="span8 well" style="background:#FFFFFF">
                    <h2>INFORMES TECNICOS</h2>
  						
                          
                          <div class="span14 well" style="background:#FFFFFF">
							<table class="table table-striped" id="tabla">
  								<caption><h3>Lista de Informes Tecnicos</h3></caption>
  								<thead>
    								<tr bgcolor="#0088cc">
      									<th>Obra</th>
                                        <th>Fecha</th>
                                        <th>Responsable</th>
    								</tr>
  								</thead>
  								<tbody>
  								<?php

								$consulta="SELECT * FROM inf_tec WHERE orden_trabajo_id = '".$_SESSION["id"]."'";
								$res=consultar($consulta);
    							while($row=mysql_fetch_array($res))
    							{ 
								
								$consulta2="SELECT * FROM usuario WHERE login='".$row[responsable]."'";
								$res2=consultar($consulta2);
								$dato=mysql_fetch_array($res2);
								
								echo "<tr>
								    	<td ><a href=\"Informe_Tecnico_Vista.php?id=$row[id]\"> $row[obra]</a> </td>
								        <td><a href=\"Informe_Tecnico_Vista.php?id=$row[id]\"> $row[fecha] </a> </td>
										<td><a href=\"Informe_Tecnico_Vista.php?id=$row[id]\"> $dato[nombre] </a> </td>
								   	</tr>";
								}
									
								?>
  								</tbody>
							</table>
                            <div class="span5 ">
								<button type="button" name="presupuesto_b_modificar" onClick=" location.href='Informe_Tecnico.php' " class="btn">Informe Nuevo</button>
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
</body>
</html>