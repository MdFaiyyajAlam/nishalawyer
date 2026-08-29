<?php
define('LARAVEL_START', microtime(true));
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$routes = [
    '/practice-areas/family-law' => 'practice-area-detail',
    '/blog/supreme-court-women-property' => 'blog-detail',
];

foreach ($routes as $path => $name) {
    $request = Illuminate\Http\Request::create($path, 'GET');
    try {
        $response = $kernel->handle($request);
        echo str_pad($name, 22) . " => " . $response->getStatusCode() . PHP_EOL;
    } catch (\Throwable $e) {
        echo str_pad($name, 22) . " => ERROR: " . get_class($e) . " - " . substr($e->getMessage(), 0, 150) . PHP_EOL;
    }
    $kernel->terminate($request, $response ?? null);
}