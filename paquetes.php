<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAQUETES</title>
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
	<!--Titulo-->
    <div class="container">
        <h1>Paquetes Disponibles</h1>
    </div>
    <!--Producto 3-->
    <div class="container" id="producto-3">
        <img class="producto-img" src="img/3.jpeg" alt="">
        <p><b>MANGUERA DE ALTA PRESION 1.5 METROS + REGULADOR ALTA PRESION</b><br/>S/ 39.90 <s>S/ 49.90</s></p>
        <a href="#modal-3">VER PRODUCTO</a>
    </div>
    <!--Modal Producto 3-->
    <div id="modal-3" class="modal-overlay">
        <a href="#producto-3" class="modal-cerrar">&times;</a>
        <img src="img/3.jpeg" alt="">
    </div>
    <!--Producto 4-->
    <div class="container" id="producto-4">
        <img class="producto-img" src="img/4.jpeg" alt="">
        <p><b>MANGUERA DE BAJA PRESION 1.5 METROS + REGULADOR BAJA PRESION</b><br/>S/ 39.90 <s>S/ 59.90</s></p>
        <a href="#modal-4">VER PRODUCTO</a>
    </div>
    <!--Modal Producto 4-->
    <div id="modal-4" class="modal-overlay">
        <a href="#producto-4" class="modal-cerrar">&times;</a>
        <img src="img/4.jpeg" alt="">
    </div>
    <!--Producto 5-->
    <div class="container" id="producto-5">
        <img class="producto-img" src="img/5.jpeg" alt="">
        <p><b>QUEMADOR + TAPA DE BRONCE COCINA INDURAMA</b><br/>S/ 119.90 <s>S/ 149.90</s></p>
        <a href="#modal-5">VER PRODUCTO</a>
    </div>
    <!--Modal Producto 5-->
    <div id="modal-5" class="modal-overlay">
        <a href="#producto-5" class="modal-cerrar">&times;</a>
        <img src="img/5.jpeg" alt="">
    </div>
    <!--Producto 6-->
    <div class="container" id="producto-6">
        <img class="producto-img" src="img/6.jpeg" alt="">
        <p><b>TAPAS DE COCINA MABE</b><br/>S/ 79.90 <s>S/ 99.90</s></p>
        <a href="#modal-6">VER PRODUCTO</a>
    </div>
    <!--Modal Producto 6-->
    <div id="modal-6" class="modal-overlay">
        <a href="#producto-6" class="modal-cerrar">&times;</a>
        <img src="img/6.jpeg" alt="">
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
