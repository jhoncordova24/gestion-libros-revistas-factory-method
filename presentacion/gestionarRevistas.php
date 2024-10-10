<?php
session_start();


if (!isset($_SESSION['admin_id'])) {

    header("Location: login.php");
    exit;
}
require_once '../negocios/ProductoFactory.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        Revista::eliminar($id);
    } else {
        $revista = ProductoFactory::crearProducto('revista');

        $revista->setTitulo($_POST['titulo']);
        $revista->setFechaPublicacion($_POST['fecha_publicacion']);
        $revista->setEditorial($_POST['editorial']);
        $revista->setPrecio($_POST['precio']);
        $revista->setUnidades($_POST['unidades']); // Agregar esta línea
        $revista->crear();
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$revistas = Revista::listar();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tienda | Mundo Literario</title>
    <link rel="stylesheet" href="../assets/css/revista.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
    <nav>
        <div class="logo">
            <i class="bx bx-menu menu-icon"></i>
            <span class="logo-name">Mundo literario</span>
            <img class="logo-img" src="../assets/images/book.png">
        </div>
        <div class="sidebar">
            <div class="logo">
                <i class="bx bx-menu menu-icon"></i>
                <span class="logo-name">Mundo literario</span>

            </div>
            <div class="sidebar-content">
                <ul class="lists">
                    <li class="list">
                        <a href="index.php" class="nav-link">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="link">Inicio</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="gestionarRevistas.php" class="nav-link">
                            <i class="bx bx-bar-chart-alt-2 icon"></i>
                            <span class="link">Gestionar Revistas</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="gestionarLibros.php" class="nav-link">
                            <i class='bx bx-book icon'></i>
                            <span class="link">Gestionar Libros</span>
                        </a>
                    </li>
                </ul>
                <div class="bottom-cotent">
                    <li class="list">
                        <a href="logout.php" class="nav-link">
                            <i class="bx bx-log-out icon"></i>
                            <span class="link">Salir</span>
                        </a>
                    </li>
                </div>
            </div>
        </div>
    </nav>

    <section class="content-revista">
        <h1>Administrar revistas</h1>
        <div class="container-revista">
            <div class="box">
                <h2>Registrar revista</h2>
                <form class="crear" method="POST" action="">
                    <input type="text" name="titulo" placeholder="Título" required>
                    <input type="date" name="fecha_publicacion" placeholder="Fecha de Publicación" required>
                    <input type="text" name="editorial" placeholder="Editorial" required>
                    <input type="number" name="precio" placeholder="Precio" required>
                    <input type="number" name="unidades" placeholder="Unidades" required> <!-- Agregar este campo -->
                    <button class="registrar" type="submit">Registrar</button>
                </form>
            </div>
            <div class="box">
                <h2>Lista de Revistas</h2>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Fecha de Publicación</th>
                                <th>Editorial</th>
                                <th>Precio</th>
                                <th>Unidades</th> <!-- Agregar encabezado para Unidades -->
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($revistas as $revista): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($revista['titulo']); ?></td>
                                    <td><?php echo htmlspecialchars($revista['fecha_publicacion']); ?></td>
                                    <td><?php echo htmlspecialchars($revista['editorial']); ?></td>
                                    <td>S/ <?php echo htmlspecialchars($revista['precio']); ?></td>
                                    <td><?php echo htmlspecialchars($revista['unidades']); ?></td> <!-- Mostrar Unidades -->
                                    <td>
                                        <button type="button" class="btn-editar" onclick="location.href='editarRevista.php?id=<?php echo $revista['id']; ?>'">Editar</button>
                                        <button type="button" class="btn-eliminar" data-id="<?php echo $revista['id']; ?>">Eliminar</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section class="overlay">
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>