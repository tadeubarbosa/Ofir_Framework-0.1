<?php
/**
* --------------------------------------------------------------------------
* This class is used to make the connection with the database
* --------------------------------------------------------------------------
* @var $pdo : Object : Stored the instance of PDO
*/

class Database
{
    private static $pdo;

    public static function connect() {
        if (!isset($pdo)) {
            try {
				$host     = getenv('HOST_NAME');
				$username = getenv('HOST_USERNAME');
				$password = getenv('HOST_PASSWORD');
				$dbname   = getenv('HOST_DBNAME');
				self::$pdo = new PDO("mysql:" . "host={$host};dbname={$dbname}", $username, $password,
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            }
            catch (PDOException $e) {
                if ($e->getCode() == 2002) {
                    echo "<b>Database configuration Error:</b> This Localhost not exist in this server";
                    exit;
                } elseif ($e->getCode() == 1049) {
                    echo "<b>Database configuration Error:</b> This Database not exist in this server";
                    exit;
                } elseif ($e->getCode() == 1044) {
                    echo "<b>Database configuration Error:</b> Database username not exist in this server";
                    exit;
                } elseif ($e->getCode() == 1045) {
                    echo "<b>Database configuration Error:</b> Database Password are incorrect";
                    exit;
                }
            }
        }

        return self::$pdo;
    }
}
