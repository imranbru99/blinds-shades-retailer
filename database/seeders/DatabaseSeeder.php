<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\ContactMessage;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\KnowledgeArticle;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin', 'manager', 'staff'] as $role) {
            Role::findOrCreate($role);
        }

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'LumenWeave Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '(303) 555-0184',
            ]
        );
        $admin->assignRole('admin');

        $manager = User::query()->updateOrCreate(
            ['email' => 'manager@lumenweave.example'],
            [
                'name' => 'Avery Quinn',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'phone' => '(303) 555-0185',
            ]
        );
        $manager->assignRole('manager');

        $staff = User::query()->updateOrCreate(
            ['email' => 'staff@lumenweave.example'],
            [
                'name' => 'Jordan Hale',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'phone' => '(303) 555-0186',
            ]
        );
        $staff->assignRole('staff');

        $settings = [
            'company_name' => 'LumenWeave Shade Co.',
            'phone' => '(303) 555-0184',
            'email' => 'hello@lumenweave.example',
            'address' => '1840 Madison Street, Denver, CO 80206',
            'whatsapp' => '13035550184',
            'tax_rate' => '8.31',
            'showroom_hours' => 'Mon–Fri 9–6, Sat 10–4',
        ];
        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }

        $products = [
            ['name' => 'Aspen 2" Wood Blind', 'sku' => 'LW-WD-ASPEN', 'category' => 'wood_blinds', 'fabric' => null, 'color' => 'Natural Oak', 'price' => 289, 'cost' => 140, 'stock_qty' => 24],
            ['name' => 'Ridge Faux Wood Blind', 'sku' => 'LW-FX-RIDGE', 'category' => 'faux_wood', 'fabric' => null, 'color' => 'Cloud White', 'price' => 189, 'cost' => 85, 'stock_qty' => 40],
            ['name' => 'Summit Dual Cellular', 'sku' => 'LW-CL-SUMMIT', 'category' => 'cellular', 'fabric' => 'Soft Linen', 'color' => 'Fog', 'price' => 245, 'cost' => 110, 'stock_qty' => 32],
            ['name' => 'Nightfall Blackout Cellular', 'sku' => 'LW-CL-NIGHT', 'category' => 'cellular', 'fabric' => 'Blackout Weave', 'color' => 'Graphite', 'price' => 275, 'cost' => 125, 'stock_qty' => 18],
            ['name' => 'Skyline Motorized Roller', 'sku' => 'LW-RL-SKY', 'category' => 'motorized', 'fabric' => 'Solar Screen 5%', 'color' => 'Bronze', 'price' => 520, 'cost' => 260, 'stock_qty' => 12],
            ['name' => 'Cascade Roman Shade', 'sku' => 'LW-RM-CASC', 'category' => 'roman', 'fabric' => 'Cotton Blend', 'color' => 'Sandstone', 'price' => 310, 'cost' => 145, 'stock_qty' => 15],
            ['name' => 'Aurora Sheer Dual Shade', 'sku' => 'LW-SH-AUR', 'category' => 'sheer', 'fabric' => 'Sheer Voile', 'color' => 'Ivory', 'price' => 365, 'cost' => 170, 'stock_qty' => 10],
            ['name' => 'QuietLift Battery Motor', 'sku' => 'LW-HW-QLIFT', 'category' => 'hardware', 'fabric' => null, 'color' => 'White', 'price' => 149, 'cost' => 70, 'stock_qty' => 50],
        ];

        foreach ($products as $product) {
            Product::query()->updateOrCreate(
                ['sku' => $product['sku']],
                array_merge($product, [
                    'description' => $product['name'].' — precision-fit window treatment from LumenWeave Shade Co.',
                    'reorder_level' => 5,
                    'is_active' => true,
                ])
            );
        }

        $customers = collect([
            ['name' => 'Elena Vargas', 'email' => 'elena@example.com', 'phone' => '(720) 555-2211', 'city' => 'Denver', 'state' => 'CO', 'zip' => '80206', 'address' => '88 Columbine Ave'],
            ['name' => 'Marcus Chen', 'email' => 'marcus@example.com', 'phone' => '(720) 555-3344', 'city' => 'Boulder', 'state' => 'CO', 'zip' => '80302', 'address' => '412 Pearl St'],
            ['name' => 'Priya Shah', 'email' => 'priya@example.com', 'phone' => '(303) 555-7788', 'city' => 'Littleton', 'state' => 'CO', 'zip' => '80120', 'address' => '19 Windermere Ct'],
            ['name' => 'Noah Barrett', 'email' => 'noah@example.com', 'phone' => '(303) 555-9901', 'city' => 'Aurora', 'state' => 'CO', 'zip' => '80012', 'address' => '705 S Havana St'],
            ['name' => 'Harper Diaz', 'email' => 'harper@example.com', 'phone' => '(720) 555-1122', 'city' => 'Denver', 'state' => 'CO', 'zip' => '80220', 'address' => '1520 Monaco Pkwy'],
        ])->map(fn ($c) => Customer::query()->updateOrCreate(['email' => $c['email']], $c));

        $productModels = Product::query()->get();
        $statuses = ['pending', 'measuring', 'in_production', 'ready_to_install', 'installed', 'completed'];

        foreach ($customers->take(4) as $index => $customer) {
            $order = Order::query()->updateOrCreate(
                ['order_number' => 'LW-DEMO-'.str_pad((string) ($index + 1), 3, '0', STR_PAD_LEFT)],
                [
                    'customer_id' => $customer->id,
                    'user_id' => $index % 2 === 0 ? $manager->id : $staff->id,
                    'status' => $statuses[$index % count($statuses)],
                    'priority' => $index === 0 ? 'rush' : 'normal',
                    'due_date' => now()->addDays(7 + $index * 3),
                    'install_address' => $customer->address.', '.$customer->city.', '.$customer->state,
                    'subtotal' => 0,
                    'tax' => 0,
                    'total' => 0,
                    'notes' => 'Demo order for '.$customer->name,
                    'created_at' => now()->subMonths(5 - $index)->addDays($index * 2),
                ]
            );

            $order->items()->delete();
            $picked = $productModels->random(2);
            $subtotal = 0;
            foreach ($picked as $i => $product) {
                $qty = $i + 1;
                $line = $qty * (float) $product->price;
                $subtotal += $line;
                OrderItem::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'description' => $product->name,
                    'quantity' => $qty,
                    'unit_price' => $product->price,
                    'line_total' => $line,
                    'window_label' => 'Window '.($i + 1),
                ]);
            }
            $tax = round($subtotal * 0.0831, 2);
            $order->update(['subtotal' => $subtotal, 'tax' => $tax, 'total' => $subtotal + $tax]);

            $invoice = Invoice::query()->updateOrCreate(
                ['invoice_number' => 'INV-DEMO-'.str_pad((string) ($index + 1), 3, '0', STR_PAD_LEFT)],
                [
                    'customer_id' => $customer->id,
                    'order_id' => $order->id,
                    'status' => $index < 2 ? 'paid' : 'sent',
                    'issue_date' => now()->subDays(20 - $index),
                    'due_date' => now()->addDays(10 + $index),
                    'amount' => $order->total,
                    'amount_paid' => $index < 2 ? $order->total : 0,
                ]
            );

            if ($index < 2) {
                Payment::query()->updateOrCreate(
                    ['reference' => 'PAY-DEMO-'.($index + 1)],
                    [
                        'invoice_id' => $invoice->id,
                        'customer_id' => $customer->id,
                        'amount' => $invoice->amount,
                        'method' => 'card',
                        'paid_at' => now()->subMonths(4 - $index),
                        'notes' => 'Demo payment',
                    ]
                );
            }

            Appointment::query()->updateOrCreate(
                ['title' => 'Measure — '.$customer->name],
                [
                    'customer_id' => $customer->id,
                    'user_id' => $staff->id,
                    'type' => 'measure',
                    'status' => 'scheduled',
                    'starts_at' => now()->addDays($index + 1)->setTime(10 + $index, 0),
                    'ends_at' => now()->addDays($index + 1)->setTime(11 + $index, 0),
                    'address' => $customer->address.', '.$customer->city,
                    'notes' => 'Bring sample binder and laser measure.',
                ]
            );
        }

        $posts = [
            [
                'title' => 'Choosing Cellular Shades for Denver Winters',
                'excerpt' => 'How honeycomb cells trap warmth without darkening every room.',
                'cover' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80',
                'body' => "Colorado winters reward window treatments that respect both sunshine and insulation. Cellular shades create air pockets that slow heat transfer while still offering light-filtering fabrics for daytime living rooms.\n\nStart with orientation: south-facing glass often needs solar screens or dual shades, while bedrooms benefit from blackout cells. Ask your LumenWeave consultant about top-down/bottom-up designs so you can keep street privacy and sky light at the same time.",
            ],
            [
                'title' => 'Motorized Blinds Without the Clutter',
                'excerpt' => 'Battery lifts, quiet motors, and remotes that actually get used.',
                'cover' => 'https://images.unsplash.com/photo-1631679706909-1844bb25caa8?auto=format&fit=crop&w=1200&q=80',
                'body' => "Motorization used to mean hardwiring and wall scars. Today’s battery tubes and rechargeable wands make automated rollers and cellular shades practical for rentals and historic homes alike.\n\nWe group motors by room so one remote or app scene can lower west windows at 4pm glare and open east bedrooms at sunrise. Child-safe homes gain another benefit: no dangling cords.",
            ],
            [
                'title' => 'Wood vs Faux Wood Blinds in Sunrooms',
                'excerpt' => 'Grain, humidity, and UV — picking the right slat for bright rooms.',
                'cover' => 'https://images.unsplash.com/photo-1505693416388-ac8eb4aa0b0b?auto=format&fit=crop&w=1200&q=80',
                'body' => "Real wood blinds look beautiful in living rooms with controlled humidity. In sunrooms and baths, moisture-resistant faux wood keeps slats straighter for longer.\n\nIf you love oak grain, we can stain wood blinds to match trim. If your room swings hot and humid, faux wood with a cordless lift is usually the smarter long-term buy.",
            ],
        ];

        foreach ($posts as $post) {
            Post::query()->updateOrCreate(
                ['slug' => Str::slug($post['title'])],
                [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'body' => $post['body'],
                    'cover_image' => $post['cover'],
                    'is_published' => true,
                    'published_at' => now()->subDays(random_int(3, 40)),
                    'user_id' => $admin->id,
                ]
            );
        }

        $articles = [
            ['title' => 'Shade telescopes to one side', 'category' => 'common_issues', 'body' => "1. Confirm brackets are level.\n2. Fully lower and raise the shade twice.\n3. Check fabric tracking on the tube.\n4. If telescoping continues, schedule a service visit with the SKU and window label."],
            ['title' => 'Cordless shade will not stay raised', 'category' => 'common_issues', 'body' => "Often caused by an overloaded spring or incorrect size. Do not force the shade. Note the product SKU, measure the opening again, and contact LumenWeave support for a clutch inspection."],
            ['title' => 'How to prepare for an in-home measure', 'category' => 'guides', 'body' => "Clear furniture 2 feet from windows, unlock window coverings, and decide privacy needs per room. Have pets secured. Photos of existing treatments help if you cannot be present for the entire visit."],
            ['title' => 'Install day checklist', 'category' => 'guides', 'body' => "Expect 1–3 hours for most homes. Installers need parking access, cleared sills, and power for motorized products. Remotes are programmed before we leave; keep the spare battery pack charged."],
            ['title' => 'Admin: creating an order from a web lead', 'category' => 'admin_manual', 'body' => "1. Convert the Contact Message to a Customer.\n2. Create an Appointment (type: measure).\n3. After measuring, create an Order with line items per window.\n4. Generate an Invoice and collect deposit via Payments."],
            ['title' => 'Admin: inventory reorder workflow', 'category' => 'admin_manual', 'body' => "Products at or below reorder_level highlight in red on the Products table. Managers should create a purchase note in product comments and update stock_qty when crates arrive at the showroom."],
            ['title' => 'Motorized shade not responding', 'category' => 'troubleshooting', 'body' => "Check battery charge, confirm the remote channel, and re-pair if needed. Hardwired motors need a breaker check. If the motor hums but does not turn, stop use and book a service appointment."],
            ['title' => 'Customer disputes invoice amount', 'category' => 'troubleshooting', 'body' => "Compare Order line items to the signed estimate. Partial payments should leave Invoice status as partial. Managers can void and reissue only when a corrected Order exists."],
        ];

        foreach ($articles as $i => $article) {
            KnowledgeArticle::query()->updateOrCreate(
                ['slug' => Str::slug($article['title'])],
                [
                    'title' => $article['title'],
                    'category' => $article['category'],
                    'body' => $article['body'],
                    'sort_order' => $i + 1,
                    'is_published' => true,
                ]
            );
        }

        ContactMessage::query()->updateOrCreate(
            ['email' => 'lead@example.com', 'subject' => 'Motorized rollers for loft'],
            [
                'name' => 'Sam Rivera',
                'phone' => '(720) 555-6677',
                'message' => 'Looking for motorized rollers on four west-facing loft windows. Prefer weekday measure.',
                'status' => 'new',
            ]
        );
    }
}
