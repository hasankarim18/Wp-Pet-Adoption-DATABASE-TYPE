<?php

namespace Hasan\PetsAdoptionDatabaseTable\Modules\PetAdoption;

if (!defined('ABSPATH')) {
    exit;
}

class DisplayPets
{
    private array $args = [];
    public array $pets = [];

    public $count;

    public $tablename;

    public function __construct()
    {
        global $wpdb;
        $this->tablename = $wpdb->prefix . 'pets';
    }

    public function register()
    {
        $this->getPets();
        add_filter('template_include', [$this, 'loadTemplate'], 99);
    }

    /**
     * Fetch pets from DB with optional filters from $_GET
     */
    public function getPets(): void
    {
        global $wpdb;
        $tablename = $this->tablename;
        //   $tablename = $wpdb->prefix . 'pets';
        // echo $tablename;
        $this->args = $this->getArgs();
        $whereQuery = $this->createWhereText();
        $sql_query = "SELECT * FROM $tablename $whereQuery LIMIT 10";

        $count_query = "SELECT COUNT(*) FROM $tablename $whereQuery";


        $placeholders = array_values($this->args);

        if (!empty($placeholders)) {
            // Use prepare with dynamic values
            $this->pets = $wpdb->get_results($wpdb->prepare($sql_query, ...$placeholders));
            $this->count = $wpdb->get_results($wpdb->prepare($count_query, ...$placeholders));
        } else {
            // No filters, raw query
            $this->pets = $wpdb->get_results($sql_query);
            $this->count = $wpdb->get_results($wpdb->prepare($count_query));
        }
    }

    /**
     * Sanitize GET args
     */
    private function getArgs(): array
    {

        $params = [
            'species' => isset($_GET['species']) ? sanitize_text_field($_GET['species']) : '',
            'birthyear' => isset($_GET['birthyear']) ? intval($_GET['birthyear']) : '',
            'petweight' => isset($_GET['petweight']) ? intval($_GET['petweight']) : '',
            'favfood' => isset($_GET['favfood']) ? sanitize_text_field($_GET['favfood']) : '',
            'favhobby' => isset($_GET['favhobby']) ? sanitize_text_field($_GET['favhobby']) : '',
            'favcolor' => isset($_GET['favcolor']) ? sanitize_text_field($_GET['favcolor']) : '',
            'petname' => isset($_GET['petname']) ? sanitize_text_field($_GET['petname']) : '',
            'minweight' => isset($_GET['minweight']) ? intval($_GET['minweight']) : '',
            'maxweight' => isset($_GET['maxweight']) ? intval($_GET['maxweight']) : '',
            'minyear' => isset($_GET['minyear']) ? intval($_GET['minyear']) : '',
            'maxyear' => isset($_GET['maxyear']) ? intval($_GET['maxyear']) : '',
        ];

        // Remove empty values
        return array_filter($params, fn($value) => $value !== '');
    }

    /**
     * Build SQL WHERE clause based on args
     */
    private function createWhereText(): string
    {
        if (empty($this->args)) {
            return '';
        }

        $conditions = [];
        foreach ($this->args as $key => $value) {
            $conditions[] = $this->specificQuery($key);
        }

        return 'WHERE ' . implode(' AND ', $conditions);
    }

    /**
     * Map args to SQL placeholders
     */
    private function specificQuery(string $index): string
    {
        switch ($index) {
            case 'minweight':
                return 'petweight >= %d';
            case 'maxweight':
                return 'petweight <= %d';
            case 'minyear':
                return 'birthyear >= %d';
            case 'maxyear':
                return 'birthyear <= %d';
            default:
                return "$index = %s";
        }
    }

    /**
     * Load custom template for pet-adoption page
     */
    public function loadTemplate($template): string
    {
        if (is_page('pet-adoption')) {
            // Pass pets array to template
            set_query_var('petad_pets', $this->pets);
            set_query_var('count_pets', $this->count);

            return plugin_dir_path(__FILE__) . 'views/template-pets.php';
        }

        return $template;
    }
}