<?php

    $id =  isset($_POST['id']) ? $_POST['id'] : 0;
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

        $statmen = $conexion->prepare("UPDATE clientes SET nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, domicilio=:domicilio, correo=:correo WHERE clientes.id=:id;");
        $statmen->bindParam(':id', $id);
        $statmen->bindParam(':nombre', $nombre);
        $statmen->bindParam(':apellido_paterno', $apellido_paterno);
        $statmen->bindParam(':apellido_materno', $apellido_materno);
        $statmen->bindParam(':domicilio', $domicilio);
        $statmen->bindParam(':correo', $correo);

        if ($statmen->execute()) {
            $mensaje = 'Datos actualizados correctmente!';
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