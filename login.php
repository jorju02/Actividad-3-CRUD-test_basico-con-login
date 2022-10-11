<?php
$mysqli = new mysqli("localhost", "root", "", "test");
if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}





if (isset($_POST['user']) && isset($_POST['pass'])) {
    $nombre = $_POST['user'];
    $contrasena = $_POST['pass'];

    /* Sentencia no preparada */
    $resultado = $mysqli->prepare("select * from test where nombre = ? and contrasena = ?");
    $resultado->bind_param("ss",$nombre,$contrasena);
    $resultado->execute();
    $resultado=$resultado->get_result();
    // mostrar resultado
    if ( $row = $resultado->fetch_assoc()) {
        echo "user y pass correctos";
        session_start();
        $_SESSION['nombre'] = $nombre;
        header("Location: select_test.php");
    } else {
        header("Location: index.php");
    }
}
