@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Background Job Dashboard</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Job ID</th>
                <th>Class</th>
                <th>Method</th>
                <th>Status</th>
                <th>Retries</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobLogs as $job)
            <tr>
                <td>{{ $job->id }}</td>
                <td>{{ $job->class }}</td>
                <td>{{ $job->method }}</td>
                <td>{{ $job->status }}</td>
                <td>{{ $job->retries }}</td>
                <td><a href="{{ route('job.detail', $job->id) }}" class="btn btn-info">View Details</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
