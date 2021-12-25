<?php

namespace Core;

use PDO;
use PDOException;
use App\Config;

/**
 * Base model
 *
 * PHP version 5.4
 */
abstract class DB
{

    /**
     * Get the PDO database connection
     *
     * @return mixed
     */
    //c1
    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {
            //$host = 'localhost';
            //$dbname = 'fsoft_mvc';
            //$username = 'root';
            //$password = '';
    
            try {
                //$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",
                //              $username, $password);
                $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
                $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return $db;
    }

    
    const HOST = 'localhost';
    
    const DB_NAME = 'fsoft_mvc';

    const USERNAME = 'root';

    const PASSWORD = '';

    public function connect() 
    {
        
        $connec = mysqli_connect(self::HOST, self::USERNAME, self::PASSWORD, self::DB_NAME);

        mysqli_set_charset($connec, 'utf8');

        if (mysqli_connect_errno() == 0) {
            return $connec;
        }

        return false;
    }

}
