<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/config/Database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Usuario.php";

class Clase extends Model
{
    // Propiedades del modelo
    public $id;
    public $nombre;
    public $descripcion;
    public $claseModel;

    // Base de datos
    protected $db;  // Cambia esto a 'protected'

    // Constructor
    public function __construct()
    {
        $this->db = new Database('localhost', 'username', 'password', 'database');
    }

    // Obtiene todas las clases
    public function getAll()
    {
        return $this->db->query("SELECT * FROM clases;");
    }

    // Obtiene los detalles de una clase
    public function getById($id)
    {
        return $this->db->query("SELECT * FROM clases WHERE id = $id");
    }

    public function getMaestroPorId($idMaestro)
    {
        if (!$idMaestro) {
            return null;
        } else {
            $sql = "SELECT nombre FROM usuarios WHERE id = {$idMaestro}";
            return $this->db->query($sql);
        }
    }

    public function getProfesoresSinClase()
    {
        return $this->db->query("SELECT id, nombre FROM usuarios WHERE id_rol = 2 and clase_asignada is null");
    }

    public function create($data)
    {
        $clase = $data['materia-create'];
        $id_maestro = $data['maestro-create'] === "Sin asignar" ? null : $data['maestro-create'];

        // Si id_maestro no es null, comprobar si existe en la tabla usuarios
        if ($id_maestro !== null && !$this->maestroExists($id_maestro)) {
            // Si el id_maestro no existe, mostrar un mensaje de error y salir
            echo "Error: id_maestro no existe en la tabla usuarios";
            return;
        }

        // Preparar la consulta SQL
        if ($id_maestro === null) {
            $sql = "INSERT INTO clases (clase, id_maestro) VALUES('$clase', NULL)";
        } else {
            $sql = "INSERT INTO clases (clase, id_maestro) VALUES('$clase', '$id_maestro')";
        }

        // Ejecutar la consulta SQL
        $this->db->query($sql);
        header("Location: /clases/admin");
    }

    public function destroy($id)
    {
        $this->db->query("UPDATE usuarios SET clase_asignada = NULL WHERE clase_asignada = $id");
        $this->db->query("DELETE FROM clases WHERE id = $id");
    }

    public function update($data)
    {
        $id = (int) $data['id'];
        $clase = $data['materia-edit'];
        $id_maestro = $data['maestro-edit'] == "Selecciona el maestro" ? null : $data['maestro-edit'];

        $usuario = new Usuario();
        if ($id_maestro !== null && !$usuario->claseExists($id_maestro)) {
            // El maestro no existe, manejar el error aquí
            return;
        }

        if ($id_maestro === null) {
            // Si 'maestro-edit' es 'Selecciona el maestro', solo actualiza la materia
            $sql = "UPDATE clases SET clase = '$clase' WHERE id = $id";
        } else {
            // Si 'maestro-edit' no es 'Selecciona el maestro', actualiza la materia y el maestro
            $sql = "UPDATE clases SET clase = '$clase', id_maestro = '$id_maestro' WHERE id = $id";
        }

        $this->db->query($sql);
    }
    public function maestroExists($idMaestro)
    {
        if ($idMaestro === null) {
            return false;
        }

        $query = "SELECT * FROM usuarios WHERE id = $idMaestro";
        $result = $this->db->query($query);

        // Si la consulta falló, devolver false
        if ($result === false) {
            return false;
        }

        // Si hay al menos una fila en el resultado, entonces el maestro existe
        return count($result) > 0;
    }
    public function getClases()
    {
        $query = "SELECT * FROM clases";
        $result = $this->db->query($query);
        return $result;
    }
}