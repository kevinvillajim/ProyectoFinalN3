<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Usuario.php";
class PermisosController extends AlumnosController
{
    public function __construct()
    {
        $this->model = new Usuario();
        $this->model->setTable('usuarios');
    }
    public function index()
    {

        $data['permisos'] = $this->model->customQuery("SELECT * FROM usuarios");
        extract($data);
        require $_SERVER["DOCUMENT_ROOT"] . "/views/admin/permisos-admin.php";

    }
    public function create()
    {
        include $_SERVER["DOCUMENT_ROOT"] . "/views/admin/permisos-admin.php";
    }

    public function edit($id)
    {
        $clase = $this->model->find($id);
        $data['clase'] = $clase;

        require $_SERVER["DOCUMENT_ROOT"] . "/views/admin/permisos-admin.php";
    }

    public function update($request)
    {

        $id = $_POST['id'];

        // Find para obtener datos actuales
        $clase = $this->model->find($id);

        // Array con la data a actualizar
        $data = [
            'id' => $id,
            'id_maestro' => $_POST['maestro-edit'],
            'clase' => $_POST['materia-edit']
        ];

        // Pasar el array a la función update  
        $this->model->update($data);
        header("Location: /clases/admin");
    }

    public function store($request)
    {
        $data = array(
            'clase' => $_POST['materia-create'],
            'id_maestro' => $_POST['maestro-create'],
        );
        $this->model->create($data);
        header("Location: /clases/admin");
    }

    public function delete($id)
    {
        $this->model->destroy($id);
        header("Location: /clases/admin");
    }

    public function getMaestroPorId($id)
    {
        $data["clase"] = $this->model->find($id);
        $data["maestro"] = $this->model->customQuery("SELECT * FROM usuarios WHERE id = {$data['clase']['id_maestro']}");
        $maestro = $data["maestro"];
        include $_SERVER["DOCUMENT_ROOT"] . "/views/admin/clases-admin.php";
    }


}