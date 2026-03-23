<?php

/*
    Plugin Name: Pet Adoption (NEW DB TABLE)
    Description: Pet adoption Database Table
    Version: 1
    Version: 1.0
    Author: Hasan Karim
    Author URI:
    License: GPL2 or later
*/
// namespace Hasan\OurFirstUniquePlugin;




if (!defined('ABSPATH')) {
    exit;
}


require_once __DIR__ . '/vendor/autoload.php';

use Hasan\PetsAdoptionDatabaseTable\Main;

Main::instance()->init();

register_activation_hook(__FILE__, 'register_activation_hook_cb');

function register_activation_hook_cb()
{
    // Register activation hook on PetAdoption
    $newDB = new Hasan\PetsAdoptionDatabaseTable\Modules\PetAdoption\NewDataBaseTable();
    $newDB->onActivate();
}

// register_deactivation_hook(__FILE__, [$newDB, 'onDeactivate'] ?? function () { });
