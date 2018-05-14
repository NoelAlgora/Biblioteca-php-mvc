<?php
class EntryController
{
    public static function cargarControlador($controller){
        $controlador=ucwords($controller).'Controller';
        $strFileController='controllers/'.$controlador.'.php';

        if(!is_file($strFileController)){
            $strFileController='controllers/'.ucwords(CONTROLADOR_DEFECTO).'Controller.php';
			$controlador=ucwords(CONTROLADOR_DEFECTO).'Controller';
        }

        require_once $strFileController;
        $controllerObj=new $controlador();
        return $controllerObj;
    }

    public static function cargarAccion($controllerObj,$action){
        $accion=$action;
        $controllerObj->$accion();
    }

    public static function lanzarAccion($controllerObj){
        if(isset($_GET["action"]) && method_exists($controllerObj, $_GET["action"])){
            EntryController::cargarAccion($controllerObj, $_GET["action"]);
        }else{
            EntryController::cargarAccion($controllerObj, ACCION_DEFECTO);
        }
    }
}
?>
