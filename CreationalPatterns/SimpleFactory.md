# 2. 工厂模式【Factory】
>工厂类负责创建的对象比较少，客户只需要传入工厂类参数，对于如何创建对象（逻辑）不关心。简单工厂模式很容易违反高内聚低耦合的原则，因此一般只在很简单的情况下使用。

```php
<?php
/*
* 对象实例的生产工厂。某些意义上，工厂模式提供了通用的方法有助于我们去获取对象，而不需要关心其具体的内在的实现。
*/
class Pen {}

class Pencil {}

class Factory {
    public function get ($classname) {
        $classname = ucwords($classname);
        if (class_exists($classname)) {
            return new $classname();
        }
        trigger_error('当前不存在'. $classname .'该类.');
    }
}

$factory = new Factory;
var_dump($factory->get('pen'));
var_dump($factory->get('pencil'));
?>
```