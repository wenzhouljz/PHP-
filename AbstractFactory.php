<?php
/*
* 抽象工厂模式：
* 不同的选择逻辑提供不同的构造工厂，而对于多个工厂而言需要一个统一的抽象工厂的一个标准，而不对多个工厂理会内部怎么生产产品的流程
* 注意：这里和工厂方法的区别是：一系列（多个），而工厂方法只有一个。
*/
namespace AbstractFactory;
abstract class Type {
    abstract public function mobile ();
    abstract public function personalComputer ();
}
namespace Apple;
use AbstractFactory\Type;
use Apple\MobileSystem\iOS;
use Apple\PCSystem\MacOSX;
class ProductType extends Type {
    public $company = 'Apple';
    public function mobile () {
        return new iOS;
    }
    public function personalComputer () {
        return new MacOSX;
    }
}
namespace Microsoft;
use AbstractFactory\Type;
use Microsoft\MobileSystem\WindowsPhone;
use Microsoft\PCSystem\Windows;
class ProductType extends Type {
    public $company = 'Microsoft';
    public function mobile () {
        return new WindowsPhone;
    }
    public function personalComputer () {
        return new Windows;
    }
}
namespace IAbstractProduct;
abstract class System {
    abstract public function getVersion ();
}
namespace Apple\MobileSystem;
use IAbstractProduct\System;
class iOS extends System {
    public function getVersion () {
        return 'iOS 12';
    }
}
namespace Microsoft\MobileSystem;
use IAbstractProduct\System;
class WindowsPhone extends System {
    public function getVersion () {
        return 'Windows 10 Mobile';
    }
}
namespace Apple\PCSystem;
use IAbstractProduct\System;
class MacOSX extends System {
    public function getVersion () {
        return 'mac OS High Sierra 10.13.6';
    }
}
namespace Microsoft\PCSystem;
use IAbstractProduct\System;
class Windows extends System {
    public function getVersion () {
        return 'Windows 10';
    }
}

namespace Test;
use Apple\ProductType as AppleProductType;
use Microsoft\ProductType as MicrosoftProductType;


$apple = new AppleProductType;
echo($apple->mobile()->getVersion());
echo(PHP_EOL);
echo($apple->personalComputer()->getVersion());
echo(PHP_EOL);
$microsoft = new MicrosoftProductType;
echo($microsoft->mobile()->getVersion());
echo(PHP_EOL);
echo($microsoft->personalComputer()->getVersion());
echo(PHP_EOL);
