<?php
// activar.php
if (isset($_GET['code'])) {
    $activar_token = $_GET['code'];

    // Verificar el código en la base de datos y activar la cuenta
    // Actualizar el estado de la cuenta a "activa"

    echo 'Su cuenta ha sido activada con éxito.';
} else {
    echo 'Código de activación no válido.';
}
