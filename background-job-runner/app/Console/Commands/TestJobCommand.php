<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ExampleJob;

class TestJobCommand extends Command
{
    protected $signature = 'job:test';
    protected $description = 'Test background job execution';

    public function handle()
    {
        runBackgroundJob(ExampleJob::class, 'run', ['param' => 'test']);
        $this->info('Job dispatched in the background!');
    }
}
