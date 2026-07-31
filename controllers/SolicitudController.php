<?php
require_once 'models/Solicitud.php';

class SolicitudController
{
    // procesar el envio de una nueva solicitud de adopcion
    public function enviarPost()
    {
        // verificar que el usuario este logueado
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login&error=auth_requerida");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once 'models/Usuario.php';
            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->getById($_SESSION['usuario_id']);

            $solicitudModel = new Solicitud();

            $nombre_adoptante = trim(($usuario['nombre'] ?? '') . ' ' . ($usuario['apellido'] ?? ''));
            if (empty($nombre_adoptante)) {
                $nombre_adoptante = "Adoptante";
            }

            $datos = [
                'mascota_id' => $_POST['mascota_id'],
                'nombre_adoptante' => $nombre_adoptante,
                'correo_adoptante' => $usuario['correo'] ?? 'sin-correo@example.com',
                'mensaje' => $_POST['mensaje'] ?? ''
            ];

            if ($solicitudModel->create($datos)) {
                // redirigir de vuelta a la mascota con un mensaje de exito
                header("Location: index.php?action=mascota&id=" . $datos['mascota_id'] . "&success=solicitud_enviada");
                exit();
            } else {
                header("Location: index.php?action=mascota&id=" . $datos['mascota_id'] . "&error=1");
                exit();
            }
        }
    }

    // actualizar el estado de una solicitud desde el panel de rescatista
    public function actualizarEstado()
    {
        // solo rescatistas
        if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] != 2) {
            header("Location: index.php?action=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['solicitud_id']) && isset($_POST['estado'])) {
            $solicitud_id = $_POST['solicitud_id'];
            $estado = $_POST['estado'];
            // validar que el estado sea correcto
            if (!in_array($estado, ['Aprobada', 'Rechazada'])) {
                header("Location: index.php?action=rescatista&error=estado_invalido");
                exit();
            }

            $solicitudModel = new Solicitud();

            //veridicacion de usuario
            if ($solicitudModel->updateEstado($solicitud_id, $estado, $_SESSION['usuario_id'])) {
                //logica de aprobacion
                if ($estado === 'Aprobada') {
                    $solicitud = $solicitudModel->getById($solicitud_id);
                    if ($solicitud) {
                        require_once 'models/Mascota.php';
                        $mascotaModel = new Mascota();
                        //pasar mascota a adoptada
                        $mascotaModel->cambiarEstado($solicitud['mascota_id'], 'Adoptado');
                        //rechazar a los demas
                        $solicitudModel->rechazarOtrasSolicitudes($solicitud['mascota_id'], $solicitud_id);
                    }
                }

                //redirigir al rescatista con mensaje de exito
                header("Location: index.php?action=rescatista&tab=solicitudes&success=estado_actualizado");
                exit();
            } else {
                header("Location: index.php?action=rescatista&tab=solicitudes&error=actualizacion_fallida");
                exit();
            }
        } else {
            header("Location: index.php?action=rescatista");
            exit();
        }
    }
}
?>