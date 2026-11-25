@extends('layouts.app')
@section('title', $post->title)
@section('content')
<style>
    .article { max-width: 760px; margin: 0 auto; padding: 3rem 1rem 4rem; }
    .article img { width:100%; border-radius:1.1rem; max-height:380px; object-fit:cover; margin:1.2rem 0 1.5rem; }
    .article .body { line-height:1.75; opacity:.9; }
    .article .body p { margin: 0 0 1rem; }
</style>
<article class="article">
    <p style="opacity:.65;margin:0 0 .5rem;">{{ optional($post->published_at)->format('F j, Y') }}</p>
    <h1 style="color:var(--lw-teal);font-size:clamp(1.8rem,4vw,2.6rem);margin:0;">{{ $post->title }}</h1>
    <img src="{{ $post->cover_image }}" alt="{{ $post->title }}">
    <div class="body">{!! nl2br(e($post->body)) !!}</div>
    <a href="{{ route('blog.index') }}" class="btn btn-ghost" style="margin-top:1rem;">Back to blog</a>
</article>
@endsection
