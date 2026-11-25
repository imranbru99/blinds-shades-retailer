<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;

class ServiceController extends Controller
{
    protected array $services = [
        'custom-blinds' => [
            'title' => 'Custom Blinds',
            'subtitle' => 'Precision-fit wood, faux wood, and aluminum blinds',
            'image' => 'https://images.unsplash.com/photo-1615874959474-d609969a20ed?auto=format&fit=crop&w=1600&q=80',
            'body' => 'From plantation-style wood blinds to slim aluminum minis, LumenWeave builds each order to your exact window specs. Choose finishes that match trim, add cordless lifts for safety, and dial in light control room by room.',
            'points' => ['Exact width and height fabrication', 'Cordless and motorized lift options', 'Interior and exterior mount hardware', 'Showroom samples for grain and stain'],
        ],
        'cellular-shades' => [
            'title' => 'Cellular & Honeycomb Shades',
            'subtitle' => 'Energy-smart light filtering for Colorado climates',
            'image' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=1600&q=80',
            'body' => 'Cellular shades trap air in honeycomb cells to soften glare and stabilize indoor temperatures. Ideal for bedrooms, offices, and sun-facing glass where comfort and privacy both matter.',
            'points' => ['Single and double cell constructions', 'Blackout and light-filtering fabrics', 'Top-down / bottom-up designs', 'Quiet motorization available'],
        ],
        'roman-roller' => [
            'title' => 'Roman & Roller Shades',
            'subtitle' => 'Tailored fabric folds and clean modern rolls',
            'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1600&q=80',
            'body' => 'Roman shades bring soft architecture to living rooms and dining spaces, while roller shades deliver a minimalist line for contemporary interiors. We source performance textiles that resist fading and keep folds crisp.',
            'points' => ['Designer fabrics and sheers', 'Cassette and fascia hardware', 'Dual-shade day/night systems', 'Smart-home ready motors'],
        ],
        'measure-install' => [
            'title' => 'Measure & Install',
            'subtitle' => 'Complimentary measuring with certified installers',
            'image' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=1600&q=80',
            'body' => 'Our design consultants measure every opening, photograph mounting conditions, and confirm clearances before fabrication. Certified installers level brackets, train you on lifts or remotes, and leave each room ready to use.',
            'points' => ['Free Denver-metro measuring', 'Written estimates with lead times', 'Child-safe hardware standards', 'Post-install walkthrough'],
        ],
    ];

    public function index(): View
    {
        return view('services.index', ['services' => $this->services]);
    }

    public function show(string $slug): View|Response
    {
        if (! isset($this->services[$slug])) {
            abort(404);
        }

        return view('services.show', [
            'service' => $this->services[$slug],
            'slug' => $slug,
            'services' => $this->services,
        ]);
    }
}
