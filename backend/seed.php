<?php
require 'vendor/autoload.php';
require 'bootstrap/app.php';

$app = app();
\Illuminate\Support\Facades\DB::connection()->getPdo();

$users = [
    ['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('admin123'), 'role' => 'admin'],
    ['name' => 'Usuario Regular', 'email' => 'user@example.com', 'password' => bcrypt('user123'), 'role' => 'user'],
];

foreach ($users as $user) {
    \App\Models\User::firstOrCreate(
        ['email' => $user['email']],
        $user
    );
}

echo "Usuarios creados exitosamente!\n";
