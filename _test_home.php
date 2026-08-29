<?php

// Boot Laravel and dispatch a GET request to the homepage.
// This validates that the home route + blade renders without fatal errors.

define('LARAVEL_START', microtime(true));

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';

/** @var \Illuminate\Contracts\Http\Kernel $kernel */
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Illuminate\Http\Request::create('/', 'GET');

try {
    $response = $kernel->handle($request);
    echo "HTTP Status: " . $response->getStatusCode() . PHP_EOL;
    $content = $response->getContent();
    echo "Body contains hero section: " . (strpos($content, 'hero-section') !== false ? 'YES' : 'NO') . PHP_EOL;
    echo "Body contains footer: " . (strpos($content, '<footer') !== false ? 'YES' : 'NO') . PHP_EOL;
    echo "Body length: " . strlen($content) . PHP_EOL;

    // If 500, extract the exception message from the rendered error page
    if ($response->getStatusCode() === 500) {
        if (preg_match('/<title>(.*?)<\/title>/s', $content, $m)) {
            echo "Error Title: " . trim(strip_tags($m[1])) . PHP_EOL;
        }
        if (preg_match('/<pre[^>]*>(.*?)<\/pre>/s', $content, $m)) {
            echo "Error Detail: " . substr(trim(strip_tags($m[1])), 0, 1200) . PHP_EOL;
        }
        if (preg_match('/<span[^>]*class="[^"]*exception-.*?">(.*?)<\/span>/s', $content, $m)) {
            echo "Exception: " . substr(trim(strip_tags($m[1])), 0, 500) . PHP_EOL;
        }
    }
} catch (\Throwable $e) {
    echo "EXCEPTION THROWN: " . get_class($e) . PHP_EOL;
    echo "Message: " . $e->getMessage() . PHP_EOL;
    echo "File: " . $e->getFile() . ":" . $e->getLine() . PHP_EOL;
}

$kernel->terminate($request, $response ?? null);