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
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : ''; 
$contrasena = isset($_POST['contrasena']) ? password_hash($_POST['contrasena'], PASSWORD_BCRYPT) : ''; // Encriptar la contraseña

// Verificar si el usuario o el email ya existen
$sql = "SELECT id FROM usuarios WHERE usuario='$usuario' OR correo_electronico='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Usuario o email ya existen
    echo "El usuario o el email ya están registrados.";
} else {
    // Insertar nuevo usuario
    $sql = "INSERT INTO usuarios (nombre, apellido, usuario, contrasena, correo_electronico) VALUES ('$nombre', '$apellido', '$usuario', '$contrasena', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>
