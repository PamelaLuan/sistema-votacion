<?php

	require_once "conexion.php";

    // recibir id de la región seleccionada
    $id = $_POST['id'];

	$formulario = new Formulario();

    // obtener comunas, según región, de la base de datos
    $comunas = $formulario->obtenerComunas($id);

    // definir etiquetas para cargar datos en html
    $select = '<option value="0">Selecionar</option> ';
    $opt = '';

    foreach($comunas as $key => $comuna){
        $opt .= '<option value="'.$comuna['id_comuna'].'">'.$comuna['comuna'].'</option>';
  
    }

    echo $select.$opt;

 ?>