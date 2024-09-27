<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="contendor-php">
<?php

$ser = "localhost";
$user = "root";
$pass = "";
$db =  "tenis_mesa_champion";

$enlace = mysqli_connect ($ser, $user, $pass, $db);

if($enlace -> connect_error){
    echo("conexion FALLIDA". $enlace->connect_error);
}

$nom = $_POST['nombre'];
$ape = $_POST['apellido'];
$rut = $_POST['rut'];
$email = $_POST['email'];
$cat = $_POST['categoria'];

$fecha_torneo = '2024-10-04';

$horas = ['09:00', '11:00', '13:00', '15:00'];
$hora_torneo = $horas [array_rand($horas)];
$mesa_torneo = rand(1,10);

$sql = "INSERT INTO participantes (nombre, apellido, rut, email, categoria, fecha, hora, mesa) 
        VALUES ('$nom', '$ape', '$rut', '$email', '$cat', '$fecha_torneo', '$hora_torneo', '$mesa_torneo')";

if($enlace->query($sql)===TRUE){
    echo"<h2> Registrado con exito¡¡¡SUERTE!!! </h2>";
}else"No se a podido registrar debido a un error". $sql. "<br>". $enlace->error;

$sql = "SELECT id, nombre, apellido, rut, email, categoria, fecha, hora, mesa FROM participantes";
$result = $enlace->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Lista de Participantes Registrados</h2>";
    echo "<table border='1'>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>RUT</th>
                <th>Email</th>
                <th>Categoría</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Mesa</th>
            </tr>";
    
            
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"]. "</td>
                <td>" . $row["nombre"]. "</td>
                <td>" . $row["apellido"]. "</td>
                <td>" . $row["rut"]. "</td>
                <td>" . $row["email"]. "</td>
                <td>" . $row["categoria"]. "</td>
                <td>" . $row["fecha"]. "</td>
                <td>" . $row["hora"]. "</td>
                <td>" . $row["mesa"]. "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay participantes registrados aún.";
}

$enlace->close();

?>
</div>
<div class="boton-salida">
    <a style="background-color:#fff7; text-decoration:none; color:#322; padding:3px 10px; border:1px solid #444; font-weight:600; position:absolute; top:5px; left:20px;" href="index.html">volver al inicio</a>
</div>
</body>
</html>