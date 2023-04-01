<?php
	
    require_once "conexion.php";

    // recibir datos formulario
    $datos = $_POST['info'];

    // convertir a array
    $array = explode(",", $datos);

    // separar referencias(checkbox) en nuevo array
    $arrayReferencia = array_slice($array, 7);
    // convertir a string
    $referencias = implode(",", $arrayReferencia);


    $formulario = new Formulario(); 

    $mensaje = "";
    $existe = false;
    $ruts = $formulario->obtenerRuts();

    // comprobar si el rut ya esta registrado
    foreach($ruts as $key => $value){
        if($array[2]==$value['rut']){
            $existe = true;
            exit;
        }
    }

    // cargar datos en la base de datos, solo si el rut no esta registrado
    if(!$existe){
        $formulario->guardarFormulario($array[0], $array[1], $array[2], $array[3], $referencias, $array[4], $array[5], $array[6]);   

        $mensaje = "Formulario ingresado!";       
    }
    
    echo $mensaje;
    
 ?>