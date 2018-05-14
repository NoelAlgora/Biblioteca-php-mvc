<?php
class DataSource {

  private static $instancia;
  private $user, $pass, $database, $host;
  private $conexion;

  private function __construct(){
    try {
      $db_cfg = require_once 'config/db.php';
      $this->host=$db_cfg["host"];
      $this->user=$db_cfg["user"];
      $this->pass=$db_cfg["pass"];
      $this->database=$db_cfg["database"];
      //$this->conexion = new PDO($this->dsn,$this->user,$this->password);
      $this->conexion = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database,
        $this->user, $this->pass);

    } catch (PDOException $e) {
      echo "Error conexion base de datos: " . $e->getMessage();
    }
  }

  public static function getInstance(){
    if (!self::$instancia){
      self::$instancia =  new DataSource();
    }
    return self::$instancia;
  }

  public function conexion(){
      return $this->conexion;
  }

  public function getData($sql,$values){
    $consulta = $this->conexion->prepare($sql);
    $consulta->execute($values);
    // echo $consulta->queryString;
    //PDO::FETCH_ASSOC: devuelve un array indexado por los nombres de las columnas del conjunto de resultados.
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    // var_dump($resultado);
    return $resultado;
  }

  public function getAllData($sql,$values){
    $consulta = $this->conexion->prepare($sql);
    $consulta->execute($values);
    $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;
  }


  public function setData($sql,$values){
    $consulta = $this->conexion->prepare($sql);
    $consulta->execute($values);
    return $this->conexion->lastInsertId();
  }
}

 ?>
