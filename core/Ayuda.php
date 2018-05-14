<?php
class Ayuda{
     
    public function url($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO){
        $urlString="index.php?controller=".$controlador."&action=".$accion;
        return $urlString;
    }

    public function isAdmin(){
        return $this->isUserLogged() && $this->getLoggedUser()['user_type'] == 1;
    }

    public function isUserLogged(){
    	return isset($_SESSION["login"]) && $_SESSION["login"] && isset($_SESSION["user_id"]);
    }

    public function getLoggedUser(){

    	if(isset($_SESSION["login"]) && $_SESSION["login"] && isset($_SESSION["user_id"]))
    	{
            //echo var_dump(DaoUsuario::getInstance()->getUserById($_SESSION["user_id"]));
    		return DaoUsuario::getInstance()->getById($_SESSION["user_id"]);
    	}
    	else
    		return null;
    }
}
?>