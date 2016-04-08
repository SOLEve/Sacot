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
	<script language="javascript">

var contador=0;
function agregaFila()
{

  contador++;
  var TABLE = document.getElementById("tabla");
  var TROW = document.getElementById("celda");
  var content = TROW.getElementsByTagName("td");
  var newRow = TABLE.insertRow(-1);
  
  newRow.className = TROW.attributes['class'].value;
  var newCell = newRow.insertCell(newRow.cells.length)
  
  txt = '<td> <input class=\"span1 \" type=\"text\" id=\"no_0\" name=\"no_'+contador+'\"> </td> '
  newCell.innerHTML = txt

  var newCell = newRow.insertCell(newRow.cells.length)
  txt = '<td> <input class=\"span2 \" type=\"text\" id=\"Des_'+contador+'\" name=\"Des_'+contador+'\"> </td>'
  newCell.innerHTML = txt
  
  var newCell = newRow.insertCell(newRow.cells.length)
  txt = '<td> <input class=\"span2 \" type=\"text\"  id=\"Cal_'+contador+'\" name=\"Cal_'+contador+'\"> </td>'
  newCell.innerHTML = txt
  
  var newCell = newRow.insertCell(newRow.cells.length)
  txt = '<td> <input class=\"span1 \" type=\"text\"  id=\"Uni_'+contador+'\" name=\"Uni_'+contador+'\"> </td>'
  newCell.innerHTML = txt
  
  var newCell = newRow.insertCell(newRow.cells.length)
  txt = '<td> <input class=\"span2 \" type=\"text\"  id=\"Can_'+contador+'\" name=\"Can_'+contador+'\"> </td>'
  newCell.innerHTML = txt
  
}

</script>
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
								<li  class=\"active\"><a href=\"Lista_Informes_Tecnicos.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Informe Tecnico</a></li>
								<li><a href=\"oficio_catastro.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Oficio de Catastro</a></li>
								<li><a href=\"Informe_Inspeccion_ot.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Informe de Inspeccion</a></li>
								<li><a href=\"Maquinaria.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Maquinaria</a></li>
								<li><a href=\"Informe_Inspeccion.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Inspeccion Sindicatura</a></li>
								<li ><a href=\"imagen.php?id=$_GET[id] \"><i class=\"icon-pencil\"></i> Anexos</a></li>
								<li><a href=\"Orden_Trabajo_jefe.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Atras</a></li>
								<li><a href=\"index.php\"><i class=\"icon-pencil\"></i>Cerrar Sesion</a></li>
							";
							?>
							</ul>
    					</div>  				
					</div>
					
    				<div class="span8 well" style="background:#FFFFFF">
                    <h2>Informe Técnico</h2>
  						<form class="form-horizontal" method="post" action="Funciones.php">
  							
  							<div class="span8">
                            	<label>Obra:</label>
  								<input class="input-xxlarge" type="text" name="obra" value="">
                                <label>Lugar:</label>
  								<input class="input-xxlarge" type="text" name="lugar" value="">
  								<label>Fecha:</label>
  								<input type="date" class="input-small" name="fecha" value="">
								<hr></hr>
                                <div class="span10">
  								<label align="center"><h4>Memoria Descriptiva:</h4></label>
  								<textarea rows="5" class="input-xxlarge"  type="text" name="descripcion"></textarea>
								<hr></hr>
								</div>
							</div>
							<div class="span5">
  										<label>Estado</label>
  										<select class="span8" name="aprobacion">
  										<option value="1">Aprobado</option>
                                    	<option value="0">No Aprobado</option>
									</select>
                                    <hr></hr>
									</div>
                                    <div class="span10">
  										<label>Responsable:</label>
  										<select class="span10" name="responsable" value="">
											<?php
    											$consulta="SELECT * FROM usuario WHERE rol_id_rol=3 AND departamento_id_dpto=(SELECT departamento_id_dpto From usuario WHERE login = '".$_SESSION["login"]."')";
												$res=consultar($consulta);
	    										while($row=mysql_fetch_array($res))
	    										{
	    											echo "<option value=\"$row[login]\">$row[nombre]</option>";
	    										}
    										?>	
    									</select>
                                        <hr></hr>
                               	 	</div>
							
							<table class="table table-striped" id="tabla">
  								<caption>Lista de Usuarios Registrados</caption>
  								<thead>
    								<tr>
    									<th>No</th>
      									<th>Descripci&oacuten</th>
      									<th>Calculos</th>
      									<th>Unidad</th>
      									<th>Cantidad</th>
    								</tr>
  								</thead>
  								<tbody>
  								<?php
									echo "<tr class=\"celda\" id=\"celda\" name=\"celda\">
									    	<td> <input class=\"span1 \" type=\"text\" id=\"no_0\" name=\"no_0\"> </td>
									    	<td> <input class=\"span2 \" type=\"text\" id=\"Des_0\" name=\"Des_0\"> </td>
									        <td> <input class=\"span2 \" type=\"text\" id=\"Cal_0\" name=\"Cal_0\"> </td>
									        <td> <input class=\"span1 \" type=\"text\" id=\"Uni_0\" name=\"Uni_0\"> </td>
									        <td> <input class=\"span2 \" type=\"text\" id=\"Can_0\" name=\"Can_0\"> </td>
									   	</tr>";
								?>
  								</tbody>
							</table>
							
							<div class="span8 offset4">
							  <button type="submit" name="b_asignar" class="btn">Asignar</button>
							  <input type="button" class="btn" value="Agregar fila" onClick="agregaFila(event)" alt="Adicionar">
						  </div>
						</form>
  					</div>
  				</div>
  				<div class="row-fluid">
					<div class="span12">
						<hr></hr>
			    	  <p align="center">Universidad Nacional Experimental del Tachira &copy; 2012 </p>
						<p align="center"> <span>
						</span>Servicio Comunitario</p>
				  		<hr></hr>
				  	</div>
				</div>
  			</div>
			
		</div>
	</div>
</body>
</html>