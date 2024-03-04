<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_REQUEST['btnEliminar'])) {
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



        $delete = "DELETE FROM cliente WHERE dni=" . $_REQUEST['dniSeleccionado'];
        $conexion ->exec($delete);
        echo $_REQUEST['dniSeleccionado'];
        echo "Cliente eliminado correctamente";


       
        $conexion = null;
        header("Refresh:2; url=principal.php");
    }
    ?>
</body>

</html>