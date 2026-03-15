<?php

namespace Hasan\OurFirstUniquePlugin\App\Trait;

trait Singleton
{
    private static $instance = null;

    public static function instance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }
}
