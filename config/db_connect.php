<?php
// Conectar a la base de datos
$host = "localhost";
$dbname = "usuarios";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $pe) {
    die("No se pudo conectar a la base de datos $dbname :" . $pe->getMessage());
}

// Recibir los datos del formulario
$email = $_POST['email'];
$id_rol = $_POST['id_rol'];
$estado = $_POST['estado'];
$id = $_POST['id'];
var_dump($_POST);

// Actualizar el usuario en la base de datos
$sql = "UPDATE usuarios SET email = :email, id_rol = :id_rol, estado = :estado WHERE id = :id";
$query = $conn->prepare($sql);
$result = $query->execute(['email' => $email, 'id_rol' => $id_rol, 'estado' => $estado, 'id' => $id]);

if ($result) {
    echo "Usuario actualizado con éxito";
} else {
    echo "Hubo un error al actualizar el usuario";
}
?>