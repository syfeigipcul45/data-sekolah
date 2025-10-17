@php
    $hasLogo = filled($logo = config('filament.panels.admin.brandLogo'));
@endphp

<div class="flex items-center">
    @if ($hasLogo)
        <img src="{{ $logo }}" alt="Logo" class="h-10">
    @else
        <div class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white">
            {{ config('filament.panels.admin.brand') }}
        </div>
    @endif
</div>