<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: usuario.php");
    exit;
}
require_once "conexion.php";

// Permisos por rol
$rol             = $_SESSION["rol"];
$esAdmin         = ($rol === "Administrador");
$puedeInventario = in_array($rol, ["Administrador", "Developer 1", "Developer 2"], true); // editar inventario
$rolesValidos    = ["Administrador", "Developer 1", "Developer 2", "Consultor"];

// Token CSRF
if (empty($_SESSION["csrf"])) {
    $_SESSION["csrf"] = bin2hex(random_bytes(32));
}
$csrf = $_SESSION["csrf"];

// Mensajes
$mensajes = [
    "agregado"     => "Registro agregado.",
    "actualizado"  => "Registro actualizado.",
    "eliminado"    => "Registro eliminado.",
    "invalido"     => "Datos inválidos. Revisa los campos.",
    "duplicado"    => "Ese usuario ya existe.",
    "autoeliminar" => "No puedes eliminar tu propio usuario.",
    "sinpermiso"   => "No tienes permiso para esa acción.",
    "csrf"         => "Sesión de formulario vencida. Intenta de nuevo."
];
$msg = $mensajes[$_GET["msg"] ?? ""] ?? "";

// Registro en edición
$editInv = null;
if ($puedeInventario && isset($_GET["editar_inventario"])) {
    $idEdit = (int)$_GET["editar_inventario"];
    $stmt = $conexion->prepare("SELECT id_producto, nombre_producto, precio, existencia FROM inventario WHERE id_producto = ?");
    $stmt->bind_param("i", $idEdit);
    $stmt->execute();
    $editInv = $stmt->get_result()->fetch_assoc();
}
$editRol = null;
if ($esAdmin && isset($_GET["editar_roles"])) {
    $idEdit = (int)$_GET["editar_roles"];
    $stmt = $conexion->prepare("SELECT id_rol, usuario, contrasena, rol FROM roles WHERE id_rol = ?");
    $stmt->bind_param("i", $idEdit);
    $stmt->execute();
    $editRol = $stmt->get_result()->fetch_assoc();
}

