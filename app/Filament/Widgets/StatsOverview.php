<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $openOrders = Order::query()->whereNotIn('status', ['completed', 'cancelled'])->count();
        $revenue = Invoice::query()->where('status', 'paid')->sum('amount_paid');
        $upcoming = Appointment::query()->where('starts_at', '>=', now())->where('status', '!=', 'cancelled')->count();

        return [
            Stat::make('Customers', Customer::query()->count())
                ->description('Active CRM records')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
            Stat::make('Open Orders', $openOrders)
                ->description('Jobs in progress')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('warning'),
            Stat::make('Paid Revenue', '$'.number_format((float) $revenue, 2))
                ->description('Collected invoice payments')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('info'),
            Stat::make('Upcoming Appointments', $upcoming)
                ->description('Measures & installs ahead')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary'),
        ];
    }
}
