@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Job Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Job ID: {{ $jobLog->id }}</h5>
            <p><strong>Class:</strong> {{ $jobLog->class }}</p>
            <p><strong>Method:</strong> {{ $jobLog->method }}</p>
            <p><strong>Parameters:</strong> {{ json_decode($jobLog->parameters) }}</p>
            <p><strong>Status:</strong> {{ $jobLog->status }}</p>
            <p><strong>Retries:</strong> {{ $jobLog->retries }}</p>
            <p><strong>Created At:</strong> {{ $jobLog->created_at }}</p>
        </div>
    </div>

    <a href="{{ route('job.dashboard') }}" class="btn btn-primary mt-3">Back to Dashboard</a>
</div>
@endsection
