<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Short URLs</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Short URLs</h1>

    @if (session('status'))
        <div class="alert-success">{{ session('status') }}</div>
    @endif

    @if(in_array(auth()->user()->role, ['admin', 'member']))
        <a href="{{ route('short_urls.create') }}">Create New Short URL</a>
    @endif

    <table>
        <thead>
            <tr>
                <th>Original URL</th>
                <th>Short URL</th>
                <th>Created By</th>
                <th>Company</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shortUrls as $url)
                <tr>
                    <td>{{ $url->original_url }}</td>
                    <td>
                        <a href="{{ route('short_urls.redirect', $url->short_code) }}" target="_blank">
                            {{ route('short_urls.redirect', $url->short_code) }}
                        </a>
                    </td>
                    <td>{{ $url->user->name ?? 'N/A' }}</td>
                    <td>{{ $url->company->name ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <br>
    <a href="{{ route('dashboard') }}">Back to Dashboard</a>
</body>
</html>
