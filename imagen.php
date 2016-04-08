<?php 
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
	

function agregaFila()
{

  var TABLE = document.getElementById("tabla");
  var TROW = document.getElementById("celda");
  var content = TROW.getElementsByTagName("td");
  var newRow = TABLE.insertRow(-1);
  
  newRow.className = TROW.attributes['class'].value;
  var newCell = newRow.insertCell(newRow.cells.length)
  
  txt = '<td> <input class=\"span1 \" type=\"text\"> </td> '
  newCell.innerHTML = txt
  
  var newCell = newRow.insertCell(newRow.cells.length)
  txt = '<td> <input class=\"span2 \" type=\"text\"> </td> '
  newCell.innerHTML = txt
  
  var newCell = newRow.insertCell(newRow.cells.length)
  txt = '<td> <input class=\"span1 \" type=\"text\"> </td> '
  newCell.innerHTML = txt
  
  var newCell = newRow.insertCell(newRow.cells.length)
  txt = '<td> <input class=\"span1 \" type=\"text\"> </td> '
  newCell.innerHTML = txt
  
  var newCell = newRow.insertCell(newRow.cells.length)
  txt = '<td> <input class=\"span2 \" type=\"text\"> </td> '
  newCell.innerHTML = txt
  
  var newCell = newRow.insertCell(newRow.cells.length)
  txt = '<td> <input class=\"span1 \" type=\"text\"> </td> '
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
								<li><a href=\"Lista_Informes_Tecnicos.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Informe Tecnico</a></li>
								<li><a href=\"oficio_catastro.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Oficio de Catastro</a></li>
								<li><a href=\"Informe_Inspeccion_ot.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Informe de Inspeccion</a></li>
								<li><a href=\"Maquinaria.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Maquinaria</a></li>
								<li><a href=\"Informe_Inspeccion.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Inspeccion Sindicatura</a></li>
								<li class=\"active\"><a href=\"imagen.php?id=$_GET[id] \"><i class=\"icon-pencil\"></i> Anexos</a></li>
								<li><a href=\"Orden_Trabajo_jefe.php?id=$_GET[id]\"><i class=\"icon-pencil\"></i> Atras</a></li>
								 <li><a href=\"index.php\"><i class=\"icon-pencil\"></i>Cerrar Sesion</a></li>
							";
							?>
							</ul>
    					</div>  				
					</div>
					
    				<div class="span8 well" style="background:#FFFFFF">
                    <h2>Anexos</h2>
<?php 
echo "
<form name=\"form1\" enctype=\"multipart/form-data\" method=\"post\" action=\"subir.php?id=$_GET[id]\">
  <label>
  Nombre
  <input name=\"nombre\" type=\"text\" id=\"nombre\">
  </label>
  <br>
  <label>
  Subir Imagen
  <input name=\"foto\" type=\"file\" id=\"foto\">
  </label>
  <br>
  <label>
  <input type=\"submit\" name=\"Submit\" value=\"Subir\">
  </label>
</form>
";


 //conexion a nivel local wampserver
 mysql_connect("localhost","root");
 //si usas conexion en la web usa 3 parametros
 // mysql_connect("nombre o ip de la base","usario","password");
 mysql_select_db("mydb");  

 $re=mysql_query("select * from anexo WHERE id_ot=$_GET[id]");

 while($f=mysql_fetch_array($re)){
 echo '<br> Nombre:  '.$f['nombre'].'<br>';
echo '<img class="img-polaroid" src="'.$f['foto'].'" width="500" heigth="500" />';
}
?>
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