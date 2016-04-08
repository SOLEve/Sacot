<?php 
	include("librerias.php");
	session_start();
	if(isset($_GET[id])&&!isset($_SESSION["id"]))
			$_SESSION["id"]=$_GET[id];

	if(isset($_POST["b_modificar"])){
		$modificar="UPDATE orden_trabajo set exposicion='".$_POST["inputExpo"]."',fe_exp='".$_POST["inputFecha"]."',aprobacion='".$_POST["aprob"]."',responsable='".$_POST["inputResponsable"]."' WHERE id='".$_GET[id]."'";
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
	
	<div >
			
		<div class="container-fluid">
    		
    		<div class="row">
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
								<li class=\"active\"><a href=\"index_jefe.php?id=$_GET[id]\"><i class=\"icon-home\"></i> Inicio</a></li>
								<li><a href=\"presupuestos.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Presupuesto</a></li>
								<li><a href=\"Lista_Informes_Tecnicos.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Informe Tecnico</a></li>
								<li><a href=\"oficio_catastro.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Oficio de Catastro</a></li>
								<li><a href=\"Informe_Inspeccion_ot.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Informe de Inspeccion</a></li>
								<li><a href=\"Maquinaria.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Maquinaria</a></li>
								<li><a href=\"Informe_Inspeccion.php?id=$_GET[id]]\"><i class=\"icon-pencil\"></i> Inspeccion Sindicatura</a></li>
								<li><a href=\"imagen.php?id=$_GET[id] \"><i class=\"icon-pencil\"></i> Anexos</a></li>
								<li><a href=\"Orden_Trabajo_jefe.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Atras</a></li>
								<li><a href=\"index.php\"><i class=\"icon-pencil\"></i>Cerrar Sesion</a></li>
							";
							?>
							</ul>
    					</div>  				
					</div>
					<?php
    					$consulta="SELECT * FROM orden_trabajo WHERE id=".$_GET["id"];
						$res=consultar($consulta);
						$fila=mysql_fetch_array($res);
    				?>
    				<div class="span8 well" style="background:#FFFFFF">
                    <h2>Orden de Trabajo</h2>
                    
                    <h5 >Solicitada por: <label><?php echo $fila[ced_sol]?></label></h5>
                    <hr></hr>
  						<form class="form-horizontal" method="post" action="#">
  							  							
  							<div class="span10 offset1">
  								<label align="center">Descripcion del Trabajo:</label>
  								<textarea rows="5" class="input-block-level" readonly  type="text">"<?php echo $fila[desc_ot]?>"</textarea>
								<hr></hr>
							</div>
  							
  							<div class="span10 offset1">
  								<label align="center">Exposicion del trabajo realizado:</label>
  								<textarea rows="5" class="input-block-level" type="text" name="inputExpo"><?php echo $fila[exposicion]?></textarea>
								<hr></hr>
							</div>
  							
							<div class="span5">
  								<label>Lista de posibles Responsables:</label>
  								<select name="inputResponsable" value="">
									<?php
    									$consulta="SELECT * FROM usuario WHERE rol_id_rol=3 AND departamento_id_dpto=(SELECT departamento_id_dpto From usuario WHERE login = '".$_SESSION["login"]."')";
										$res=consultar($consulta);
	    								while($row=mysql_fetch_array($res))
	    								{
	    									echo "<option value=\"$row[login]\">$row[nombre]</option>";
	    								}
    								?>	
    								</select>
                                    <?php
    					$consulta="SELECT * FROM usuario WHERE login='".$fila[responsable]."'";
						$res=consultar($consulta);
						$fila2=mysql_fetch_array($res);
    				?>
                    <hr></hr>
                                    <label>Responsable Asignado:</label>
                                    <input class="span12" type="text" readonly name="responsableSeleccionado" value="<?php echo $fila2[nombre]?>">
  
								<hr></hr>
                                
							</div>
							
							<div class="span3">
  								<label>Fecha a asignar:</label>
  								<input class="span14" type="date" name="inputFecha" value="<?php echo $fila[fe_exp]?>">
								<hr>
								</hr>
				  			</div>
                            
							<div class="span3">
  								<label>Aprobar</label>
  								<select class="span5" name="aprob">
  									<option value="1">SI</option>
                                    <option value="0">NO</option>
								</select>
								<hr></hr>
							</div>
                            <div class="span3">
  								<label>Fecha asignada:</label>
  								<input class="span12" type="text" readonly name="fechaAsignada" value="<?php echo $fila[fe_exp]?>">
								<hr></hr>
							</div>
                            <div class="span3">
  								<label>Estado aprobado</label>
  									<?php if($fila[aprobacion]==1){?>
										<input class="span12" type="text" readonly name="estado" value="Aprobado">
                                    <?php }?>
                                    <?php if($fila[aprobacion]==0){?>
									<input class="span12" type="text" readonly name="estado" value="Sin aprobar">
                                    <?php }?>
								<hr></hr>
							</div>
							
							<div class="span8 offset4">
								
								<button type="submit" name="b_modificar" class="btn-primary-primary">Modificar</button>
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