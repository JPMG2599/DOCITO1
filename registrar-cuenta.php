<?php
include("config.php");

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexion");
}

// Obtenemos los datos del form
$nombre = $_POST["nombre"]." ". $_POST["apellido"];
$telefono = $_POST["tel"];
$estado = $_POST["estado"];
$correo = $_POST["email"];
$password = password_hash($_POST["password"], PASSWORD_BCRYPT);
$rol = $_POST["roles"];

// --- AGREGAR UN CLIENTE ---
if ($rol == "cliente") {
    $sql = "INSERT INTO Cliente (nombre, correo, telefono, estado, contrasena) VALUES ('$nombre', '$correo', '$telefono', '$estado', '$password')";
}

// --- AGREGAR UN ASISTENTE ---
if ($rol == "asistente") {
    $correoDoc = $_POST["doctorEmail"];

    $sql_doc = "SELECT id_doctor FROM Doctor WHERE correo = '$correoDoc'";
    $result_doc = $conn->query($sql_doc);

    if ($result_doc->num_rows > 0) {
        $row_doc = $result_doc->fetch_assoc();
        $id_doctor = $row_doc["id_doctor"];

        $sql = "INSERT INTO Asistente (nombre, correo, contrasena, id_doctor, telefono, estado) VALUES ('$nombre', '$correo', '$password', '$id_doctor', '$telefono', '$estado')";
    } else {
        echo "No se encontró ningún doctor con el correo proporcionado";
    }
}

// --- AGREGAR UN DOCTOR ---
if ($rol == "doctor") {
    $especialidad = $_POST["especialidad"];
    $sql = "INSERT INTO Doctor (nombre, correo, telefono, estado, contrasena, especialidad) VALUES ('$nombre', '$correo', '$telefono', '$estado', '$password', '$especialidad')";
}


if ($conn->query($sql) === FALSE) { echo "Error en la consulta"."<br>";}