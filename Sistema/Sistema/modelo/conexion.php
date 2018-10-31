<?php

class Conexion{//La conexion a la base de datos

    public function conectar(){
        $link = new PDO("mysql:host=localhost;dbname=sistema_tutorias", "Edwin123@","Edwin123@");
        return $link;
    }

}