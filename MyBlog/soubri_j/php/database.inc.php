<?php
/*
    ETNA PROJECT, 26/11/2018 by soubri_j
    my_blog : database.inc.php
    File description:
        Database management for my_blog project.
*/
$root = $_SERVER["DOCUMENT_ROOT"];
define("DB_PATH", $root."/database/my_blog.db");

class Database { 
    private static $my_database = null;

    public static function get_database():?PDO
    {
        if (self::$my_database != null) {
            return self::$my_database;
        }

        try {
            self::$my_database = new PDO("sqlite:".DB_PATH);
        } catch (PDOException $ex) {
            echo("Error connection database : ".$ex->getMessage()."<br>");
        }
        return self::$my_database;
    }
}
?>