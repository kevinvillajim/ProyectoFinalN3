<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/UserModel.php";
class LoginController
{
    public function index()
    {
        include $_SERVER["DOCUMENT_ROOT"] . "/views/login.php";
    }
    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $userModel = new UserModel();
            $user = $userModel->findByEmail($email);

            if ($user && $password === $user[0]["password"]) {
                $_SESSION["userId"] = $user[0]["id"];
                $_SESSION["user"] = $user[0];
                switch ($user[0]["id_rol"]) {
                    case 1:
                        header("Location: /dashboard/admin");
                        break;
                    case 2:
                        header("Location: /dashboard/maestro");
                        break;
                    case 3:
                        header("Location: /dashboard/alumno");
                        break;
                }
            } else {
                $errorMessage = $user ? "Contraseña incorrecta" : "Usuario no encontrado";
                extract(compact('errorMessage'));
                include $_SERVER["DOCUMENT_ROOT"] . "/views/login.php";
            }
        } else {
            include $_SERVER["DOCUMENT_ROOT"] . "/views/login.php";
        }
    }
}