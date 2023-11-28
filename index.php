<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/controllers/HomeController.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/controllers/admin/AlumnosController.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/controllers/admin/ClasesController.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/controllers/admin/MaestrosController.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/controllers/admin/PermisosController.php");
$HomeController = new HomeController();
$AlumnosController = new AlumnosController();
$ClasesController = new ClasesController();
$MaestrosController = new MaestrosController();
$PermisosController = new PermisosController();
$route = explode("?", $_SERVER["REQUEST_URI"]);
$method = $_SERVER["REQUEST_METHOD"];

if ($method === "POST") {

  switch ($route[0]) {

    case '/alumnos/admin':

      if ($_POST['action'] == 'create') {
        $AlumnosController->store($_POST);
      }

      if ($_POST['action'] == 'update') {
        $AlumnosController->update($_POST);
      }

      if ($_POST['action'] == 'delete') {
        $AlumnosController->delete($_POST['id']);
      }

      break;

    case '/clases/admin':

      if ($_POST['action'] == 'create') {
        $ClasesController->store($_POST);
      }

      if ($_POST['action'] == 'update') {
        $ClasesController->update($_POST);
      }

      if ($_POST['action'] == 'delete') {
        $ClasesController->delete($_POST['id']);
      }

      break;

    case '/maestros/admin':

      if ($_POST['action'] == 'create') {
        $MaestrosController->store($_POST);
      }

      if ($_POST['action'] == 'update') {
        $MaestrosController->update($_POST);
      }

      if ($_POST['action'] == 'delete') {
        $MaestrosController->delete($_POST['id']);
      }

      break;

    case '/permisos/admin':

      if ($_POST['action'] == 'create') {
        $PermisosController->store($_POST);
      }

      if ($_POST['action'] == 'update') {
        $PermisosController->update($_POST);
      }

      if ($_POST['action'] == 'delete') {
        $PermisosController->delete($_POST['id']);
      }

      break;

  }

}

if ($method === "GET") {
  if ($route[0] == '/alumnos/admin') {
    $AlumnosController->index();
  }
  if ($route[0] == '/clases/admin') {
    $ClasesController->index();
  }
  if ($route[0] == '/dashboard/admin') {
    $HomeController->index();
  }
  if ($route[0] == '/maestros/admin') {
    $MaestrosController->index();
  }
  if ($route[0] == '/permisos/admin') {
    $PermisosController->index();
  }

}