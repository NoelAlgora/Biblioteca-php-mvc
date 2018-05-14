<?php
class DaoPrestamo extends DaoBase
{
    private static $instance;

    public function __construct() {
        parent::__construct("prestamo");
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
        $result = DataSource::getInstance()->getAllData("SELECT l.id, l.name, l.author, l.genre, l.year, l.resume, p.date_start, p.date_end, p.status, p.id as prestamo_id, p.user_id FROM libro l LEFT JOIN prestamo p ON p.libro_id = l.id WHERE p.libro_id IS NOT NULL ORDER BY p.status, p.date_end DESC", array());

        return $result;
    }

    public function getMisPrestamos($user_id)
    {
        $date_now = date("Y-m-d H:i:s");
        $result = DataSource::getInstance()->getAllData("SELECT l.id, l.name, l.author, l.genre, l.year, l.resume, p.date_start, p.date_end, p.status, p.id as prestamo_id FROM libro l LEFT JOIN prestamo p ON p.user_id = :user_id AND p.libro_id = l.id WHERE p.user_id IS NOT NULL ORDER BY p.status, p.date_end DESC", array(':user_id'=>$user_id));

        return $result;
    }

    public function devolverPrestamo($prestamo_id)
    {
      $result = DataSource::getInstance()->setData("UPDATE $this->table SET status = 1 WHERE id = :prestamo_id",
        array(':prestamo_id'=>$prestamo_id));
      return $result;
    }

  public function insertPrestamo($libro_id, $user_id)
  {
      $result = DataSource::getInstance()->getData("SELECT * FROM $this->table WHERE libro_id = :libro_id AND status = 0",
        array(':libro_id'=>$libro_id));

      if(!$result)
      {
        $date_now = date("Y-m-d H:i:s");
        $date_end = strtotime(date("Y-m-d H:i:s", strtotime($date_now)) . " +1 month");
        $date_end = date("Y-m-d H:i:s", $date_end);

        $result = DataSource::getInstance()->setData("INSERT INTO $this->table (user_id, libro_id, date_start, date_end) VALUES (:user_id,:libro_id,:date_start,:date_end)",
        array(':user_id'=>$user_id,':libro_id'=>$libro_id,':date_start'=>$date_now,':date_end'=>$date_end));
      }

      return $result;
  }
}
?>