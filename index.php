<?php
session_start();

// accion o vista que el usuario quiere cargar
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// controladores y métodos
$rutas = [
    'index' => ['controller' => 'HomeController', 'method' => 'index'],
    'catalogo' => ['controller' => 'MascotaController', 'method' => 'catalogo'],
    'mascota' => ['controller' => 'MascotaController', 'method' => 'detalle'],
    'login' => ['controller' => 'UsuarioController', 'method' => 'login'],
    'login_post' => ['controller' => 'UsuarioController', 'method' => 'loginPost'],
    'registrarse' => ['controller' => 'UsuarioController', 'method' => 'registrarse'],
    'registro_post' => ['controller' => 'UsuarioController', 'method' => 'registroPost'],
    'logout' => ['controller' => 'UsuarioController', 'method' => 'logout'],
    'rescatista' => ['controller' => 'UsuarioController', 'method' => 'rescatista'],
    'perfil' => ['controller' => 'UsuarioController', 'method' => 'perfil'],
    'perfil_post' => ['controller' => 'UsuarioController', 'method' => 'actualizarPerfil']
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

