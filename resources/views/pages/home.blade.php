@extends('layouts.app')

@section('title', 'LumenWeave Shade Co.')
@section('meta', 'Premium custom blinds and shades retailer in Denver — cellular, roman, roller, wood blinds, and motorized installs.')

@push('styles')
<style>
    .hero {
        position: relative; min-height: calc(100vh - 74px);
        display: grid; align-items: end;
        background:
            linear-gradient(180deg, rgba(26,35,50,.18) 0%, rgba(10,77,92,.72) 70%, rgba(10,77,92,.88) 100%),
            url('https://images.unsplash.com/photo-1600210492490-eebdd14d4e15?auto=format&fit=crop&w=2000&q=80') center/cover no-repeat;
        color: white; overflow: hidden;
    }
    .hero-inner { padding: 4.5rem 0 4rem; animation: riseIn .9s ease both; }
    .hero-brand {
        font-family: 'Syne', sans-serif; font-weight: 800; font-size: clamp(2.6rem, 7vw, 5.2rem);
        line-height: .95; max-width: 12ch; margin: 0 0 1rem;
    }
    .hero p { max-width: 38ch; font-size: 1.1rem; opacity: .92; line-height: 1.55; }
    .hero-actions { display: flex; flex-wrap: wrap; gap: .8rem; margin-top: 1.6rem; }
    @keyframes riseIn {
        from { opacity: 0; transform: translateY(24px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .section { padding: 4.5rem 0; }
    .section h2 { font-size: clamp(1.8rem, 3vw, 2.5rem); margin: 0 0 .6rem; color: var(--lw-teal); }
    .lead { opacity: .8; max-width: 55ch; line-height: 1.6; margin-bottom: 2rem; }
    .service-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.2rem; }
    .service-tile {
        position: relative; min-height: 240px; border-radius: 1.2rem; overflow: hidden;
        display: flex; align-items: flex-end; color: white;
        transform: translateY(12px); opacity: 0; animation: riseIn .7s ease forwards;
    }
    .service-tile:nth-child(2) { animation-delay: .12s; }
    .service-tile:nth-child(3) { animation-delay: .2s; }
    .service-tile:nth-child(4) { animation-delay: .28s; }
    .service-tile img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
    .service-tile .shade {
        position: absolute; inset: 0;
        background: linear-gradient(180deg, transparent 20%, rgba(10,77,92,.88) 100%);
    }
    .service-tile .copy { position: relative; padding: 1.3rem; }
    .dash-preview {
        display: grid; grid-template-columns: 1.1fr .9fr; gap: 1.5rem; align-items: center;
        background: white; border: 1px solid var(--lw-line); border-radius: 1.4rem; overflow: hidden;
    }
    .dash-preview img { width: 100%; height: 100%; min-height: 320px; object-fit: cover; }
    .dash-copy { padding: 2rem; }
    .metric-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: .8rem; margin-top: 1.2rem; }
    .metric {
        background: var(--lw-mist); border-radius: .9rem; padding: 1rem;
        animation: riseIn .8s ease both; animation-delay: .15s;
    }
    .metric strong { display: block; font-size: 1.4rem; color: var(--lw-teal); }
    .posts { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
    .post-card {
        background: white; border: 1px solid var(--lw-line); border-radius: 1rem; overflow: hidden;
        transition: transform .25s ease;
    }
    .post-card:hover { transform: translateY(-4px); }
    .post-card img { width: 100%; height: 160px; object-fit: cover; }
    .post-card .body { padding: 1rem 1.1rem 1.2rem; }
    @media (max-width: 900px) {
        .service-grid, .posts, .dash-preview, .metric-row { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<section class="hero">
    <div class="wrap hero-inner">
        <div class="hero-brand">LumenWeave Shade Co.</div>
        <p>Custom blinds and shades shaped for Colorado light — measured in your home, woven for privacy, and installed with quiet precision.</p>
        <div class="hero-actions">
            <a href="{{ route('contact') }}" class="btn btn-amber">Book a free measure</a>
            <a href="{{ route('services.index') }}" class="btn btn-ghost" style="border-color:rgba(255,255,255,.35);color:#fff;">Explore treatments</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <h2>Window treatments, tailored</h2>
        <p class="lead">From honeycomb cellular shades to motorized rollers, every LumenWeave order is built around how you actually live with daylight.</p>
        <div class="service-grid">
            <a class="service-tile" href="{{ route('services.show', 'custom-blinds') }}">
                <img src="https://images.unsplash.com/photo-1615874959474-d609969a20ed?auto=format&fit=crop&w=1200&q=80" alt="Custom wood blinds">
                <div class="shade"></div>
                <div class="copy"><h3 style="margin:0 0 .35rem;">Custom Blinds</h3><p style="margin:0;opacity:.9;">Wood, faux wood, and aluminum fits.</p></div>
            </a>
            <a class="service-tile" href="{{ route('services.show', 'cellular-shades') }}">
                <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=1200&q=80" alt="Cellular shades">
                <div class="shade"></div>
                <div class="copy"><h3 style="margin:0 0 .35rem;">Cellular Shades</h3><p style="margin:0;opacity:.9;">Energy-smart honeycomb comfort.</p></div>
            </a>
            <a class="service-tile" href="{{ route('services.show', 'roman-roller') }}">
                <img src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1200&q=80" alt="Roman and roller shades">
                <div class="shade"></div>
                <div class="copy"><h3 style="margin:0 0 .35rem;">Roman & Roller</h3><p style="margin:0;opacity:.9;">Soft folds and clean modern lines.</p></div>
            </a>
            <a class="service-tile" href="{{ route('services.show', 'measure-install') }}">
                <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=1200&q=80" alt="Measure and install">
                <div class="shade"></div>
                <div class="copy"><h3 style="margin:0 0 .35rem;">Measure & Install</h3><p style="margin:0;opacity:.9;">Complimentary Denver-metro measuring.</p></div>
            </a>
        </div>
    </div>
</section>

<section class="section" style="padding-top:0;">
    <div class="wrap">
        <div class="dash-preview">
            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1400&q=80" alt="Bright living room with large windows">
            <div class="dash-copy">
                <h2>Operations dashboard preview</h2>
                <p class="lead" style="margin-bottom:0;">The LumenWeave ERP tracks measuring appointments, shade inventory, install jobs, invoices, and AI-assisted content — so the showroom and field team stay in sync.</p>
                <div class="metric-row">
                    <div class="metric"><strong>ERP</strong>Orders + installs</div>
                    <div class="metric"><strong>AI</strong>Chat + generators</div>
                    <div class="metric"><strong>KB</strong>Guides & manuals</div>
                </div>
                <a href="/admin" class="btn btn-primary" style="margin-top:1.2rem;">Open admin demo</a>
            </div>
        </div>
    </div>
</section>

<section class="section" style="padding-top:0;">
    <div class="wrap">
        <h2>About the atelier</h2>
        <p class="lead">Founded in Cherry Creek, LumenWeave is a US blinds and shades retailer focused on precise light control — not one-size catalogs. Our consultants help you balance privacy, UV protection, and the way afternoon sun moves through each room.</p>
        <a href="{{ route('about') }}" class="btn btn-ghost">Our story</a>
    </div>
</section>

@if($posts->count())
<section class="section" style="padding-top:0;">
    <div class="wrap">
        <h2>Design notes</h2>
        <p class="lead">Ideas from our showroom floor — fabric opacity, motorization, and mountain-light strategies.</p>
        <div class="posts">
            @foreach($posts as $post)
                <a class="post-card" href="{{ route('blog.show', $post->slug) }}">
                    <img src="{{ $post->cover_image }}" alt="{{ $post->title }}">
                    <div class="body">
                        <h3 style="margin:0 0 .4rem;font-size:1.05rem;">{{ $post->title }}</h3>
                        <p style="margin:0;opacity:.75;font-size:.92rem;">{{ $post->excerpt }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="section" style="padding-top:0;">
    <div class="wrap" style="background:linear-gradient(135deg,var(--lw-teal),#126875);color:#fff;border-radius:1.4rem;padding:2.4rem;">
        <h2 style="color:#fff;margin:0 0 .5rem;">Ready for better light?</h2>
        <p style="opacity:.9;max-width:46ch;line-height:1.55;">Tell us about your windows. We’ll schedule a free measure and bring fabric samples that actually suit Colorado sun.</p>
        <a href="{{ route('contact') }}" class="btn btn-amber" style="margin-top:1rem;">Contact the showroom</a>
    </div>
</section>
@endsection
