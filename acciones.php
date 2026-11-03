<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: usuario.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: administrador.php");
    exit;
}
require_once "conexion.php";

function volver($msg) {
    header("Location: administrador.php?msg=" . $msg);
    exit;
}

// Permisos por rol
$rol             = $_SESSION["rol"];
$esAdmin         = ($rol === "Administrador");
$puedeInventario = in_array($rol, ["Administrador", "Developer 1", "Developer 2"], true);
$rolesValidos    = ["Administrador", "Developer 1", "Developer 2", "Consultor"];

// Token CSRF
if (!hash_equals($_SESSION["csrf"] ?? "", $_POST["csrf"] ?? "")) {
    volver("csrf");
}

$tabla  = $_POST["tabla"] ?? "";
$accion = $_POST["accion"] ?? "";
$id     = (int)($_POST["id"] ?? 0);

/* ===================== INVENTARIO ===================== */
if ($tabla === "inventario") {
    if (!$puedeInventario) volver("sinpermiso");

    if ($accion === "agregar" || $accion === "actualizar") {
        $nombre     = trim($_POST["nombre_producto"] ?? "");
        $precio     = filter_var($_POST["precio"] ?? "", FILTER_VALIDATE_FLOAT);
        $existencia = filter_var($_POST["existencia"] ?? "", FILTER_VALIDATE_INT);

        if ($nombre === "" || mb_strlen($nombre) > 150 ||
            $precio === false || $precio < 0 || $precio > 99999999.99 ||
            $existencia === false || $existencia < 0) {
            volver("invalido");
        }

        if ($accion === "agregar") {
            $stmt = $conexion->prepare("INSERT INTO inventario(nombre_producto, precio, existencia) VALUES (?, ?, ?)");
            $stmt->bind_param("sdi", $nombre, $precio, $existencia);
            $stmt->execute();
            volver("agregado");
        } else {
            $stmt = $conexion->prepare("UPDATE inventario SET nombre_producto = ?, precio = ?, existencia = ? WHERE id_producto = ?");
            $stmt->bind_param("sdii", $nombre, $precio, $existencia, $id);
            $stmt->execute();
            volver("actualizado");
        }
    }

    if ($accion === "eliminar") {
        $stmt = $conexion->prepare("DELETE FROM inventario WHERE id_producto = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        volver("eliminado");
    }
}

/* ===================== ROLES (solo Administrador) ===================== */
if ($tabla === "roles") {
    if (!$esAdmin) volver("sinpermiso");

    if ($accion === "agregar" || $accion === "actualizar") {
        $usuario    = trim($_POST["usuario"] ?? "");
        $contrasena = $_POST["contrasena"] ?? "";
        $rolNuevo   = $_POST["rol"] ?? "";

        if ($usuario === "" || mb_strlen($usuario) > 50 ||
            $contrasena === "" || mb_strlen($contrasena) > 50 ||
            !in_array($rolNuevo, $rolesValidos, true)) {
            volver("invalido");
        }

        // Usuario repetido
        $idComparar = ($accion === "actualizar") ? $id : 0;
        $stmt = $conexion->prepare("SELECT id_rol FROM roles WHERE usuario = ? AND id_rol <> ? LIMIT 1");
        $stmt->bind_param("si", $usuario, $idComparar);
        $stmt->execute();
        if ($stmt->get_result()->fetch_assoc()) {
            volver("duplicado");
        }

        if ($accion === "agregar") {
            $stmt = $conexion->prepare("INSERT INTO roles(usuario, contrasena, rol) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $usuario, $contrasena, $rolNuevo);
            $stmt->execute();
            volver("agregado");
        } else {
            $stmt = $conexion->prepare("UPDATE roles SET usuario = ?, contrasena = ?, rol = ? WHERE id_rol = ?");
            $stmt->bind_param("sssi", $usuario, $contrasena, $rolNuevo, $id);
            $stmt->execute();

            // Si el admin se edita a sí mismo, refrescar la sesión
            if ($id === (int)$_SESSION["id_rol"]) {
                $_SESSION["usuario"] = $usuario;
                $_SESSION["rol"]     = $rolNuevo;
            }
            volver("actualizado");
        }
    }

    if ($accion === "eliminar") {
        if ($id === (int)$_SESSION["id_rol"]) {
            volver("autoeliminar");
        }
        $stmt = $conexion->prepare("DELETE FROM roles WHERE id_rol = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        volver("eliminado");
    }
}

volver("invalido");