<?php
namespace Hasan\PetsAdoptionDatabaseTable\Modules\PetAdoption;


if (!defined('ABSPATH')) {
    exit;
}


class PetAdoption
{
    //  private NewDataBaseTable $newDataBaseTable;
    private AdminMenu $adminMenu;
    private DisplayPets $displayPets;
    private LoadAssets $loadAssets;

    private Database $database;



    public function __construct()
    {
        $this->adminMenu = new AdminMenu();
        $this->displayPets = new DisplayPets();
        $this->loadAssets = new LoadAssets();
        // inject Displaypet intor Database
        $this->database = new Database($this->displayPets);

    }
    public function register()
    {
        //  $this->newDataBaseTable = new NewDataBaseTable;

        /**8888888888888888 */
        $this->adminMenu->register();
        $this->displayPets->register();
        $this->loadAssets->register();
        $this->database->register();

    }

}

?>