# PHP的23种设计模式
>设计模式的目的是为了代码可重用性、让代码更容易被他人理解、保证代码可靠性。
>设计模式类型也分为创建设计模式结构设计模式、行为设计模式、类的设计模式，以及对象设计模式

[toc]

## 创建设计模式（Creational Patterns）
>创建设计模式（Creational Patterns）(5种)：
>&nbsp;&nbsp;&nbsp;&nbsp;用于创建对象时的设计模式。更具体一点，初始化对象流程的设计模式。当程序日益复杂时，需要更加灵活地创建对象，同时减少创建时的依赖。而创建设计模式就是解决此问题的一类设计模式

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

### 1. 工厂模式【Factory】
>对象实例的生产工厂。某些意义上，工厂模式提供了通用的方法有助于我们去获取对象，而不需要关心其具体的内在的实现。

```php
<?php
/*
* 对象实例的生产工厂。某些意义上，工厂模式提供了通用的方法有助于我们去获取对象，而不需要关心其具体的内在的实现。
*/
class Pen {}

class Pencil {}

class Factory {
    public function __get ($classname) {
        $classname = ucwords($classname);
        if (class_exists($classname)) {
            return new $classname();
        }
        trigger_error('当前不存在'. $classname .'该类.');
    }
}

$factory = new Factory;
var_dump($factory->pen);
var_dump($factory->pencil);
var_dump($factory->eraser);
?>
```

### 2. 抽象工厂模式【AbstractFactory】
>不同的选择逻辑提供不同的构造工厂，而对于多个工厂而言需要一个统一的抽象工厂，和工厂方法的区别是：一系列（多个），而工厂方法只有一个。

```php
<?php
abstract class BaseArea {
    const PI = 3.14;
    abstract public function area ($p1,$p2);
    public function name () {
        return static::class;
    }
}

class Circle extends BaseArea {
    public function area ($p1,$p2) {
        return $this->name() . ': ' . ((double) static::PI*$p1*$p2);
    }
}

class Triangle extends BaseArea {
    public function area ($p1,$p2) {
        return $this->name() . ': ' . ((double) $p1 * $p2 * 0.5);
    }
}

class Rectangle extends BaseArea {
    public function area ($p1,$p2) {
        return $this->name() . ': ' . ((double) $p1 * $p2);
    }
}

echo (new Circle)->area(1,2);// 椭圆公式 PI * a * b
echo PHP_EOL;
echo (new Circle)->area(2,2);// 圆公式 PI * r * r
echo PHP_EOL;
echo (new Triangle)->area(4,2);// 三角形公式 1/2 * a * h
echo PHP_EOL;
echo (new Rectangle)->area(4,2);// 矩形公式 l * w
echo PHP_EOL;
```
