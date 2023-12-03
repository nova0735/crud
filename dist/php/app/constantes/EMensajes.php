<?php

class EMensajes{
    
    const CORRECTO = "CORRECTO";
    const INSERCION_EXITOSA = "INSERCION_EXITOSA";
    const ERROR_INSERCION = "ERROR_INSERCION";
    const ACTUALIZACION_EXITOSA = "ACTUALIZACION_EXITOSA";
    const ERROR_ACTUALIZACION = "ERROR_ACTUALIZACION";
    const ELIMINACION_EXITOSA = "ELIMINACION_EXITOSA";
    const ERROR_ELIMINACION = "ERROR_ELIMINACION";
    const ERROR = "ERROR";

    public static function getMensaje($codigo){
        switch($codigo){
            case EMensajes::CORRECTO:
                return new Respuesta(1, "Se ha realizado la operación exitosamente");
            case EMensajes::INSERCION_EXITOSA:
                return new Respuesta(1, "Se ha insertado el registro exitosamente");
            case EMensajes::ACTUALIZACION_EXITOSA:
                return new Respuesta(1, "Se ha actualizado el registro exitosamente");
            case EMensajes::ELIMINACION_EXITOSA:
                return new Respuesta(1, "Se ha eliminado el registro exitosamente");
            case EMensajes::ERROR:
                return new Respuesta(1, "Ha ocurrido un error");
            case EMensajes::ERROR_INSERCION:
                return new Respuesta(1, "Ha ocurrido un error al insertar el registro");
            case EMensajes::ERROR_ACTUALIZACION:
                return new Respuesta(1, "Ha ocurrido un error al actualizar el registro");
            case EMensajes::ERROR_ELIMINACION:
                return new Respuesta(1, "Ha ocurrido un error al eliminar el registro");
        }   

    }
}