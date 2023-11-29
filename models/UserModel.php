<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Model.php";
class UserModel extends Model
{
    protected $table = "usuarios";

    public function findByEmail($email)
    {
        return $this->customQuery("SELECT * FROM usuarios WHERE email = '$email'");
    }
}