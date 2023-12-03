<?php

class Conexion{
    private $conexion;
    private $configuracion = [
        "driver" => "mysql",
        "host" => "localhost",
        "database" => "db_e2",
        "port" => "3306",
        "username" => "root",
        "password" => "",
        "charset" => "utf8mb4"
    ];
    public function __construct(){

    }

    public function conectar(){
        //Conexión a la base de datos
        try{
            $CONTROLADOR = $this->configuracion["driver"];
            $SERVIDOR = $this->configuracion["host"];
            $BASEDATOS = $this->configuracion["database"];
            $PUERTO = $this->configuracion["port"];
            $USUARIO = $this->configuracion["username"];
            $CLAVE = $this->configuracion["password"];
            $CODIFICACION = $this->configuracion["charset"];

            $url = "{$CONTROLADOR}:host={$SERVIDOR};port={$PUERTO};dbname={$BASEDATOS};charset={$CODIFICACION}";
            $this->conexion = new PDO($url, $USUARIO, $CLAVE);

            return $this->conexion;
        }catch(Exception $exc){
            echo "Error: No se pudo conectar a la base de datos";
            echo $exc->getTraceAsString();
        }
    }
}