@props(['align' => 'right', 'width' => 'full', 'contentClasses' => 'text-white bg-gray-800'])

@php
switch ($align) {
    case 'left':
        $alignmentClasses = 'origin-top-left left-0';
        break;
    case 'top':
        $alignmentClasses = 'origin-top';
        break;
    case 'right':
    default:
        $alignmentClasses = 'origin-top-right right-0';
        break;
}

@endphp

<div class="z-10" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
    <div class="flex items-center">
        <div @click="open = ! open">
            {{ $trigger }}
        </div>
        <div class="ml-3">
            {{ $offline }}
        </div>
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute z-50 top-0 left-0  {{ $width }} {{ $alignmentClasses }}"
            style="display: none;height:90vh;"
            @click="open = false">
        <div class="h-full pt-12 {{ $contentClasses }}">
            <div @click="open = false">
                {{ $esc }}
            </div>
            {{ $content }}
        </div>
    </div>
</div>
