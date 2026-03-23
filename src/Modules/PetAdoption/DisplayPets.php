<?php

namespace Hasan\PetsAdoptionDatabaseTable\Modules\PetAdoption;


if (!defined('ABSPATH')) {
    exit;
}


class DisplayPets
{
    public function register()
    {
        add_filter('template_include', array($this, 'loadTemplate'), 99);
    }

    public function loadTemplate($template)
    {
        if (is_page('pet-adoption')) {
            return plugin_dir_path(__FILE__) . 'views/template-pets.php';
        }
        return $template;
    }
}