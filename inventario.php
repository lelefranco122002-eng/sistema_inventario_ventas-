<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'conexion.php';

$sql = "SELECT p.id, p.nombre_producto, c.nombre_categoria, p.stock, p.precio
FROM productos p
INNER JOIN categorias c ON p.categoria_id = c.id
ORDER BY p.id ASC";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inventario - Sistema de Ventas</title>

<style>
    <style>

body{
    font-family: Arial;
    background:#f4f4f4;
}

table{
    width:100%;
    border-collapse:collapse;
}

th,td{
    border:1px solid #ccc;
    padding:10px;
}

/* AQUÍ VA EL NUEVO CÓDIGO */

.btn-eliminar{

    background:#ef4444;
    color:white;
    padding:6px 12px;
    text-decoration:none;
    border-radius:5px;
    font-size:13px;
    font-weight:bold;

}
.btn-editar{

background:#f59e0b;
color:white;
padding:6px 12px;
text-decoration:none;
border-radius:4px;
font-weight:bold;
margin-right:5px;

}

.btn-editar:hover{

background:#d97706;

}

.btn-eliminar:hover{

    background:#b91c1c;

}

</style><style>

body{
    font-family: Arial;
}

table{
    width:100%;
}

th{
    background:#2563eb;
    color:white;
}

/* Agrega esto al final */

.btn-eliminar{
    background:#ef4444;
    color:white;
    padding:6px 12px;
    text-decoration:none;
    border-radius:4px;
    font-size:13px;
    font-weight:bold;
}

.btn-eliminar:hover{
    background:#b91c1c;
}

</style>

</head>
<body>

<div class="container">

<div class="header">
    <h2>Catálogo de Inventario</h2>
    <br>

<a href="nuevo_producto.php"
style="
background:#3b82f6;
color:white;
padding:10px 20px;
text-decoration:none;
border-radius:5px;
display:inline-block;
margin-bottom:20px;
">

+ Nuevo Producto

</a>

    <div>
        <span>Usuario:
            <strong><?php echo $_SESSION['nombre']; ?></strong>
        </span>

        <a href="logout.php" class="btn-salir">Cerrar Sesión</a>
    </div>
</div>

<table>
<thead>
<tr>
    <th>Código</th>
    <th>Nombre del Producto</th>
    <th>Categoría</th>
    <th>Stock</th>
    <th>Precio</th>
    <th>Acciones</th>
</tr>
</thead>

<tbody>

<?php
if ($resultado->num_rows > 0) {

    while ($fila = $resultado->fetch_assoc()) {

        $claseStock = ($fila['stock'] < 10) ? 'stock-bajo' : '';
?>

<tr>

<td><?php echo $fila['id']; ?></td>

<td><?php echo $fila['nombre_producto']; ?></td>

<td><?php echo $fila['nombre_categoria']; ?></td>

<td><?php echo $fila['stock']; ?></td>

<td>$<?php echo number_format($fila['precio'],2); ?></td>

<td>

<a href="editar_producto.php?id=<?php echo $fila['id']; ?>" class="btn-editar">
✏️ Editar
</a>

<a href="eliminar_producto.php?id=<?php echo $fila['id']; ?>"
class="btn-eliminar"
onclick="return confirm('¿Seguro de eliminar este producto?');">
🗑️ Eliminar
</a>

</td>
</tr>

<?php
    }

} else {
?>

<tr>
    <td colspan="5" style="text-align:center;">
        No hay productos registrados en el sistema.
    </td>
</tr>

<?php } ?>

</tbody>
</table>

</div>

<?php
$resultado->free();
?>

</body>
</html>