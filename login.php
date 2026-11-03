<?php
session_start();
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: usuario.php");
    exit;
}

$usuario  = trim($_POST["usuario"] ?? "");
$password = $_POST["password"] ?? "";

$stmt = $conexion->prepare("SELECT id_rol, usuario, rol FROM roles WHERE usuario = ? AND contrasena = ? LIMIT 1");
$stmt->bind_param("ss", $usuario, $password);
$stmt->execute();
$resultado = $stmt->get_result();

if ($fila = $resultado->fetch_assoc()) {
    session_regenerate_id(true);
    $_SESSION["id_rol"]  = $fila["id_rol"];
    $_SESSION["usuario"] = $fila["usuario"];
    $_SESSION["rol"]     = $fila["rol"];
    header("Location: administrador.php");
} else {
    header("Location: usuario.php?error=1");
}

$stmt->close();
$conexion->close();
exit;