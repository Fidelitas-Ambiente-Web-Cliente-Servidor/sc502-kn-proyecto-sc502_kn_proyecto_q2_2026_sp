<?php
require_once 'models/Mascota.php';

class MascotaController
{
    public function catalogo()
    {
        $mascotaModel = new Mascota();
        $mascotas = $mascotaModel->getAll();
        $extra_js = "catalogo.js";

        require_once 'views/catalogo.php';
    }

    public function detalle()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $mascotaModel = new Mascota();
            $mascota = $mascotaModel->getById($id);
            $extra_js = "adopcion.js";

            if ($mascota) {
                require_once 'views/mascota.php';
            } else {
                echo "<h1>404 - No se encontro la mascota </h1>";
            }
        } else {
            // si no hay id se devuelve al catalogo
            header("Location: index.php?action=catalogo");
            exit();
        }
    }
}
?>