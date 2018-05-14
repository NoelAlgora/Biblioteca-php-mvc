<?php
class DaoBase {

    public $table;

    public function __construct($table) {
        $this->table=(string) $table;

        require_once 'DataSource.php';
    }

    public function getDataSource(){
        return DataSource::getInstance();
    }

    public function getAll(){
        return DataSource::getInstance()->getAllData("SELECT * FROM $this->table ORDER BY id DESC", array());
    }

    public function getById($id){
        return DataSource::getInstance()->getData("SELECT * FROM $this->table WHERE id = :id", array(':id'=>$id));
    }

    public function getBy($column,$value){
		return DataSource::getInstance()->getAllData("SELECT * FROM $this->table WHERE $column = :value", array(':value'=>$value));
    }

    public function deleteById($id){
        return DataSource::getInstance()->setData("DELETE FROM $this->table WHERE id=$id");
    }

    public function deleteBy($column,$value){
        return DataSource::getInstance()->setData("DELETE FROM $this->table WHERE $column='$value'");
    }
}
?>
