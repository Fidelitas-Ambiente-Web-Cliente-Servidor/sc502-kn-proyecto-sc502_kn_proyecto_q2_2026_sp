<?php
session_start();

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// controladores y métodos
$rutas = [
    //publicas
    'index' => ['controller' => 'HomeController', 'method' => 'index'],
    //mascotas
    'catalogo' => ['controller' => 'MascotaController', 'method' => 'catalogo'],
    'mascota' => ['controller' => 'MascotaController', 'method' => 'detalle'],
    //usuarios
    'login' => ['controller' => 'UsuarioController', 'method' => 'login'],
    'login_post' => ['controller' => 'UsuarioController', 'method' => 'loginPost'],
    'registrarse' => ['controller' => 'UsuarioController', 'method' => 'registrarse'],
    'registro_post' => ['controller' => 'UsuarioController', 'method' => 'registroPost'],
    'logout' => ['controller' => 'UsuarioController', 'method' => 'logout'],
    //rescatista
    'rescatista' => ['controller' => 'UsuarioController', 'method' => 'rescatista'],
    'perfil' => ['controller' => 'UsuarioController', 'method' => 'perfil'],
    'perfil_post' => ['controller' => 'UsuarioController', 'method' => 'actualizarPerfil'],
    //solicitudes
    'mascota_crear' => ['controller' => 'MascotaController', 'method' => 'crearForm'],
    'mascota_crear_post' => ['controller' => 'MascotaController', 'method' => 'crearPost'],
    'mascota_editar' => ['controller' => 'MascotaController', 'method' => 'editarForm'],
    'mascota_editar_post' => ['controller' => 'MascotaController', 'method' => 'editarPost'],
    'mascota_eliminar' => ['controller' => 'MascotaController', 'method' => 'eliminar'],
    //solicitudes
    'solicitud_enviar_post' => ['controller' => 'SolicitudController', 'method' => 'enviarPost'],
    'solicitud_estado' => ['controller' => 'SolicitudController', 'method' => 'actualizarEstado'],
    //admin
    'admin_dashboard' => ['controller' => 'AdminController', 'method' => 'dashboard'],
    'admin_usuarios' => ['controller' => 'AdminController', 'method' => 'usuarios'],
    'admin_toggle_usuario' => ['controller' => 'AdminController', 'method' => 'toggleUsuario'],
    'admin_cambiar_rol' => ['controller' => 'AdminController', 'method' => 'cambiarRol'],
    'admin_mascotas' => ['controller' => 'AdminController', 'method' => 'mascotas']
];

if (array_key_exists($action, $rutas)) {
    $controllerName = $rutas[$action]['controller'];
    $methodName = $rutas[$action]['method'];

    require_once "controllers/{$controllerName}.php";

    $controller = new $controllerName();
    $controller->$methodName();
} else {
    // error 404 
    echo "<h1>404 - pagina no encontrada</h1>";
}

