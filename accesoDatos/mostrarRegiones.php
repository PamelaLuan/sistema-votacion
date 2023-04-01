<?php

	require_once "conexion.php";

    $formulario = new Formulario();

    // obtener regiones de la base de datos
    $regiones = $formulario->obtenerRegiones();

    // definir etiquetas para cargar datos en html
    $select = '<option value="0">Selecionar</option> ';
    $opt ='';
    
    foreach($regiones as $key => $region){
        $opt=$opt.'<option value="'.$region['id_region'].'">'.$region['region'].'</option>';
    }

    echo $select.$opt;	

 ?>