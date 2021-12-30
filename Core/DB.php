<?php

namespace Core;

use PDO;
use PDOException;
use App\Config;

/**
 * Base model
 */
abstract class DB
{

    /**
     * Get the PDO database connection
     *
     * @return mixed
     */
    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {    
            try {
                $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
                $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return $db;
    }
}
