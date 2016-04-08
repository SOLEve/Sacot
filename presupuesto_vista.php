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
				<div class="span11">
					<hr></hr>
					<h1 align="center" style="font-size:70px; font-style: inherit; color:#0000FF">SACOT</h1>
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
								<li ><a href=\"index_jefe.php?id=".$_SESSION["id"]."\"><i class=\"icon-home\"></i> Inicio</a></li>
								<li class=\"active\"><a href=\"presupuestos.php?id=".$_SESSION["id"]."\"><i class=\"icon-pencil\"></i> Presupuesto</a></li>
								<li><a href=\"Lista_Informes_Tecnicos.php?id=".$_SESSION["id"]."\"><i class=\"icon-pencil\"></i> Informe Tecnico</a></li>
								<li><a href=\"oficio_catastro.php?id=".$_SESSION["id"]."\"><i class=\"icon-pencil\"></i> Oficio de Catastro</a></li>
								<li><a href=\"Informe_Inspeccion_ot.php?id=".$_SESSION["id"]."\"><i class=\"icon-pencil\"></i> Informe de Inspeccion</a></li>
								<li><a href=\"Maquinaria.php?id=".$_SESSION["id"]."\"><i class=\"icon-pencil\"></i> Maquinaria</a></li>
								<li><a href=\"Informe_Inspeccion.php?id=".$_SESSION["id"]."\"><i class=\"icon-pencil\"></i> Inspeccion Sindicatura</a></li>
								<li ><a href=\"imagen.php?id=".$_SESSION["id"]."\"><i class=\"icon-pencil\"></i> Anexos</a></li>
								<li><a href=\"Orden_Trabajo_jefe.php?id=".$_SESSION["id"]."\"><i class=\"icon-pencil\"></i> Atras</a></li>
								<li><a href=\"index.php\"><i class=\"icon-pencil\"></i>Cerrar Sesion</a></li>
							";
							?>
							</ul>
    					</div>  				
					</div>
					
    				<div class="span8 well" style="background:#FFFFFF">
                    <?php $consulta="SELECT * FROM presupuesto WHERE id_ppto='".$_GET["id"]."'";
						  $res=consultar($consulta);
						  $fila=mysql_fetch_array($res);
					?>
                    <h2>Presupuesto</h2>
                    <hr></hr>
  						<form class="form-horizontal" method="post" action="Funciones.php">
  							
  								<div class="span10 ">
  								<label>Obra:</label>
  								<input class="input-xxlarge" readonly type="text" name="obra" value="<?php echo $fila[obra]?>">
								
								<label>Lugar:</label>
  								<input class="input-xxlarge" readonly type="text" name="lugar" value="<?php echo $fila[lugar]?>">
								
  								<label>Contratista:</label>
  								<input class="input-xxlarge" readonly type="text" name="contratista" value="<?php echo $fila[contratista]?>">
								<div class="span5">
  									<label>Fecha:</label>
  									<input type="date" readonly class="input-small" name="fecha" value="<?php echo $fila[fecha_ppto]?>">
                                </div>
                                <div class="span5">
  									<label>Estado</label>
  									<?php if($fila[aprobacion]==1){?>
										<input class="span12" type="text" readonly name="estado" value="Aprobado">
                                    <?php }?>
                                    <?php if($fila[aprobacion]==0){?>
									<input class="span12" type="text" readonly name="estado" value="Sin aprobar">
                                    <?php }?>
									</select>
									
								</div>
						  		</div>
                          </div>
                          <div class="span14 well" style="background:#FFFFFF">
							<table class="table table-striped" id="tabla">
  								<caption><h3>Lista de Items</h3></caption>
                                
  								<thead>
    								<tr bgcolor="#0080C0">
      									<th>No</th>
      									<th>Descripcion</th>
      									<th>Unidad</th>
      									<th>Cantidad</th>
      									<th>Precio/Unitario</th>
      									<th>Monto Total</th>
    								</tr>
  								</thead>
  								<tbody>
  								<?php
									$consulta="SELECT * FROM item_pre WHERE presupuesto_id_ppto = '".$_GET["id"]."'";
									$res=consultar($consulta);
    								while($row=mysql_fetch_array($res))
    								{
									echo "<tr>
								    	<td>$row[id] </td>
								        <td>$row[descripcion]  </td>
										<td>$row[unidad]  </td>
								        <td>$row[cantidad]  </td>
										<td>$row[precio_unit]  </td>
										<td>$row[monto]  </td>
										
								   	</tr>";
									}
								?>
  								</tbody>
							</table>
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