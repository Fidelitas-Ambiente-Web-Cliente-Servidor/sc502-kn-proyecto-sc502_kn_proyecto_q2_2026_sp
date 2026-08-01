<?php
require_once 'models/Usuario.php';
require_once 'models/Mascota.php';
require_once 'models/Solicitud.php';

class AdminController
{
    public function __construct()
    {
        //proteccion a que lo vea solo el admin
        if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['usuario_rol']) || $_SESSION['usuario_rol'] != 1) {
            header("Location: index.php?action=index");
            exit();
        }
    }

    //dashboard admin
    public function dashboard()
    {
        $mascotaModel = new Mascota();
        $usuarioModel = new Usuario();
        $solicitudModel = new Solicitud();

        //estadisticas globales
        $totalMascotas = $mascotaModel->countTotal();
        $mascotasAdoptadas = $mascotaModel->countAdoptadas();
        $totalUsuarios = count($usuarioModel->getAll());
        $solicitudesPendientes = $solicitudModel->countPendientes();

        $page_title = "Panel de Administrador - Dashboard";
        require 'views/admin/dashboard.php';
    }

    //mostrar lista de usuarios
    public function usuarios()
    {
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->getAll();

        $page_title = "Panel de Administrador - Usuarios";
        require 'views/admin/usuarios.php';
    }

    //activar o desactivar usuario
    public function toggleUsuario()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //el admin no puede desactivarse, po aquellos de errores
            if ($id != $_SESSION['usuario_id']) {
                $usuarioModel = new Usuario();
                $usuarioModel->toggleEstado($id);
            }
        }
        header("Location: index.php?action=admin_usuarios");
        exit();
    }

    //cambiar rol de un usuario
    public function cambiarRol()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario_id']) && isset($_POST['nuevo_rol'])) {
            $id = $_POST['usuario_id'];
            $nuevoRol = $_POST['nuevo_rol'];

            // protegerse de que el admin se quite el rol a si mismo
            if ($id != $_SESSION['usuario_id']) {
                $usuarioModel = new Usuario();
                $usuarioModel->cambiarRol($id, $nuevoRol);
            }
        }
        header("Location: index.php?action=admin_usuarios");
        exit();
    }

    //mostrar lista completa de mascotas
    public function mascotas()
    {
        $mascotaModel = new Mascota();
        $mascotas = $mascotaModel->getAllAdmin();

        $page_title = "Panel de Administrador - Mascotas";
        require 'views/admin/mascotas.php';
    }
}
?>