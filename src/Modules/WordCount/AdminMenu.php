<?php

namespace Hasan\TroviaWpWordcount\WordCount;

class AdminMenu
{
    private SettingsPage $settingsPage;

    public function __construct(SettingsPage $settingsPage)
    {
        $this->settingsPage = $settingsPage;
    }

    public function register(): void
    {
        add_action('admin_menu', [$this, 'addOptionsPage']);
    }

    public function addOptionsPage(): void
    {
        add_options_page(
            'Word Count Settings',
            __('Word Count', 'TroviaWcpDomain'),
            'manage_options',
            'trovia-wordcount-settings',
            [$this->settingsPage, 'render']
        );
    }
}
