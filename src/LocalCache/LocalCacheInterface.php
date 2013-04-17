<?php

namespace LocalCache;

interface LocalCacheInterface
{
    public function get($id);
    public function set($id, $data, $time = 0);
    public function rm($id);
    public function clear();
}