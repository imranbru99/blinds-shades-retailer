@extends('layouts.app')
@section('title', 'About')
@section('content')
<style>
    .page-hero { padding: 3.5rem 0 2rem; }
    .page-hero h1 { font-size: clamp(2rem, 4vw, 3rem); color: var(--lw-teal); margin: 0 0 .8rem; }
    .split { display: grid; grid-template-columns: 1.1fr .9fr; gap: 1.5rem; align-items: start; }
    .split img { width: 100%; border-radius: 1.2rem; min-height: 360px; object-fit: cover; }
    .prose-lw { line-height: 1.7; opacity: .88; }
    @media (max-width: 860px) { .split { grid-template-columns: 1fr; } }
</style>
<div class="wrap page-hero">
    <h1>About LumenWeave</h1>
    <p style="max-width:56ch;opacity:.8;line-height:1.6;">A Denver blinds and shades atelier built around daylight, craftsmanship, and calm installs.</p>
</div>
<div class="wrap split" style="padding-bottom:3rem;">
    <div class="prose-lw">
        <p>LumenWeave Shade Co. started as a Cherry Creek showroom for homeowners who wanted more than off-the-shelf stock blinds. We specialize in custom wood blinds, cellular shades, romans, rollers, and quiet motorization — measured on-site and fabricated to the millimeter.</p>
        <p>Our team pairs design consultants with certified installers so the same details captured during measuring show up on install day. Whether you need blackout for a mountain bedroom or sheer layers for a sunlit studio, we help you choose opacity, mount style, and lift systems that feel effortless.</p>
        <p>Today the business runs on a full ERP: customers, inventory SKUs, install jobs, invoices, appointments, and an AI assistant trained on our product FAQ and field troubleshooting.</p>
        <a href="{{ route('contact') }}" class="btn btn-primary" style="margin-top:1rem;">Visit the showroom</a>
    </div>
    <img src="https://images.unsplash.com/photo-1616594039964-ae9021a400a0?auto=format&fit=crop&w=1200&q=80" alt="Bright bedroom with soft window light">
</div>
@endsection
