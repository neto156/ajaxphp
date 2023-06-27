<?php

    $nombre =  isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellido_paterno =  isset($_POST['apellido_paterno']) ? $_POST['apellido_paterno'] : '';
    $apellido_materno =  isset($_POST['apellido_materno']) ? $_POST['apellido_materno'] : '';
    $domicilio =  isset($_POST['domicilio']) ? $_POST['domicilio'] : '';
    $correo =  isset($_POST['correo']) ? $_POST['correo'] : '';


    $mensaje = '';
    $exito = false;

    $conexion;

    try {
        $conexion = new PDO('mysql:host=localhost;dbname=practica_ajax', 'root', '');
        // $resultados = $conexion->query("INSERT INTO empleados VALUES (null, $numero, $nombre, $apellidos, $ingreso, $telefono)");

        $statmen = $conexion->prepare("INSERT INTO clientes(nombre, apellido_paterno, apellido_materno, domicilio, correo) VALUES (:nombre, :apellido_paterno, :apellido_materno, :domicilio, :correo)");
        $statmen->bindParam(':nombre', $nombre);
        $statmen->bindParam(':apellido_paterno', $apellido_paterno);
        $statmen->bindParam(':apellido_materno', $apellido_materno);
        $statmen->bindParam(':domicilio', $domicilio);
        $statmen->bindParam(':correo', $correo);

        if ($statmen->execute()) {
            $mensaje = 'Empleado creado correctmente!';
            $exito = true;
        } else {
            $mensaje = 'Lo sentimos, algo salio mal. Intenta nuevamente';
            die($mensaje);
        }
        echo  $mensaje;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

?>