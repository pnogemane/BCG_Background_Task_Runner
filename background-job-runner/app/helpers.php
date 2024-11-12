<?php

if (!function_exists('runBackgroundJob')) {
    function runBackgroundJob($class, $method, $params = [], $retries = 3) {
        if (!class_exists($class) || !method_exists($class, $method)) {
            \Log::error("Invalid job: $class::$method");
            return false;
        }

        $job = \App\Models\JobLog::create([
            'class' => $class,
            'method' => $method,
            'parameters' => json_encode($params),
            'status' => 'pending',
            'retries' => $retries
        ]);

        $command = PHP_OS === 'WINNT'
            ? "start /b php artisan job:run $job->id"
            : "php artisan job:run $job->id &";
        exec($command);

        return true;
    }
}
