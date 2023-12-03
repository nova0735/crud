<?php

//Modelando tabla usuarios

class Usuarios extends ModeloGenerico{
    protected $userId;
    protected $roleId;
    protected $user_name;
    protected $pass;
    protected $firstName;
    protected $lastName;
    protected $stat;
    protected $createUser;
    protected $createDate;
    protected $modifiedUser;
    protected $modifiedDate;

    public function __construct($propiedades = null){
        //herencia
        //nombre de la tabla, nombre de la clase, propiedades
        parent::__construct("users", Usuarios::class, $propiedades);
    }

    //Getters y setters
    public function getUserId(){
        return $this->userId;
    }

    public function getRoleId(){
        return $this->roleId;
    }

    public function setRoleId($roleId){
        $this->roleId = $roleId;
    }

    public function getPass(){
        return $this->pass;
    }

    public function setPass($pass){
        $this->pass = $pass;
    }

    public function getUser_name(){
        return $this->user_name;
    }

    public function setUser_name($user_name){
        $this->user_name = $user_name;
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function setLastName($lastName){
        $this->lastName = $lastName;
    }

    public function getStat(){
        return $this->stat;
    }

    public function setStat($stat){
        $this->stat = $stat;
    }

    public function getCreateUser(){
        return $this->createUser;
    }

    public function setCreateUser($createUser){
        $this->createUser = $createUser;
    }

    public function getCreateDate(){
        return $this->createDate;
    }

    public function setCreateDate($createDate){
        $this->createDate = $createDate;
    }

    public function getModifiedUser(){
        return $this->modifiedUser;
    }

    public function setModifiedUser($modifiedUser){
        $this->modifiedUser = $modifiedUser;
    }

    public function getModifiedDate(){
        return $this->modifiedDate;
    }

    public function setModifiedDate($modifiedDate){
        $this->modifiedDate = $modifiedDate;
    }

    //Métodos de la clase
}