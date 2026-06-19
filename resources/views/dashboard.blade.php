<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - URL Shortener</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }} (Role: {{ auth()->user()->role }})</p>

    <nav>
        <ul>
            @if(in_array(auth()->user()->role, ['superadmin', 'admin']))
                <li><a href="{{ route('invitations.create') }}">Invite User</a></li>
            @endif
            <li><a href="{{ route('short_urls.index') }}">Manage Short URLs</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
</body>
</html>
