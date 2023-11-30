<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Clase.php";


class ClasesController
{
    private $claseModel;

    public function __construct()
    {
        $this->claseModel = new Clase();
    }

    public function index()
    {
        $clases = $this->claseModel->getAll();
        $profes = $this->claseModel->getProfesoresSinClase();

        if (is_array($clases)) {
            foreach ($clases as $clave => $clase) {
                $idMaestro = $clase['id_maestro'];
                $maestro = $this->claseModel->getMaestroPorId($idMaestro);
                $clases[$clave]['maestro'] = $maestro;
            }
        }

        $data['clases'] = $clases;
        $data['profes'] = $profes;

        require $_SERVER["DOCUMENT_ROOT"] . "/views/admin/clases-admin.php";
    }

    public function store($data)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'materia-create' => $_POST['materia-create'],
                'maestro-create' => $_POST['maestro-create']
            ];
            $this->claseModel->create($data);
        } else {

        }
    }

    public function edit($id)
    {

        $clase = $this->claseModel->getById($id);
        $profes = $this->claseModel->getProfesoresSinClase();

        $data['clase'] = $clase;
        $data['profes'] = $profes;

        require $_SERVER["DOCUMENT_ROOT"] . "/views/admin/clases-admin.php";
    }

    public function update($data)
    {
        var_dump($_POST);
        $this->claseModel->update($data);
        header("Location: /clases/admin");
    }

    public function delete($id)
    {
        $this->claseModel->destroy($id);
        header("Location: /clases/admin");
    }
}