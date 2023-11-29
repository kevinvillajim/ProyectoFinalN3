<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Model.php";

class Calificacion extends Model
{
    protected $table = "calificaciones";

    public function getClaseById($id)
    {
        $clase = new Clase();
        $clase->setTable('clases');
        return $clase->customQuery("SELECT * FROM clases WHERE id = $id");
    }

    public function getEstudianteById($id)
    {
        $estudiante = new Clase();
        $estudiante->setTable('usuarios');
        return $estudiante->customQuery("SELECT * FROM usuarios WHERE id = $id");
    }

    public function getmsgById($id)
    {
        $msg = new Clase();
        $msg->setTable('msg');
        return $msg->customQuery("SELECT * FROM msg WHERE id = $id");
    }
    public function loadView($data)
    {
        extract($data);
        include $_SERVER["DOCUMENT_ROOT"] . "/views/maestro/alumnos-maestro.php";
    }
    public function loadViewAlumno($data)
    {
        extract($data);
        include $_SERVER["DOCUMENT_ROOT"] . "/views/alumno/calificaciones-alumno.php";
    }

    public function getMsgCountById($id)
    {
        $result = $this->customQuery("SELECT COUNT(*) as count FROM msg WHERE para = $id");
        return $result[0]['count'];
    }


}