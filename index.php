<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repuestos y Accesorios para Cocina | Tienda De Repuestos De Cocina</title>
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
		<form id="searchForm" action="#" method="get">
			<input type="text" id="searchInput" name="buscar" placeholder="Buscar...">
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
    <!--Contenido Principal-->
    <div class="container">
        <h1>Encuentra el Repuesto Exacto para tu Cocina</h1>
        <p><b>¿Tu cocina necesita un repuesto?</b> Contamos con un catálogo organizado para que encuentres la pieza precisa sin perder tiempo.</p>
        <p><b>Calidad y compatibilidad garantizada.</b> Disponemos de piezas individuales y kits completos de instalación (mangueras, reguladores, quemadores y perillas) de las marcas más reconocidas del mercado como Mabe, Bosch, Sole e Indurama.</p>
        <a href="producto.php">Ver Catalogo</a>
    </div>
    <!--Paquetes disponibles-->
    <div class="container">
        <h1>Paquetes:</h1>
        <br>
        <img class="producto-img" src="img/3.jpeg" alt="">
        <p><b>MANGUERA DE ALTA PRESION 1.5 METROS + REGULADOR ALTA PRESION</b><br/>S/ 39.90 <s>S/ 49.90</s></p>
        <img class="producto-img" src="img/4.jpeg" alt="">
        <p><b>MANGUERA DE BAJA PRESION 1.5 METROS + REGULADOR BAJA PRESION</b><br/>S/ 39.90 <s>S/ 59.90</s></p>
        <a href="paquetes.php">Ver Paquetes</a>
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
