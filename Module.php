<?php

namespace LocalCache;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getTestingConfig()
    {
        if (!is_readable(__DIR__ . '/config/module.testing.config.php')) {
            return [];
        }

        return include __DIR__ . '/config/module.testing.config.php';
    }
}