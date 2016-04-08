<?php 
	session_start();
	include("librerias.php");
	if(isset($_SESSION["conex"]))
	{
		if($_SESSION["conex"]==0)
		{
		echo '<script language="JavaScript" type="text/javascript">
				document.location= "index.php";
				</script>';
		}	
	}
	
		if(isset($_POST["b_modificar"]))
		{	
		$modificar="insert oficio set fecha='".$_POST["inputFecha"]."',descripcion='".$_POST["inputExpo"]."', orden_trabajo_id='".$_GET[id]."'";
		actualizar_bd($modificar);
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
<?php 
							echo "
								<li ><a href=\"index_jefe.php?id=$_GET[id]\"><i class=\"icon-home\"></i> Inicio</a></li>
								<li><a href=\"presupuestos.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Presupuesto</a></li>
								<li><a href=\"Lista_Informes_Tecnicos.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Informe Tecnico</a></li>
								<li  class=\"active\"><a href=\"oficio_catastro.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Oficio de Catastro</a></li>
								<li><a href=\"Informe_Inspeccion_ot.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Informe de Inspeccion</a></li>
								<li><a href=\"Maquinaria.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Maquinaria</a></li>
								<li><a href=\"Informe_Inspeccion.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Inspeccion Sindicatura</a></li>
								<li ><a href=\"imagen.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Anexos</a></li>
								<li><a href=\"Orden_Trabajo_jefe.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Atras</a></li>
								<li><a href=\"index.php\"><i class=\"icon-pencil\"></i>Cerrar Sesion</a></li>
							";
							?>
							</ul>
    					</div>  				
					</div>
					<?php
    					$consulta="SELECT * FROM oficio WHERE orden_trabajo_id=".$_GET["id"];
						$res=consultar($consulta);
						$fila=mysql_fetch_array($res);
    				?>
                    
                    					
    				<div class="span8 well" style="background:#FFFFFF">
  						<form class="form-horizontal" method="post" action="#">
  							
  							<div class="span5">
  								<th><h4>Ciudadana:</h4></th>
  								<th><h5>Ing. Virginia Vivas</h5></th>
  								<th><h5>Alcaldesa del Municipio Cordoba</h5></th>
  							
								<hr></hr>
							</div>
  							
  							<div class="span5 offset2">
  								<label><h4>Santa Ana:</h4></label>
  								<input type="date" class="input-small" name="inputFecha" value="<?php echo $fila[fecha]?>">
  								<hr></hr>
							</div>
  							
  							<div class="span11">
  								<label align="left">Su Despacho:</label>
  								<textarea rows="15" class="input-block-level" type="text" name = "inputExpo"><?php echo $fila[descripcion]?></textarea>
								<hr></hr>
							</div>
							
							<div class="span8 offset5">
								<button type="submit" name="b_modificar" class="btn-primary">Asignar</button>
							</div>
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