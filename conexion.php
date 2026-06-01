<?php
// Configuración de las credenciales de la base de datos
$host = "localhost";
$db_name = "sistema_inventario";
$username = "root";
$password = ""; // Vacío por defecto en XAMPP

// Habilitar el reporte de errores de mysqli para usar excepciones
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    // Iniciar conexión
    $conn = new mysqli($host, $username, $password, $db_name);

    // Configurar UTF-8
    $conn->set_charset("utf8");

} catch (mysqli_sql_exception $e) {

    die("Error crítico: No se pudo establecer la conexión segura con el servidor de datos.");

}
?>