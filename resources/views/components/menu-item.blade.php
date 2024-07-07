@props( [
    'title',
    'icon',
    'route',
    'active' => false,
] )
<div class="app-menu__item">
    <a href="{{ $route }}" @class( [ 'active' => $active ] )>
        <div class="icon">
            <i class="{{ $icon }}"></i>
        </div>
        <div>{{ $title }}</div>
    </a>
</div>
