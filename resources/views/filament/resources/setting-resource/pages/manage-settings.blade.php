<x-filament-panels::page>
    <form wire:submit="save">
        {{ $this->form }}

        @if(count($this->getCachedFormActions()) > 0)
            <x-filament-panels::form.actions
                :actions="$this->getCachedFormActions()"
                :full-width="$this->hasFullWidthFormActions()"
            />
        @endif
    </form>
</x-filament-panels::page>
