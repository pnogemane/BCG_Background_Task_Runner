<?php

use Illuminate\Support\Facades\Route;
use App\Models\JobLog;
use Illuminate\Http\Request;

Route::get('/', function () {
    $jobs = JobLog::all();
    return view('welcome', compact('jobs'));
});

Route::post('/run-job', function (Request $request) {
    $validated = $request->validate([
        'class' => 'required|string',
        'method' => 'required|string',
    ]);

    $class = $validated['class'];
    $method = $validated['method'];
    $params = [];  // Adjust as needed for parameter handling

    if (class_exists($class) && method_exists($class, $method)) {
        runBackgroundJob($class, $method, $params);
        return back()->with('success', 'Job dispatched in the background!');
    }

    return back()->withErrors(['error' => 'Invalid class or method.']);
});
