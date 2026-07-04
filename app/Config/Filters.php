<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseFilters
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
        
        // Menggunakan namespace standard filter CI4
        'filterauth'    => \App\Filters\FilterAuth::class, 
    ];

    /**
     * List of special required filters.
     */
    public array $required = [
        'before' => [
            'forcehttps',
            'pagecache',
        ],
        'after' => [
            'pagecache',
            'performance',
            'toolbar',
        ],
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     */
    public array $globals = [
        'before' => [
            'filterauth' => [
                'except' => [
                    'auth', 'auth/*',
                    'home', 'home/*',
                    'kontak', 'kontak/*',
                    'tentang', 'tentang/*',
                    'peta', 'peta/*' // <-- Mengizinkan halaman peta diakses sebelum login
                ]
            ]
        ],
        'after' => [
            'toolbar',
            'filterauth' => [
                'except' => [
                    'auth', 'auth/*',
                    'admin', 'admin/*',
                    'home', 'home/*',
                    'wilayah', 'wilayah/*',
                    'kategori', 'kategori/*',
                    'bengkel', 'bengkel/*',
                    'user', 'user/*',
                    'kontak', 'kontak/*',
                    'tentang', 'tentang/*',
                    'peta', 'peta/*' // <-- Mengizinkan halaman peta diakses setelah login agar tidak bentrok
                ]
            ],
        ],
    ];

    public array $methods = [];

    public array $filters = [];
}