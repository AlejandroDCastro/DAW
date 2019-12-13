<!DOCTYPE html> 
<html lang="es"> 
<head> 
<meta charset="utf-8" /> 
<title>Prueba de SELECT y mysqli orientado a objetos</title> 
</head> 
<body> 
<?php 

// Conecta con el servidor de MySQL 
$conn = new mysqli( 
         'localhost',   // El servidor 
         'daw',    // El usuario 
         'daw',          // La contraseña 
         'daw'); // La base de datos 
		 
if(!$conn) { 
	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error(); 
	echo '</p>'; 
	exit; 
}

/*****************************************
 Obtener todos los usuarios en una tabla.
*****************************************/

// Ejecuta una sentencia SQL 
$sentencia = "SELECT p.id, p.nombre, l.nombre as localidad 
				FROM Persona p JOIN Localidad l ON p.localidad = l.id";

if(!($resultado = $conn->query($sentencia))) {
	echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $conn->connect_error; 
	echo '</p>'; 
	exit;
}

echo "<table>";
echo "<tr>"; 
echo "<th>ID</th><th>Nombre</th><th>Localidad</th>";
echo "</tr>";
// Recorre el resultado y lo muestra en forma de tabla HTML 
while($fila = $resultado->fetch_object()) {
	echo "<tr>";
	echo "<td>$fila->id</td>";
	echo "<td>$fila->nombre</td>";
	echo "<td>$fila->localidad</td>";
	echo "</tr>";
}
echo "</table>";
// Libera la memoria ocupada por el resultado 
$resultado->close();

/**************************************************
 Obtener los datos de una persona a partir de su id
***************************************************/

$id_usu = $_GET['user'];
// Ejecuta una sentencia SQL 
$sentencia = "SELECT p.id, p.nombre, l.nombre as localidad 
				FROM Persona p JOIN Localidad l ON p.localidad = l.id
				WHERE p.id = ?";

$stmt = $conn->prepare($sentencia);
$stmt->bind_param('i', $id_usu);
if(!$stmt->execute()) {
	echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $conn->connect_error; 
	echo '</p>'; 
	exit;
}

$resultado = $stmt->get_result();
if($resultado->num_rows) 
{
	$fila = $resultado->fetch_object();
	echo "ID: $fila->id<br/>";
	echo "ID: $fila->nombre<br/>";
	echo "ID: $fila->localidad<br/>";
} 
else
{
	echo "Ese usuario no existe";
}
$resultado->close();

// Cierra la conexión 
$conn->close(); 
?> 
</body> 
</html>