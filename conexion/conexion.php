<?php

$servidor="mysql:dbname=p_curn;host=127.0.0.1";
$usuario="root";
$password="";

try {
		$pdo= new PDO($servidor,$usuario,$password,array(PDo::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
		
} catch (PDOException $e) {
	echo "conexion mala : (".$e->getMessage();
}

?>