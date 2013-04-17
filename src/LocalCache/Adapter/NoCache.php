<?php

namespace LocalCache\Adapter;

use LocalCache\LocalCacheInterface;

class NoCache implements LocalCacheInterface
{
    public function get($id)
    {
        return null;
    }

    public function set($id, $data, $time = null)
    {
        return true;
    }

    public function rm($id)
    {
        return true;
    }

    public function clear()
    {
        return true;
    }

}