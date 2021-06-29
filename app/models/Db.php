<?php
class Db {
    public static $connection = NULL;

    public function __construct()
    {
        if(!self::$connection){
            self::$connection = new mysqli('localhost', 'root', '', 'sportsshop',3309);
            self::$connection->set_charset('utf8mb4');
        }
        return self::$connection;
    }
    public function select($sql)
    {
        $items = [];
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
}