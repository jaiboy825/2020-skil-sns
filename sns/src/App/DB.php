<?php

namespace Gondr\App;

class DB
{
    private static $db = null;

    public static function getDB()
    {
        if(is_null(self::$db)) {
            self::$db = new \PDO("mysql:host=gondr.asuscomm.com; dbname=yy_10221; charset=utf8mb4", "yy_10221", "1234");
        }

        return self::$db;
    }

    public static function execute($sql, $data = [])
    {
        $q = self::getDB()->prepare($sql);
        return $q->execute($data);
    }

    public static function fetch($sql, $data=[], $mode = \PDO::FETCH_OBJ) 
    {
        $q = self::getDB()->prepare($sql);
        $q->execute($data);
        return $q->fetch($mode);
    }

    public static function fetchAll($sql, $data=[], $mode = \PDO::FETCH_OBJ)
    {
        $q = self::getDB()->prepare($sql);
        $q->execute($data);
        return $q->fetchAll($mode);
    }

    public static function lastId()
    {
        return self::getDB()->lastInsertId();
    }
}