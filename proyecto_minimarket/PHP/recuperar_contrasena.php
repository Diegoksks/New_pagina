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
$email = $_POST['email'];

// Verificar si el email existe
$sql = "SELECT id FROM usuarios WHERE correo_electronico='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Aquí puedes agregar el código para enviar el correo de recuperación de contraseña
    // Enviar notificación al usuario (esto es un ejemplo; necesitarás implementar el envío de correo)
    echo "Correo enviado correctamente.";
} else {
    echo "El correo electrónico no está registrado.";
}

// Cerrar conexión
$conn->close();
?>
