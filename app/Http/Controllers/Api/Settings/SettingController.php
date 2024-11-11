<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }
    public function storeEmailConfig(Request $request)
    {
        $validated = $request->validate([
            'host' => 'required|string',
            'port' => 'required|integer',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Store email configuration
        $this->settingService->storeEmailConfig($validated);

        return response()->json(['message' => 'Email configuration stored successfully'], 201);
    }

    /**
     * Get email configuration.
     */
    public function getEmailConfig()
    {
        $emailConfig = $this->settingService->getEmailConfig();

        return response()->json($emailConfig);
    }

    /**
     * Store or update Pusher configuration.
     */
    public function storePusherConfig(Request $request)
    {
        $validated = $request->validate([
            'app_id' => 'required|string',
            'key' => 'required|string',
            'secret' => 'required|string',
        ]);

        $this->settingService->storePusherConfig($validated);

        return response()->json(['message' => 'Pusher configuration stored successfully'], 201);
    }

    /**
     * Get Pusher configuration.
     */
    public function getPusherConfig()
    {
        $pusherConfig = $this->settingService->getPusherConfig();

        return response()->json($pusherConfig);
    }

    /**
     * Store or update social media links.
     */
    public function storeSocialLinks(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'link' => 'required|url',
        ]);

        $this->settingService->storeSocialLinks($validated['name'], $validated['link']);

        return response()->json(['message' => ucfirst($validated['name']).' link stored successfully'], 201);
    }

    /**
     * Get social media links.
     */
    public function getSocialLinks()
    {
        $socialLinks = $this->settingService->getSocialLinks();

        return response()->json($socialLinks);
    }

    /**
     * Store or update application configuration (like logo, language, etc.).
     */
    public function storeAppConfig(Request $request)
    {
        $validated = $request->validate([
            'logo_url' => 'required|url',
            'language' => 'required|string',
        ]);

        $this->settingService->storeAppConfig($validated);

        return response()->json(['message' => 'App configuration stored successfully'], 201);
    }

    /**
     * Get application configuration.
     */
    public function getAppConfig()
    {
        $appConfig = $this->settingService->getAppConfig();

        return response()->json($appConfig);
    }
}
