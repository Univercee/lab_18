<?php

class ShootingTypesController {
    private $table;
    private $errors;
    public function __construct()
    {
        $this->table = new ShootingType;
        $this->errors = [];
    }

    public function get(int $id){
        return $this->table->get($id);
    }

    public function getAll(){
        return $this->table->getAll();
    }
}

?>