<?php

namespace Hasan\OurFirstUniquePlugin;

use Hasan\OurFirstUniquePlugin\App\Trait\Singleton;
use Hasan\OurFirstUniquePlugin\BlogContentEdit\BlogContentEdit;

class Main
{
    use Singleton;

    public function init()
    {
        $this->define_constance();

        add_action('plugins_loaded', [$this, 'plugins_loaded']);
    }

    public function define_constance()
    {
        define('OUR_FIRST_UNIQUE_PLUGIN_VERSION', '1.0.0');
        define('OUR_FIRST_UNIQUE_PLUGIN_AUTHOR', 'Hasan Karim');

        define(
            'OUR_FIRST_UNIQUE_PLUGIN_URL',
            plugin_dir_url(dirname(__DIR__))
        );

        define(
            'OUR_FIRST_UNIQUE_PLUGIN_PATH',
            plugin_dir_path(dirname(__DIR__))
        );
    }

    public function plugins_loaded()
    {
        load_plugin_textdomain(
            'our-first-unique-plugin',
            false,
            dirname(plugin_basename(dirname(__DIR__))) . '/languages'
        );
        // load classes
        $this->load_classes();
    }

    private function load_classes()
    {
        $blog = new BlogContentEdit();
        $blog->init();
    }
}
