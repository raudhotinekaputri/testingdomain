<?php

return [
    'menu' => [
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Produk', 'url' => 'produk'],
        ['name' => 'Acara', 'url' => 'acaras'],
        [
            'name' => 'Kelola Halaman',
            'url'  => '#',
            'submenu' => [
                ['name' => 'Kelola Acara', 'url' => 'admin/acaras'],
                ['name' => 'Kelola Produk', 'url' => 'admin/produks'],
                ['name' => 'Kelola UMKM', 'url' => 'admin/umkms'],
            ]
        ],
    ]
];
