<?php

// TWWC => Trovia WP Wordcount


namespace Hasan\PetsAdoptionDatabaseTable;

use Hasan\PetsAdoptionDatabaseTable\App\Trait\Singleton;
use Hasan\PetsAdoptionDatabaseTable\Modules\PetAdoption\PetAdoption;


if (!defined('ABSPATH')) {
    exit;
}


class Main
{
    use Singleton;

    private array $modules = [];



    public function init()
    {
        $this->define_constance();

        add_action('plugins_loaded', [$this, 'plugins_loaded']);

    }

    public function define_constance()
    {
        define('PETAD_VERSION', '1.0.0');
        define('PETAD_PLUGIN_AUTHOR', 'Hasan Karim');

        define(
            'PETAD_PLUGIN_URL',
            plugin_dir_url(__FILE__)
        );

        define(
            'PETAD_PLUGIN_PATH',
            plugin_dir_path(__FILE__)
        );
    }

    public function plugins_loaded()
    {
        load_plugin_textdomain(
            'TroviaWcpDomain',
            false,
            dirname(plugin_basename(dirname(__FILE__))) . '/languages'
        );
        // load classes
        $this->load_classes();
    }

    private function load_classes()
    {
        $this->modules = [
            new PetAdoption(),
        ];

        foreach ($this->modules as $module) {
            if (method_exists($module, 'register')) {
                $module->register();
            }


        }
    }

}
