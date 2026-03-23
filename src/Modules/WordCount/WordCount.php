<?php

namespace Hasan\TroviaWpWordcount\WordCount;

class WordCount
{
    private AdminMenu $adminMenu;
    private Settings $settings;
    private SettingsPage $settingsPage;

    private IfWrap $ifWrap;


    public function __construct()
    {
        $this->settingsPage = new SettingsPage();
        $this->adminMenu = new AdminMenu($this->settingsPage);
        $this->settings = new Settings();
        $this->ifWrap = new IfWrap();

    }

    public function init(): void
    {

        add_action('init', [$this, 'load_classes']);


    }

    public function load_classes(): void
    {
        $this->adminMenu->register();
        $this->settings->register();
        $this->ifWrap->register();
    }

}


