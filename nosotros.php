<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOSOTROS</title>
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
    <!--Sobre el proyecto-->
    <div class="container">
        <h1>Origen Del Proyecto</h1>
        <p>Este sitio web fue desarrollado como proyecto final para la asignatura de Taller de Programación Web de la Universidad Tecnológica del Perú (UTP). El objetivo principal del sistema es solucionar el desorden de catálogos mediante una arquitectura estructurada, acelerando la localización de repuestos e integrando un módulo de administración para la gestión en tiempo real de la base de datos de productos.</p>
        <p><b>Stack Tecnologico: </b>HTML, CSS, JavaScript, PHP, MySQL</p>
    </div> 
    <!--Fundador-->
    <div class="container">
        <div class="developer">
            <div class="developerbox">
                <img src="img/fondo2.jpg" alt="" class="fondo">
            </div>
        <img src="img/fundador.png" alt="" class="persona">
        </div>
        <br>
        <h1>Victor Pacheco</h1>
        <h4>Fundador De La Tienda</h4>
        <p>Con más de 10 años de experiencia en el sector de repuestos de cocinas, mi objetivo principal es ayudarte a encontrar la pieza exacta que tu equipo necesita sin complicaciones.</p>
        <p>Entendemos lo frustrante que es buscar un repuesto por modelo y no dar con el correcto. Por eso, hemos optimizado nuestra plataforma y atención para asesorarte de manera precisa, garantizando repuestos compatibles y soluciones rápidas para tu hogar o negocio.</p>  
    </div>
    <!--Developer 1-->
    <div class="container">
        <div class="developer">
            <div class="developerbox">
                <img src="img/fondo1.jpg" alt="" class="fondo">
            </div>
        <img src="img/developer1.png" alt="" class="persona">
        </div>
        <br>
        <h1>Israel Adrian Palomares Dueñas</h1>
        <h4>Desarrollador Frontend</h4>
        <p>Estudiante de Ingeniería de Sistemas en la UTP, enfocado en el diseño de interfaces web intuitivas. A cargo del desarrollo visual, estructuración de menús y optimización de la experiencia de navegación para facilitar la búsqueda rápida de repuestos.</p>
        <a href="https://github.com/Israel-Adrian-UTP">Contactar</a>        
    </div>
    <!--Developer 2-->
    <div class="container">
        <div class="developer">
            <div class="developerbox">
                <img src="img/fondo3.jpg" alt="" class="fondo">
            </div>
        <img src="img/developer2.png" alt="" class="persona">
        </div>
        <br>
        <h1>Brayan Negrón Cortez</h1>
        <h4>Desarrollador Backend</h4>
        <p>Estudiante de Ingeniería de Sistemas en la UTP, especializado en la gestión de bases de datos y lógica de servidor. Responsable de estructurar la base de datos de inventario y la integración de la sección de administración para el dueño de la tienda.</p>
        <a href="https://github.com/Andre20041711">Contactar</a>        
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
