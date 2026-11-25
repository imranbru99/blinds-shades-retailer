<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LumenWeave Shade Co.') — Custom Blinds & Shades | Denver</title>
    <meta name="description" content="@yield('meta', 'LumenWeave Shade Co. designs and installs custom blinds, cellular shades, and motorized window treatments across Denver.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Syne:wght@500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --lw-ink: #1A2332;
            --lw-teal: #0A4D5C;
            --lw-aqua: #5EB7B0;
            --lw-mist: #E8F1F3;
            --lw-amber: #E8A838;
            --lw-paper: #F5F8F9;
            --lw-line: rgba(10, 77, 92, 0.12);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Outfit', sans-serif;
            color: var(--lw-ink);
            background:
                radial-gradient(1200px 500px at 10% -10%, rgba(94, 183, 176, 0.18), transparent 60%),
                radial-gradient(900px 400px at 100% 0%, rgba(232, 168, 56, 0.12), transparent 55%),
                linear-gradient(180deg, #F5F8F9 0%, #EEF4F5 100%);
            min-height: 100vh;
        }
        h1, h2, h3, .brand-font { font-family: 'Syne', sans-serif; letter-spacing: -0.02em; }
        a { color: inherit; text-decoration: none; }
        .wrap { width: min(1120px, calc(100% - 2rem)); margin-inline: auto; }
        .site-header {
            position: sticky; top: 0; z-index: 40;
            backdrop-filter: blur(14px);
            background: rgba(245, 248, 249, 0.86);
            border-bottom: 1px solid var(--lw-line);
        }
        .nav {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 0; gap: 1rem;
        }
        .logo {
            font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.15rem;
            color: var(--lw-teal); display: flex; align-items: center; gap: .55rem;
        }
        .logo-mark {
            width: 2rem; height: 2rem; border-radius: .55rem;
            background: linear-gradient(135deg, var(--lw-teal), var(--lw-aqua));
            display: grid; place-items: center; color: white; font-size: .85rem;
        }
        .nav-links { display: flex; flex-wrap: wrap; gap: .9rem 1.1rem; align-items: center; font-size: .95rem; }
        .nav-links a { opacity: .85; }
        .nav-links a:hover { opacity: 1; color: var(--lw-teal); }
        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: .4rem;
            border: 0; border-radius: 999px; padding: .75rem 1.25rem;
            font-weight: 600; cursor: pointer; transition: transform .2s ease, box-shadow .2s ease;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn-primary {
            background: linear-gradient(135deg, var(--lw-teal), #126875);
            color: #fff; box-shadow: 0 10px 24px rgba(10, 77, 92, 0.22);
        }
        .btn-ghost {
            background: transparent; border: 1px solid var(--lw-line); color: var(--lw-ink);
        }
        .btn-amber { background: var(--lw-amber); color: #1A2332; }
        .site-footer {
            margin-top: 5rem; border-top: 1px solid var(--lw-line);
            background: var(--lw-ink); color: #d7e4e7; padding: 3rem 0 2rem;
        }
        .footer-grid { display: grid; gap: 2rem; grid-template-columns: 1.4fr 1fr 1fr; }
        .site-footer a { color: #d7e4e7; opacity: .85; }
        .site-footer a:hover { opacity: 1; color: var(--lw-aqua); }
        .whatsapp-float {
            position: fixed; right: 1.25rem; bottom: 1.25rem; z-index: 50;
            width: 3.4rem; height: 3.4rem; border-radius: 999px;
            background: #25D366; color: white; display: grid; place-items: center;
            box-shadow: 0 12px 30px rgba(37, 211, 102, 0.35);
            animation: floatPulse 2.8s ease-in-out infinite;
        }
        @keyframes floatPulse {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        .chat-widget {
            position: fixed; right: 1.25rem; bottom: 5.2rem; z-index: 50; width: min(340px, calc(100vw - 2rem));
        }
        .chat-panel {
            display: none; background: white; border: 1px solid var(--lw-line);
            border-radius: 1rem; overflow: hidden; box-shadow: 0 20px 50px rgba(26, 35, 50, 0.18);
        }
        .chat-panel.open { display: flex; flex-direction: column; height: 420px; }
        .chat-head { background: var(--lw-teal); color: white; padding: .9rem 1rem; font-weight: 600; }
        .chat-log { flex: 1; overflow: auto; padding: 1rem; background: var(--lw-paper); }
        .chat-bubble { max-width: 90%; margin-bottom: .7rem; padding: .65rem .8rem; border-radius: .8rem; font-size: .9rem; line-height: 1.4; }
        .chat-bubble.bot { background: white; border: 1px solid var(--lw-line); }
        .chat-bubble.user { background: var(--lw-aqua); color: #08343c; margin-left: auto; }
        .chat-form { display: flex; gap: .4rem; padding: .7rem; border-top: 1px solid var(--lw-line); }
        .chat-form input { flex: 1; border: 1px solid var(--lw-line); border-radius: .6rem; padding: .6rem .7rem; }
        .chat-toggle {
            margin-left: auto; display: block; border: 0; border-radius: 999px;
            background: var(--lw-teal); color: white; padding: .7rem 1rem; font-weight: 600; cursor: pointer;
            box-shadow: 0 12px 28px rgba(10, 77, 92, 0.25);
        }
        @media (max-width: 800px) {
            .footer-grid { grid-template-columns: 1fr; }
            .nav-links { display: none; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <header class="site-header">
        <div class="wrap nav">
            <a href="{{ route('home') }}" class="logo">
                <span class="logo-mark">LW</span>
                LumenWeave Shade Co.
            </a>
            <nav class="nav-links">
                <a href="{{ route('services.index') }}">Services</a>
                <a href="{{ route('about') }}">About</a>
                <a href="{{ route('blog.index') }}">Blog</a>
                <a href="{{ route('kb.index') }}">Knowledge Base</a>
                <a href="{{ route('contact') }}">Contact</a>
                <a href="/admin" class="btn btn-ghost" style="padding:.45rem .9rem;">ERP Login</a>
            </nav>
            <a href="{{ route('contact') }}" class="btn btn-primary">Free Measure</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="wrap footer-grid">
            <div>
                <div class="brand-font" style="font-size:1.3rem;color:#fff;margin-bottom:.6rem;">LumenWeave Shade Co.</div>
                <p style="opacity:.8;line-height:1.6;max-width:34ch;">Custom blinds, shades, and motorized light control for Denver homes and studios — measured precisely, installed cleanly.</p>
            </div>
            <div>
                <strong style="color:#fff;">Visit</strong>
                <p style="opacity:.8;line-height:1.7;margin:.6rem 0 0;">1840 Madison Street<br>Denver, CO 80206<br>(303) 555-0184</p>
            </div>
            <div>
                <strong style="color:#fff;">Explore</strong>
                <p style="display:grid;gap:.45rem;margin:.6rem 0 0;">
                    <a href="{{ route('services.index') }}">Services</a>
                    <a href="{{ route('kb.index') }}">Knowledge Base</a>
                    <a href="{{ route('blog.index') }}">Design Notes</a>
                    <a href="/admin">Admin ERP</a>
                </p>
            </div>
        </div>
        <div class="wrap" style="margin-top:2rem;opacity:.55;font-size:.85rem;">© {{ date('Y') }} LumenWeave Shade Co. All rights reserved.</div>
    </footer>

    <a class="whatsapp-float" href="https://wa.me/13035550184" target="_blank" rel="noopener" aria-label="WhatsApp">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.5 3.5A11 11 0 0 0 3.2 17.7L2 22l4.4-1.1A11 11 0 1 0 20.5 3.5zm-8.5 17a9 9 0 0 1-4.6-1.3l-.3-.2-2.6.7.7-2.5-.2-.3A9 9 0 1 1 12 20.5zm5-6.7c-.3-.1-1.6-.8-1.9-.9s-.4-.1-.6.1-.7.9-.8 1-.3.2-.6.1a7.3 7.3 0 0 1-2.2-1.4 8.2 8.2 0 0 1-1.5-1.9c-.2-.3 0-.4.1-.6l.4-.5.1-.3c0-.1 0-.3-.1-.4s-.6-1.4-.8-1.9-.4-.4-.6-.4h-.5c-.2 0-.4.1-.6.3a2 2 0 0 0-.6 1.5 3.5 3.5 0 0 0 .7 1.8 8 8 0 0 0 3 3.1 10.5 10.5 0 0 0 2.1.9 3.3 3.3 0 0 0 2.1.1 2.7 2.7 0 0 0 1.8-1.2 2.2 2.2 0 0 0 .2-1.2c-.1-.1-.3-.2-.6-.3z"/></svg>
    </a>

    @include('partials.chatbot')
    @stack('scripts')
</body>
</html>
