### 1. 单例模式【Singleton】
>在运行时为某个特定的类创建仅有一个可访问的实例。
**思路**：
&nbsp;&nbsp;同一个类的静态属性可以看作所有实例化对象的共有数据。

```php
<?php
// 创建一个单例模式
class Database
{
    private static $db;// 该属性用来保存实例
    private function __construct () {}// 构造函数为private,防止创建对象
    public static function connect ()// 创建一个用来实例化对象的方法
    {
        if (!(self::$db instanceof Pdo))// 通过$db来保存pdo一个实例数据库连接
            self::$db = new Pdo('mysql:host=127.0.0.1;dbname=test', 'root', '');
        return self::$db;
    }
    private function __clone ()// 防止对象被复制
    {
        trigger_error('禁止对象被复制!');
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
php?>
```
>以上代码在执行中的时候，我们可以切换到```mysql```终端，利用```mysql```的```show processlist```查看```mysql```的连接详情，按照单例模式来说```$db1```和```$db2```它们使用只有一个```Pdo```类的实例化所以mysql的连接数算一个，```$db3,$db4,$db5```三个连接数，再加上```mysql```终端一个连接数一共是五个
<br>

![image](https://github.com/wenzhouljz/php-design-patterns/blob/master/processlist.jpg?raw=true)
