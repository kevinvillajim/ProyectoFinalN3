<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Clase.php";
class PermisosController extends AlumnosController
{
    public function __construct()
    {
        $this->model = new Usuario();
        $this->model->setTable('usuarios');
    }

    public function index()
    {
        $claseModel = new Clase();
        $data['permisos'] = $this->model->customQuery("SELECT * FROM usuarios");
        $data['rolesTotal'] = $this->getRoles();
        $data['clases'] = $claseModel->getClases(); // Asegúrate de que tienes un método getClases() en tu controlador
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
        var_dump($_POST);
        $id = $_POST['id'];

        $clase = $this->model->find($id);

        $data = [
            'id' => $id,
            'id_maestro' => $_POST['maestro-edit'],
            'clase' => $_POST['materia-edit']
        ];

        $this->model->update($data);
        header("Location: /permisos/admin");
    }

    public function store($request)
    {
        $data = array(
            'clase' => $_POST['materia-create'],
            'id_maestro' => $_POST['maestro-create'],
        );
        $this->model->create($data);
        header("Location: /permisos/admin");
    }

    public function delete($id)
    {
        $this->model->destroy($id);
        header("Location: /permisos/admin");
    }

    public function getMaestroPorId($id)
    {
        $data["clase"] = $this->model->find($id);
        $data["maestro"] = $this->model->customQuery("SELECT * FROM usuarios WHERE id = {$data['clase']['id_maestro']}");
        $maestro = $data["maestro"];
        include $_SERVER["DOCUMENT_ROOT"] . "/views/admin/permisos-admin.php";
    }

    public function getRoles()
    {
        return $this->model->customQuery("SELECT * FROM roles");
    }

}