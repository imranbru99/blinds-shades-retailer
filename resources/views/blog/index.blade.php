@extends('layouts.app')
@section('title', 'Blog')
@section('content')
<style>
    .page-hero { padding: 3.5rem 0 1.5rem; }
    .page-hero h1 { font-size: clamp(2rem, 4vw, 3rem); color: var(--lw-teal); margin: 0 0 .8rem; }
    .grid { display:grid; grid-template-columns: repeat(3, 1fr); gap:1rem; padding-bottom:3rem; }
    .card { background:white; border:1px solid var(--lw-line); border-radius:1rem; overflow:hidden; }
    .card img { width:100%; height:170px; object-fit:cover; }
    .card .body { padding:1rem 1.1rem 1.2rem; }
    @media (max-width: 900px) { .grid { grid-template-columns: 1fr; } }
</style>
<div class="wrap page-hero">
    <h1>Design notes</h1>
    <p style="opacity:.8;">Guides and ideas for blinds, shades, and living with mountain light.</p>
</div>
<div class="wrap grid">
    @foreach($posts as $post)
        <a class="card" href="{{ route('blog.show', $post->slug) }}">
            <img src="{{ $post->cover_image }}" alt="{{ $post->title }}">
            <div class="body">
                <h2 style="margin:0 0 .4rem;font-size:1.1rem;">{{ $post->title }}</h2>
                <p style="margin:0;opacity:.75;font-size:.92rem;">{{ $post->excerpt }}</p>
            </div>
        </a>
    @endforeach
</div>
<div class="wrap" style="padding-bottom:3rem;">{{ $posts->links() }}</div>
@endsection
