<?php
require_once 'models/Usuario.php';

class UsuarioController
{
    public function login()
    {
        // si esta logueado, redirigir segun su rol
        if (isset($_SESSION['usuario_id'])) {
            if ($_SESSION['usuario_rol'] == 2) {
                header("Location: index.php?action=rescatista");
            } else {
                header("Location: index.php?action=catalogo");
            }
            exit();
        }
        $extra_js = "auth.js";
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

                //evitar login si la cuenta esta inactiva
                if (isset($usuario['estado']) && $usuario['estado'] == 'Inactivo') {
                    header("Location: index.php?action=login&error=inactivo");
                    exit();
                }

                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['usuario_rol'] = $usuario['rol_id'];
                // redirigir segun el rol
                if ($usuario['rol_id'] == 2) {
                    header("Location: index.php?action=rescatista");
                } else {
                    header("Location: index.php?action=catalogo");
                }
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
        // si esta logueado, redirigir segun su rol
        if (isset($_SESSION['usuario_id'])) {
            if ($_SESSION['usuario_rol'] == 2) {
                header("Location: index.php?action=rescatista");
            } else {
                header("Location: index.php?action=catalogo");
            }
            exit();
        }
        $extra_js = "auth.js";
        require_once 'views/registrarse.php';
    }

    //esta funcion recibe los datos del formulario de registro y crea un nuevo usuario
    public function registroPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuarioModel = new Usuario();

            $datos = [
                'rol_id' => isset($_POST['rol_id']) ? $_POST['rol_id'] : 3, // dinamico desde form
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
        if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] != 2) {
            header("Location: index.php?action=login");
            exit();
        }

        //trae las mascotas del usuario, si es rescatista
        require_once 'models/Mascota.php';
        $mascotaModel = new Mascota();
        $mascotas = $mascotaModel->getByRescatista($_SESSION['usuario_id']);

        // metricas del rescatista
        $mascotasAdoptadas = $mascotaModel->countByRescatistaAndEstado($_SESSION['usuario_id'], 'Adoptado');
        $mascotasDisponibles = $mascotaModel->countByRescatistaAndEstado($_SESSION['usuario_id'], 'Disponible');

        // trae las solicitudes
        require_once 'models/Solicitud.php';
        $solicitudModel = new Solicitud();
        $solicitudes = $solicitudModel->getByRescatista($_SESSION['usuario_id']);
        $extra_js = "rescatista.js";
        require_once 'views/rescatista.php';
    }

    // vista de perfil
    public function perfil()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit();
        }
        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->getById($_SESSION['usuario_id']);
        //trae las solicitudes del adoptante
        require_once 'models/Solicitud.php';
        $solicitudModel = new Solicitud();
        $solicitudes = $solicitudModel->getByAdoptanteCorreo($usuario['correo']);

        require_once 'views/perfil.php';
    }

    // actualizacion de perfil
    public function actualizarPerfil()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuarioModel = new Usuario();

            $datos = [
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'telefono' => $_POST['telefono']
            ];

            if (!empty($_POST['contrasena'])) {
                $datos['contrasena'] = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
            }

            if ($usuarioModel->update($_SESSION['usuario_id'], $datos)) {
                // update session name
                $_SESSION['usuario_nombre'] = $_POST['nombre'];
                header("Location: index.php?action=perfil&success=1");
                exit();
            } else {
                header("Location: index.php?action=perfil&error=1");
                exit();
            }
        }
    }

    // endpoint ajax si un correo ya esta registrado en la base de datos
    public function apiVerificarCorreo()
    {
        //define el encabezado para enviar datos en formato json
        header('Content-Type: application/json; charset=utf-8');
        //obtiene el correo enviado desde el front
        $correo = isset($_GET['correo']) ? trim($_GET['correo']) : '';
        if (empty($correo)) {
            echo json_encode(['disponible' => false, 'mensaje' => 'correo vacio']);
            exit();
        }
        //crea instancia del modelo
        $usuarioModel = new Usuario();
        $existe = $usuarioModel->getByCorreo($correo);
        //devuelve json si eciste el correo o no
        if ($existe) {
            echo json_encode(['disponible' => false, 'mensaje' => 'este correo ya esta registrado']);
        } else {
            echo json_encode(['disponible' => true, 'mensaje' => 'correo disponible']);
        }
        exit();
    }
}
?>