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
				<div class="span8">
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
									<li class="active"><a href="index_administrador.php"><i class="icon-home"></i> Inicio</a></li>
                                    <li ><a href="index_administrador.php"><i class="icon-home"></i> Atras</a></li>
                                    <li><a href="index.php"><i class="icon-pencil"></i>Cerrar Sesion</a></li>
								</ul>
							</form>
    					</div>  				
					</div>

    				<div class="span8 well" style="background:#FFFFFF">
                    <h2>Ordenes De Trabajo</h2>
    					<form name="form1" method="post" action="">
                        <table width="600">
						    <tr bgcolor="#F8F8F8">
						      <td><label class="radio">Por Id:
						        <input name="RadioGroup" type="radio" id="RadioGroup1_0" value="1">
						        </label></td>
								
						      <td><label class="radio">Por Descripcion:
						        <input type="radio" name="RadioGroup" value="2" id="RadioGroup1_1">
						        </label></td>

						      <td><label class="radio">Por Fecha:
						        <input type="radio" name="RadioGroup" value="3" id="RadioGroup1_2">
						        </label></td>
                                
                                <td><label class="radio">Por C.I. Solicitante:
						        <input name="RadioGroup" type="radio" id="RadioGroup1_3" value="4">
					          </label></td>
					        </tr>
				      </table>
                      
                    <input class="span14"  onclick="this.value='';" type="text" name="buscar" value="Ingrese datos a buscar">
						  
					 <table width="400">
                          <label>Por emisor:</label>
						    <tr bgcolor="#F8F8F8">
						      <td><label class="radio">Todas:
						        <input name="RadioGroup1" type="radio" id="RadioGroup1_0" value="0" checked>
						        </label></td>
								
						      <td><label class="radio">Despacho:
						        <input type="radio" name="RadioGroup1" value="1" id="RadioGroup1_1">
						        </label></td>

						      <td><label class="radio">Alcalde:
						        <input type="radio" name="RadioGroup1" value="2" id="RadioGroup1_2">
						        </label></td>
                            </tr>
				      </table>
							<table width="300">
                          <label>Ejecutada:</label>
						    <tr bgcolor="#F8F8F8">
						      <td><label class="radio">
						        <div align="left">Ambas:
						        <input name="RadioGroup2" type="radio" id="RadioGroup1_0" value="0" checked>
						        </div>
                              </label></td>
								
						      <td><label class="radio">Si:
						        <input type="radio" name="RadioGroup2" value="1" id="RadioGroup1_1">
					          </label></td>

						      <td><label class="radio">No:
						        <input type="radio" name="RadioGroup2" value="2" id="RadioGroup1_2">
					          </label></td>
                            </tr>
				      </table>
                      <label>Lista de Departamentos:</label>
                      <select class="span6" name = "lista_a">
<option value="0">Todos los Departamentos</option>
                                                        <option value="1">Ingenieria Municipal</option>
                                                        <option value="2">Servicios Generales</option>
                                                        <option value="3">Hacienda</option>
                                                        <option value="4">Catastro</option>
                                                        <option value="5">Recaudacion</option>
                                                        <option value="6">Sindicatura Municipal</option>
                                                        <option value="7">Recursos Humanos</option>
                                                        <option value="8">Registro Civil</option>
                                                        
						  </select>
                      <label>Lista de Responsables:</label>
  								<select name="inputResponsable" >
  								  <option value="todos">Todos</option>
									<?php
    									$consulta="SELECT * FROM usuario WHERE rol_id_rol=3 ";
										$res=consultar($consulta);
	    								while($row=mysql_fetch_array($res))
	    								{
	    									echo "<option value=\"$row[login]\">$row[nombre]</option>";
	    								}
    								?>	
    								</select>
                                    
                          <button type="submit" name="b_buscar"  class="btn-primary">Buscar</button>
				    </form>

                  </div>
  				</div>
               <div class="well" style="background:#FFFFFF">
                <table width="100" align="center" class="table table-striped">
  							<caption>
  							<strong>Lista de Ordenes de Trabajo</strong>
				  </caption>
  							<thead>
    							<tr>
      								<th>Id</th>
      								<th>Descripcion</th>
                                    <th>Fecha</th>
      								<th>C.I Solicitante</th>
                                    <th>Ordenado por</th>
                                    <th>Responsable</th>
                                    <th>Departamento</th>
    							</tr>
  							</thead>
  							<tbody>
  							<?php
