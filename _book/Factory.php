<?php
/*
* 简单工厂模式是通过一个静态方法来创建对象的。
*/
interface Stationery {
    public function name ();
}
class Pen implements Stationery {
    public function name () {
        return __CLASS__;
    }
}

class Pencil implements Stationery {
    public function name () {
        return __CLASS__;
    }
    public function buy ($color) {
        return '买了一只'.$color.'铅笔';
    }
}

class Factory {
    public static function __callStatic ($classname, $args) {
        $classname = ucwords($classname);
        if (class_exists($classname)) {
            if (count($args) == 0) {
                return new $classname();
            } else {
                $method = $args[0];
                unset($args[0]);
                $arguments = $args;
                return call_user_func_array([$classname, $method], $arguments);
            }
        }
        trigger_error('当前不存在'. $classname .'该类.');
    }
}

$factory = new Factory;
// var_dump($factory::pen());
// var_dump($factory::pencil());
// var_dump($factory::eraser());
echo $factory::pen('name');
echo PHP_EOL;
echo $factory::pencil('buy','黑色');
echo PHP_EOL;
