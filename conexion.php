<?php
////Variable Servidor
$server = "";     
//Variable Usuario Hosting
$user   = "";
//Variable Contraseña             
$pass   = "";      
//Variable Base De Datos Mysql
$db     = ""; 
//Reporte de excepciones
mysqli_report(MYSQLI_REPORT_OFF);
//Variable De Conexion a la Base De Datos
$conexion = new mysqli($server, $user, $pass, $db);
//Condicional
if ($conexion->connect_errno) {
	echo "No conectado a la Base De Datos: " . $db . " .";
} else {
	echo "Conectado a la Base De Datos: " . $db . " .";
}

?>
