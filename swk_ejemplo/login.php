<?php
session_start();
include 'conexion.php'; // Incluye el archivo de conexión

// Obtener los datos del formulario
$email = $_POST["email"];
$password = $_POST["password"];

$validar_login=mysqli_query($conn, "SELECT id, password FROM registro WHERE email='$email'");

if (mysqli_num_rows($validar_login) >0){
    $_SESSION['email']=$email;
    header('Location: index.html');
    exit;
}else {
    // Autenticación fallida, redirigir al usuario de nuevo al formulario de inicio de sesión
     echo'<script>
      location.href = "login_incorrecto.html"
      </script>';
    exit;
}
?>
