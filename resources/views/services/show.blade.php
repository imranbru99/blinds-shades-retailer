@extends('layouts.app')
@section('title', $service['title'])
@section('content')
<style>
    .hero-svc {
        min-height: 48vh; display:grid; align-items:end; color:#fff;
        background: linear-gradient(180deg, rgba(10,77,92,.25), rgba(10,77,92,.82)), url('{{ $service['image'] }}') center/cover no-repeat;
    }
    .hero-svc .wrap { padding: 3.5rem 0 2.5rem; }
    .content { display:grid; grid-template-columns: 1.3fr .7fr; gap:1.5rem; padding: 2.5rem 0 3rem; }
    .points { list-style:none; padding:0; margin:1rem 0 0; display:grid; gap:.6rem; }
    .points li { background:white; border:1px solid var(--lw-line); border-radius:.8rem; padding:.8rem 1rem; }
    .side { background:white; border:1px solid var(--lw-line); border-radius:1rem; padding:1.2rem; height:fit-content; }
    @media (max-width: 860px) { .content { grid-template-columns: 1fr; } }
</style>
<section class="hero-svc">
    <div class="wrap">
        <h1 style="font-size:clamp(2rem,4vw,3rem);margin:0 0 .5rem;">{{ $service['title'] }}</h1>
        <p style="margin:0;opacity:.92;max-width:48ch;">{{ $service['subtitle'] }}</p>
    </div>
</section>
<div class="wrap content">
    <div>
        <p style="line-height:1.75;opacity:.88;font-size:1.05rem;">{{ $service['body'] }}</p>
        <ul class="points">
            @foreach($service['points'] as $point)
                <li>{{ $point }}</li>
            @endforeach
        </ul>
    </div>
    <aside class="side">
        <h3 style="margin-top:0;color:var(--lw-teal);">More services</h3>
        @foreach($services as $sSlug => $item)
            @if($sSlug !== $slug)
                <a href="{{ route('services.show', $sSlug) }}" style="display:block;padding:.45rem 0;opacity:.85;">{{ $item['title'] }}</a>
            @endif
        @endforeach
        <a href="{{ route('contact') }}" class="btn btn-primary" style="margin-top:1rem;width:100%;">Request a quote</a>
    </aside>
</div>
@endsection
