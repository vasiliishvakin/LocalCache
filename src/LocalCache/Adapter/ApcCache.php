<?php

namespace LocalCache\Adapter;

use LocalCache\LocalCacheInterface;

class ApcCache implements LocalCacheInterface
{
    function __construct()
    {
        if (!extension_loaded('apc')) {
            throw new \RuntimeException('APC extension not loaded');
        }
    }

    public function get($id)
    {
        $data = apc_fetch($id);
        if ($data === false) {
            return null;
        }
        return $data;
    }

    public function set($id, $data, $time = 0)
    {
        return apc_add($id, $data, $time);
    }

    public function rm($id)
    {
        return apc_delete($id);
    }

    public function clear()
    {
        return apc_clear_cache('user');
    }

}