@props(['title' => ''])

<div class="mt-6 first:mt-0">
    @if($title)
    <p class="px-4 text-xs font-semibold text-primary-300 uppercase tracking-wider mb-3">
        {{ $title }}
    </p>
    @endif
    <div class="space-y-2">
        {{ $slot }}
    </div>
</div>
