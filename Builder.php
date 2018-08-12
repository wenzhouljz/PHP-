<?php
/*
*  建造者模式四个成员：Product（产品）、Builder（抽象建造者）、ConcreteBuilder（具体建造者）、Director（指挥者）
*/

interface Builder {
    public function create ();
    public function get ();
}

class PackageA {
    public function create ();
}