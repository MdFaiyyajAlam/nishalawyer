<?php
define('LARAVEL_START', microtime(true));
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$client = App\Models\User::whereHas('role', function ($q) { $q->where('slug', 'client'); })->first();
Illuminate\Support\Facades\Auth::loginUsingId($client->id);
$svc = app(App\Services\ReportService::class);
// reproduce the client dashboard query
try { echo "cases count: ".$client->cases()->count()."\\n"; } catch(\Throwable $e){ echo "cases FAIL: ".$e->getMessage()."\\n"; }
try { echo "appointments: ".App\Models\Appointment::where('client_id',$client->id)->where('date','>=',now()->toDateString())->count()."\\n"; } catch(\Throwable $e){ echo "apt FAIL: ".$e->getMessage()."\\n"; }
try {
  $apts = App\Models\Appointment::where('client_id',$client->id)->get();
  foreach($apts as $a){ echo "apt date=".($a->date)." start=".var_export($a->start_time,true)."\\n"; }
} catch(\Throwable $e){ echo "apt get FAIL: ".$e->getMessage()."\\n"; }
