<?php
// index.php

// --- CONFIGURACIÓN (AQUI HAY ERRORES) ---
// ¿Existe 'localhost' dentro de un contenedor aislado?
$servername = "localhost"; 

$username = "root";
$password = "123456"; 

$dbname = "libro_visitas";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Error Fatal de Conexión: " . $conn->connect_error);
}


$sql = "CREATE TABLE IF NOT EXISTS firmas (id INT AUTO_INCREMENT PRIMARY KEY, texto VARCHAR(255))";
$conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $texto = $_POST['firma'];
    $conn->query("INSERT INTO firmas (texto) VALUES ('$texto')");
}
?>

<h1>Libro de Firmas</h1>
<form method="post">
    <input type="text" name="firma" placeholder="Tu nombre">
    <input type="submit" value="Firmar">
</form>
<h3>Firmas:</h3>
<ul>
<?php
$result = $conn->query("SELECT texto FROM firmas");
while($row = $result->fetch_assoc()) { echo "<li>" . $row['texto'] . "</li>"; }
?>
</ul>
