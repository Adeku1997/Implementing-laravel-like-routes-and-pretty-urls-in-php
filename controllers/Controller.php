<?php

namespace Controllers;

class Controller
{
    /**
     * @var mysqli
     */
    protected $conn;

    public function __construct()
    {
        require "../db.php";

        $this->conn = $conn;
    }
}
