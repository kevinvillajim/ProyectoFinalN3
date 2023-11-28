<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/controllers/admin/AlumnosController.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Clase.php";
class HomeController extends AlumnosController
{
    public function index()
    {
        include $_SERVER["DOCUMENT_ROOT"] . "/views/admin/dashboard-admin.php";
    }
}