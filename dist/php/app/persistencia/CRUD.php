<?php

class CRUD{

    protected $tabla;
    protected $conexion;
    protected $wheres = "";
    protected $sql = null;

    public function __construct($tabla = null){
        $this->conexion = (new Conexion())->conectar();
        $this->tabla = $tabla;
    }

    //Creando métodos para el CRUD
    public function get(){
        try{
            $this->sql = "SELECT * FROM {$this->tabla} {$this->wheres}";
            $sth = $this->conexion->prepare($this->sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_OBJ);

        }catch(Exception $exc){
            echo $exc->getTraceAsString();
        }
    }

    public function first(){
        $lista = $this->get();
        if(count($lista) > 0){
            return $lista[0];
        }else{
            return null;
        }
    }
    
    public function insert($obj){
        //Recibo un objeto
        try{
            //El implode me permite unir los campos de un array
            $campos = implode("`, `", array_keys($obj));//nombre`, `apellido`, `edad
            $valores = ":" . implode(", :", array_keys($obj)); //:nombre, :apellido, :edad
            $this->sql = "INSERT INTO {$this->tabla} (`{$campos}`) VALUES ({$valores})";
            $this->ejecutar($obj);
            $id = $this->conexion->lastInsertId();
            return $id;
        }catch(Exception $exc){
            echo $exc->getTraceAsString();
        }
    }

    public function update($obj){
        try{
            $campos = "";
            foreach($obj as $llave => $valor){
                $campos .= "`$llave`=:$llave,";
            }
            $campos = rtrim($campos, ",");
            $this->sql = "UPDATE {$this->tabla} SET {$campos} {$this->wheres}";
            $filasAfectadas = $this->ejecutar($obj);
            return $filasAfectadas;
        }catch(Exception $exc){
            echo $exc->getTraceAsString();
        }
    }

    public function delete(){
        try{
            $this->sql = "DELETE FROM {$this->tabla} {$this->wheres}";
            $filasAfectadas = $this->ejecutar();
            return $filasAfectadas;
        }catch(Exception $exc){
            echo $exc->getTraceAsString();
        }
    }
    
    //Campo de la base de datos, condición y valor
    public function where($llave, $condicion, $valor){
        $this->wheres .= (strpos($this->wheres, "WHERE")) ? " AND " : " WHERE ";
        $this->wheres .= "`$llave` $condicion ".((is_string($valor)) ? "\"$valor\"" : $valor) . " ";
        return $this;
    }

    public function orWhere($llave, $condicion, $valor){
        $this->wheres .= (strpos($this->wheres, "WHERE")) ? " OR " : " WHERE ";
        $this->wheres .= "`$llave` $condicion ".((is_string($valor)) ? "\"$valor\"" : $valor) . " ";
        return $this;
    }

    private function ejecutar($obj = null){
        $sth = $this->conexion->prepare($this->sql);
        if($obj !== null){
            //Recorrer llaves y valores del objeto
            foreach($obj as $llave => $valor){
                //Comprobando su está indefinido
                if(empty($valor)){
                    $valor = null;
                }
                $sth->bindValue(":$llave", $valor);
            }
        }
        $sth->execute();
        $this->reiniciarValores();
        return $sth->rowCount();
    }

    private function reiniciarValores(){
        $this->wheres = "";
        $this->sql = null;
    }
}
