<?php

namespace LocalCache;

class LocalCache implements LocalCacheInterface
{
    /**
     * @var LocalCache
     */
    protected static $instance;

    /**
     * @var array
     */
    protected static $config;

    /**
     * @var LocalCacheInterface
     */
    protected $adapter;


    private function __construct() {}

    private function __clone() {}

    private function __wakeup() {}

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            $class = __CLASS__;
            self::$instance = new $class();
        }
        return self::$instance;
    }

    public static function setConfig(array $config = [])
    {
        self::$config = $config;
    }

    public function getConfig()
    {
        if (is_null(self::$config)) {
            self::$config =(array) Module::getConfig();
            if (isset(self::$config[__NAMESPACE__])) {
                self::$config = (array) self::$config[__NAMESPACE__];
            }
        }
        return self::$config;
    }

    /**
     * @return string
     */
    public function getAdapterClass()
    {
        if (!isset($this->getConfig()['Adapter'])) {
            return 'NoCache';
        }
        return $this->getConfig()['Adapter'];
    }

    public function getAdapter()
    {
        if (is_null($this->adapter)) {
            $adapterClass = $this->getAdapterClass();
            if (strpos($adapterClass, '\\') === false) {
                $adapterClass = '\\' . __NAMESPACE__ . '\\' . 'Adapter\\' . $adapterClass;
            }
            $this->adapter = new $adapterClass;
        }
        return $this->adapter;
    }

    function __call($name, $arguments)
    {
        $adapter = $this->getAdapter();
        if (!method_exists($adapter, $name)) {
            throw new \LogicException('Method $name not exist in adapter ' . get_class($adapter));
        }
        return call_user_func_array([$adapter, $name], $arguments);
    }

    public function get($id)
    {
        $data = $this->getAdapter()->get($id);
        return is_null($data) ? $data : unserialize($data);
    }

    public function set($id, $data, $time = 0)
    {
        return $this->getAdapter()->set($id, serialize($data), $time);
    }

    public function rm($id)
    {
        return $this->getAdapter()->rm($id);
    }

    public function clear()
    {
        return $this->getAdapter()->clear();
    }
}
