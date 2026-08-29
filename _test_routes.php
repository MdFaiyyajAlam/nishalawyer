<?php

define('LARAVEL_START', microtime(true));
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$routes = [
    '/' => 'home',
    '/about' => 'about',
    '/practice-areas' => 'practice-areas',
    '/faq' => 'faq',
    '/contact' => 'contact',
    '/blog' => 'blog',
    '/login' => 'login',
    '/register' => 'register',
    '/forgot-password' => 'forgot-password',
    '/privacy-policy' => 'privacy-policy',
    '/terms-of-service' => 'terms-of-service',
    '/legal-notice' => 'legal-notice',
];

foreach ($routes as $path => $name) {
    $request = Illuminate\Http\Request::create($path, 'GET');
    try {
        $response = $kernel->handle($request);
        $status = $response->getStatusCode();
        echo str_pad($name, 20) . " => " . $status . PHP_EOL;
    } catch (\Throwable $e) {
        echo str_pad($name, 20) . " => ERROR: " . get_class($e) . " - " . substr($e->getMessage(), 0, 120) . PHP_EOL;
    }
    $kernel->terminate($request, $response ?? null);
}