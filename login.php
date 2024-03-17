<?php
include("config.php");

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexion");
}

// obtenemos los datos
$correo = $_POST["email"];
$password = $_POST["password"];

// Verificar si el correo y la contraseña coinciden con un cliente
$sql = "SELECT * FROM Cliente WHERE correo = '$correo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Verificar contraseñas
    if (password_verify($password, $row["contrasena"])) {
        session_start();
        $_SESSION['user'] = $correo;
        $_SESSION['rol'] = "cliente";
        header("Location: inicio.html");
        exit;
    }
}

// Si no se encontró un cliente, verificar si el correo y la contraseña coinciden con un asistente
$sql = "SELECT * FROM Asistente WHERE correo = '$correo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Verificar contraseñas
    if (password_verify($password, $row["contrasena"])) {
        session_start();
        $_SESSION['user'] = $correo;
        $_SESSION['rol'] = "asistente";
        header("Location: inicio.html");
        exit;
    }
}

// Si no se encontró ni cliente ni asistente, enviar un mensaje al cliente
session_start();
$_SESSION['error'] = "Usuario o contraseña incorrectos.";
header("Location: index.php"); // Redirigir de vuelta al formulario de inicio de sesión
exit;