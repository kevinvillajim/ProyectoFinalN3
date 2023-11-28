<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Usuario.php";

class MaestrosController extends AlumnosController
{
    protected $ruta = "/views/admin/maestros-admin.php";

    public function index()
    {
        // Crear una instancia de Usuario en lugar de Model
        $usuarioModel = new Usuario();
        $maestros = $usuarioModel->customQuery("SELECT * FROM usuarios where id_rol = 2");

        foreach ($maestros as $clave => $maestro) {
            $id_clase = $maestro['clase_asignada'];
            $nombreClase = $usuarioModel->obtenerNombreClasePorId($id_clase);
            $maestros[$clave]["nombreClase"] = isset($nombreClase["clase"]) ? $nombreClase["clase"] : null;
        }

        $data['maestros'] = $maestros;
        require $_SERVER["DOCUMENT_ROOT"] . $this->ruta;
    }


    public function create()
    {
        include $_SERVER["DOCUMENT_ROOT"] . $this->ruta;
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
        $maestroData = [
            'id' => $request['maestro-id-edit'],
            'dni' => $request['dni-edit'],
            'email' => $request['email-edit'],
            'nombre' => $request['name-edit'],
            'direccion' => $request['direccion-edit'],
            'nacimiento' => $request['birth-edit'],
            'clase_asignada' => $request['clase-edit']
        ];
        $this->model->update($maestroData);
        header("Location: /maestros/admin");
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