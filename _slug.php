<?php
define('LARAVEL_START', microtime(true));
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$slugs = [];
$pa = App\Models\PracticeArea::where('is_active', true)->first();
$post = App\Models\BlogPost::where('status', 'published')->first();
echo "PA: ".($pa?->slug).PHP_EOL;
echo "POST: ".($post?->slug).PHP_EOL;