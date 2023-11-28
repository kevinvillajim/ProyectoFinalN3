<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/controllers/admin/AlumnosController.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/models/Clase.php";
class DashboardControllerMaestro extends AlumnosController
{
    public function index()
    {
        include $_SERVER["DOCUMENT_ROOT"] . "/views/maestro/dashboard-maestro.php";
    }
}