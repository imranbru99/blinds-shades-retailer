@extends('layouts.app')
@section('title', 'Services')
@section('content')
<style>
    .page-hero { padding: 3.5rem 0 1.5rem; }
    .page-hero h1 { font-size: clamp(2rem, 4vw, 3rem); color: var(--lw-teal); margin: 0 0 .8rem; }
    .grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.2rem; padding-bottom: 3rem; }
    .card { background: white; border: 1px solid var(--lw-line); border-radius: 1.2rem; overflow: hidden; }
    .card img { width: 100%; height: 210px; object-fit: cover; }
    .card .body { padding: 1.2rem 1.3rem 1.4rem; }
    @media (max-width: 860px) { .grid { grid-template-columns: 1fr; } }
</style>
<div class="wrap page-hero">
    <h1>Services</h1>
    <p style="opacity:.8;max-width:52ch;">Retail and install expertise for blinds, shades, and motorized light control across the Denver metro.</p>
</div>
<div class="wrap grid">
    @foreach($services as $slug => $service)
        <a class="card" href="{{ route('services.show', $slug) }}">
            <img src="{{ $service['image'] }}" alt="{{ $service['title'] }}">
            <div class="body">
                <h2 style="margin:0 0 .4rem;font-size:1.25rem;color:var(--lw-teal);">{{ $service['title'] }}</h2>
                <p style="margin:0;opacity:.78;">{{ $service['subtitle'] }}</p>
            </div>
        </a>
    @endforeach
</div>
@endsection
