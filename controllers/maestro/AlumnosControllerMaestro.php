<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/controllers/admin/AlumnosController.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Calificacion.php";

class AlumnosControllerMaestro extends AlumnosController
{
    public function __construct()
    {
        $calificacionesModel = new Calificacion();
        $calificacionesModel->setTable('calificaciones');
    }

    public function index()
    {
        $calificacionesModel = new Calificacion();
        $calificaciones = $calificacionesModel->customQuery("SELECT * FROM calificaciones");
        $data['calificaciones'] = [];

        foreach ($calificaciones as $calificacion) {
            $item = [];
            $item['calificacion'] = $calificacion;
            $item['clase'] = $calificacionesModel->getClaseById($calificacion['id_clase']);
            $item['estudiante'] = $calificacionesModel->getEstudianteById($calificacion['id_estudiante']);
            $item['msg'] = isset($calificacion['msg']) ? $calificacionesModel->getmsgById($calificacion['msg']) : null;
            $data['calificaciones'][] = $item;
        }
        foreach ($data['calificaciones'] as $item) {
            $calificacion = $item['calificacion'];
            $clase = $item['clase'];
            $estudiante = $item['estudiante'];
            $msg = $item['msg'];
        }

        $calificacionesModel->loadView($data);
    }

}