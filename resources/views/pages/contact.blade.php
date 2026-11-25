@extends('layouts.app')
@section('title', 'Contact')
@section('content')
<style>
    .page-hero { padding: 3.5rem 0 1.5rem; }
    .page-hero h1 { font-size: clamp(2rem, 4vw, 3rem); color: var(--lw-teal); margin: 0 0 .8rem; }
    .contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; padding-bottom: 3rem; }
    .panel { background: white; border: 1px solid var(--lw-line); border-radius: 1.2rem; padding: 1.5rem; }
    label { display:block; font-size:.9rem; margin: .7rem 0 .3rem; font-weight: 600; }
    input, textarea { width: 100%; border: 1px solid var(--lw-line); border-radius: .7rem; padding: .75rem .85rem; font: inherit; background: #fff; }
    .alert { background: #e7f7f1; border: 1px solid #9ad7c2; color: #145c45; padding: .9rem 1rem; border-radius: .8rem; margin-bottom: 1rem; }
    @media (max-width: 860px) { .contact-grid { grid-template-columns: 1fr; } }
</style>
<div class="wrap page-hero">
    <h1>Contact the showroom</h1>
    <p style="opacity:.8;max-width:50ch;">Book a complimentary measure or ask about motorized shades, fabric samples, and install timing.</p>
</div>
<div class="wrap contact-grid">
    <div class="panel">
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        <form method="post" action="{{ route('contact.store') }}">
            @csrf
            <label>Name</label>
            <input name="name" value="{{ old('name') }}" required>
            @error('name')<div style="color:#b42318;font-size:.85rem;">{{ $message }}</div>@enderror
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email')<div style="color:#b42318;font-size:.85rem;">{{ $message }}</div>@enderror
            <label>Phone</label>
            <input name="phone" value="{{ old('phone') }}">
            <label>Subject</label>
            <input name="subject" value="{{ old('subject') }}">
            <label>Message</label>
            <textarea name="message" rows="5" required>{{ old('message') }}</textarea>
            @error('message')<div style="color:#b42318;font-size:.85rem;">{{ $message }}</div>@enderror
            <button class="btn btn-primary" style="margin-top:1rem;" type="submit">Send message</button>
        </form>
    </div>
    <div class="panel">
        <h2 style="margin-top:0;color:var(--lw-teal);">LumenWeave Shade Co.</h2>
        <p style="line-height:1.7;opacity:.85;">1840 Madison Street<br>Denver, CO 80206<br>(303) 555-0184<br>hello@lumenweave.example</p>
        <p style="line-height:1.7;opacity:.85;"><strong>Hours:</strong> Mon–Fri 9am–6pm · Sat 10am–4pm · Sun by appointment</p>
        <img src="https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?auto=format&fit=crop&w=1200&q=80" alt="Living room seating near windows" style="width:100%;border-radius:1rem;margin-top:1rem;object-fit:cover;max-height:240px;">
    </div>
</div>
@endsection
