<?php

class ModeloGenerico extends CRUD{
    private $className;
    //Atributos que no se van a insertar en la base de datos
    private $excluir = ["className","tabla","conexion","wheres","sql","excluir"];

    public function __construct($tabla, $className, $propiedades = null){
        parent::__construct($tabla);
        $this->className = $className;

        if(empty($propiedades)){
            return;
        }

        foreach($propiedades as $llave => $valor){
            $this->{$llaves} = $valor;
        }
    }
    protected function obtenerAtributos(){
        //Obtener los atributos de la clase
        $variables = get_class_vars($this->className);
        $atributos = [];
        $max = count($variables);
        foreach($variables as $llave => $valor){
            //Si la llave no está en el array de atributos excluidos
            if(!in_array($llave, $this->excluir)){
                //Se agrega al array de atributos
                $atributos[] = $llave;
            }
        }
        return $atributos;
    }

    protected function parsear($obj = null){
        try{
            $atributos = $this->obtenerAtributos();
            $objetoFinal = [];
            //Obtener el objeto desde el modelo
            if($obj == null){
                foreach($atributos as $indice => $llave){
                    if(isset($this->{$llave})){
                        $objetoFinal[$llave] = $this->{$llave};
                    }
                }
                return $objetoFinal;
            }
            //Corregir el objeto que recibimos con los atributos del modelo
            foreach($atributos as $indice => $llave){
                if(isset($obj[$llave])){
                    $objetoFinal[$llave] = $obj[$llave];
                }
            }
            return $objetoFinal;
        }catch(Exception $exc){
            throw new Exception("Error en " . $this->className . ".parsear() => " . $ex->getMessage());
        }
    }

    public function fill($obj){
        try{
            $atributos = $this->obtenerAtributos();
            foreach($atributos as $indice => $llave){
                if(isset($obj[$llave])){
                    $this->{$llave} = $obj[$llave];
                }
            }
        }catch(Exception $exc){
            throw new Exception("Error en " . $this->className . ".fill() => " . $ex->getMessage());
        }

    }

    public function insert($obj = null){
        $obj = $this->parsear($obj);
        return parent::insert($obj);
    }

    public function update($obj = null){
        $obj = $this->parsear($obj);
        return parent::update($obj);
    }

    //getter y setter
    public function __get($nombreAtributo){
        return $this->{$nombreAtributo};
    }

    public function __set($nombreAtributo, $valor){
        $this->{$nombreAtributo} = $valor;
    }
}