
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $mysqli = new mysqli("localhost", "root", "", "test");
    if ($mysqli->connect_errno) {
        echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    /* Sentencia preparada, etapa 1: preparación */
    if (!($sentencia = $mysqli->prepare("DELETE FROM test WHERE id=?"))) {
        echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    /* Sentencia preparada, etapa 2: vinculación y ejecución */
    if (!$sentencia->bind_param("i", $id)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    /* se recomienda el cierre explícito */
    $sentencia->close();

    /* Sentencia no preparada */
    //$resultado = $mysqli->query("SELECT * FROM test");
    //var_dump($resultado->fetch_all());
    header("Location: select_test.php");
} else {
    echo ("<br>Error en parametros<br>");
}






?>

