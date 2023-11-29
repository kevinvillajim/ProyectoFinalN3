<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/controllers/maestro/AlumnosControllerMaestro.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Calificacion.php";

class ClasesControllerAlumno extends AlumnosControllerMaestro
{
    public function index()
    {
        require $_SERVER["DOCUMENT_ROOT"] . "/views/alumno/clases-alumno.php";
    }

    // public function __construct()
    // {
    //     $this->model = new Calificacion();
    //     $this->model->setTable('inscripciones');
    // }

    // public function index()
    // {
    //     $calificaciones = $this->model->customQuery("SELECT * FROM clases");

    //     $data['calificaciones'] = [];

    //     foreach ($calificaciones as $calificacion) {
    //         $item = [];
    //         $item['calificacion'] = $calificacion;
    //         $item['clase'] = $this->model->getClaseById($calificacion['id_clase']);
    //         $item['estudiante'] = $this->model->getEstudianteById($calificacion['id_estudiante']);
    //         $item['msg'] = isset($calificacion['msg']) ? $this->model->getmsgById($calificacion['msg']) : null;
    //         $item['msg_count'] = $this->model->getMsgCountById($calificacion['id_estudiante']);
    //         $data['calificaciones'][] = $item;
    //     }

    //     $this->model->loadViewAlumno($data);
    // }
}