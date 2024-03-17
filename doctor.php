<?php
include("config.php");

$conn = new mysqli($servername, $username, $password, $database);

$correoDoc = $_POST["doctorEmail"];

$sql = "SELECT correo FROM Doctor WHERE correo = '$correoDoc'";
$result = $conn->query($sql);

// Verificamos si el doctor está registrado
$response = array("registered" => ($result->num_rows > 0));

// Enviamos la respuesta en formato JSON
echo json_encode($response);