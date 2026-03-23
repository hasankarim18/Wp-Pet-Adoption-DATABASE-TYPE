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


    public function __construct()
    {
        //  $this->newDataBaseTable = new NewDataBaseTable;
        $this->adminMenu = new AdminMenu();
        $this->displayPets = new DisplayPets();
        $this->loadAssets = new LoadAssets();
    }
    public function register()
    {
        $this->adminMenu->register();
        $this->displayPets->register();
        $this->loadAssets->register();

    }

}

?>