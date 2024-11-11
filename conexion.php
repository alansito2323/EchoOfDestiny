<?php
$servername = "autorack.proxy.rlwy.net";
$username = "root";
$password = "MXyNzHLqHbsQbnsQTHOwIhnIYpMqHHvT";
$dbname = "railway";
$port = 37390;

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>