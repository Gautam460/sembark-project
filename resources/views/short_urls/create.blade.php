<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Short URL</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Create Short URL</h1>

    @if ($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('short_urls.store') }}">
        @csrf
        <div>
            <label>Original URL</label>
            <input type="url" name="original_url" value="{{ old('original_url') }}" required>
        </div>

        <button type="submit">Shorten</button>
    </form>
    
    <br>
    <a href="{{ route('short_urls.index') }}">Back to List</a>
</body>
</html>
