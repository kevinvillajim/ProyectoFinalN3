<?php
$db = new mysqli('localhost', 'root', '', 'universidad');

if ($db->connect_error) {
    header('Content-Type: application/json');
    die(json_encode(['error' => $db->connect_error]));
}

$id = $_GET['id'];

$stmt = $db->prepare("SELECT email, id_rol, estado FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);

if (!$stmt->execute()) {
    header('Content-Type: application/json');
    die(json_encode(['error' => $stmt->error]));
}

$result = $stmt->get_result();
$data = $result->fetch_assoc();

header('Content-Type: application/json');
echo json_encode($data);

$db->close();
?>