if(!($_POST['RadioGroup']>0)) //ningun item seleccionado
{
	if($_POST["lista_a"]==0)//por departamento
	{
		if($_POST['RadioGroup1']==0)//por emisor
		{
			if($_POST['RadioGroup2']==0)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";

				}
			}
		}
		if($_POST['RadioGroup1']==1)//por emisor despacho
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ordenado_por = 'Despacho'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ordenado_por = 'Despacho' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ordenado_por = 'Despacho' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ordenado_por = 'Despacho' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ordenado_por = 'Despacho' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ordenado_por = 'Despacho' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}
		if($_POST['RadioGroup1']==2)//por emisor alcalde
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ordenado_por = 'Alcalde'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ordenado_por = 'Alcalde' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ordenado_por = 'Alcalde' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ordenado_por = 'Alcalde' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ordenado_por = 'Alcalde' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ordenado_por = 'Alcalde' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}
		
	}else //($_POST["lista_a"]>0)
	{
	 	if($_POST['RadioGroup1']==0)//por emisor
		{
			if($_POST['RadioGroup2']==0)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where departamento_id_dpto = ".$_POST["lista_a"]."";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where departamento_id_dpto = ".$_POST["lista_a"]." and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";

				}
			}
		}
		if($_POST['RadioGroup1']==1)//por emisor despacho
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}
		if($_POST['RadioGroup1']==2)//por emisor alcalde
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}	
	}							
}else
{ ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if($_POST['RadioGroup']==1)
	{
		if($_POST["lista_a"]==0)//por departamento
	{
		if($_POST['RadioGroup1']==0)//por emisor
		{
			if($_POST['RadioGroup2']==0)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' ";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";

				}
			}
		}
		if($_POST['RadioGroup1']==1)//por emisor despacho
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}
		if($_POST['RadioGroup1']==2)//por emisor alcalde
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}
		
	}else //($_POST["lista_a"]>0)
	{
	 	if($_POST['RadioGroup1']==0)//por emisor
		{
			if($_POST['RadioGroup2']==0)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and  departamento_id_dpto = ".$_POST["lista_a"]."";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 1";
				}else
				{

					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";

				}
			}
		}
		if($_POST['RadioGroup1']==1)//por emisor despacho
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}
		if($_POST['RadioGroup1']==2)//por emisor alcalde
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where id like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}	
	}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_POST['RadioGroup']==2)
{
	if($_POST["lista_a"]==0)//por departamento
	{
		if($_POST['RadioGroup1']==0)//por emisor
		{
			if($_POST['RadioGroup2']==0)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' ";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";

				}
			}
		}
		if($_POST['RadioGroup1']==1)//por emisor despacho
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}
		if($_POST['RadioGroup1']==2)//por emisor alcalde
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}
		
	}else //($_POST["lista_a"]>0)
	{
	 	if($_POST['RadioGroup1']==0)//por emisor
		{
			if($_POST['RadioGroup2']==0)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]."";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";

				}
			}
		}
		if($_POST['RadioGroup1']==1)//por emisor despacho
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}
		if($_POST['RadioGroup1']==2)//por emisor alcalde
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where desc_ot like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}	
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_POST['RadioGroup']==3)
{
	if($_POST["lista_a"]==0)//por departamento
	{
		if($_POST['RadioGroup1']==0)//por emisor
		{
			if($_POST['RadioGroup2']==0)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";

				}
			}
		}
		if($_POST['RadioGroup1']==1)//por emisor despacho
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}
		if($_POST['RadioGroup1']==2)//por emisor alcalde
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}
		
	}else //($_POST["lista_a"]>0)
	{
	 	if($_POST['RadioGroup1']==0)//por emisor
		{
			if($_POST['RadioGroup2']==0)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]."";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";

				}
			}
		}
		if($_POST['RadioGroup1']==1)//por emisor despacho
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}
		if($_POST['RadioGroup1']==2)//por emisor alcalde
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where fe_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}	
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_POST['RadioGroup']==4)
{
		if($_POST["lista_a"]==0)//por departamento
	{
		if($_POST['RadioGroup1']==0)//por emisor
		{
			if($_POST['RadioGroup2']==0)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";

				}
			}
		}
		if($_POST['RadioGroup1']==1)//por emisor despacho
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Despacho' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}
		if($_POST['RadioGroup1']==2)//por emisor alcalde
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and ordenado_por = 'Alcalde' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}
		
	}else //($_POST["lista_a"]>0)
	{
	 	if($_POST['RadioGroup1']==0)//por emisor
		{
			if($_POST['RadioGroup2']==0)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]."";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";

				}
			}
		}
		if($_POST['RadioGroup1']==1)//por emisor despacho
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Despacho' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}
		if($_POST['RadioGroup1']==2)//por emisor alcalde
		{
			if($_POST['RadioGroup2']==0)//por ejecutada ambas
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde'";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==1)//por ejecutada si
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 1";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 1 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
			if($_POST['RadioGroup2']==2)//por ejecutada no
			{
				if($_POST["inputResponsable"]=="todos")
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 0";
				}else
				{
					$consulta="SELECT * FROM orden_trabajo where ced_sol like '%".$_POST['buscar']."%' and departamento_id_dpto = ".$_POST["lista_a"]." and ordenado_por = 'Alcalde' and ejecutada = 0 and responsable= '".$_POST["inputResponsable"]."'";
				}
			}
		}	
	}	
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////										
}
									
								$imprimir;
								$res=consultar($consulta);
    							while($row=mysql_fetch_array($res))
    							{
								if($row[departamento_id_dpto]==1){$imprimir="Ingenieria Municipal";}
								if($row[departamento_id_dpto]==2){$imprimir="Servicios Generales";}
								if($row[departamento_id_dpto]==3){$imprimir="Hacienda";}
								if($row[departamento_id_dpto]==4){$imprimir="Catastro";}
								if($row[departamento_id_dpto]==5){$imprimir="Recaudacion";}
								if($row[departamento_id_dpto]==6){$imprimir="Sindicatura Municipal";}
								if($row[departamento_id_dpto]==7){$imprimir="Recursos Humanos";}
								if($row[departamento_id_dpto]==8){$imprimir="Registro Civil";}
								
								$consulta2="SELECT * FROM usuario WHERE login='".$row[responsable]."'";
								$res2=consultar($consulta2);
								$dato=mysql_fetch_array($res2);
								
								echo "<tr>
								    	<td align=\"right\"> $row[id] </td>
								        <td>$row[desc_ot]  </td>
										<td>$row[fe_sol] </td>
								        <td> $row[ced_sol] </td>
										<td> $row[ordenado_por] </td>
										<td> $dato[nombre] </td>
										<td> $imprimir</td>
								   	</tr>";
								}
								
							?>
  							</tbody>
						</table>
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