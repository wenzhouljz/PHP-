<?php
/*
* 抽象工厂模式：
* 不同的选择逻辑提供不同的构造工厂，而对于多个工厂而言需要一个统一的抽象工厂
* 注意：这里和工厂方法的区别是：一系列（多个），而工厂方法只有一个。
*/
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
