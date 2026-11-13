
<x-filament-panels::page>
    <div class="space-y-6">
        <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-900">
            <div class="mb-5">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Developer Subscription Payment
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Manage the GCash QR code used for the ₱1,000 monthly ADV-EDITS subscription.
                </p>
            </div>

            <form wire:submit="save" class="space-y-6">
                {{ $this->form }}

                <div class="flex justify-end">
                    <x-filament::button type="submit" icon="heroicon-o-check">
                        Save Subscription QR
                    </x-filament::button>
                </div>
            </form>
        </div>
    </div>
</x-filament-panels::page>
