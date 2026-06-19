<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortUrlRequest;
use App\Models\ShortUrl;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'superadmin') {
            $shortUrls = ShortUrl::all();
        } elseif ($user->role === 'admin') {
            $shortUrls = ShortUrl::where('company_id', $user->company_id)->get();
        } else {
            // member
            $shortUrls = ShortUrl::where('user_id', $user->id)->get();
        }

        return view('short_urls.index', compact('shortUrls'));
    }

    public function create()
    {
        if (auth()->user()->role === 'superadmin') {
            abort(403, 'SuperAdmin cannot create short urls.');
        }

        return view('short_urls.create');
    }

    public function store(StoreShortUrlRequest $request)
    {
        if (auth()->user()->role === 'superadmin') {
            abort(403, 'SuperAdmin cannot create short urls.');
        }

        $data = $request->validated();

        $shortCode = Str::random(6);
        while (ShortUrl::where('short_code', $shortCode)->exists()) {
            $shortCode = Str::random(6);
        }

        ShortUrl::create([
            'original_url' => $data['original_url'],
            'short_code' => $shortCode,
            'user_id' => auth()->id(),
            'company_id' => auth()->user()->company_id,
        ]);

        return redirect()->route('short_urls.index')->with('status', 'Short URL created successfully.');
    }

    public function redirect($short_code)
    {
        $shortUrl = ShortUrl::where('short_code', $short_code)->firstOrFail();

        return redirect()->away($shortUrl->original_url);
    }
}
