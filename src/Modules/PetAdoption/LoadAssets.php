<?php
namespace Hasan\PetsAdoptionDatabaseTable\Modules\PetAdoption;


if (!defined('ABSPATH')) {
    exit;
}

class LoadAssets
{
    public function register()
    {
        add_action('wp_enqueue_scripts', array($this, 'loadAssets'));


    }

    public function loadAssets()
    {
        wp_enqueue_style('pet-adoption-style', plugin_dir_url(__FILE__) . 'pet-adoption.css');
    }
}
