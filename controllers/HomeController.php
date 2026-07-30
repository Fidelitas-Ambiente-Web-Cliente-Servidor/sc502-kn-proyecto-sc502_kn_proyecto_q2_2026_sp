<?php
require_once 'models/Mascota.php';

class HomeController
{
    public function index()
    {
        // mascotas destacadas para el inicio
        $mascotaModel = new Mascota();
        $mascotas = $mascotaModel->getAll();
        // 3 mascotas para la vista de inicio
        $mascotas = array_slice($mascotas, 0, 3);

        require_once 'views/index.php';
    }
}
?>