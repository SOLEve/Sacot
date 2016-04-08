<?php session_start();
	include("librerias.php");
	
	$cont=0;
	if(isset($_POST["presupuesto_b_InsertarOrden"]))
	{
		
		//
		$insertar="INSERT INTO presupuesto(`orden_trabajo_id`, `fecha_ppto`, `obra`, `lugar`, `contratista` ,`responsable`,`aprobacion`) VALUES('".$_SESSION["id"]."', '".$_POST["fecha"]."', '".$_POST["obra"]."','".$_POST["lugar"]."','".$_POST["contratista"]."','".$_POST["responsable"]."','".$_POST["aprobacion"]."')";
		echo "insercion de la obra";
		if(actualizar_bd($insertar))
		{
			$consulta2="SELECT * FROM  `presupuesto` WHERE id_ppto = (SELECT MAX( id_ppto ) FROM  `presupuesto`) and orden_trabajo_id='".$_SESSION["id"]."'";
			$res2=consultar($consulta2);
			$fila2=mysql_fetch_array($res2);
			

			while(isset($_POST["no_".$cont]))
			{
				
				$insertar="INSERT INTO item_pre(`id`,`descripcion`,`unidad`,`cantidad`,`precio_unit`,`monto`,`presupuesto_id_ppto`) VALUES ('".$_POST["no_".$cont]."','".$_POST["descripcion_".$cont]."','".$_POST["unidad_".$cont]."','".$_POST["cantidad_".$cont]."','".$_POST["precio_".$cont]."','".$_POST["monto_".$cont]."','".$fila2["id_ppto"]."')";
				
				$result=actualizar_bd($insertar);
				$cont++;
			}
			if($cont>0)
			echo '<script language="JavaScript" type="text/javascript">
				document.location= "presupuestos.php";
				</script>';
		}
	}
	
	$conta=0;
	if(isset($_POST["b_asignar"]))
	{
		
		//
		$insertar="INSERT INTO inf_tec(`orden_trabajo_id`, `fecha`, `obra`, `lugar`, `descripcion` ,`responsable`,`aprobacion`) VALUES('".$_SESSION["id"]."', '".$_POST["fecha"]."', '".$_POST["obra"]."','".$_POST["lugar"]."','".$_POST["descripcion"]."','".$_POST["responsable"]."','".$_POST["aprobacion"]."')";
		echo "insercion de la obra informe";
		
		if(actualizar_bd($insertar))
		{
			$consulta2="SELECT * FROM `inf_tec` WHERE id = (SELECT MAX( id ) FROM `inf_tec`) and orden_trabajo_id='".$_SESSION["id"]."'";
			$res2=consultar($consulta2);
			$fila2=mysql_fetch_array($res2);
			

			while(isset($_POST["no_".$conta]))
			{
				
				$insertar="INSERT INTO item_inf(`id`,`descripcion`,`calculos`,`unidad`,`cant_total`,`inf_tec_id`) VALUES ('".$_POST["no_".$conta]."','".$_POST["Des_".$conta]."','".$_POST["Cal_".$conta]."','".$_POST["Uni_".$conta]."','".$_POST["Can_".$conta]."','".$fila2["id"]."')";
				
				$result=actualizar_bd($insertar);

				echo "<br>";
				$conta++;
			}
			if($conta>0)
			echo '<script language="JavaScript" type="text/javascript">
				document.location= "Lista_Informes_Tecnicos.php";
				</script>';
		}
	}
	
?>