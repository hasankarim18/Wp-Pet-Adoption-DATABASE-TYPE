<?php
namespace Hasan\PetsAdoptionDatabaseTable\Modules\PetAdoption;


if (!defined('ABSPATH')) {
    exit;
}


class AdminMenu
{
    public function register()
    {
        add_action('admin_menu', [$this, 'create_menu_page']);
    }

    public function create_menu_page()
    {
        add_menu_page(
            'Pet Adoption',
            'Pet Adoption',
            'manage_options',
            'pet-adoption-db',
            [$this, 'display_pet_adoption_page'],
            'dashicons-admin-generic',
            150
        );

        add_submenu_page(
            'pet-adoption-db',
            'Pet Adoption',
            'Pet Adoption',
            'manage_options',
            'pet-adoption-db',
            [$this, 'display_pet_adoption_page'],
        );
        add_submenu_page(
            'pet-adoption-db',
            'Add Pet',
            'Add Pet',
            'manage_options',
            'pet-adoption-db-app-pet',
            [$this, 'display_pet_adoption_page_app_pet'],
        );

    }

    public function display_pet_adoption_page()
    {
        include plugin_dir_path(__FILE__) . 'views/display_pet_adoption_page.php';

    }

    public function display_pet_adoption_page_app_pet()
    {
        ?>
        <div class="wrap">
            <h2>Add pet</h2>
        </div>
        <?php
    }
}