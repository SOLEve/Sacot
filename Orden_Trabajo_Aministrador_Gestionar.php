<?php 
	include("librerias.php");
	
	if(isset($_POST["b_eliminar"])){
		$eliminar="DELETE FROM orden_trabajo WHERE id='".$_GET[id]."'";
		actualizar_bd($eliminar);
	}
								
	if(isset($_POST["b_modificar"])){
		$modificar="UPDATE orden_trabajo set ced_sol='".$_POST["inputCedula"]."',ordenado_por='".$_POST["lista_a"]."',departamento_id_dpto='".$_POST["lista_b"]."', desc_ot='".$_POST["inputdesc"]."' WHERE id='".$_GET[id]."'";
		actualizar_bd($modificar);
	}
	$consulta="SELECT  * FROM orden_trabajo WHERE id ='".$_GET["id"]."'";
	$res=consultar($consulta);
	$row=mysql_fetch_array($res);
	
	
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
								<li><a href="#"><i class="icon-pencil"></i> Agregar</a></li>
								<li><a href="Orden_Trabajo.php?p=1"><i class="icon-list-alt"></i> Listar</a></li>
								<li><a href="consultar_ot.php"><i class="icon-search"></i> Administrar</a></li>
                                <li><a href="index.php"><i class="icon-pencil"></i>Cerrar Sesion</a></li>
							</ul>
    					</div>  				
					</div>

					
    				<div class="span8 well" style="background:#FFFFFF">
                    <?php ?>
    					<form action="#" method="post" class="form-horizontal">
  						<div class="span6">
                        
  							<label>Ordenado Por:</label>
                                                        <select name = "lista_a" >
                                                        <?php if($row[ordenado_por]==1){?>
                                                        <option value="1" selected>Despacho</option>
                                                        <?php }else{?>
                                                        <option value="1">Despacho</option>
                                                        <?php }?>
                                                        <?php if($row[ordenado_por]==2){?>
                                                        <option value="2" selected>Alcalde</option>
														<?php }else{?>
                                                        <option value="2">Alcalde</option>
                                                        <?php }?>
                                                        </select>
                         </div>
                                            <div class="control-group">

                                                <label class="control-label" for="inputDep">Ordenado A:</label>
                                                <div class="controls">
												<select class="span6" name = "lista_b" value="<?php echo $row[responsable];?>">
														<?php if($row[departamento_id_dpto]==1){?>
                                                        <option value="1" selected>Ingenieria Municipal</option>
                                                        <?php }else{?>
                                                        <option value="1">Ingenieria Municipal</option>
                                                        <?php }?>
                                                        <?php if($row[departamento_id_dpto]==2){?>
                                                        <option value="2" selected>Servicios Generales</option>
                                                        <?php }else{?>
                                                        <option value="2">Servicios Generales</option>
                                                        <?php }?>
                                                        <?php if($row[departamento_id_dpto]==3){?>
                                                        <option value="3" selected>Hacienda</option>
                                                        <?php }else{?>
                                                        <option value="3">Hacienda</option>
                                                        <?php }?>
                                                        <?php if($row[departamento_id_dpto]==4){?>
                                                        <option value="4" selected>Catastro</option>
                                                        <?php }else{?>
                                                        <option value="4">Catastro</option>
                                                        <?php }?>
                                                        <?php if($row[departamento_id_dpto]==5){?>
                                                        <option value="5" selected>Recaudacion</option>
                                                        <?php }else{?>
                                                        <option value="5">Recaudacion</option>
                                                        <?php }?>
                                                        <?php if($row[departamento_id_dpto]==6){?>
                                                        <option value="6" selected>Sindicatura Municipal</option>
                                                        <?php }else{?>
                                                        <option value="6">Sindicatura Municipal</option>
                                                        <?php }?>
                                                        <?php if($row[departamento_id_dpto]==7){?>
                                                        <option value="7" selected>Recursos Humanos</option>
                                                        <?php }else{?>
                                                        <option value="7">Recursos Humanos</option>
                                                        <?php }?>
                                                        <?php if($row[departamento_id_dpto]==8){?>
                                                        <option value="8" selected>Registro Civil</option>
                                                        <?php }else{?>
                                                        <option value="8">Registro Civil</option>
                                                        <?php }?>
                                                        
												</select>
												</div>
											</div>
                                        <div class="control-group">
											<label class="control-label" for="inputCedula">Cedula</label>
							    			<div class="controls">
                                            
							    			<input type="text" name="inputCedula" value="<?php echo $row[ced_sol];?>">
											</div>
										</div>
						
                                        <div class="control-group">
										<label class="control-label" for="inputdesc">Descripcion del Trabajo</label>
							    			<div class="controls">
							    				<input type="text" name="inputdesc" value="<?php echo $row[desc_ot];?>">
											</div>
										</div>



						<button type="submit" name="b_modificar" class="btn-primary">Modificar</button>
                        <button type="submit" name="b_eliminar" class="btn-primary">Eliminar</button>
  					</div>
  				           
					</form>
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
