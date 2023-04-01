<?php
        
    class Formulario{

        // OBTENER CANDIDATOS DE LA BASE DE DATOS
        function obtenerRuts(){

            $cnx = conexion();

            $st = $cnx->prepare("SELECT rut FROM formulario");
            $st->execute();
            
            return $st->fetchAll();
        }


        // OBTENER CANDIDATOS DE LA BASE DE DATOS
        function obtenerCandidatos(){

            $cnx = conexion();

            $st = $cnx->prepare("SELECT id_candidato, nombre_candidato FROM candidato");
            $st->execute();
            
            return $st->fetchAll();
        }


        // OBTENER REGIONES DE LA BASE DE DATOS
        function obtenerRegiones(){

            $cnx = conexion();

            $st = $cnx->prepare("SELECT id_region, region FROM region");
            $st->execute();
            
            return $st->fetchAll();
        }


        // OBTENER COMUNAS DE LA BASE DE DATOS
        function obtenerComunas($id){

            $cnx = conexion();

            $st = $cnx->prepare("SELECT id_comuna, comuna FROM comuna WHERE region_id=:region");
            $st->bindParam(':region', $id);
            $st->execute();
            
            return $st->fetchAll();
        }


        // GUARDAR FORMULARIO EN LA BASE DE DATOS
        function guardarFormulario($nombre, $alias, $rut, $email, $referencia, $region, $comuna, $candidato){

            $cnx = conexion();

            $st = $cnx->prepare("INSERT INTO formulario (nombre_completo, alias, rut, email, redes_referencia, region_id, comuna_id, candidato_id) VALUES (:nombre, :alias, :rut, :email, :referencia, :region, :comuna, :candidato)");

            $st->bindParam(':nombre', $nombre);
            $st->bindParam(':alias', $alias);
            $st->bindParam(':rut', $rut);
            $st->bindParam(':email', $email);
            $st->bindParam(':referencia', $referencia);
            $st->bindParam(':region', $region);
            $st->bindParam(':comuna', $comuna);
            $st->bindParam(':candidato', $candidato);

            $st->execute();
        }

    }
    

    // CONEXION A LA BASE DE DATOS
    function conexion(){
        $user = 'root';
        $pass = '';

        try{

            $cnx = new PDO('mysql:host=localhost;dbname=sistema_votacion', $user, $pass);
            $cnx->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            return $cnx;

        }catch (PDOException $e){

            return "Error al conectar con la base de datos "+$e->getMessage();
        }

    }

?>