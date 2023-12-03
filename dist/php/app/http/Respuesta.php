<?php

class Respuesta{
    public $codigo;
    public $mensaje;
    public $datos;

    function __construct($codigo = null, $mensaje = null, $datos = null){
        //Obtener la respuesta por código
        if(isset($codigo) && empty($mensaje)){
            $respuesta = EMensajes::getMensaje($codigo);
            $this->codigo = $respuesta->codigo;
            $this->mensaje = $respuesta->mensaje;
            $this->datos = $respuesta->datos;
            return;
        }

        //Comprobando código / Evaluando si es String
        if(is_string($codigo)){
            $temp = EMensajes::getMensaje($codigo);
            $codigo = $temp->codigo;
        }

        $this->codigo = $codigo;
        $this->mensaje = $mensaje;
        $this->datos = $datos;
    }

    public function json($obj =null){
        header('Content-Type: application/json');
        if(is_array($obj) || is_object($obj)){
            return json_encode($obj);
            //Devolviendo arreglo con código, mensaje y datos
        }
        return json_encode($this);
    }

    //Getters y Setters
    public function getCodigo(){
        return $this->codigo;
    }

    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    public function getMensaje(){
        return $this->mensaje;
    }

    public function setMensaje($mensaje){
        $this->mensaje = $mensaje;
    }

    public function getDatos(){
        return $this->datos;
    }

    public function setDatos($datos){
        $this->datos = $datos;
    }

}