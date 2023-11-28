<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Model.php";

class Clase extends Model
{
    protected $table = "clases";

    public function getMaestroPorId($idMaestro)
    {
        if (!$idMaestro) {
            return null;
        } else {
            $sql = "SELECT nombre FROM usuarios WHERE id = {$idMaestro}";
            $res = $this->db->query($sql);
            $maestro = $res->fetch_assoc();
            return $maestro;
        }
    }
    public function getClases()
    {
        return $this->customQuery("SELECT * FROM clases");
    }
    public function getProfesoresSinClase()
    {
        $res = $this->customQuery("SELECT id, nombre FROM usuarios WHERE id_rol = 2 and clase_asignada is null");
        return $res;
    }

    public function create($data)
    {
        try {
            $this->db->begin_transaction();
            parent::create($data);

            $idMaestro = $data['id_maestro'];
            $updateUsuarioQuery = "UPDATE usuarios SET clase_asignada = LAST_INSERT_ID() WHERE id = $idMaestro";
            $this->db->query($updateUsuarioQuery);
            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollback();
            echo "Error: " . $e->getMessage();
        }
    }
    public function destroy($id)
    {
        try {
            $this->db->begin_transaction();

            // Obtener usuarios asignados a la clase
            $usersAssigned = $this->db->query("SELECT id FROM usuarios WHERE clase_asignada = $id")->fetch_all(MYSQLI_ASSOC);

            // Actualizar clase_asignada a NULL para los usuarios asignados
            foreach ($usersAssigned as $user) {
                $userId = $user['id'];
                $this->db->query("UPDATE usuarios SET clase_asignada = NULL WHERE id = $userId");
            }

            // Eliminar la clase
            parent::destroy($id);

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollback();
            echo "Error: " . $e->getMessage();
        }
    }

    public function update($data)
    {
        $id = $data['id'];
        $idMaestro = $data['id_maestro'];

        $maestroCount = 0;

        $checkMaestroQuery = "SELECT COUNT(*) FROM usuarios WHERE id = ?";
        $stmtCheckMaestro = $this->db->prepare($checkMaestroQuery);
        $stmtCheckMaestro->bind_param('i', $idMaestro);
        $stmtCheckMaestro->execute();
        $stmtCheckMaestro->bind_result($maestroCount);
        $stmtCheckMaestro->fetch();
        $stmtCheckMaestro->close();

        if ($maestroCount > 0) {
            $previousTeacherQry = "SELECT id_maestro FROM {$this->table} WHERE id = ?";
            $stmtPreviousTeacher = $this->db->prepare($previousTeacherQry);
            $stmtPreviousTeacher->bind_param('i', $id);
            $stmtPreviousTeacher->execute();
            $previousTeacherId = $stmtPreviousTeacher->get_result()->fetch_assoc()['id_maestro'];
            $stmtPreviousTeacher->close();

            $updateQuery = "UPDATE {$this->table} SET id_maestro = ?, clase = ? WHERE id = ?";
            $stmt = $this->db->prepare($updateQuery);
            $stmt->bind_param('iss', $idMaestro, $data['clase'], $id);
            $stmt->execute();
            $stmt->close();

            $this->db->query("UPDATE usuarios SET clase_asignada = NULL WHERE id = $previousTeacherId");

            $newTeacherId = $idMaestro;
            $this->db->query("UPDATE usuarios SET clase_asignada = $id WHERE id = $newTeacherId");
        } else {
            echo "Error: El ID del maestro no es válido.";
        }
    }

    private function isTeacherAvailable($teacherId)
    {
        $result = $this->db->query("SELECT id FROM usuarios WHERE id = $teacherId AND clase_asignada IS NULL");
        return $result->num_rows > 0;
    }
}