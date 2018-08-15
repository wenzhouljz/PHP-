<?php
// 创建一个单例模式
class Database
{
    private static $db;
    private function __construct () {}
    public static function connect ()
    {
        if (!(self::$db instanceof Pdo))
            self::$db = new Pdo('mysql:host=127.0.0.1;dbname=test', 'root', '');
        return self::$db;
    }
    private function __clone ()
    {
        trigger_error('Clone is not allowed !');
    }
}

$db1 = Database::connect();
$db2 = Database::connect();

$db3 = new Pdo('mysql:host=127.0.0.1;dbname=test', 'root', '');
$db4 = new Pdo('mysql:host=127.0.0.1;dbname=test', 'root', '');
$db5 = new Pdo('mysql:host=127.0.0.1;dbname=test', 'root', '');
$cmd = null;
while (!($cmd === 'quit')) {
    $cmd = trim(fgets(STDIN));
}