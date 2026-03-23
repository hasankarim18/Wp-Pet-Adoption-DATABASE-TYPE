<?php

namespace Hasan\TroviaWpWordcount\WordCount;

class SettingsPage
{
    public function render(): void
    {
        ?>
        <div class="wrap">
            <div style="display: flex; gap:30px;">
                <div>
                    <h1>Word Count Settings</h1>
                    <form action="options.php" method="POST">
                        <?php
                        settings_fields('wordcountplugin');
                        do_settings_sections('trovia-wordcount-settings');
                        submit_button();
                        ?>
                    </form>
                </div>
                <div>
                    <h1>
                        <?php $position = get_option('wcp_location'); ?>
                        Location: <?php echo esc_html($position === '0' ? 'Beginning of post' : 'End of post'); ?>
                    </h1>
                    <h2>
                        <?php $adminComment = get_option('wcp_admin_comment', 'Hello world!'); ?>
                        Admin Comment: <?php echo esc_html($adminComment); ?>
                    </h2>
                    <h2>checkbox: <?php echo esc_html(get_option('wcp_show_word_count')); ?></h2>
                    <h2>wcp_enable_character_count: <?php echo esc_html(get_option('wcp_enable_character_count')); ?></h2>
                    <h2>wcp_show_read_time: <?php echo esc_html(get_option('wcp_show_read_time')); ?></h2>
                </div>
            </div>
        </div>
        <?php
    }
}
