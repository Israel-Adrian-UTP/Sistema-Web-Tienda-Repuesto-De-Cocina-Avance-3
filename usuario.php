<?php
session_start();
if (isset($_SESSION["usuario"])) {
    header("Location: administrador.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USUARIO</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="shortcut icon" href="img/store.ico" type="image/x-icon">
</head>
<body>
    <!--Encabezado-->
    <header>
        <img class="title-logo" src="img/titulologo.png">
    </header>
    <!--Buscador-->
    <div class="search-bar">
        <form action="#" method="get">
            <input type="text" name="buscar" placeholder="Buscar...">
            <button type="submit">Buscar</button>
        </form>
    </div>
    <!--Menu De Navegacion-->
    <nav>
        <ul>
            <li><a href="index.php">INICIO</a></li>
            <li><a href="producto.php">PRODUCTOS</a></li>
            <li><a href="paquetes.php">PAQUETES</a></li>
            <li><a href="nosotros.php">NOSOTROS</a></li>
            <li><a href="usuario.php">USUARIO</a></li>
        </ul>
    </nav> 
    <!--Login-->
    <div class="container">
        <h1>Iniciar Sesion</h1>
        <form class="login-form" id="loginForm" action="login.php" method="post">
            <div class="campo">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required>
            </div>
            <div class="campo">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
            </div>
            <button type="submit" class="btn-login">Continuar</button>
            <p id="message" style="margin-top: 15px; text-align: center; font-weight: bold;">
                <?php if (isset($_GET["error"])): ?>
                    Usuario o contraseña incorrectos.
                <?php endif; ?>
            </p>
        </form>
    </div>
    <!--Pie De Pagina-->
    <footer>
        <div class="containerfooter">
            <span>
                Desarrollado por
                <br>
                <img src="img/UTP.png" alt="" class="logofooter">
                <br>
                &copy; 2026, <b>Tienda De Repuestos De Cocina. </b>Todos los derechos reservados.
            </span>
        </div>
    </footer>
	<!--Boton subir arriba-->
	<button id="btnVolverArriba" class="btn-volver-arriba" title="Volver arriba">↑</button>
	<!--Boton modo oscuro-->
	<button id="btnModoOscuro" class="btn-modo-oscuro" title="Modo oscuro">🌙</button>
	<!--JavaScript-->
	<script src="js/login.js"></script>
</body>
</html>