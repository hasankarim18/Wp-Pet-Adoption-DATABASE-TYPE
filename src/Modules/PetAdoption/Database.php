<?php

namespace Hasan\PetsAdoptionDatabaseTable\Modules\PetAdoption;
require_once plugin_dir_path(__FILE__) . 'inc/generatePet.php';

if (!defined('ABSPATH')) {
    exit;
}

class Database extends DisplayPets
{
    private DisplayPets $displayPets;
    public function __construct(DisplayPets $displayPets)
    {
        $this->displayPets = $displayPets;



        //  throw new \Exception('Not implemented');
    }
    public function register()
    {
        add_action('admin_post_createpet', array($this, 'createPetHandler'));
        add_action('admin_post_nopriv_createpet', array($this, 'createPetHandler'));
        // delete pet
        add_action('admin_post_deletepet', array($this, 'deletePetHandler'));
        add_action('admin_post_nopriv_deletepet', array($this, 'deletePetHandler'));
    }

    public function createPetHandler()
    {
        // echo "dataaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaabaasassssssssssssssssssssssssss";
        if (current_user_can('administrator')) {
            $pet = generatePet();
            $pet['petname'] = isset($_POST['incommingpetname']) ? sanitize_text_field($_POST['incommingpetname']) : '';
            global $wpdb;

            $tablename = $this->displayPets->tablename;
            echo $tablename;

            $wpdb->insert($tablename, $pet);
            wp_safe_redirect(site_url('/pet-adoption'));
            exit();

        } else {
            wp_safe_redirect(site_url('/'));
            exit();
        }



    }

    public function deletePetHandler()
    {
        if (current_user_can('administrator')) {
            global $wpdb;
            $postId = $_POST['id'];
            $wpdb->delete($wpdb->prefix . 'pets', ['id' => $postId]);
            wp_safe_redirect(site_url('/pet-adoption'));
        } else {
            wp_safe_redirect(site_url('/'));
        }
        exit();
    }
}

?>