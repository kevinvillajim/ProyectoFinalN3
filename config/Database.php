<?php
class Database
{
    public static function query($query)
    {
        try {
            $config = include($_SERVER["DOCUMENT_ROOT"] . "/config/databaseConfig.php");

            $mysqli = new mysqli($config["host"], $config["username"], $config["password"], $config["dbname"]);

            $res = $mysqli->query($query);
            $data = $res->fetch_all(MYSQLI_ASSOC);

            $mysqli->close();

            return $data;
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
