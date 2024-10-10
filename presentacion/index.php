<?php
session_start();


if (!isset($_SESSION['admin_id'])) {

    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tienda | Mundo Literario</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css" />
    <!-- Boxicons CSS -->
    <link
        href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
        rel="stylesheet" />
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
                            <i class="bx bx-food-menu icon"></i>
                            <span class="link">Gestionar Revistas</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="gestionarlibros.php" class="nav-link">
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

    <section class="content">
        <h1>Bienvenido, ¿Qué deseas hacer?</h1>
        <div class="admin">
            <div class="card">
                <div class="content-card">
                    <p class="heading">Gestionar Libros
                    </p>
                    <p class="para">
                        Accede a nuestra extensa colección de libros y gestiona todos los aspectos relacionados con ellos.
                    </p>
                    <i class='bx bx-book icon' style="font-size: 6rem; display: block; margin: 0 auto;"></i>
                    <button class="btn" onclick="window.location.href='gestionarLibros.php';">Gestionar</button>
                </div>
            </div>
            <div class="card">
                <div class="content-card">
                    <p class="heading">Gestionar Revistas
                    </p>
                    <p class="para">
                        Accede a nuestra extensa colección de revistas y gestiona todos los aspectos relacionados con ellas.
                    </p>
                    <i class='bx bx-food-menu icon' style="font-size: 6rem; display: block; margin: 0 auto;"></i>

                    <button class="btn" onclick="window.location.href='gestionarRevistas.php';">Gestionar</button>
                </div>
            </div>
        </div>
    </section>

    <section class="overlay">
    </section>

    <script src="../assets/js/script.js"></script>
</body>

</html>