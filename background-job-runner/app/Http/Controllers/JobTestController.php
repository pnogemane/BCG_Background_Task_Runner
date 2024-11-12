<?php

namespace App\Http\Controllers;

use App\Jobs\ExampleJob;

class JobTestController extends Controller
{
    public function runJob()
    {
        runBackgroundJob(ExampleJob::class, 'run', ['param' => 'test']);
        return response()->json(['message' => 'Job dispatched successfully']);
    }
}
