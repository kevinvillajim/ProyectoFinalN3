<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Model.php";

class Usuario extends Model
{
    protected $table = "usuarios";

    public function obtenerNombreClasePorId($id_clase)
    {
        if (!$id_clase) {
            return null;
        } else {
            $query = "SELECT clase FROM clases WHERE id = $id_clase";
            $res = $this->db->query($query);
            $clase_asignada = $res->fetch_assoc();
            return $clase_asignada;
        }
    }

    public function destroyUsuario($id)
    {
        try {
            $this->db->begin_transaction();

            // Obtener el ID de la clase asignada
            $query = "SELECT clase_asignada FROM usuarios WHERE id = $id";
            $result = $this->db->query($query);
            $row = $result->fetch_assoc();
            $idClase = $row['clase_asignada'];

            // Verificar si existe la clase antes de la eliminación
            if ($idClase !== null) {
                // Obtener usuarios asignados a la clase (la clase que se está eliminando)
                $usersAssigned = $this->db->query("SELECT id FROM usuarios WHERE clase_asignada = $idClase")->fetch_all(MYSQLI_ASSOC);

                // Actualizar clase_asignada a NULL en la tabla 'usuarios'
                $this->db->query("UPDATE usuarios SET clase_asignada = NULL WHERE id = $id");

                // Aquí es donde necesitas actualizar todas las otras tablas que tienen una referencia al usuario
                // Por ejemplo, si tienes una tabla 'cursos' que tiene una columna 'id_usuario', podrías hacer algo como esto:
                $this->db->query("UPDATE cursos SET id_usuario = NULL WHERE id_usuario = $id");
                $this->db->query("UPDATE clases SET id_maestro = NULL WHERE id_usuario = $id");

                // Deshabilitar temporalmente la restricción de clave foránea
                $this->db->query("SET foreign_key_checks = 0");

                // Eliminar la fila correspondiente en la tabla 'clases'
                $deleteQuery = "DELETE FROM clases WHERE id = $idClase";
                $this->db->query($deleteQuery);

                // Verificar si se eliminó la clase correctamente
                if ($this->db->affected_rows > 0) {
                    // Actualizar clase_asignada a NULL para los usuarios asignados a la clase que se está eliminando
                    foreach ($usersAssigned as $user) {
                        $userId = $user['id'];
                        $this->db->query("UPDATE usuarios SET clase_asignada = NULL WHERE id = $userId");
                    }
                }

                // Restaurar la restricción de clave foránea
                $this->db->query("SET foreign_key_checks = 1");

                // Finalmente, eliminar el usuario
                $this->db->query("DELETE FROM usuarios WHERE id = $id");

                $this->db->commit();
            } else {
                echo "El usuario no tiene una clase asignada.";
            }
        } catch (Exception $e) {
            $this->db->rollback();
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateClaseAsignada($idMaestro, $claseAsignada)
    {
        // Actualizar la tabla usuarios
        $query = "UPDATE usuarios SET clase_asignada = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $claseAsignada, $idMaestro);
        $stmt->execute();
        $stmt->close();

        // Actualizar la tabla clases
        $query = "UPDATE clases SET id_maestro = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $idMaestro, $claseAsignada);
        $stmt->execute();
        $stmt->close();
    }

    public function updateIdMaestro($claseAsignada, $idMaestro)
    {
        // Actualizar la tabla clases
        $query = "UPDATE clases SET id_maestro = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $idMaestro, $claseAsignada);
        $stmt->execute();
        $stmt->close();

        // Actualizar la tabla usuarios
        $query = "UPDATE usuarios SET clase_asignada = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $claseAsignada, $idMaestro);
        $stmt->execute();
        $stmt->close();
    }

    public function update($data)
    {
        $query = "UPDATE usuarios SET email = ?, nombre = ?, direccion = ?, nacimiento = ?, clase_asignada = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssii', $data['email'], $data['nombre'], $data['direccion'], $data['nacimiento'], $data['clase_asignada'], $data['id']);
        $stmt->execute();
        $stmt->close();
    }

    public function claseExists($claseId)
    {
        // Si claseId es null, devolver true
        if ($claseId === null) {
            return true;
        }

        $query = "SELECT * FROM clases WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $claseId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        // Si hay al menos una fila en el resultado, entonces la clase existe
        return $result->num_rows > 0;
    }

    public function create($data)
    {
        $query = "INSERT INTO usuarios (email, nombre, direccion, nacimiento, id_rol, clase_asignada) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);

        // Si 'clase_asignada' es null, usamos NULL en la consulta SQL
        $clase_asignada = !empty($data['clase_asignada']) ? $data['clase_asignada'] : NULL;

        $stmt->bind_param('ssssis', $data['email'], $data['nombre'], $data['direccion'], $data['nacimiento'], $data['id_rol'], $clase_asignada);

        $stmt->execute();
        $result = $stmt->insert_id;
        $stmt->close();

        return $result;
    }
}