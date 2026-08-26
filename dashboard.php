<?php 
session_start(); 
 
// Validar que el usuario haya iniciado sesión 
if (!isset($_SESSION['user_id'])) { 
    header("Location: index.php"); 
    exit(); 
} 
 
require_once "conexion.php"; 
 
// MÉTRICA 1 
$res_total = $conn->query("SELECT COUNT(id) AS cantidad FROM productos"); 
$fila_total = $res_total->fetch_assoc(); 
$total_productos = $fila_total['cantidad']; 
 
// MÉTRICA 2 
$res_valor = $conn->query("SELECT SUM(precio * stock) AS capital FROM productos"); 
$fila_valor = $res_valor->fetch_assoc(); 
 
$capital_inventario = $fila_valor['capital'] ? $fila_valor['capital'] : 0; 
 
// MÉTRICA 3 
$res_caro = $conn->query("SELECT MAX(precio) AS max_precio FROM productos"); 
$fila_caro = $res_caro->fetch_assoc(); 
 
$precio_maximo = $fila_caro['max_precio'] ? $fila_caro['max_precio'] : 0; 
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Dashboard</title>

<style>

body{

font-family:Segoe UI;
background:#f1f5f9;
margin:0;
padding:20px;

}

.navbar{

background:#1e293b;
color:white;
padding:15px 25px;
border-radius:8px;

display:flex;
justify-content:space-between;
align-items:center;

margin-bottom:30px;

}

.btn-salir{

background:#ef4444;
color:white;
padding:8px 15px;
text-decoration:none;
border-radius:5px;
font-weight:bold;

}

.tarjetas-container{

display:flex;
gap:20px;
margin-bottom:30px;

}

.tarjeta{

background:white;
flex:1;
padding:25px;
text-align:center;
border-radius:8px;
box-shadow:0 4px 6px rgba(0,0,0,.05);
border-top:5px solid #3b82f6;

}

.tarjeta.verde{

border-top:5px solid #10b981;

}

.tarjeta.naranja{

border-top:5px solid #f59e0b;

}

.numero{

font-size:32px;
font-weight:bold;

}

.menu-modulos{

display:flex;
gap:20px;

}

.modulo{

flex:1;
background:#3b82f6;
color:white;
padding:20px;
text-decoration:none;
text-align:center;
border-radius:8px;
font-size:18px;
font-weight:bold;

}

.modulo:hover{

background:#2563eb;

}

</style>

</head>

<body>

<div class="navbar">

<h1>

Bienvenido,
<?php echo $_SESSION['nombre']; ?>

</h1>

<a href="logout.php" class="btn-salir">

Cerrar Sesión

</a>

</div>


<div class="tarjetas-container">

<div class="tarjeta">

<h3>Total Productos</h3>

<p class="numero">

<?php echo $total_productos; ?>

</p>

</div>


<div class="tarjeta verde">

<h3>Capital Inventario</h3>

<p class="numero">

$<?php echo number_format($capital_inventario,2); ?>

</p>

</div>


<div class="tarjeta naranja">

<h3>Producto Más Caro</h3>

<p class="numero">

$<?php echo number_format($precio_maximo,2); ?>

</p>

</div>

</div>


<h2>Módulos</h2>

<div class="menu-modulos">

<!-- MÓDULO DE INVENTARIO -->
<a href="inventario.php" class="modulo">

📦 Inventario

</a>


<!-- MÓDULO DE PROVEEDORES - NUEVO -->
<a href="proveedores.php" 
class="modulo" 
style="background:#8b5cf6;">

🚚 Módulo de Proveedores

</a>


<!-- PUNTO DE VENTA -->
<a href="#" 
class="modulo" 
style="background:#64748b;">

🛒 Punto de Venta
(Próximamente)

</a>

</div>

</body>

</html>