<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Incluir conexión
require_once 'conexion.php';

// Verificar que los datos lleguen por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Capturar y limpiar los datos
    $empresa = trim($_POST['empresa']);
    $contacto = trim($_POST['contacto']);
    $telefono = trim($_POST['telefono']);
    $direccion = trim($_POST['direccion']);

    try {

        // Consulta SQL
        $sql = "INSERT INTO proveedores 
                (nombre_empresa, contacto, telefono, direccion)
                VALUES (?, ?, ?, ?)";

        // Preparar consulta
        $stmt = $conn->prepare($sql);

        // Vincular parámetros
        $stmt->bind_param(
            "ssss",
            $empresa,
            $contacto,
            $telefono,
            $direccion
        );

        // Ejecutar
        $stmt->execute();

        // Cerrar sentencia
        $stmt->close();

        // Regresar al catálogo
        header("Location: proveedores.php");
        exit();

    } catch (mysqli_sql_exception $e) {

        die("Error crítico al registrar el proveedor: " . $e->getMessage());
    }

} else {

    // Si intentan entrar directamente
    header("Location: proveedores.php");
    exit();
}

?>