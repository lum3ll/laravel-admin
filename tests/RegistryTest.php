<?php

use LaravelAdmin\Registry;

class RegistryTest extends PHPUnit_Framework_Testcase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRegistryThrowsExceptionWhenNotInstanceOfModel()
    {
        $registry = new Registry;
        $registry->add('invalid', $this);
    }
}