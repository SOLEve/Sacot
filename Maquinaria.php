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
		$modificar="insert maquinas set fecha='".$_POST["inputFecha"]."',operador='".$_POST["inputConductor"]."', orden_trabajo_id='".$_GET[id]."',num_control='".$_POST["inputControl"]."',sector='".$_POST["inputSector"]."',salida='".$_POST["inputSalida"]."',entrada='".$_POST["inputEntrada"]."',observacion='".$_POST["inputObservacion"]."',situacion_maq='".$_POST["optionsRadios"]."',ejecucion='".$_POST["optionsRadios1"]."'";
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
								<li><a href=\"oficio_catastro.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Oficio de Catastro</a></li>
								<li><a href=\"Informe_Inspeccion_ot.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Informe de Inspeccion</a></li>
								<li class=\"active\"><a href=\"Maquinaria.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Maquinaria</a></li>
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
    					$consulta="SELECT * FROM maquinas WHERE orden_trabajo_id=".$_GET["id"];
						$res=consultar($consulta);
						$fila=mysql_fetch_array($res);
    				?>
                    
    				<div class="span8 well" style="background:#FFFFFF">
                    <caption><h2>Maquinaria</h2></caption>
  						<form class="form-horizontal" method="post" action="#">
  							
  							<div class="span5">
  								<label>Fecha:</label>
  								<input class="span4" type="date" name="inputFecha" value="<?php echo $fila[fecha]?>">
  								<label>Conductor:</label>
  								<input class="input-large" type="text" name="inputConductor" value="<?php echo $fila[operador]?>">
							</div>
							
						  <div class="span5 offset1">
  								<label>N&deg; Control:</label>
							  <input name="inputControl" type="text" class="input-large" value="<?php echo $fila[num_control]?>">
							</div>
							
						  <div class="span8">
  								<label>Sector:</label>
  								<input class="input-xxlarge" type="text" name="inputSector" value="<?php echo $fila[sector]?>">
								<hr></hr>
							</div>
                            
                            <div class="span5">
                            <label class="radio">
                            <label>Situacion de la Maquinaria:</label>
  <input <?php if($fila[situacion_maq]==Operativa){?> checked <?php }?> type="radio" name="optionsRadios" id="optionsRadios1" value="Operativa" >
  Operativa
</label>
<label class="radio">
  <input <?php if($fila[situacion_maq]==Garaje){?> checked <?php }?> type="radio" name="optionsRadios" id="optionsRadios2" value="Garaje">
 En Garaje
</label>
<label class="radio">
  <input <?php if($fila[situacion_maq]==situacion_maq){?> checked <?php }?> type="radio" name="optionsRadios" id="optionsRadios3" value="No_Operativa">
  No Operativa
</label></div>

<div class="span5">
                            <label class="radio">
                            <label>Ejecutada la orden:</label>
  <input <?php if($fila[ejecucion]==si){?> checked <?php }?> type="radio" name="optionsRadios1" id="optionsRadios1" value="si" >
  Si
</label>
<label class="radio">
  <input <?php if($fila[ejecucion]==no){?> checked <?php }?> type="radio" name="optionsRadios1" id="optionsRadios2" value="no">
  No
</label>
<hr></hr>
</div>
<div class="span5">
	<label>Salida del Garaje</label>
	<input class="span3" type="time" name="inputSalida" value="<?php echo $fila[salida]?>">
	<label>Entrada del Garaje</label>
    <input class="span3" type="time" name="inputEntrada" value="<?php echo $fila[entrada]?>">
</div>
<div class="span8">
  								<label>Observacion:</label>
  								<input class="input-xxlarge" type="text" name="inputObservacion" value="<?php echo $fila[observacion]?>">
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