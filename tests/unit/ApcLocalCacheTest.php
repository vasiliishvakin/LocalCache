<?php
use \LocalCache\LocalCache;

class ApcLocalCacheTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        LocalCache::setConfig(['Adapter'=>'ApcCache']);
        LocalCache::getInstance()->clear();
    }

    protected function tearDown()
    {
    }

    // tests
    public function testApc()
    {
        $this->assertTrue(extension_loaded('apc'), 'APC not installed');
        $this->assertTrue((bool)ini_get('apc.enable_cli'), 'Apc not configured to work in cli mode');
        $this->assertInstanceOf("\\LocalCache\\Adapter\\ApcCache", LocalCache::getInstance()->getAdapter(), 'Apc adapter not loaded');
    }

    public function testGetAndSet()
    {
        $cache = LocalCache::getInstance();
        $id = uniqid('testApc');
        $data = uniqid('testApc');

        $result = $cache->set($id, $data);
        $this->assertTrue($result);

        $dataGet = $cache->get($id);
        $this->assertEquals($data, $dataGet);
    }

    public function testRm()
    {
        $cache = LocalCache::getInstance();
        $id = uniqid('testApc');
        $data = uniqid('testApc');

        $cache->set($id, $data);

        $cache->rm($id);
        $dataGet = $cache->get($id);

        $this->assertNull($dataGet);
    }

    public function testClear()
    {
        $cache = LocalCache::getInstance();
        $id = uniqid('testApc');
        $data = uniqid('testApc');

        $cache->set($id, $data);

        $cache->clear();
        $dataGet = $cache->get($id);

        $this->assertNull($dataGet);
    }

}