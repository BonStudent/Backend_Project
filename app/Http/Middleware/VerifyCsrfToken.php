<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/*', // Example: Exclude all routes under 'api' prefix
        '/get_details',
        '/add_details',
        '/update_details/*',
        '/get_accounts',
        '/add_accounts',
        '/update_accounts/*',
        '/get_remarks/', 
        '/add_remarks/', 
        '/update_remarks/*',
        '/get_recommendation/', 
        '/add_recommendation/', 
        '/update_recommendation/*',
        '/get_mtsrstatus/', 
        '/add_mtsrstatus/', 
        '/update_mtsrstatus/*',
        '/get_files/', 
        '/add_uploads/',
        '/update_uploads/*',
        '/add_images',
        '/update_images/*',
        '/get_images/',
        
    ];
}
