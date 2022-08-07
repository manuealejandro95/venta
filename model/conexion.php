<?php
class Conexion{

    static private $instance = null;
     
    private function __contruct() {}
     
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Conexion();
        }
        return self::$instance;
    }

    public function Conectar(){
        $host = "localhost";
        $user = "root";
        $clave = "";
        $bd = "pruebalogin";
        $conexion = mysqli_connect($host,$user,$clave,$bd);
        if ($conexion->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }else{
            return $conexion;
        }
        
    }
}
