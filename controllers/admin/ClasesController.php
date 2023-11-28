<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Clase.php";
class ClasesController extends AlumnosController
{
    public function __construct()
    {
        $this->model = new Clase();
        $this->model->setTable('clases');
    }
    public function index()
    {

        $clases = $this->model->getClases();
        $profes = $this->model->getProfesoresSinClase();
        foreach ($clases as $clave => $clase) {

            $idMaestro = $clase['id_maestro'];

            $maestro = $this->model->getMaestroPorId($idMaestro);

            $clases[$clave]['maestro'] = $maestro;

        }
        $data['clases'] = $clases;
        $data['profes'] = $profes;

        require $_SERVER["DOCUMENT_ROOT"] . "/views/admin/clases-admin.php";

    }
    public function create()
    {
        $profesoresSinClase = $this->model->getProfesoresSinClase();
        $data['profesores'] = $profesoresSinClase;
        include $_SERVER["DOCUMENT_ROOT"] . "/views/admin/clases-admin.php";
    }

    public function edit($id)
    {
        $clase = $this->model->find($id);
        $profes = $this->model->getProfesoresSinClase();

        $data['clase'] = $clase;
        $data['profes'] = $profes;

        require $_SERVER["DOCUMENT_ROOT"] . "/views/admin/clases-admin.php";
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

    public function getProfesoresSinClase()
    {
        $profesoresSinClase = $this->model->getProfesoresSinClase();
        include $_SERVER["DOCUMENT_ROOT"] . "/views/admin/clases-admin.php";

    }

}