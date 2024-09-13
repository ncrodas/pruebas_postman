<?php
// listar_usuarios.php: Lista todos los usuarios en la base de datos

require 'db.php';  // Asegúrate de tener la conexión a la base de datos configurada en este archivo

try {
    // Preparar la consulta SQL para obtener los nombres de usuarios
    $stmt = $pdo->prepare("SELECT id, username FROM users");
    $stmt->execute();
    
    // Obtener todos los resultados en un array asociativo
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los usuarios en formato JSON
    echo json_encode($users);

} catch (PDOException $e) {
    // Manejo de errores
    echo json_encode(["error" => "Error al listar usuarios: " . $e->getMessage()]);
}
?>
