<?php
require_once 'models/Mascota.php';
require_once 'models/Raza.php';

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

    // solo rescatistas y administradores pueden gestionar mascotas
    private function verificarRescatista()
    {
        if (!isset($_SESSION['usuario_id']) || !in_array($_SESSION['usuario_rol'], [1, 2])) {
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
            //si se crea redirige al rescatista o admin
            if ($mascotaModel->create($datos)) {
                $redirect = ($_SESSION['usuario_rol'] == 1) ? "admin_mascotas" : "rescatista";
                header("Location: index.php?action=$redirect&success=1");
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
            // validar que la mascota le pertenezca o sea admin
            if ($mascota && ($mascota['usuario_id'] == $_SESSION['usuario_id'] || $_SESSION['usuario_rol'] == 1)) {
                $especies = $mascotaModel->getEspecies();
                $razas = $mascotaModel->getRazas();
                $tamanos = $mascotaModel->getTamanos();
                $energias = $mascotaModel->getEnergias();

                $accion_form = "mascota_editar_post&id=" . $id;

                $extra_js = "rescatista.js";
                require_once 'views/mascota_form.php';
            } else {
                $redirect = ($_SESSION['usuario_rol'] == 1) ? "admin_mascotas" : "rescatista";
                header("Location: index.php?action=$redirect&error=acceso_denegado");
                exit();
            }
        } else {
            $redirect = ($_SESSION['usuario_rol'] == 1) ? "admin_mascotas" : "rescatista";
            header("Location: index.php?action=$redirect");
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

            // en update se mantiene al propietario original si es admin editando otra mascota
            $datos = [
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
                $redirect = ($_SESSION['usuario_rol'] == 1) ? "admin_mascotas" : "rescatista";
                header("Location: index.php?action=$redirect&success=1");
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

            // borrar de bd, si es admin pasa null para saltar verificacion de usuario
            $usuario_id = ($_SESSION['usuario_rol'] == 1) ? null : $_SESSION['usuario_id'];

            if ($mascotaModel->delete($id, $usuario_id)) {
                $redirect = ($_SESSION['usuario_rol'] == 1) ? "admin_mascotas" : "rescatista";
                header("Location: index.php?action=$redirect&success=eliminado");
            } else {
                $redirect = ($_SESSION['usuario_rol'] == 1) ? "admin_mascotas" : "rescatista";
                header("Location: index.php?action=$redirect&error=1");
            }
            exit();
        }
    }

    //endpoint ajax retorna razas de una especie en formato json
    public function apiRazasPorEspecie()
    {
        //define el encabezado para enviar datos en formato json
        header('Content-Type: application/json; charset=utf-8');
        //obtiene el id de la especie enviada desde el front
        $especie_id = isset($_GET['especie_id']) ? intval($_GET['especie_id']) : 0;
        //crea instancia del modelo
        $razaModel = new Raza();
        //obtiene las razas de la especie
        $razas = $razaModel->getByEspecie($especie_id);
        //convierte el array de razas a json y lo devuelve
        echo json_encode($razas);
        exit();
    }
}
?>