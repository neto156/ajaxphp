<?php

    $conexion;

    try {
        $conexion = new PDO('mysql:host=localhost;dbname=practica_ajax', 'root', '');
        // echo "Conexion exitosa";

        $query = "SELECT * FROM clientes";

        $statmen = $conexion->prepare($query);
        $statmen->execute();
        $result = $statmen->fetchAll();
        if (!$result) {
            die('Query Error' . mysqli_error($conexion));
        }
    
        $json = array();
        foreach ($result as $row) {
            $json[] = array(
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'apellido_paterno' => $row['apellido_paterno'],
                'apellido_materno' => $row['apellido_materno'],
                'domicilio' => $row['domicilio'],
                'correo' => $row['correo'],
            );
        }

        $jsonstring = json_encode($json);

        echo $jsonstring;

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

?>