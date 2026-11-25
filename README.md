# LumenWeave Shade Co. — Blinds & Shades Retailer ERP + AI

Production-ready Laravel 13 + Filament 3 website, ERP, and AI toolkit for a US blinds and shades retailer based in Denver, Colorado. Includes a public marketing site, knowledge base, WhatsApp + chatbot widgets, and a full admin ERP for customers, inventory, orders, invoices, appointments, and AI content tools.

## ✨ Features
- 🏠 Public marketing site with hero, services, about, dashboard preview, and contact form
- 🪟 Service detail pages for custom blinds, cellular shades, roman/roller, and measure-install
- 📚 Blog / design notes and a seeded knowledge base (issues, guides, admin manual, troubleshooting)
- 💬 Floating WhatsApp button + public AI chatbot (OpenAI when keyed, FAQ demo otherwise)
- 🧑‍💼 Filament ERP at `/admin` with Admin / Manager / Staff roles
- 📦 Customers, products/inventory, orders/jobs, invoices, payments, appointments
- 📊 Reports dashboard with stats + charts
- ⚙️ Settings page for company profile and tax rate
- 🤖 Admin AI Content Studio + troubleshooting/automation assistant
- 🌱 Realistic demo seeders for a full walkthrough

## 🧰 Tech Stack
- Laravel 13
- Filament 3
- Livewire + Alpine.js + Tailwind CSS
- MySQL (SQLite supported for local demo)
- OpenAI HTTP integration with Gemini config keys for fallback wiring
- Spatie Laravel Permission

## 🚀 Installation
```bash
git clone https://github.com/imranbru99/blinds-shades-retailer.git
cd blinds-shades-retailer
composer install
cp .env.example .env
php artisan key:generate

# SQLite demo (default) — ensure database/database.sqlite exists
# Or configure MySQL in .env

php artisan migrate --seed
npm install && npm run build
php artisan serve
```

Visit:
- Public site: http://127.0.0.1:8000
- Admin ERP: http://127.0.0.1:8000/admin

### Admin login
- Email: `admin@example.com`
- Password: `password`

Optional AI: set `OPENAI_API_KEY` (and optionally `GEMINI_API_KEY`) in `.env`.

## 🖼️ Screenshots / Visual Dashboard
![LumenWeave living room light](https://images.unsplash.com/photo-1600210492490-eebdd14d4e15?auto=format&fit=crop&w=1400&q=80)

![Custom blinds display](https://images.unsplash.com/photo-1615874959474-d609969a20ed?auto=format&fit=crop&w=1400&q=80)

![Cellular shade comfort](https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=1400&q=80)

![Showroom-inspired interior](https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1400&q=80)

## 🌐 Live Demo
Placeholder — deploy to your preferred host (Forge, Vapor, shared PHP) and update this section with the production URL.

## 🔍 SEO-optimized repo description suggestion
`LumenWeave Shade Co. — Laravel 13 + Filament 3 blinds & shades retailer website with ERP, inventory, scheduling, invoices, knowledge base, and AI chatbot for US SMEs.`

---

## 🤝 Let's Connect & Collaborate
I am open to Senior Remote Full-Stack Roles, AI Platform Architecture Contracts, and Enterprise Technical Advisory.
Timezone: UTC+6 (Dhaka / Rangpur, Bangladesh) — Flexible overlap with US, UK, and European business hours.
Delivery Mode: Async-ready, Slack, Discord, Jira, GitHub, and production-first accountability.

| Channel | Address / Handle | Quick Action |
|---------|------------------|--------------|
| 🌐 Primary Portfolio | imrandev.bd | Visit Site ↗ |
| 📦 Packagist Packages | packagist.org/packages/imrandevbd/ | View Packages ↗ |
| 💼 LinkedIn Profile | linkedin.com/in/imranbru99 | Connect ↗ |
| 🐙 GitHub Profile | github.com/imranbru99 | Follow ↗ |
| 💬 WhatsApp Direct | +880 1576-918420 | Chat Now ↗ |
| 📧 Direct Email | me@imrandev.bd | Send Email ↗ |
| 🐦 X (Twitter) | @imrandev_bd | Follow ↗ |
| 📺 YouTube Tech | @ImranDevBD | Subscribe ↗ |
