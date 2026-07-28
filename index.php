<?php
// accion o vista que el usuario quiere cargar
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// evitamos que el usuario acceda a archivos que no existan
$allowed_views = ['index', 'catalogo', 'login', 'mascota', 'registrarse', 'rescatista'];

if (in_array($action, $allowed_views)) {
    //  llamado a los controladores
    include_once "views/{$action}.php";
} else {
    // error 404 
    echo "<h1>404 - pagina no encontrada</h1>";
}


