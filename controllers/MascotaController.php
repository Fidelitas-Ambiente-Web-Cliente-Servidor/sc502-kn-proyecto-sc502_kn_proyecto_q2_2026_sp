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

    // solo rescatistas pueden gestionar mascotas
    private function verificarRescatista()
    {
        if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] != 2) {
            header("Location: index.php?action=login");
            exit();
        }
    }

    //get
    public function crearForm()
    {
        $this->verificarRescatista();
        $mascotaModel = new Mascota();
        $especies = $mascotaModel->getEspecies();
        $razas = $mascotaModel->getRazas();
        $tamanos = $mascotaModel->getTamanos();
        $energias = $mascotaModel->getEnergias();

        $accion_form = "mascota_crear_post";
        $mascota = null; // para saber que es creacion

        $extra_js = "rescatista.js";
        require_once 'views/mascota_form.php';
    }

    //post crear
    public function crearPost()
    {
        $this->verificarRescatista();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mascotaModel = new Mascota();

            $datos = [
                'usuario_id' => $_SESSION['usuario_id'],
                'especie_id' => $_POST['especie_id'],
                'raza_id' => $_POST['raza_id'],
                'tamano_id' => $_POST['tamano_id'],
                'energia_id' => $_POST['energia_id'],
                'nombre' => $_POST['nombre'],
                'edad' => $_POST['edad'],
                'historia' => $_POST['historia'],
                'foto_path' => $_POST['foto_path'], // usamos url
                'estado' => $_POST['estado']
            ];
            //si se crea redirige al rescatista
            if ($mascotaModel->create($datos)) {
                header("Location: index.php?action=rescatista&success=1");
                exit();
            } else { //sino devuelve error
                header("Location: index.php?action=mascota_crear&error=1");
                exit();
            }
        }
    }

    //editar
    public function editarForm()
    {
        $this->verificarRescatista();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $mascotaModel = new Mascota();
            $mascota = $mascotaModel->getById($id);
            // validar que la mascota le pertenezca
            if ($mascota && $mascota['usuario_id'] == $_SESSION['usuario_id']) {
                $especies = $mascotaModel->getEspecies();
                $razas = $mascotaModel->getRazas();
                $tamanos = $mascotaModel->getTamanos();
                $energias = $mascotaModel->getEnergias();

                $accion_form = "mascota_editar_post&id=" . $id;

                $extra_js = "rescatista.js";
                require_once 'views/mascota_form.php';
            } else {
                header("Location: index.php?action=rescatista&error=acceso_denegado");
                exit();
            }
        } else {
            header("Location: index.php?action=rescatista");
            exit();
        }
    }
    //post
    public function editarPost()
    {
        $this->verificarRescatista();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $mascotaModel = new Mascota();

            $datos = [
                'usuario_id' => $_SESSION['usuario_id'], //por seguridad
                'especie_id' => $_POST['especie_id'],
                'raza_id' => $_POST['raza_id'],
                'tamano_id' => $_POST['tamano_id'],
                'energia_id' => $_POST['energia_id'],
                'nombre' => $_POST['nombre'],
                'edad' => $_POST['edad'],
                'historia' => $_POST['historia'],
                'foto_path' => $_POST['foto_path'], //url
                'estado' => $_POST['estado']
            ];

            if ($mascotaModel->update($id, $datos)) {
                header("Location: index.php?action=rescatista&success=1");
                exit();
            } else {
                header("Location: index.php?action=mascota_editar&id=" . $id . "&error=1");
                exit();
            }
        }
    }

    public function eliminar()
    {
        $this->verificarRescatista();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $mascotaModel = new Mascota();

            // borrar de bd, pasando usuario_id como verificacion
            if ($mascotaModel->delete($id, $_SESSION['usuario_id'])) {
                header("Location: index.php?action=rescatista&success=eliminado");
            } else {
                header("Location: index.php?action=rescatista&error=1");
            }
            exit();
        }
    }
}
?>