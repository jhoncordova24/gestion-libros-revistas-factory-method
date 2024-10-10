<?php
session_start();
$error_message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../integracion/db.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $connection = Database::getInstance();
    $stmt = $connection->prepare("SELECT * FROM administradores WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && $password === $admin['password']) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        header("Location: index.php");
        exit;
    } else {
        $error_message = "Credenciales incorrectas. Por favor, inténtelo de nuevo.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mundo Literario | Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" /> <!-- Incluir Animate.css -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Asegúrate de incluir esto -->
</head>

<body>
    <section class="content-login">
        <?php if (isset($error_message) && !empty($error_message)): ?>
            <script>
                // Mostrar SweetAlert si hay un mensaje de error
                Swal.fire({
                    title: 'Oops...',
                    text: '<?php echo addslashes($error_message); ?>', // Escapar el mensaje para evitar problemas
                    icon: 'error',
                    showClass: {
                        popup: `
                animate__animated
                animate__fadeInUp
                animate__faster
            `
                    },
                    hideClass: {
                        popup: `
                animate__animated
                animate__fadeOutDown
                animate__faster
            `
                    },
                    confirmButtonColor: '#2b5bff', 
                    cancelButtonColor: 'gray',
                    showCancelButton: true, 
                    cancelButtonText: 'Cancelar', 
                    confirmButtonText: 'Aceptar', 
                    shadow: false 
                });
            </script>

        <?php endif; ?>
        <form class="login" method="POST" action="">
            <h2 class="login-title">Iniciar Sesión</h2>
            <img src="../assets/images/admin.png" alt="Admin">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <button class="btn-login" type="submit">Iniciar Sesión</button>
        </form>
    </section>
</body>

</html>