<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SettingService
{
    // Store the single instance
    private static $instance = null;

    // Prevent external instantiation
    private function __construct()
    {
    }

    // Get the instance of SettingService (Singleton)
    public static function getInstance(): SettingService
    {
        if (self::$instance === null) {
            self::$instance = new SettingService();
        }

        return self::$instance;
    }

    /**
     * Store or update a setting.
     *
     * @param string $name
     * @param mixed $value
     * @param string|null $context
     * @return Setting
     */
    public function storeSetting(string $name, $value, ?string $context = null, $settingable_type = null, $settingable_id = null): Setting
    {
        // Store or update the setting in the database
        return Setting::updateOrCreate(
            ['name' => $name],
            [
                'value' => json_encode($value), // Store complex data as JSON
                'context' => $context,
                'settingable_type' => $settingable_type,
                'settingable_id' => $settingable_id,
                'autoload' => 1, // Autoload this setting (optional)
                'public' => 1    // Public visibility
            ]
        );
    }

    /**
     * Retrieve a setting by its name.
     *
     * @param string $name
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getSetting(string $context)
    {
        $setting = Setting::select('id', 'name', 'value', 'context')->where('context', $context)->get();

        return json_decode($setting, true);
    }

    /**
     * Store or update email setup.
     *
     * @param array $emailConfig
     * @return Setting
     */
    public function storeEmailConfig(array $emailConfig): Setting
    {
        return $this->storeSetting('email', $emailConfig, 'email');
    }

    /**
     * Retrieve email configuration.
     *
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getEmailConfig()
    {
        return $this->getSetting('email');
    }

    /**
     * Store or update Pusher configuration.
     *
     * @param array $pusherConfig
     * @return Setting
     */
    public function storePusherConfig(array $pusherConfig): Setting
    {
        return $this->storeSetting('pusher', $pusherConfig, 'pusher');
    }

    /**
     * Retrieve Pusher configuration.
     *
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getPusherConfig()
    {
        return $this->getSetting('pusher');
    }

    /**
     * Store or update social media links.
     *
     * @param array $links
     * @return Setting
     */
    public function storeSocialLinks($name, $link): Setting
    {
        return $this->storeSetting($name, $link, 'social');
    }

    /**
     * Retrieve social media links.
     *
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getSocialLinks()
    {
        return $this->getSetting('social');
    }

    /**
     * Store or update application configuration (like logo, language, etc.).
     *
     * @param array $appConfig
     * @return Setting
     */
    public function storeAppConfig(array $appConfig): Setting
    {
        return $this->storeSetting('app_config', $appConfig, 'app');
    }

    /**
     * Retrieve application configuration.
     *
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getAppConfig()
    {
        return $this->getSetting('app_config');
    }
}
