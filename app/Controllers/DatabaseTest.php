<?php

namespace App\Controllers;

class DatabaseTest extends BaseController
{
    function index()
    {
        try {
            $db = \Config\Database::connect();
            $db->initialize();

            return "Database Connected Successfully";
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
}
