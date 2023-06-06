<?php

namespace App\Core;

class Singleton
{
    private static array $instances = [];

    protected function __construct() { }
    protected function __clone() { }

    /**
     * Get or create new class instance
     * @return mixed
     */
    public static function getInstance()
    {
        $subclass = static::class;
        if (!isset(self::$instances[$subclass])) {
            self::$instances[$subclass] = new static();
        }
        return self::$instances[$subclass];
    }
}