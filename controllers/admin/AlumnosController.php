<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Model.php";

class AlumnosController
{
    protected $ruta = "/views/admin/alumnos-admin.php";
    protected $model;

    public function __construct()
    {
        $this->model = new Model();
        $this->model->setTable('usuarios');
    }

    public function index()
    {
        $alumnos = $this->model->customQuery("SELECT * FROM usuarios where id_rol = 3");
        include $_SERVER["DOCUMENT_ROOT"] . $this->ruta;
    }

    public function create()
    {
        include $_SERVER["DOCUMENT_ROOT"] . $this->ruta;
    }

    public function edit($id)
    {
        $alumno = $this->model->find($id);
        $_SESSION["alumno_id_edit"] = $alumno["id"];
        include $_SERVER["DOCUMENT_ROOT"] . $this->ruta;
    }


    public function update($request)
    {
        $this->model = new Usuario();

        $alumnoData = [
            'id' => $request['alumno-id-edit'],
            'dni' => $request['dni-edit'],
            'email' => $request['email-edit'],
            'nombre' => $request['name-edit'],
            'direccion' => $request['direccion-edit'],
            'nacimiento' => $request['birth-edit']
        ];

        $this->model->update($alumnoData);
        header("Location: /alumnos/admin");
        exit();
    }

    public function store($request)
    {
        $data = array(
            'dni' => $_POST['dni-create'],
            'email' => $_POST['email-create'],
            'nombre' => $_POST['name-create'] . " " . $_POST['apellido-create'],
            'direccion' => $_POST['direccion-create'],
            'nacimiento' => $_POST['birth-create'],
            'id_rol' => 3,
        );
        $response = $this->model->create($data);
        header("Location: /alumnos/admin");
    }

    public function delete($id)
    {
        $this->model->destroy($id);
        header("Location: /alumnos/admin");
    }
}