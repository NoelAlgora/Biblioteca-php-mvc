<?php
//Configuración global
require_once 'config/global.php';
 
//Base para los controladores
require_once 'core/ControladorBase.php';
 
//Funciones para el controlador frontal
require_once 'core/EntryController.php';
 
//Cargamos controladores y acciones
if(isset($_GET["controller"])){
    $controllerObj=EntryController::cargarControlador($_GET["controller"]);
    EntryController::lanzarAccion($controllerObj);
}else{
    $controllerObj=EntryController::cargarControlador(CONTROLADOR_DEFECTO);
    EntryController::lanzarAccion($controllerObj);
}
?>