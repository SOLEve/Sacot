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
				<div class="span12">
					<hr></hr>
					<h1 align="center">SACOT</h1>
					<h2 align="center" >Sistema de Administracion y Control de Ordenes de Trabajo</h2>
				</div>
				
			</div>
			<hr></hr>
			<div class="container-fluid">

				<div class="row-fluid">

    				<div class="span4 well" style="background:#FFFFCC">
    					<div class="well">	
    						<!--Menu Principal en el cuerpo de la pagina-->
							<ul class="nav nav-pills  nav-stacked">
								<li class="active"><a href="index_jefe.php"><i class="icon-home"></i> Inicio</a></li>
								<li><a href="#"><i class="icon-pencil"></i> Presupuesto</a></li>
								<li><a href="#"><i class="icon-pencil"></i> Informe Tecnico</a></li>
								<li><a href="#"><i class="icon-pencil"></i> Oficio de Catastro</a></li>
								<li><a href="#"><i class="icon-pencil"></i> Informe de Inspeccion</a></li>
								<li><a href="#"><i class="icon-pencil"></i> Maquinaria</a></li>
								<li><a href="#"><i class="icon-pencil"></i> Inspeccion Sindicatura</a></li>
								<li><a href="Orden_Trabajo_jefe.php"><i class="icon-pencil"></i> Atras</a></li>
							</ul>
    					</div>  				
					</div>
					<?php
    					$consulta="SELECT ced_sol,desc_ot FROM orden_trabajo WHERE id=".$_GET["id"];
						$res=consultar($consulta);
						$fila=mysql_fetch_array($res);
    				?>
    				<div class="span8 well" style="background:#FFFFCC">
  						<form class="form-horizontal" method="post" action="#">
  							<div class="span8 offset4" >
  								<label>Cedula del Solicitante:</label>
  								<input type="text" name="inputCedula" readonly value="<?php echo $fila[ced_sol]?>">
								<hr></hr>
							</div>
  							
  							<div class="span10 offset1">
  								<label align="center">Descripcion del Trabajo:</label>
  								<textarea rows="5" class="input-block-level" readonly  type="text">"<?php echo $fila[desc_ot]?>"</textarea>
								<hr></hr>
							</div>
  							
  							<div class="span10 offset1">
  								<label align="center">Exposicion del trabajo realizado:</label>
  								<textarea rows="5" class="input-block-level" type="text"></textarea>
								<hr></hr>
							</div>
  							
							<div class="span5 offset1">
  								<label>Funcionario:</label>
  								<input type="text" name="inputFuncionario" value="<?php echo $_SESSION['login']?>">
								<hr></hr>
							</div>
							
							<div class="span5">
  								<label>Fecha:</label>
  								<input type="date" name="inputFecha" value="">
								<hr></hr>
							</div>
							
							<div class="span10 offset2">
								<th>Solo para ser Llenado por el Responsable del Seguimiento</th>
								<hr></hr>
							</div>
							
							<div class="span4 offset2">
								<label>Aprobacion:</label>
								<select  class = "span4">
									<option value="1">SI</option>
									<option value="2">NO</option>
								</select>
								<hr></hr>
							</div>
							
							<div class="span5">
								<label>Calidad de Trabajo:</label>
								<select  class = "span5">
									<option value="1">BUENO</option>
									<option value="2">REGULAR</option>
									<option value="2">MALO</option>
								</select>
								<hr></hr>
							</div>
							
							<div class="span4 offset2">
								<label>Ejecucion:</label>
								<select  class = "span4">
									<option value="1">SI</option>
									<option value="2">NO</option>
								</select>
								<hr></hr>
							</div>
							
							<div class="sapn6">
								<label>Responsable:</label>
								<select name="sel_resp" value="">
									<?php
	    								$consulta="SELECT * FROM usuario WHERE rol_id_rol=3";
										$res=consultar($consulta);
		    							while($row=mysql_fetch_array($res))
		    							{
		    								echo "<option value=\"$row[nombre]\">$row[nombre]</option>";
		    							}
	    							?>	
	    						</select>
	    						<hr></hr>
    						</div>
							
							<div class="span5 offset1">
  								<label align="center">Desempe;o</label>
  								<textarea rows="2" class="input-block-level" type="text"></textarea>
								<hr></hr>
							</div>
							
							<div class="span5">
  								<label align="center">Comentario</label>
  								<textarea rows="2" class="input-block-level" type="text"></textarea>
								<hr></hr>
							</div>
							
							<div class="span8 offset4">
								<hr></hr>
								<button type="submit" name="b_modificar" class="btn-primary">Modificar</button>
							 	<button type="submit" name="b_eliminar" class="btn-primary">Eliminar</button>
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