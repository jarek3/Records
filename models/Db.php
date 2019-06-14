<?php
class Db
{
private static $connection;
private static $settings = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false,
        );
public static function connect($host, $user, $password, $databaze)
    {
        if (!isset(self::$connection))
        {
                self::$connection = @new PDO(
                        "mysql:host=$host;dbname=$databaze",
                        $user,
                        $password,
                        self::$settings
                );
        }
    }                       
    
public static function queryOne($query, $params = array())
    {
        $result = self::$connection->prepare($query);
        $result->execute($params);
        return $result->fetch();
    }
public static function queryAll($query, $params = array())
    {
        $result = self::$connection->prepare($query);
        $result->execute($params);
        return $result->fetchAll();
    }
public static function querySingle($query, $params = array())
    {
        $result = self::querySingle($query, $params);
        return $result[0];
    }
 // Spustí dotaz a vrátí počet ovlivněných řádků
public static function query($query, $params = array())
    {
        $result = self::$connection->prepare($query);
        $result->execute($params);
        return $result->rowCount();
    }
    
public static function insert($table, $params = array())
    {    
        return self::query("INSERT INTO `$table` (`".
                implode('`, `', array_keys($params)).
                "`) VALUES (".str_repeat('?,', sizeOf($params)-1)."?)",
                        array_values($params));
    }
    
public static function update($table, $hodnoty = array(), $podminka, $params = array())
    {
        return self::query("UPDATE `$table` SET `".
                implode('` = ?, `', array_keys($hodnoty)).
                "` = ? " . $podminka,
                array_merge(array_values($hodnoty), $params));
    }
    
public static function getLastId()
    {
        return self::$connection->lastInsertId();
    }    
}
?>

