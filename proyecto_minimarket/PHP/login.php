<?php
// Datos de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "minimercado";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

// Verificar si el usuario existe
$sql = "SELECT id, contrasena FROM usuarios WHERE usuario='$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Usuario encontrado
    $row = $result->fetch_assoc();
    $hashed_password = $row['contrasena'];
    
    // Verificar la contraseña
    if (password_verify($contrasena, $hashed_password)) {
        // Contraseña correcta
        session_start();
        $_SESSION['usuario'] = $usuario;
        echo "Inicio de sesión exitoso!";
        // Redirigir a una página protegida o panel de usuario
        header("Location: ../HTML/home.html"); // Cambia la URL según tu estructura
        exit();
    } else {
        // Contraseña incorrecta
        echo "Usuario o contraseña incorrectos.";
    }
} else {
    // Usuario no encontrado
    echo "Usuario o contraseña incorrectos.";
}

// Cerrar conexión
$conn->close();
?>
