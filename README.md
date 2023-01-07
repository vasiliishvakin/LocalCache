> **Warning**
> Repository is outdated and abandoned! :no_entry_sign: No active development or any support! :skull_and_crossbones:

LocalCache
===========

Parts of this code are based on and/or adapted from original work by [Adam King] (https://github.com/agking/php-cache-class)

A simple PHP composer module, using the singleton design pattern to handle caching data.

Currently supports APC, but may be adapt to 'eaccelerator', 'xcache', 'file', etc.

```php
$cache = LocalCache::getInstance();
if (false !== ($data = $cache->get($id))) {
    $data = get_data_from_db($id);
    $cache->set($id, $data);
}
return $data;
```

The data is automatically serialize/unserialize in LocalCache;
