<?php
class DaoUsuario extends DaoBase
{
    private static $instance;

    public function __construct() {
        parent::__construct("user");
    }

    public static function getInstance()
    {
      if (is_null( self::$instance ) )
      {
        self::$instance = new self();
      }
      return self::$instance;
    }

  //Nos trae un registro que buscamos nombre y contraseña
  public function searchUsuarioByEmailPass($email,$password){
    return DataSource::getInstance()->getData("SELECT * FROM $this->table WHERE email = :email AND password = :password",
      array(':email'=>$email,':password'=>$password));
  }

  /*Busca usuario por nombre, si existe devuelve $result con el id, sino es un false.
  Util para unicamente comprobar si existe un usuari con el mismo nombre al register???*/
  public function searchUsuarioByName($nombre) {
    $result = DataSource::getInstance()->getData("SELECT id FROM $this->table WHERE username = :nombre",
      array(':nombre'=>$nombre));

    return $result;
  }

  //Inserta el Usuario en la base de datos y nos devuelve la id o 0 si error
  public function insertUsuario($user_name,
                                $apellido,$email,
                                $user_password){
      $result = DataSource::getInstance()->setData("INSERT INTO $this->table (name, last_name, email, password) VALUES (:nombre,:apellido,:email,:password)",
        array(':nombre'=>$user_name,':apellido'=>$apellido,':email'=>$email,':password'=>$user_password));
      //llega la id o 0 si error, no devolvemos TO
      return $result;
  }
}
?>
