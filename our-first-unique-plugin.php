<?php

/*
    Plugin Name: Our First Unique Plugin
    Description: This is a simple plugin that does something Unique.
    Version: 1.0
    Author: Hasan Karim
    Author URI:
    License: GPL2 or later
*/
// namespace Hasan\OurFirstUniquePlugin;

if (!defined('ABSPATH')) {
    exit;
}

// if (!class_exists(Main::class) && is_readable(__DIR__ . '/vendor/autoload.php')) {
//     require_once __DIR__ . '/vendor/autoload.php';
// }

// class_exists(Main::class) || Main::instance()->init();

// Namespace = composer prefix + folder path



require_once __DIR__ . '/vendor/autoload.php';

use Hasan\OurFirstUniquePlugin\Main;

Main::instance()->init();






