<?php

use \LocalCache\LocalCache;

class LocalCacheTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {

    }

    protected function tearDown()
    {
    }

    // tests
    public function testGetInstance()
    {
        $cache = LocalCache::getInstance();
        $this->assertInstanceOf('\\LocalCache\\LocalCache', $cache);
    }
}