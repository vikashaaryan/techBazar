<div>
    @props([
    'href',
    'icon' => '',
    'active' => false
])

@php
    $isActive = request()->url() === $href || request()->routeIs($active);
@endphp

<a {{ $attributes->merge(['href' => $href]) }}
   class="sidebar-item flex items-center py-2 px-2 rounded text-sm 
          {{ $isActive ? 'bg-slate-700 text-primary-600 font-semibold' : '' }}">
    <i class="{{ $icon }} text-[6px] mr-3"></i>
    <span class="sidebar-text">{{ $slot }}</span>
</a>

</div>