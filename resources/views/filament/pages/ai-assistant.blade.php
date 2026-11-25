<x-filament-panels::page>
    <form wire:submit="ask" class="space-y-6">
        {{ $this->form }}
        <x-filament::button type="submit">Ask assistant</x-filament::button>
    </form>

    @if ($reply)
        <div class="mt-8 rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <h3 class="mb-3 text-lg font-semibold">Assistant reply</h3>
            <p class="whitespace-pre-wrap text-sm leading-relaxed">{{ $reply }}</p>
        </div>
    @endif
</x-filament-panels::page>
