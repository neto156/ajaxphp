<?php

    $id =  isset($_POST['id']) ? $_POST['id'] : 0;
    
    $mensaje = '';
    $exito = false;

    if ($id) {

        echo $id;
        try {
            $conexion = new PDO('mysql:host=localhost;dbname=practica_ajax', 'root', '');
    
            $statmen = $conexion->prepare("DELETE FROM clientes WHERE clientes.id=:id;");
            $statmen->bindParam(':id', $id);
    
            if ($statmen->execute()) {
                $mensaje = 'Se ha eliminado el registro correctmente!';
                $exito = true;
            } else {
                $mensaje = 'Lo sentimos, algo salio mal. Intenta nuevamente';
                die($mensaje);
            }
            echo  $mensaje;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        $mensaje = 'Lo sentimos, algo salio mal. Intenta nuevamente';
    }

?>