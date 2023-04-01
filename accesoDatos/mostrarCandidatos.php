<?php

	require_once "conexion.php";

	$formulario = new Formulario();
    
    // obtener candidatos de la base de datos
    $candidatos = $formulario->obtenerCandidatos();
    
    // definir etiquetas para cargar datos en html
    $select = '<option value="0">Selecionar</option> ';
    $opt ='';

    foreach($candidatos as $key => $candidato){
        $opt=$opt.'<option value="'.$candidato['id_candidato'].'">'.$candidato['nombre_candidato'].'</option>';
    }

    echo $select.$opt;

 ?>