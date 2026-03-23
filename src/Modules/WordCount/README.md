# WordCount Module

This folder contains the Word Count plugin feature split into modular classes for maintainability and clarity.

## Files

- `WordCount.php` - Main orchestration class (facade) used by `Main`.
- `AdminMenu.php` - Hook into `admin_menu` and register the options page.
- `Settings.php` - Register settings sections/fields and provide sanitization + HTML callbacks.
- `SettingsPage.php` - Render the settings page UI and display current option values.

---

## Architecture

The module uses a simple composition structure:

- `WordCount` constructs dependencies:
  - `AdminMenu(SettingsPage)`
  - `Settings`
- `WordCount::init()` registers the hooks
  - `AdminMenu::register()` → `admin_menu` → options page
  - `Settings::register()` → `admin_init` → settings API registration

This keeps each class focused on a single responsibility.

---

## Syntax explanation

### `WordCount.php`

```php
namespace Hasan\TroviaWpWordcount\WordCount;

class WordCount
{
    private AdminMenu $adminMenu;
    private Settings $settings;
    private SettingsPage $settingsPage;

    public function __construct()
    {
        $this->settingsPage = new SettingsPage();
        $this->adminMenu = new AdminMenu($this->settingsPage);
        $this->settings = new Settings();
    }

    public function init(): void
    {
        $this->adminMenu->register();
        $this->settings->register();
    }
}
```

- `__construct` builds the subcomponents.
- `init` attaches hooks with WordPress.

### `AdminMenu.php`

- `register` uses `add_action('admin_menu', ...)`.
- `addOptionsPage` calls `add_options_page` with `SettingsPage::render` callback.

### `Settings.php`

- `register` uses `add_action('admin_init', ...)`.
- `settings` registers all settings and fields.
- Sanitizers:
  - `sanitize_location`, `sanitize_checkbox`.
- HTML render callbacks use `checked()` and `selected()`.

### `SettingsPage.php`

- `render` outputs the admin page and includes:
  - `settings_fields('wordcountplugin')`
  - `do_settings_sections('trovia-wordcount-settings')`
  - `submit_button()`

---

## Workflow

1. `Main::plugins_loaded` calls `load_classes()`.
2. `new WordCount()` object is created with all dependencies.
3. `WordCount::init()` registers the AdminMenu and Settings.
4. In admin area:
   - menu entry appears under `Settings > Word Count`.
   - fill form elements and save options.
   - options are sanitized by `Settings` class.
5. Data is visible in the panel of `SettingsPage`.

---

## Usage example in `Main.php`

```php
use Hasan\TroviaWpWordcount\WordCount\WordCount;

class Main
{
    public function load_classes()
    {
        $this->wordCount = new WordCount();
        $this->wordCount->init();
    }
}
```

---

## Notes on extension

- Add new option by:
  1. `register_setting` in `Settings::settings()`.
  2. `add_settings_field` with callback method.
  3. new callback method in `Settings` to print input.
  4. read with `get_option('your_option_key')`.

- If logic grows, split `Settings` into `SettingsRegister` + `SettingsFields`.
