<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Job Dashboard</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="/run-job" method="POST">
            @csrf
            <div class="mb-3">
                <label for="class" class="form-label">Job Class</label>
                <input type="text" id="class" name="class" class="form-control" placeholder="App\Jobs\ExampleJob" required>
            </div>
            <div class="mb-3">
                <label for="method" class="form-label">Job Method</label>
                <input type="text" id="method" name="method" class="form-control" placeholder="run" required>
            </div>
            <button type="submit" class="btn btn-primary">Run Job</button>
        </form>

        <h3 class="mt-5">Job Logs</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Class</th>
                    <th>Method</th>
                    <th>Parameters</th>
                    <th>Status</th>
                    <th>Retries</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                    <tr>
                        <td>{{ $job->id }}</td>
                        <td>{{ $job->class }}</td>
                        <td>{{ $job->method }}</td>
                        <td>{{ $job->parameters }}</td>
                        <td>{{ $job->status }}</td>
                        <td>{{ $job->retries }}</td>
                        <td>{{ $job->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
