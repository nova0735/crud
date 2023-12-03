<?php

require_once './src/Roots.php';
require PATH_SRC . 'autoloader/Autoloader.php';

Autoloader::registrar();

$controladorUsuarios = new ControladorUsuarios();

$data = json_decode(file_get_contents('php://input'), true);

echo "<script>alert('Entró a php');</script>";
// Verificar si se recibió un vector en los datos
if (isset($data['vector']) && is_array($data['vector'])) {

    $primerElemento = $data['vector'][0];
    echo "<script>alert('{$primerElemento}');</script>";
    switch ($primerElemento) {
        case 1:
            //Login
            $respuesta = $controladorUsuarios->listarUsuarios();
            echo "<script>alert('{$respuesta[0]}');</script>";
            $usuario = $data[1];
            $contrasena = $data[2];
            $respuestaVector = array();

            if ($respuesta->codigo === 1 && is_array($respuesta->datos)) {
                // Iterar sobre cada registro en la respuesta
                foreach ($respuesta->datos as $usuarioRegistrado) {
                    if ($usuarioRegistrado->user_name === $usuario && $usuarioRegistrado->pass === $contrasena) {
                        $respuestaVector['success'] = true;
                        $respuestaVector['stat'] = $usuarioRegistrado->stat;
                        $respuestaVector['roleId'] = $usuarioRegistrado->roleId;
                        break;
                    }
                }
            }
            if (!isset($respuestaVector['success'])) {
                $respuestaVector['success'] = false;
            }
            echo json_encode($respuestaVector);
            break;
        case 2:
            
            break;
        case 3.14:
            $respuesta = 'El primer elemento es 3.14. Realizar acción 3.';
            break;
        default:
            $respuesta = 'El primer elemento no coincide con ninguna acción conocida.';
            break;
    }
    echo json_encode(['respuesta' => $respuesta]);
} else {
    echo json_encode(['error' => 'No se recibió un vector válido.']);
}

/*
Buscar Usuario por ID

 $controladorUsuarios = new ControladorUsuarios();

$respuesta = $controladorUsuarios->buscarUsuarioPorId(6);
echo "<pre>";
var_dump($respuesta);
echo "<pre/>";

*/

/*
Listar Usuarios

$controladorUsuarios = new ControladorUsuarios();
$respuesta = $controladorUsuarios->listarUsuarios();
var_dump($respuesta);

 */

/*
Eliminar Usuario

$controladorUsuarios = new ControladorUsuarios();

$respuesta = $controladorUsuarios->eliminarUsuario(7);
echo "<pre>";
var_dump($respuesta);
echo "<pre/>";
$respuesta = $controladorUsuarios->listarUsuarios();
var_dump($respuesta);

 */

/*
Insertar un usuario

$controladorUsuarios = new ControladorUsuarios();
$respuesta = $controladorUsuarios->insertarUsuario(
    [
        "roleId" => 2,
        "user_name" => "Armando99",
        "firstName" => "Armando",
        "lastName" => "Soto",
        "stat" => "Usuario",
        "createUser" => "Admin",
        "createDate" => date("Y-m-d H:i:s")
    ]

);*/


/*
Modificar un usuario

$controladorUsuarios = new ControladorUsuarios();
$usuario = [
    //iDUsuario es la llave de la función / Agrego los atributos a cambiar
    "idUsuario" => 6,
    "stat" => "1"
];
$respuesta = $controladorUsuarios->actualizarUsuario($usuario);
echo "<pre>";
var_dump($respuesta);
echo "<pre/>";
$respuesta = $controladorUsuarios->listarUsuarios();
var_dump($respuesta);
*/

