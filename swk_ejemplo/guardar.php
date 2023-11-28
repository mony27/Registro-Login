<?php
include 'conexion.php'; // Incluye el archivo de conexión
include 'activar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);;
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    // Generar un token de activación único
    $activar_token = uniqid();
    
    $sql = "INSERT INTO registro (nombre, password, email, telefono,activar_token) VALUES ('$nombre', '$password', '$email', '$telefono','$activar_token')";

      // Enviar correo electrónico de activación
      $to = $_POST['email'];
      $subject = 'Activación de cuenta';
      $message = 'Haga clic en el siguiente enlace para activar su cuenta: ' . 
                 'http://http://regal-longma-ccabb2/activar.php?code='.$activar_token;
      $headers = 'From: 482000500@alumnos.utzac.edu.mx';
  
      mail($to, $subject, $message, $headers);
//verificar que el correo no se repita en la base de datos
$verificar_correo=mysqli_query($conn, "SELECT email FROM registro WHERE email='$email' and verificar_correo='1'");
if (mysqli_num_rows($verificar_correo) >0){
    echo'
    <script>
    alert("Este email ya esta registrado y verificado, inicia sesion con tu correo y contraseña");
    window.location.href="registro.html";
    </script>';
    exit();
}

if ($conn->query($sql) === TRUE) {
        echo 'Se ha enviado un enlace de activación a su correo electrónico.';
        echo '<script type="text/javascript">
        window.location.href="login.html";
        alert("Registro exitoso");
        </script>';
        
    } else {
        echo "Error al registrar datos: " . $conn->error;
    }

    
}
header("REGISTRATE: login.html?mensaje=registrado");
$conn->close();
?>
