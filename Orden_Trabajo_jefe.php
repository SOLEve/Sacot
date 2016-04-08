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
			if(isset($_SESSION["id"]))
				session_unregister ( "id" );
	if(isset($_GET["p"])){
		$fin = 10;
		$pag = (int) $_GET["p"];
		if ($pag < 1){
   			$pag = 1;
		}
		$inicio = ($pag-1) * $fin;
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
</head>
<body>
	
	<div style="background:url(imagenes/fondo.jpg)">
			
		<div class="container-fluid" >
    		
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
    						<form action="Eliminar_Usuario.php" method="post" name="formulario">
	    						<ul class="nav nav-pills  nav-stacked">
									<li class="active"><a href="index_jefe.php"><i class="icon-home"></i> Inicio</a></li>
                                    <li ><a href="index_jefe.php"><i class="icon-home"></i> Atras</a></li>
                                    <li><a href="index.php"><i class="icon-pencil"></i>Cerrar Sesion</a></li>
								</ul>
							</form>
    					</div>  				
					</div>

    				<div class="span8 well" style="background:#FFFFFF">
                    <h2>Ordenes De Trabajo</h2>
                    <hr></hr>
    					<form name="form1" method="post" action="">
                    <input class="span14"  onclick="this.value='';" type="text" name="buscar" value="Ingrese datos a buscar">
						  <table width="600">
						    <tr>
						      <td><label class="radio">Por Id:
						        <input type="radio" name="RadioGroup" value="1" id="RadioGroup1_0">
						        </label></td>
								
						      <td><label class="radio">Por Descripcion:
						        <input type="radio" name="RadioGroup" value="2" id="RadioGroup1_1">
						        </label></td>

						      <td><label class="radio">Por Fecha:
						        <input type="radio" name="RadioGroup" value="3" id="RadioGroup1_2">
						        </label></td>
                                
                                <td><label class="radio">Por C.I. Solicitante:
						        <input name="RadioGroup" type="radio" id="RadioGroup1_2" value="4" checked>
					          </label></td>
					        </tr>
				      </table>
                      <button type="submit" name="b_buscar"  class="btn-primary" >Buscar</button>
				    </form>
                    <hr></hr>
    					<table class="table table-striped">
  							<caption><h3>Lista de Ordenes de Trabajo</h3></caption>
  							<thead>
    							<tr bgcolor="#0088cc">
      								<th>Id</th>
      								<th>Descripcion</th>
                                    <th>Fecha</th>
      								<th>C.I. Solicitante</th>
    							</tr>
  							</thead>
  							<tbody>
  							<?php
								
								
								
								
								if(!($_POST['RadioGroup']>0)){							
    							$consulta="SELECT * FROM orden_trabajo WHERE departamento_id_dpto = (SELECT departamento_id_dpto From usuario WHERE login = '".$_SESSION["login"]."') and ejecutada = 0 LIMIT $inicio, $fin";
								}else{
										if($_POST['RadioGroup']==1)
										$consulta="SELECT * FROM orden_trabajo WHERE departamento_id_dpto = (SELECT departamento_id_dpto From usuario WHERE login = '".$_SESSION["login"]."') and ejecutada = 0 and id like '%".$_POST['buscar']."%' LIMIT $inicio, $fin";
										if($_POST['RadioGroup']==2)
										$consulta="SELECT * FROM orden_trabajo WHERE departamento_id_dpto = (SELECT departamento_id_dpto From usuario WHERE login = '".$_SESSION["login"]."') and ejecutada = 0 and desc_ot like '%".$_POST['buscar']."%' LIMIT $inicio, $fin";
										if($_POST['RadioGroup']==3)
										$consulta="SELECT * FROM orden_trabajo WHERE departamento_id_dpto = (SELECT departamento_id_dpto From usuario WHERE login = '".$_SESSION["login"]."') and ejecutada = 0 and fe_exp like '%".$_POST['buscar']."%' LIMIT $inicio, $fin";
										if($_POST['RadioGroup']==4)
										$consulta="SELECT * FROM orden_trabajo WHERE departamento_id_dpto = (SELECT departamento_id_dpto From usuario WHERE login = '".$_SESSION["login"]."') and ejecutada = 0 and ced_sol like '%".$_POST['buscar']."%' LIMIT $inicio, $fin";
									}
								
								$res3=consultar($consulta);
								$fila3=mysql_fetch_array($res3);
								$totalPaginas=ceil($fila3[0]/$fin);
								
								$_SESSION["total"]=$totalPaginas;
								
								$res=consultar($consulta);
    							while($row=mysql_fetch_array($res))
    							{
								echo "<tr>
								    	<td align=\"right\"><a href=\"seguimiento_ot.php?id=$row[id]\"> $row[id]</a> </td>
								        <td><a href=\"seguimiento_ot.php?id=$row[id]\"> $row[desc_ot] </a> </td>
										<td><a href=\"seguimiento_ot.php?id=$row[id]\"> $row[fe_exp] </a> </td>
								        <td><a href=\"seguimiento_ot.php?id=$row[id]\">  $row[ced_sol] </a> </td>
								   	</tr>";
								}
								
							?>
  							</tbody>
						</table>	
  						<div class="pagination" align="center">
  							<ul>
    						<li><a href="Orden_Trabajo_jefe.php?p=<?php echo $pag-1?>">Anterior</a></li>
                            	<?php for($i=1;$i<=$totalPaginas;$i++){
									if($pag!=$i)
    									echo "<li><a href=\"Orden_Trabajo_jefe.php?p=".$i."\">$i</a></li>";
									else
										echo "<li class=\"active\"><a  href=\"Orden_Trabajo_jefe.php?p=".$i."\">$i</a></li>";
                                 }?>
                                 <?php if($pag<$totalPaginas){?>
    							<li><a href="Orden_Trabajo_jefe.php?p=<?php echo $pag+1?>" >Siguiente</a></li>
                                <?php }else{?>
                                <li " class="disabled" ><a href="Orden_Trabajo_jefe.php?p=<?php echo $pag?>">Siguiente</a></li>
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