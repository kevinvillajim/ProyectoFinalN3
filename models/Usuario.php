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
}