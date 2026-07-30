<?php
require_once 'models/Usuario.php';

class UsuarioController
{
    public function login()
    {
        // si esta logueado, redirigir al panel
        if (isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=rescatista");
            exit();
        }
        require_once 'views/login.php';
    }

    //esta funcion recibe los datos del formulario de login y verifica si el usuario existe
    public function loginPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];

            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->getByCorreo($correo);

            // verificar si el usuario existe y la contraseña coincide
            if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['usuario_rol'] = $usuario['rol_id'];
                // redirigir al panel
                header("Location: index.php?action=rescatista");
                exit();
            } else {
                header("Location: index.php?action=login&error=1");
                exit();
            }
        }
    }

    //mostrar formulario de registro
    public function registrarse()
    {
        // si esta logueado, redirigir al panel
        if (isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=rescatista");
            exit();
        }
        require_once 'views/registrarse.php';
    }

    //esta funcion recibe los datos del formulario de registro y crea un nuevo usuario
    public function registroPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuarioModel = new Usuario();

            $datos = [
                'rol_id' => 2, // rol de rescatista por defecto en la db
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'correo' => $_POST['correo'],
                'contrasena' => password_hash($_POST['contrasena'], PASSWORD_BCRYPT),
                'telefono' => $_POST['telefono']
            ];

            if ($usuarioModel->create($datos)) {
                header("Location: index.php?action=login&success=1");
                exit();
            } else {
                header("Location: index.php?action=registrarse&error=1");
                exit();
            }
        }
    }

    //logout base
    public function logout()
    {
        session_destroy();
        header("Location: index.php");
        exit();
    }

    //proteccion del seccionado, solo el usuario que esta logueado
    public function rescatista()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit();
        }
        require_once 'views/rescatista.php';
    }
}
?>