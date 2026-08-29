<?php
define('LARAVEL_START', microtime(true));
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$client = App\Models\User::whereHas('role', function ($q) { $q->where('slug', 'client'); })->first();
$advocate = App\Models\User::whereHas('role', function ($q) { $q->where('slug', 'advocate'); })->first();
$tests = [
    ['user' => $advocate, 'path' => '/admin', 'label' => 'admin.dashboard'],
];
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
foreach ($tests as $t) {
    if (!$t['user']) { echo $t['label'].": NO USER\n"; continue; }
    Illuminate\Support\Facades\Auth::loginUsingId($t['user']->id);
    $request = Illuminate\Http\Request::create($t['path'], 'GET');
    try {
        $resp = $kernel->handle($request);
        echo $t['label']." => ".$resp->getStatusCode()." (len ".strlen($resp->getContent()).")\n";
    } catch (\Throwable $e) { echo $t['label']." => ERROR ".$e->getMessage()."\n"; }
    $kernel->terminate($request, $resp ?? null);
}
