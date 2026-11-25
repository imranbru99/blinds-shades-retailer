@extends('layouts.app')
@section('title', $article->title)
@section('content')
<style>
    .article { max-width: 760px; margin: 0 auto; padding: 3rem 1rem 4rem; }
    .badge { display:inline-block; background:var(--lw-mist); color:var(--lw-teal); border-radius:999px; padding:.25rem .7rem; font-size:.8rem; font-weight:600; }
    .body { line-height:1.75; opacity:.9; margin-top:1.2rem; }
</style>
<article class="article">
    <span class="badge">{{ str_replace('_', ' ', $article->category) }}</span>
    <h1 style="color:var(--lw-teal);font-size:clamp(1.8rem,4vw,2.5rem);margin:.7rem 0 0;">{{ $article->title }}</h1>
    <div class="body">{!! nl2br(e($article->body)) !!}</div>
    <a href="{{ route('kb.index') }}" class="btn btn-ghost" style="margin-top:1.2rem;">All articles</a>
</article>
@endsection
