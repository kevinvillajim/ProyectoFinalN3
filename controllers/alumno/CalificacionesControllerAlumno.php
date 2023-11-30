<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/controllers/maestro/AlumnosControllerMaestro.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Calificacion.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/config/Database.php";

class CalificacionesControllerAlumno extends AlumnosControllerMaestro
{
    public function __construct()
    {
        $this->model = new Calificacion();
        $this->model->setTable('calificaciones');
    }

    public function index()
    {
        $calificaciones = $this->model->customQuery("SELECT * FROM calificaciones");

        $data['calificaciones'] = [];

        foreach ($calificaciones as $calificacion) {
            $item = [];
            $item['calificacion'] = $calificacion;
            $item['clase'] = $this->model->getClaseById($calificacion['id_clase']);
            $item['estudiante'] = $this->model->getEstudianteById($calificacion['id_estudiante']);
            $item['msg'] = isset($calificacion['msg']) ? $this->model->getmsgById($calificacion['msg']) : null;
            $item['msg_count'] = $this->model->getMsgCountById($calificacion['id_estudiante']);
            $data['calificaciones'][] = $item;
        }

        $this->model->loadViewAlumno($data);
    }
}