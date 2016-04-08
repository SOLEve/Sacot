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
	
$nombre=$_POST['nombre'];
$nombrefoto=$_FILES['foto']['name'];
$ruta=$_FILES['foto']['tmp_name'];
 
$consulta="SELECT * FROM orden_trabajo WHERE id=".$_GET["id"];
$res=consultar($consulta);
$fila=mysql_fetch_array($res); 

$destino =  "fotos/"."$fila[id]/".$nombrefoto;
copy($ruta,$destino);



 mysql_connect("localhost","root");
 mysql_select_db("mydb");  
 mysql_query("insert into anexo(nombre,foto,id_ot) values('$nombre','$destino','$_GET[id]')");
 header("Location:imagen.php?id= $_GET[id]");
?>