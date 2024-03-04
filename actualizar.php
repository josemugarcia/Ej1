<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php



    // Conexión a la base de datos
    try {
        $conexion = new PDO("mysql:host=localhost;dbname=banco;charset=utf8", "root", "");
    } catch (PDOException $e) {
        echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
        die("Error: " . $e->getMessage());
    }
    $consulta = $conexion->query("SELECT dni, nombre,direccion,telefono FROM cliente");
    ?>



    <form action="" method="post">
        <table border="1">
            <tr>
                <td><b>DNI</b></td>
                <td><b>Nombre</b></td>
                <td><b>Dirección</b></td>
                <td><b>Teléfono</b></td>
            </tr>
            <?php
            while ($cliente = $consulta->fetchObject()) {
                if ($cliente->dni == $_REQUEST['dniSeleccionado']) {
            ?>
                    <tr>
                        <td><input type="text" name="dniNuevo" value="<?= $cliente->dni ?>"></td>
                        <td><input type="text" name="nombreNuevo" value="<?= $cliente->nombre ?>"></td>
                        <td><input type="text" name="direccionNuevo" value="<?= $cliente->direccion ?>"></td>
                        <td><input type="text" name="telefonoNuevo" value="<?= $cliente->telefono ?>"></td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
        <input type="hidden" name="dniSeleccionado" value="<?= $_REQUEST['dniSeleccionado'] ?>">
        <input type="submit" name="btnCambiar" value="Cambiar">
    </form>
    <?php




    if (isset($_REQUEST['btnCambiar'])) {
        // Conexión a la base de datos
        try {
            $conexion = new PDO(
                "mysql:host=localhost;dbname=banco;charset=utf8",
                "root",
                ""
            );
        } catch (PDOException $e) {
            echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
            die("Error: " . $e->getMessage());
        }


        $update = "UPDATE cliente SET  dni=\"$_REQUEST[dniNuevo]\",nombre=\"$_REQUEST[nombreNuevo]\",
        direccion=\"$_REQUEST[direccionNuevo]\", telefono=\"$_REQUEST[telefonoNuevo]\" WHERE
        dni=\"$_REQUEST[dniSeleccionado]\"";

        $conexion->exec($update);




        $conexion = null;
        header("Refresh:0; url=principal.php");
    }
    ?>




    <a href="principal.php">VoLver a inicio</a>


</body>

</html>