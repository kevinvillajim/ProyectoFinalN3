<?php
class Model
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $config = include($_SERVER["DOCUMENT_ROOT"] . "/config/databaseConfig.php");

        try {
            $this->db = new mysqli(
                $config["host"],
                $config["username"],
                $config["password"],
                $config["dbname"]
            );
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }

    public function setTable($tableName)
    {
        $this->table = $tableName;
    }

    public function all()
    {
        $res = $this->db->query("select * from {$this->table}");
        $data = $res->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    public function find($id)
    {
        $res = $this->db->query("select * from {$this->table} where id = $id");
        $data = $res->fetch_assoc();

        return $data;
    }

    public function create($data)
    {
        try {
            $keys = array_keys($data);
            $keysString = implode(", ", $keys);

            $values = array_values($data);
            $valuesString = implode("', '", $values);
            $query = "insert into {$this->table}($keysString) values ('$valuesString')";

            $res = $this->db->query($query);

            if ($res) {
                $ultimoId = $this->db->insert_id;
                $data = $this->find($ultimoId);

                return $data;
            } else {
                return "No se pudo crear el alumno";
            }
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function update($data)
    {
        if (!isset($data["id"])) {
            echo "No se proporcionó un ID para actualizar.";
            return;
        }

        $setPairs = [];
        foreach ($data as $key => $value) {
            // Evitar que el id se actualice y solo incluir columnas válidas
            if ($key !== "id" && in_array($key, ["dni", "email", "nombre", "direccion", "nacimiento"])) {
                $setPairs[] = "$key = '$value'";
            }
        }

        $alumnoId = $this->db->real_escape_string($data["id"]);
        $query = "UPDATE {$this->table} SET " . implode(", ", $setPairs) . " WHERE id = $alumnoId";
        $result = $this->db->query($query);
        if (!$result) {
            echo "Error en la ejecución de la actualización: " . $this->db->error;
        }
    }


    public function destroy($id)
    {
        $this->db->query("delete from {$this->table} where id = $id");
    }

    public function customQuery($sql)
    {
        $res = $this->db->query($sql);
        $data = $res->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
}