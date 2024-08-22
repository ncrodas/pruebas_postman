<?php
// register.php: Maneja el registro de nuevos usuarios

require 'db.php';

// Permitir tanto GET como POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') {
    // Usar $_REQUEST para capturar los datos enviados ya sea por POST o GET
    $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : null;
    $password = isset($_REQUEST['password']) ? password_hash($_REQUEST['password'], PASSWORD_DEFAULT) : null;

    if ($username && $password) {
        try {
            // Preparar la consulta SQL para insertar un nuevo usuario en la base de datos
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            echo json_encode(["message" => "Registro exitoso"]);
        } catch (PDOException $e) {
            echo json_encode(["error" => "Error al registrar el usuario: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["error" => "Faltan campos obligatorios"]);
    }
} else {
    echo json_encode(["error" => "Método de solicitud no permitido"]);
}
?>
