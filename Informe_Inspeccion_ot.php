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
	$modificar="insert inf_insp set fecha_inf_insp ='".$_POST["inputFecha"]."',orden_trabajo_id='".$_GET[id]."',nombre_sol='".$_POST["inputNombre"]."', sector='".$_POST["inputSector"]."',direccion='".$_POST["inputDireccion"]."',Fact_serv='".$_POST["input1"]."',perm_Ab='".$_POST["input2"]."',Denuncia='".$_POST["input3"]."',prob_ab='".$_POST["input4"]."',perm_const='".$_POST["input5"]."',perm_an='".$_POST["input6"]."',Accion_social='".$_POST["input7"]."',Reparaciones_menores='".$_POST["input8"]."',Certificacion_planos='".$_POST["input9"]."',Problemas_cloacas='".$_POST["input10"]."',Prob_via='".$_POST["input11"]."',situacion='".$_POST["inputSituacion"]."',acciones='".$_POST["inputAcciones"]."',responsable='".$_POST["inputResponsable"]."'";
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
								<li class=\"active\"><a href=\"Informe_Inspeccion_ot.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Informe de Inspeccion</a></li>
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
    					$consulta="SELECT * FROM inf_insp WHERE orden_trabajo_id=".$_GET["id"];
						$res=consultar($consulta);
						$fila=mysql_fetch_array($res);
    				?>
    				<div class="span8 well" style="background:#FFFFFF">
                    <caption><h2>Informe de Inspeccion</h2></caption>
  						<form class="forma" method="post" action="#">
  							
  							<div class="span5">
  								<label>Fecha:</label>
  								<input type="date" class="input-small" name="inputFecha" value="<?php echo $fila[fecha_inf_insp]?>">
							</div>

  					
							
						  <div class="span10">
                            <label>Nombre del Solicitante:</label>
							<input class="input-xxlarge" type="text" name="inputNombre" value="<?php echo $fila[nombre_sol]?>">
                          	<label><br>Lugar de Inspeccion:</label>
  							<label>Sector:</label>
							<input class="input-xxlarge" type="text" name="inputSector" value="<?php echo $fila[sector]?>">
                            <label>Direccion:</label>
  							<input class="input-xxlarge" type="text" name="inputDireccion" value="<?php echo $fila[direccion]?>">
							<hr></hr>
  <label class="checkbox"><label>Objeto de la Inspeccion:<br></label>
 <input <?php if($fila[Fact_serv]==1){?> checked <?php }?> name="input1" type="checkbox"  onClick="if(this.checked == true){"value = "1""}else{"value = "0""}">Factibilidad de Servicios<br><br></label>
 <input <?php if($fila[perm_Ab]==1){?> checked <?php }?> name="input2" type="checkbox" onClick="if(this.checked == true){"value = "1""}else{"value = "0""}">Permiso Aducci&oacute;n Aguas Blancas<br><br></label>
 <input <?php if($fila[Denuncia]==1){?> checked <?php }?> name="input3"  type="checkbox"  onClick="if(this.checked == true){"value = "1""}else{"value = "0""}">Denuncias Vecinales<br><br></label>
 <input <?php if($fila[prob_ab]==1){?> checked <?php }?> type="checkbox" name="input4" onClick="if(this.checked == true){"value = "1""}else{"value = "0""}">Problemas de Aguas Blancas<br><br></label>
 <input <?php if($fila[perm_const]==1){?> checked <?php }?> type="checkbox" name="input5" onClick="if(this.checked == true){"value = "1""}else{"value = "0""}">Permiso de Construcci&oacute;n<br><br></label>
 <input <?php if($fila[perm_an]==1){?> checked <?php }?> type="checkbox" name="input6" onClick="if(this.checked == true){"value = "1""}else{"value = "0""}">Permiso Aducci&oacute;n Aguas Negras<br><br></label>
 <input <?php if($fila[Accion_social]==1){?> checked <?php }?> type="checkbox" name="input11" onClick="if(this.checked == true){"value = "1""}else{"value = "0""}">Problemas de Vialidad<br><br></label>
 <input <?php if($fila[Reparaciones_menores]==1){?> checked <?php }?> type="checkbox" name="input7" onClick="if(this.checked == true){"value = "1""}else{"value = "0""}">Acci&oacute;n Social<br><br></label>
 <input <?php if($fila[Certificacion_planos]==1){?> checked <?php }?> type="checkbox" name="input8" onClick="if(this.checked == true){"value = "1""}else{"value = "0""}">Reparaciones Menores<br><br></label>
 <input <?php if($fila[Problemas_cloacas]==1){?> checked <?php }?> type="checkbox" name="input9" onClick="if(this.checked == true){"value = "1""}else{"value = "0""}">Certificacion de Planos<br><br></label>
 <input <?php if($fila[Prob_via]==1){?> checked <?php }?> type="checkbox" name="input10" onClick="if(this.checked == true){"value = "1""}else{"value = "0""}">Problemas de Cloacas<br><br></label>
							</div>
						  <div class="span12">
							<label><br>Situacion Encontrada:</label>
  								<textarea rows="5" class="input-block-level" type="text" name="inputSituacion"><?php echo $fila[situacion]?></textarea>
								<hr></hr>
                            <label>Acciones Correctivas:</label>
  								<textarea rows="5" class="input-block-level" type="text" name="inputAcciones"><?php echo $fila[acciones]?></textarea>
								<hr></hr>
						  </div>
<div class="span5">
  								<label>Responsable:</label>
  								<input type="text" name="inputResponsable" value="<?php echo $fila[responsable]?>" >
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