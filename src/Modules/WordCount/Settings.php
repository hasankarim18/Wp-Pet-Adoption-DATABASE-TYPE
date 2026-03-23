<?php



namespace Hasan\TroviaWpWordcount\WordCount;

if (!defined('ABSPATH')) {
    exit;
}

class Settings
{
    public function register(): void
    {
        add_action('admin_init', [$this, 'settings']);
    }

    public function settings(): void
    {
        add_settings_section(
            'wcp_first_section',
            null,
            function () {
                echo '<h1><u>Word Count Settings</u></h1>';
            },
            'trovia-wordcount-settings'
        );

        register_setting('wordcountplugin', 'wcp_location', [
            'sanitize_callback' => [$this, 'sanitize_location'],
            'default' => '0',
        ]);

        add_settings_field('wcp_location', 'Display Location', [$this, 'locationHTML'], 'trovia-wordcount-settings', 'wcp_first_section');

        register_setting('wordcountplugin', 'wcp_headline_text', [
            'sanitize_callback' => 'sanitize_text_field',
            'default' => 'Hello world!',
        ]);

        add_settings_field('wcp_headline_text', 'Headline Text', [$this, 'headlineTextHTML'], 'trovia-wordcount-settings', 'wcp_first_section');

        register_setting('wordcountplugin', 'wcp_show_word_count', [
            'sanitize_callback' => [$this, 'sanitize_checkbox'],
            'default' => '1',
        ]);

        add_settings_field('wcp_show_word_count', 'Enable Word Count', [$this, 'showWordCountHTML'], 'trovia-wordcount-settings', 'wcp_first_section');

        register_setting('wordcountplugin', 'wcp_enable_character_count', [
            'sanitize_callback' => [$this, 'sanitize_checkbox'],
            'default' => '0',
        ]);

        add_settings_field('wcp_enable_character_count', 'Enable Character Count', [$this, 'enable_character_count_html'], 'trovia-wordcount-settings', 'wcp_first_section');

        register_setting('wordcountplugin', 'wcp_show_read_time', [
            'sanitize_callback' => [$this, 'sanitize_checkbox'],
            'default' => '1',
        ]);

        add_settings_field('wcp_show_read_time', 'Show read time', [$this, 'show_read_time_html'], 'trovia-wordcount-settings', 'wcp_first_section');

        register_setting('wordcountplugin', 'wcp_admin_comment', [
            'sanitize_callback' => 'sanitize_text_field',
            'default' => 'Hello world!',
        ]);

        add_settings_section(
            'wcp_second_section',
            null,
            function () {
                echo '<h1><u>Admin Comment Settings</u></h1>';
            },
            'trovia-wordcount-settings'
        );

        add_settings_field('wcp_admin_comment', 'Admin Comment', [$this, 'adminCommentHTML'], 'trovia-wordcount-settings', 'wcp_second_section');
    }

    public function sanitize_location($input)
    {
        if ($input !== '0' && $input !== '1') {
            add_settings_error('wcp_location', 'wcp_location_error', 'Display location must be within beginning or end');
            return get_option('wcp_location');
        }

        return $input;
    }

    public function sanitize_checkbox($value)
    {
        return $value === '1' ? '1' : '0';
    }

    public function show_read_time_html(): void
    {
        $value = get_option('wcp_show_read_time', '1');
        echo '<div><input value="1" type="checkbox" name="wcp_show_read_time" ' . checked($value, '1', false) . '></div>';
    }

    public function enable_character_count_html(): void
    {
        $value = get_option('wcp_enable_character_count', '0');
        echo '<input value="1" type="checkbox" name="wcp_enable_character_count" ' . checked($value, '1', false) . '>';
    }

    public function locationHTML(): void
    {
        $value = get_option('wcp_location', '0');

        echo '<select name="wcp_location">'
            . '<option value="0" ' . selected($value, '0', false) . '>Beginning of post</option>'
            . '<option value="1" ' . selected($value, '1', false) . '>End of post</option>'
            . '</select>';
    }

    public function headlineTextHTML(): void
    {
        $value = get_option('wcp_headline_text', 'Hello world!');
        echo '<div style="width: 600px;"><input style="width: 100%;display:block;" name="wcp_headline_text" type="text" value="' . esc_attr($value) . '"></div>';
    }

    public function showWordCountHTML(): void
    {
        $value = get_option('wcp_show_word_count', '1');
        echo '<div><input value="1" type="checkbox" name="wcp_show_word_count" ' . checked($value, '1', false) . '></div>';
    }

    public function adminCommentHTML(): void
    {
        $value = get_option('wcp_admin_comment', 'Hello world!');
        echo '<div style="min-width: 600px;"><input style="width: 100%;display:block;" name="wcp_admin_comment" type="text" value="' . esc_attr($value) . '"></div>';
    }
}
