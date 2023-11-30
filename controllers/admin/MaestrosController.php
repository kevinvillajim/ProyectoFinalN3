<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Usuario.php";
require_once "AlumnosController.php";


class MaestrosController extends AlumnosController
{
    protected $ruta = "/views/admin/maestros-admin.php";

    public function index()
    {
        // Crear una instancia de Usuario y Clase
        $usuarioModel = new Usuario();
        $claseModel = new Clase();
        $this->model = new Usuario();

        // Obtener todos los maestros y clases
        $maestros = $usuarioModel->customQuery("SELECT * FROM usuarios where id_rol = 2");
        $clases = $claseModel->getClases();

        foreach ($maestros as $clave => $maestro) {
            $id_clase = $maestro['clase_asignada'];
            $nombreClase = $usuarioModel->obtenerNombreClasePorId($id_clase);
            $maestros[$clave]["nombreClase"] = isset($nombreClase["clase"]) ? $nombreClase["clase"] : null;
        }

        $data['maestros'] = $maestros;
        $data['clases'] = $clases;
        require $_SERVER["DOCUMENT_ROOT"] . $this->ruta;
    }

    public function create()
    {
        require $_SERVER["DOCUMENT_ROOT"] . $this->ruta;
    }

    public function edit($id)
    {
        $maestro = $this->model->find($id);
        $nombreClase = $this->model->obtenerNombreClasePorId($maestro['clase_asignada']);
        $data['nombreClase'] = $nombreClase;
        $data['maestro'] = $maestro;
        include $_SERVER["DOCUMENT_ROOT"] . $this->ruta;
    }

    public function update($request)
    {
        // Crear una nueva instancia de Usuario
        $this->model = new Usuario();

        $maestroData = [
            'id' => $request['maestro-id-edit'],
            'email' => $request['email-edit'],
            'nombre' => $request['name-edit'],
            'direccion' => $request['direccion-edit'],
            'nacimiento' => $request['birth-edit'],
            'clase_asignada' => $request['clase-edit']
        ];
        $this->model->update($maestroData);
        $this->model->updateClaseAsignada($maestroData['id'], $maestroData['clase_asignada']);
        $this->model->updateIdMaestro($maestroData['clase_asignada'], $maestroData['id']);
        header("Location: /maestros/admin");
        exit();
    }
    public function store($request)
    {
        $data = array(
            'email' => $_POST['email-create'],
            'nombre' => $_POST['name-create'] . " " . $_POST['apellido-create'],
            'direccion' => $_POST['direccion-create'],
            'nacimiento' => $_POST['birth-create'],
            'id_rol' => 2,
            'clase_asignada' => $_POST['clase-create'] === 'Selecciona la Clase' ? null : $_POST['clase-create'],
        );

        $usuario = new Usuario();

        if (empty($data['clase_asignada']) || $usuario->claseExists($data['clase_asignada'])) {
            // Si 'clase_asignada' es null, no intentamos actualizar 'clase_asignada' en la base de datos
            if (empty($data['clase_asignada'])) {
                $data['clase_asignada'] = null;
            }

            $response = $usuario->create($data);

            if ($response) {
                if (!empty($data['clase_asignada'])) {
                    $usuario->updateClaseAsignada($response, $data['clase_asignada']);
                    $usuario->updateIdMaestro($data['clase_asignada'], $response);
                }

                header("Location: /maestros/admin");
            } else {
                echo "Hubo un error al crear el maestro.";
            }
        } else {
            echo "La clase no existe.";
        }
        exit();
    }

    public function delete($id)
    {
        // Crear una instancia de Usuario en lugar de Model
        $usuarioModel = new Usuario();
        $usuarioModel->destroyUsuario($id);
        header("Location: /maestros/admin");
    }
}