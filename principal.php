<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Crea una aplicación web que permita hacer listado, alta, baja y modificación sobre la tabla cliente de la base
de datos banco.
• Para realizar el listado bastará un SELECT, tal y como se ha visto en los ejemplos.
• El alta se realizará mediante un formulario donde se especificarán todos los campos del nuevo registro. Luego
esos datos se enviarán a una página que ejecutará INSERT.
• Para realizar una baja, se mostrará un botón que ejecutará DELETE.
• La modificación se realiza mediante UPDATE. -->

    <h2>
        Base de datos <u>banco</u><br>
        Tabla <u>cliente</u><br>
    </h2>
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
    <table border="1">
        <tr>
            <td><b>DNI</b></td>
            <td><b>Nombre</b></td>
            <td><b>Dirección</b></td>
            <td><b>Teléfono</b></td>
        </tr>
        <?php
        while ($cliente = $consulta->fetchObject()) {
        ?>
            <tr>
                <td><?= $cliente->dni ?></td>
                <td><?= $cliente->nombre ?></td>
                <td><?= $cliente->direccion ?></td>
                <td><?= $cliente->telefono ?></td>
                <td>
                    <form action="eliminar.php" method="post">
                        <input type="submit" name="btnEliminar" value="Eliminar">
                        <input type="hidden" name="dniSeleccionado" value="<?php echo $cliente->dni ?>">
                    </form>
                </td>
                <td>
                    <form action="actualizar.php" method="post">
                        <input type="submit" name="btnModificar" value="Modificar">
                        <input type="hidden" name="dniSeleccionado" value="<?php echo $cliente->dni ?>">
                    </form>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>

    <form action="insertar.php" method="post">
        <input type="submit" name="btnAñadir" value="Añadir">
    </form>
    <br>
    Número de clientes: <?= $consulta->rowCount() ?>
    <?php $conexion = null; ?> //cerramos la conexión a la BD
</body>

</html>