<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

try {
    \Illuminate\Support\Facades\Artisan::call('migrate', [
        '--force' => true
    ]);
    \Illuminate\Support\Facades\Artisan::call('db:seed', [
        '--force' => true
    ]);
    
    echo "<h1>Database Berhasil Dibuat dan Diisi (Migrated & Seeded)!</h1>";
    echo "<pre>" . \Illuminate\Support\Facades\Artisan::output() . "</pre>";
    echo "<br><br><b>PENTING:</b> Harap hapus file <code>migrate.php</code> ini demi keamanan setelah Anda melihat pesan ini!";
} catch (\Exception $e) {
    echo "<h1>Gagal melakukan migrasi database!</h1>";
    echo "<p>Pesan Error: " . $e->getMessage() . "</p>";
    echo "<b>Tips:</b> Pastikan koneksi database di file .env sudah diisi dengan benar sesuai data dari InfinityFree.";
}
