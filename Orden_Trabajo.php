<?php 
  include("librerias.php");
  session_start();
  
  if(isset($_GET["p"])){
	
	$fin = 10;
	$pag = (int) $_GET["p"];
	if ($pag < 1){
   		$pag = 1;
	}
	$inicio = ($pag-1) * $fin;
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
								<li class="active"><a href="index_administrador.php"><i class="icon-home"></i> Inicio</a></li>
								<li><a href="Agregar_OT.php"><i class="icon-pencil"></i> Agregar</a></li>
								<li><a href="Orden_Trabajo.php?p=1"><i class="icon-list-alt"></i> Listar</a></li>
								<li><a href="consultar_ot.php?p=1" ><i class="icon-search"></i>Consultar</a></li>
                                <li><a href="index.php"><i class="icon-pencil"></i>Cerrar Sesion</a></li>
							</ul>
    					</div>  				
					</div>


    				<div class="span8 well" style="background:#FFFFFF">
                    	
    					<table class="table table-striped">
  							<caption>
  							<h3>Lista de Ordenes De Trabajo Registradas</h3>
  							</caption>
  							<thead>
    							<tr bgcolor="#0088cc">
      								<th>Cedula</th>
      								<th>Descripcion</th>
      								<th>Departamentos</th>
    							</tr>
  							</thead>
  							<tbody>
                            	<?php
								//echo $offset." ".$limite;
									$consulta2="select count(ced_sol) FROM orden_trabajo join departamento where `id_dpto` = `departamento_id_dpto`";
									$res2=consultar($consulta2);
									$fila=mysql_fetch_array($res2);
									$totalPaginas=ceil($fila[0]/$fin);
									$_SESSION["total"]=$totalPaginas;
				                    $consulta="SELECT ced_sol,`desc_ot`,`nombre` FROM orden_trabajo join departamento where `id_dpto` = `departamento_id_dpto` LIMIT $inicio, $fin ";
									
				                    $res=consultar($consulta);
				                    while($row=mysql_fetch_array($res))
				                    {
				                      echo " <tr>
				                              <td align='right'> $row[ced_sol] </td>
                                              <td> $row[desc_ot] </td>
                                              <td> $row[nombre] </td>
				                             </tr>";
				                    }
				                  ?>
  							</tbody>
						</table>	
  						<div class="pagination" align="center">
  							<ul>
    						<li><a href="Orden_Trabajo.php?p=<?php echo $pag-1?>">Anterior</a></li>
                            	<?php for($i=1;$i<=$totalPaginas;$i++){
									if($pag!=$i)
    									echo "<li><a href=\"Orden_Trabajo.php?p=".$i."\">$i</a></li>";
									else
										echo "<li class=\"active\"><a  href=\"Orden_Trabajo?p=".$i."\">$i</a></li>";
                                 }?>
                                 <?php if($pag<$totalPaginas){?>
    							<li><a href="Orden_Trabajo.php?p=<?php echo $pag+1?>" >Siguiente</a></li>
                                <?php }else{?>
                                <li " class="disabled" ><a href="Orden_Trabajo.php?p=<?php echo $pag?>">Siguiente</a></li>
                                <?php }?>
  							</ul>
						</div>
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
<script language="javascript">
	
	function consultar()
	{

	}

</script>