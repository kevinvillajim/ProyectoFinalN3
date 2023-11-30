<?php
class Database
{
    public static function query($query)
    {
        try {
            $config = include($_SERVER["DOCUMENT_ROOT"] . "/config/databaseConfig.php");

            $mysqli = new mysqli($config["host"], $config["username"], $config["password"], $config["dbname"]);

            $res = $mysqli->query($query);

            // Si la consulta es un INSERT, UPDATE, DELETE, etc., devolver el resultado directamente
            if ($res === true || $res === false) {
                $mysqli->close();
                return $res;
            }

            // Si la consulta es un SELECT, FETCH, etc., devolver todas las filas
            $data = $res->fetch_all(MYSQLI_ASSOC);

            $mysqli->close();

            return $data;
        } catch (mysqli_sql_exception $e) {
            throw new Exception("Error en la consulta SQL: " . $e->getMessage());
        }
    }
}