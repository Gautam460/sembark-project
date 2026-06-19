<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invite User</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Invite User</h1>

    @if ($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('invitations.store') }}">
        @csrf
        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        @if(auth()->user()->role === 'superadmin')
            <div>
                <label>Client Name (Company)</label>
                <input type="text" name="company_name" value="{{ old('company_name') }}" required>
            </div>
            <div>
                <label>Role</label>
                <select name="role">
                    <option value="admin">Admin</option>
                </select>
            </div>
        @else
            <div>
                <label>Role</label>
                <select name="role">
                    <option value="admin">Admin</option>
                    <option value="member">Member</option>
                </select>
            </div>
        @endif

        <button type="submit">Invite</button>
    </form>
    <a href="{{ route('dashboard') }}">Back to Dashboard</a>
</body>
</html>
