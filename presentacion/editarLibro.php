<?php
session_start();


if (!isset($_SESSION['admin_id'])) {
    
    header("Location: login.php"); 
    exit;
}
require_once '../negocios/ProductoFactory.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $libro = ProductoFactory::crearProducto('libro');

    $libro->setId($_POST['id']);
    $libro->setTitulo($_POST['titulo']);
    $libro->setAutor($_POST['autor']);
    $libro->setEditorial($_POST['editorial']);
    $libro->setPrecio($_POST['precio']);
    $libro->setUnidades($_POST['unidades']);


    $libro->editar();

    
    header("Location: gestionarLibros.php");
    exit;
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
 
    $connection = Database::getInstance();
    $stmt = $connection->prepare("SELECT * FROM libros WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $libro = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    
    header("Location: index.libros.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
    <link rel="stylesheet" href="../assets/css/revista.css">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="logo">
            <i class="bx bx-menu menu-icon"></i>
            <span class="logo-name">Mundo Literario</span>
            <img class="logo-img" src="../assets/images/book.png">
        </div>
        <div class="sidebar">
            <div class="logo">
                <i class="bx bx-menu menu-icon"></i>
                <span class="logo-name">Mundo Literario</span>
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


    <section class="content-editar">
        <form class="editar" method="POST" action="">
            <h1 class="edit-title">Editar Libro</h1>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($libro['id']); ?>">

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($libro['titulo']); ?>" required>

            <label for="autor">Autor:</label>
            <input type="text" id="autor" name="autor" value="<?php echo htmlspecialchars($libro['autor']); ?>" required>

            <label for="editorial">Editorial:</label>
            <input type="text" id="editorial" name="editorial" value="<?php echo htmlspecialchars($libro['editorial']); ?>" required>

            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" value="<?php echo htmlspecialchars($libro['precio']); ?>" required>

            <label for="precio">Unidades:</label>
            <input type="text" id="unidades" name="unidades" value="<?php echo htmlspecialchars($libro['unidades']); ?>" required>

            <button class="editar-btn" type="submit">Actualizar</button>
        </form>

    </section>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>