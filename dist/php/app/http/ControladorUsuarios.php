<?php

class ControladorUsuarios{
    function __construct(){

    }

    public function insertarUsuario($usuario){
        $usuarioModel = new Usuarios();
        $id = $usuarioModel->insert($usuario);
        $insersionExitosa = ($id>0);
        $respuesta = new Respuesta($insercionExistosa ? EMensajes::INSERCION_EXITOSA : EMensajes::ERROR);
        $respuesta->setDatos($id);
    }

    public function listarUsuarios(){
        $usuarioModel = new Usuarios();
        $lista = $usuarioModel->get();
        $busqueda = (count($lista)>0);
        $respuesta = new Respuesta($busqueda ? EMensajes::CORRECTO : EMensajes::ERROR);
        $respuesta->setDatos($lista);
        return $respuesta;
    }

    public function actualizarUsuario($usuario){
        $usuarioModel = new Usuarios();
        $actualizados = $usuarioModel->where("userId", "=", $usuario["idUsuario"])->update($usuario);
        $actualizar = ($actualizados>0);
        $respuesta = new Respuesta($actualizar ? EMensajes::ACTUALIZACION_EXITOSA : EMensajes::ERROR_ACTUALIZACION);
        $respuesta->setDatos($actualizados);
    }
    
    public function eliminarUsuario($idUsuario){
        $usuarioModel = new Usuarios();
        $eliminados = $usuarioModel->where("userId", "=", $idUsuario)->delete();
        $elimiar = ($eliminados>0);
        $respuesta = new Respuesta($eliminar ? EMensajes::ELIMINACION_EXITOSA : EMensajes::ERROR_ELIMINACION);
        $respuesta->setDatos($eliminados);
    }

    public function buscarUsuarioPorId($idUsuario){
        $usuarioModel = new Usuarios();
        //Get me devuelve un array de objetos
        $usuario = $usuarioModel->where("userId", "=", $idUsuario)->first();
        $busqueda = ($usuario!=null);
        $respuesta = new Respuesta($busqueda ? EMensajes::CORRECTO : EMensajes::ERROR);
        $respuesta->setDatos($usuario);
    }
}