<?php 
	session_start();
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
	
		if(isset($_POST["b_modificar"]))
		{	
		$modificar="UPDATE orden_trabajo set desempeño='".$_POST["inputDesempeño"]."',fecha_ejecutada='".$_POST["inputFecha1"]."',ejecutada='".$_POST["optionsRadios"]."',calidad='".$_POST["optionsRadios1"]."',comentario='".$_POST["inputComentario"]."' WHERE id='".$_GET[id]."'";
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
	
	<div style="background:url(imagenes/fondo.jpg)">
			
		<div class="container-fluid" >
    		
    		<div class="row" style="background:url(imagenes/images.gif)">
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
								<li class="active"><a href="index_resp.php"><i class="icon-home"></i> Inicio</a></li>
								<li><a href="Orden_Trabajo_resp.php"><i class="icon-pencil"></i> Atras</a></li>
                                <li><a href="index.php"><i class="icon-pencil"></i>Cerrar Sesion</a></li>
							</ul>
    					</div>  				
					</div>
					<?php
    					$consulta="SELECT * FROM orden_trabajo WHERE id=".$_GET["id"];
						$res=consultar($consulta);
						$fila=mysql_fetch_array($res);
    				?>

    				<div class="span8 well" style="background:#FFFFFF">
                    	<div class="span14 well"">
                    		<caption><h2>Orden de Trabajo</h2></caption>
                    		<h4>Solicitada por:<?php echo $fila[ced_sol]?></h4>
                        	<hr></hr>
                        </div>
  						<form class="form-horizontal" method="post" action="#">
  							
  							<div class="span10 offset1">
  								<label align="center"><h4>Descripcion del Trabajo:</h4></label>
  								<textarea rows="5" class="input-block-level" readonly  type="text">"<?php echo $fila[desc_ot]?>"</textarea>
								<hr></hr>
							</div>
  							<div class="span10 offset1">
							  <label align="center"><h4>Exposicion del trabajo realizado:</h4></label>
  								<textarea rows="5" readonly class="input-block-level" type="text"><?php echo $fila[exposicion]?></textarea>
								<hr></hr>
							</div>
  							<div class="span10 offset1">
  								<label align="center"><h4>Desempeño a Corregir:</h4></label>
  								<textarea rows="5" name="inputDesempeño" class="input-block-level" type="text"><?php echo $fila[desempeño]?></textarea>
								<hr></hr>
							</div>
  							
							<div class="span5 offset1">
  								<label><h4>Funcionario:</h4></label>
  								<input name="inputFuncionario" type="text" value="<?php echo $_SESSION['login']?>" readonly>
								<hr></hr>
							</div>
							
							<div class="span5">
  								<label><h4>Fecha:</h4></label>
  								<input type="date" name="inputFecha1" value="<?php echo $fila[fecha_ejecutada]?>">
								<hr></hr>
							</div>
                            <div class="span5">
                            <label class="radio">
                            <label><h4>Ejecutada la orden:</h4></label>
  							<input <?php if($fila[ejecutada]==1){?> checked <?php }?> type="radio" name="optionsRadios" id="optionsRadios1" value="1" checked>
  							si</label>
							<label class="radio">
  							<input <?php if($fila[ejecutada]==0){?> checked <?php }?>type="radio" name="optionsRadios" id="optionsRadios2" value="0">
  							no</label>
                            </div>

							<div class="span5">
                            <label class="radio">
                            <label><h4>Calidad del trabajo:</h4></label>
  							<input <?php if($fila[calidad]==Bueno){?> checked <?php }?> type="radio" name="optionsRadios1" id="optionsRadios1" value="Bueno" checked>
  							Bueno</label>
							<label class="radio">
 		 					<input <?php if($fila[calidad]==Regular){?> checked <?php }?> type="radio" name="optionsRadios1" id="optionsRadios2" value="Regular">
  							Regular</label>
							<label class="radio">
  							<input <?php if($fila[calidad]==Malo){?> checked <?php }?> type="radio" name="optionsRadios1" id="optionsRadios3" value="Malo">
  							Malo</label>
                            </div>

							<div class="span10 offset1">
  							<label align="center"><h4>Comentario (Si aplica):</h4></label>
  							<textarea rows="5" name="inputComentario" class="input-block-level" type="text"><?php echo $fila[comentario]?></textarea>
							<hr></hr>
							</div>
							<p></p>
<div class="span8 offset4">
				<hr></hr>
								<button type="submit" name="b_modificar" class="btn-primary btn-primary-primary">Modificar</button>
						  </div>
						</form>
  					</div>
  				</div>
  				<div class="row-fluid">s
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