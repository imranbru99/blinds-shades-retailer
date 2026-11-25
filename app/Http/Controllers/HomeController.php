<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()
            ->where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.home', compact('posts'));
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }
}
