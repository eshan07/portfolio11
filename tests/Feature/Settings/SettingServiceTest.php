<?php

namespace Tests\Feature\Settings;

use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SettingServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }

    #[Test]
    public function it_stores_social_media_links()
    {
        $social = [
            'name' => 'facebook',
            'url' => 'https://facebook.com/yourprofile',
        ];

        // Get the instance of SettingService and store the social link
        $settingService = SettingService::getInstance();
        $settingService->storeSocialLinks($social['name'], $social['url']);

        // Retrieve the setting from the database
        $setting = Setting::where('name', 'facebook')->first();

        // Assert that the setting is stored correctly
        $this->assertNotNull($setting);  // Ensure setting exists
        $this->assertEquals('facebook', $setting->name);  // Assert correct name
        $this->assertEquals('https://facebook.com/yourprofile', json_decode($setting->value));  // Assert correct URL
    }
}
