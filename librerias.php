<?php

	function conectar()
	{
		$servidor = "localhost";
		$usuario = "root";
		$clave = "";
		$link = mysql_connect($servidor,$usuario,$clave);
		if (!$link)
		{
			mostrar_mensaje("NO SE PUEDE CONECTAR CON EL SERVIDOR DE LA BASE DE DATOS");
			die("NO SE PUEDE CONECTAR CON EL SERVIDOR DE LA BASE DE DATOS");
		}
		if (mysql_select_db("mydb",$link))
		{
			mysql_query ("SET NAMES 'utf8'");
			return $link;
		}else
		{
			//base de datos no disponible
			mostrar_mensaje("Base de datos no disponible");
			return NULL;
		}	
	}

	/*
		Creamos una funcion que nos servira para el proceso de insert, update y delete
	*/
	function actualizar_bd($sql)
	{
		$link = conectar();
		return mysql_query($sql,$link);

		//mostrar_mensaje("SUS DATOS HAN SIDO GUARDADOS");
	}
	
	/*
		Funcion que nos servira para un select
	*/
	function consultar($sql)
	{
		$link = conectar();
		$res = mysql_query($sql,$link);
		return $res;
	}

	function validar($n)
	{
			if($n==1){
				echo '<script language="JavaScript" type="text/javascript">
				document.location= "index_administrador.php";
				</script>';
			}
			if($n==2){
				echo '<script language="JavaScript" type="text/javascript">
				document.location= "index_jefe.php";
				</script>';
			}
			if($n==3){
				echo '<script language="JavaScript" type="text/javascript">
				document.location= "index_resp.php";
				</script>';
			}
	}
	
	


?>
