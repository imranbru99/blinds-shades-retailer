<x-filament-panels::page>
    <form wire:submit="generate" class="space-y-6">
        {{ $this->form }}

        <x-filament::button type="submit">
            Generate with AI
        </x-filament::button>
    </form>

    @if ($result)
        <div class="mt-8 rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <h3 class="mb-3 text-lg font-semibold">Generated output</h3>
            <div class="prose dark:prose-invert max-w-none whitespace-pre-wrap">{{ $result }}</div>
        </div>
    @endif
</x-filament-panels::page>
