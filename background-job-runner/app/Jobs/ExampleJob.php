<?php
namespace App\Jobs;
use Illuminate\Support\Facades\Log;

class ExampleJob
{
    public function run($params = [])
    {
        Log::info("ExampleJob is running with parameters:", $params);
        if (isset($params['param'])) {
            Log::info("Received param: " . $params['param']);
        } else {
            Log::info("No parameters provided.");
        }
    }
}
