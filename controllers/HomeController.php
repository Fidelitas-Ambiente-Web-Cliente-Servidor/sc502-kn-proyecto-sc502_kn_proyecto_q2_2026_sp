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

    //endpoint ajax retorna listado de mascotas en formato json para filtrado en tiempo real
    public function apiMascotasFiltradas()
    {
        header('Content-Type: application/json; charset=utf-8');
        $mascotaModel = new Mascota();
        $mascotas = $mascotaModel->getAll();

        //obtiene los parametros enviados desde el front
        $busqueda = isset($_GET['busqueda']) ? mb_strtolower(trim($_GET['busqueda'])) : '';
        $especies = isset($_GET['especies']) ? explode(',', $_GET['especies']) : [];
        $estados = isset($_GET['estados']) ? explode(',', $_GET['estados']) : [];
        //filtra los parametros
        $especies = array_filter($especies);
        $estados = array_filter($estados);
        //crea un array con el resultado del filtrado
        $resultado = [];
        //filtra las mascotas segun los parametros
        foreach ($mascotas as $m) {
            $texto = mb_strtolower($m['nombre'] . ' ' . ($m['nombre_raza'] ?? '') . ' ' . ($m['tamano'] ?? '') . ' ' . ($m['energia'] ?? ''));
            $cumpleBusqueda = empty($busqueda) || strpos($texto, $busqueda) !== false;
            $cumpleEspecie = empty($especies) || in_array((string) $m['especie_id'], $especies) || in_array(mb_strtolower($m['nombre_especie'] ?? ''), array_map('mb_strtolower', $especies));
            $cumpleEstado = empty($estados) || in_array($m['estado'], $estados);
            //si cumple con todos los filtros, se agrega al resultado
            if ($cumpleBusqueda && $cumpleEspecie && $cumpleEstado) {
                $resultado[] = $m;
            }
        }
        //convierte el array de resultados a json y lo devuelve
        echo json_encode(array_values($resultado));
        exit();
    }
}
?>