<?php

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $conexion;

        try {
            $conexion = new PDO('mysql:host=localhost;dbname=practica_ajax', 'root', '');
            // echo "Conexion exitosa";

            $statmen = $conexion->prepare("SELECT * FROM clientes WHERE clientes.id=:id;");
            $statmen->bindParam(':id', $id);
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

            $jsonstring = json_encode($json[0]);

            echo $jsonstring;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }


    }

?>