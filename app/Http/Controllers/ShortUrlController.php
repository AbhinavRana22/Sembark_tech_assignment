<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('Super Admin')) {
            $shortUrls = ShortUrl::with([
                'company',
                'user'
            ])
            ->latest()
            ->paginate(10);

        } elseif ($user->hasRole('Admin')) {

            $shortUrls = ShortUrl::where(
                'company_id',
                $user->company_id
            )
            ->latest()
            ->paginate(10);

        } else {

            $shortUrls = ShortUrl::where(
                'user_id',
                $user->id
            )
            ->latest()
            ->paginate(10);
        }

        return view(
            'short-urls.index',
            compact('shortUrls')
        );
    }

    public function create()
    {
        if(auth()->user()->hasRole('Super Admin'))
        {
            abort(403);
        }

        return view('short-urls.create');
    }

    public function store(Request $request)
    {
        if(auth()->user()->hasRole('Super Admin'))
        {
            abort(403);
        }

        $request->validate([
            'original_url' => [
                'required',
                'url'
            ]
        ]);

        do {

            $shortCode = Str::random(6);

        } while (
            ShortUrl::where(
                'short_code',
                $shortCode
            )->exists()
        );

        ShortUrl::create([
            'company_id' => auth()->user()->company_id,
            'user_id' => auth()->id(),
            'original_url' => $request->original_url,
            'short_code' => $shortCode,
        ]);

        return redirect()
            ->route('short-urls.list')
            ->with(
                'success',
                'Short URL created successfully.'
            );
    }

    public function redirect($shortCode)
    {
        $shortUrl = ShortUrl::where('short_code', $shortCode)->firstOrFail();

        $shortUrl->increment('clicks');

        return redirect($shortUrl->original_url);
    }
}