// Datos
$inventario = $conexion->query("SELECT id_producto, nombre_producto, precio, existencia FROM inventario ORDER BY id_producto");
$roles      = $esAdmin ? $conexion->query("SELECT id_rol, usuario, contrasena, rol FROM roles ORDER BY id_rol") : null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USUARIO</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="shortcut icon" href="img/store.ico" type="image/x-icon">
    <style>
        .form-crud { display: flex; flex-wrap: wrap; gap: 10px; align-items: flex-end; margin: 15px 0; }
        .form-crud label { display: block; font-size: 0.85em; font-weight: bold; margin-bottom: 3px; }
        .form-crud input, .form-crud select { padding: 6px 8px; }
        .form-crud button, .btn-tabla { padding: 6px 12px; cursor: pointer; }
        .acciones-celda { display: flex; gap: 6px; align-items: center; }
        .acciones-celda form { margin: 0; }
        .aviso { margin: 10px 0; font-weight: bold; }
    </style>
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

    <!--Sesion activa-->
    <div class="container">
        <p>
            Sesión iniciada como <b><?= htmlspecialchars($rol) ?></b>
            <a href="logout.php">Cerrar sesión</a>
        </p>
        <?php if ($msg !== ""): ?>
            <p class="aviso"><?= htmlspecialchars($msg) ?></p>
        <?php endif; ?>
    </div>

    <?php if ($esAdmin): ?>
    <!--Tabla roles (solo Administrador)-->
    <div class="container">
        <h1>Tabla: roles</h1>

        <form class="form-crud" action="acciones.php" method="post">
            <input type="hidden" name="csrf" value="<?= $csrf ?>">
            <input type="hidden" name="tabla" value="roles">
            <?php if ($editRol): ?>
                <input type="hidden" name="accion" value="actualizar">
                <input type="hidden" name="id" value="<?= (int)$editRol['id_rol'] ?>">
            <?php else: ?>
                <input type="hidden" name="accion" value="agregar">
            <?php endif; ?>
            <div>
                <label>Usuario</label>
                <input type="text" name="usuario" maxlength="50" required value="<?= htmlspecialchars($editRol['usuario'] ?? '') ?>">
            </div>
            <div>
                <label>Contraseña</label>
                <input type="text" name="contrasena" maxlength="50" required value="<?= htmlspecialchars($editRol['contrasena'] ?? '') ?>">
            </div>
            <div>
                <label>Rol</label>
                <select name="rol" required>
                    <?php foreach ($rolesValidos as $r): ?>
                        <option value="<?= $r ?>" <?= (($editRol['rol'] ?? '') === $r) ? 'selected' : '' ?>><?= $r ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit"><?= $editRol ? 'Actualizar' : 'Agregar' ?></button>
            <?php if ($editRol): ?><a href="administrador.php">Cancelar</a><?php endif; ?>
        </form>

        <div class="tabla-wrapper">
            <table class="tabla-datos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($roles->num_rows > 0): ?>
                        <?php while ($fila = $roles->fetch_assoc()): ?>
                            <tr>
                                <td><?= (int)$fila['id_rol'] ?></td>
                                <td><?= htmlspecialchars($fila['usuario']) ?></td>
                                <td><?= htmlspecialchars($fila['contrasena']) ?></td>
                                <td><?= htmlspecialchars($fila['rol']) ?></td>
                                <td>
                                    <div class="acciones-celda">
                                        <a href="administrador.php?editar_roles=<?= (int)$fila['id_rol'] ?>">EDITAR</a>
                                        <form action="acciones.php" method="post" onsubmit="return confirm('¿Eliminar este usuario?');">
                                            <input type="hidden" name="csrf" value="<?= $csrf ?>">
                                            <input type="hidden" name="tabla" value="roles">
                                            <input type="hidden" name="accion" value="eliminar">
                                            <input type="hidden" name="id" value="<?= (int)$fila['id_rol'] ?>">
                                            <button type="submit" class="btn-tabla">ELIMINAR</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="5">Sin registros.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <!--Tabla inventario-->
    <div class="container">
        <h1>Tabla: inventario</h1>

        <?php if ($puedeInventario): ?>
        <form class="form-crud" action="acciones.php" method="post">
            <input type="hidden" name="csrf" value="<?= $csrf ?>">
            <input type="hidden" name="tabla" value="inventario">
            <?php if ($editInv): ?>
                <input type="hidden" name="accion" value="actualizar">
                <input type="hidden" name="id" value="<?= (int)$editInv['id_producto'] ?>">
            <?php else: ?>
                <input type="hidden" name="accion" value="agregar">
            <?php endif; ?>
            <div>
                <label>Producto</label>
                <input type="text" name="nombre_producto" maxlength="150" required size="40" value="<?= htmlspecialchars($editInv['nombre_producto'] ?? '') ?>">
            </div>
            <div>
                <label>Precio (S/)</label>
                <input type="number" name="precio" step="0.01" min="0" required value="<?= htmlspecialchars($editInv['precio'] ?? '') ?>">
            </div>
            <div>
                <label>Existencia</label>
                <input type="number" name="existencia" min="0" step="1" required value="<?= htmlspecialchars($editInv['existencia'] ?? '') ?>">
            </div>
            <button type="submit"><?= $editInv ? 'Actualizar' : 'Agregar' ?></button>
            <?php if ($editInv): ?><a href="administrador.php">Cancelar</a><?php endif; ?>
        </form>
        <?php endif; ?>

        <div class="tabla-wrapper">
            <table class="tabla-datos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Existencia</th>
                        <?php if ($puedeInventario): ?><th>Acciones</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($inventario->num_rows > 0): ?>
                        <?php while ($fila = $inventario->fetch_assoc()): ?>
                            <tr>
                                <td><?= (int)$fila['id_producto'] ?></td>
                                <td><?= htmlspecialchars($fila['nombre_producto']) ?></td>
                                <td>S/ <?= number_format((float)$fila['precio'], 2) ?></td>
                                <td><?= (int)$fila['existencia'] ?></td>
                                <?php if ($puedeInventario): ?>
                                <td>
                                    <div class="acciones-celda">
                                        <a href="administrador.php?editar_inventario=<?= (int)$fila['id_producto'] ?>">EDITAR</a>
                                        <form action="acciones.php" method="post" onsubmit="return confirm('¿Eliminar este producto?');">
                                            <input type="hidden" name="csrf" value="<?= $csrf ?>">
                                            <input type="hidden" name="tabla" value="inventario">
                                            <input type="hidden" name="accion" value="eliminar">
                                            <input type="hidden" name="id" value="<?= (int)$fila['id_producto'] ?>">
                                            <button type="submit" class="btn-tabla">ELIMINAR</button>
                                        </form>
                                    </div>
                                </td>
                                <?php endif; ?>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="<?= $puedeInventario ? 5 : 4 ?>">Sin registros.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
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
<?php $conexion->close(); ?>