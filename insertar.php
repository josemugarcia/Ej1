<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_REQUEST['btnInsertar'])) {
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
        // Comprueba si ya existe un cliente con el DNI introducido
        $consulta = $conexion->query("SELECT dni FROM cliente WHERE dni=" . $_REQUEST['dniCliente']);

        if ($consulta->rowCount() > 0) {



            echo "Ya existe un cliente con DNI <br>";
            echo "Por favor, vuelva a insertar un nuevo cliente";
    ?>

    <?php
        } else {
            $insercion = "INSERT INTO cliente (dni, nombre, direccion, telefono) VALUES
    ('$_REQUEST[dniCliente]','$_REQUEST[nombreCliente]','$_REQUEST[direccionCliente]','$_REQUEST[telefonoCliente]')";
            //echo $insercion;
            $conexion->exec($insercion);
            echo "Cliente dado de alta correctamente.";


            $conexion = null;

            header("Refresh:0; url=principal.php");
        }
    }


    ?>
    <h3>Insertar Registros en la tabla cliente de La BBDD banco</h3>

    <form action="">
        DNI
        <input type="text" name="dniCliente" id=""><br>
        Nombre
        <input type="text" name="nombreCliente" id=""><br>
        Direccion
        <input type="text" name="direccionCliente" id=""><br>
        Telefono
        <input type="text" name="telefonoCliente" id=""><br>

        <input type="submit" name="btnInsertar" value="insertar">
    </form>

    <a href="principal.php">Volver A inicio</a>
</body>

</html>