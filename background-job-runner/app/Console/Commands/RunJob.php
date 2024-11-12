<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JobLog;

class RunJob extends Command
{
    protected $signature = 'job:run {id}';
    protected $description = 'Run a specific job by ID';

    public function handle()
    {
        $id = $this->argument('id');
        $jobLog = JobLog::find($id);

        if (!$jobLog) {
            $this->error("Job with ID $id not found.");
            return;
        }

        $jobLog->status = 'in_progress';
        $jobLog->save();

        try {
            $class = $jobLog->class;
            $method = $jobLog->method;
            $parameters = json_decode($jobLog->parameters, true) ?? [];

            if (class_exists($class) && method_exists($class, $method)) {
                $instance = new $class();
                call_user_func_array([$instance, $method], $parameters);

                $jobLog->status = 'completed';
            } else {
                $jobLog->status = 'failed';
                $this->error("Invalid job class or method.");
            }
        } catch (\Exception $e) {
            $jobLog->status = 'failed';
            $jobLog->retries--;

            if ($jobLog->retries > 0) {
                $jobLog->save();
                $this->error("Job failed, retrying... Retries left: {$jobLog->retries}");
                exec("php artisan job:run {$jobLog->id}");
            } else {
                $this->error("Job permanently failed: {$e->getMessage()}");
            }
        }

        $jobLog->save();
    }
}
