<?php
// register.php: Maneja el registro de nuevos usuarios

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        echo json_encode(["message" => "Registro exitoso"]);
    } catch (PDOException $e) {
        echo json_encode(["error" => "Error al registrar el usuario: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Método de solicitud no permitido"]);
}
?>