<?php

class ShootingType {

    private $pdo;
    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function get(int $id){
        $query = $this->pdo->prepare("SELECT * FROM `shooting_types` WHERE id = :id LIMIT 1");
        $query->bindParam(':id', $id);
        $query->execute();
        $element = $query->fetch();
        return empty($element)?null:$element;
    }

    public function getAll(){
        $query = $this->pdo->prepare("SELECT * FROM `shooting_types`");
        $query->execute();
        $elements = $query->fetchAll();
        return empty($elements)?null:$elements;
    }
}

?>