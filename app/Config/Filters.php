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
        
        // 1. DIUBAH: Menggunakan namespace standard filter CI4
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
            // 2. DIUBAH: Dari 'FilterAuth' menjadi 'filterauth' (huruf kecil semua)
            'filterauth' => [
                'except' => [
                    'Auth', 'Auth/*',
                    'Home', 'Home/*',
                ]
            ]
        ],
        'after' => [
            'toolbar',
            'filterauth' => [
                'except' => [
                    'Auth', 'Auth/*',
                    'Admin', 'Admin/*',
                    'Home', 'Home/*',
                    'Wilayah', 'Wilayah/*',
                    'Kategori', 'Kategori/*',
                    'Bengkel', 'Bengkel/*',
                    'User', 'User/*',
                ]
            ],
        ],
    ];

    public array $methods = [];

    public array $filters = [];
}