<?php

return [
    'menus' => [
        'owner' => [
            'Laporan Penjualan' => 'sales-reports.index',
            'Program Penjualan' => 'sales-programs.index',
        ],
        'admin' => [
            'User' => 'users.index',
            'Menu' => 'menus.index',
            'Pembayaran' => 'payments.index',
            'Inventory' => 'inventories.index',
        ],
        'waiters' => [
            'Meja' => 'tables.index',
            'Reservasi' => 'reservations.index',
            'Pesanan' => 'orders.index',
        ],
        'cook' => [
            'Pesanan' => 'orders.index',
        ],
        'cleaner' => [
            'Meja' => 'tables.index',
        ],
        // 'shared' => [
        //     'Dashboard' => 'dashboard',
        // ],
    ],
];
