@extends('layouts.app')
@section('title', 'Knowledge Base')
@section('content')
<style>
    .page-hero { padding: 3.5rem 0 1.5rem; }
    .page-hero h1 { font-size: clamp(2rem, 4vw, 3rem); color: var(--lw-teal); margin: 0 0 .8rem; }
    .cat { margin-bottom: 2rem; }
    .cat h2 { font-size: 1.2rem; color: var(--lw-ink); margin: 0 0 .8rem; text-transform: capitalize; }
    .list { display:grid; gap:.6rem; }
    .item { background:white; border:1px solid var(--lw-line); border-radius:.9rem; padding:1rem 1.1rem; }
</style>
<div class="wrap page-hero">
    <h1>Knowledge Base</h1>
    <p style="opacity:.8;max-width:54ch;">Common issues, install guides, admin manual notes, and troubleshooting for blinds and shades operations.</p>
</div>
<div class="wrap" style="padding-bottom:3rem;">
    @foreach($articles as $category => $items)
        <div class="cat">
            <h2>{{ str_replace('_', ' ', $category) }}</h2>
            <div class="list">
                @foreach($items as $article)
                    <a class="item" href="{{ route('kb.show', $article->slug) }}">
                        <strong>{{ $article->title }}</strong>
                    </a>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection
