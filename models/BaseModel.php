<?php

require_once __DIR__ . '/../config/Database.php';

abstract class BaseModel {
    protected $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->connect();
    }

    abstract public function getAll();
}
