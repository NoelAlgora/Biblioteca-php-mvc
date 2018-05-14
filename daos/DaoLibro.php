<?php
class DaoLibro extends DaoBase
{
    private static $instance;

    public function __construct() {
        parent::__construct("libro");
    }

    public static function getInstance()
    {
      if (is_null( self::$instance ) )
      {
        self::$instance = new self();
      }
      return self::$instance;
    }

    public function getAll()
    {
      $date_now = date("Y-m-d H:i:s");

      //$result = Datasource::getinstance()->getAllData("SELECT l.id, l.name, l.author, l.genre, l.year, l.resume FROM libro l LEFT JOIN prestamo p ON l.id = p.libro_id WHERE p.status IS NULL OR p.status = 1", array());
      $result = DataSource::getInstance()->getAllData("SELECT l.id, l.name, l.author, l.genre, l.year, l.resume, p.date_start, p.date_end, p.status FROM libro l
              LEFT JOIN (
                    SELECT    MAX(id) max_id, libro_id 
                    FROM      prestamo 
                    GROUP BY  libro_id
              ) c_max ON (c_max.libro_id = l.id)
              LEFT JOIN prestamo p ON (p.id = c_max.max_id) ORDER BY p.status", array());

      return $result;
    }

    public function getReservados()
    {
      $date_now = date("Y-m-d H:i:s");

      $result = DataSource::getInstance()->getAllData("SELECT l.id, l.name, l.author, l.genre, l.year, l.resume, p.date_start, p.date_end, p.status, p.id as prestamo_id, p.user_id FROM libro l LEFT JOIN prestamo p ON l.id = p.libro_id WHERE p.libro_id IS NOT NULL AND p.status = 0", array());

      return $result;
    }

    public function getDisponibles()
    {
      $result = DataSource::getInstance()->getAllData("SELECT l.id, l.name, l.author, l.genre, l.year, l.resume FROM libro l
              LEFT JOIN (
                    SELECT    MAX(id) max_id, libro_id 
                    FROM      prestamo 
                    GROUP BY  libro_id
              ) c_max ON (c_max.libro_id = l.id)
              LEFT JOIN prestamo p ON (p.id = c_max.max_id)
              WHERE c_max.max_id IS NULL OR p.status = 1", array());

      return $result;
    }

  //Inserta el Usuario en la base de datos y nos devuelve la id o 0 si error
  public function insertLibro($name,
                                $author,
                                $genre,
                                $year,
                                $resume){
      $result = DataSource::getInstance()->setData("INSERT INTO libro (name, author, genre, year, resume) VALUES (:name,:author,:genre,:year,:resume)",
        array(':name'=>$name,':author'=>$author,':genre'=>$genre,':year'=>$year,':resume'=>$resume));
      //llega la id o 0 si error, no devolvemos TO
      return $result;
  }
}
?>