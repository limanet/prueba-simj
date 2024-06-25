@props( [
    'title',
    'icon',
    'route',
    'active' => false,
] )
<div class="app-menu_item">
    <a href="{{ $route }}" @class( [ 'active' => $active ] )>
        <i class="{{ $icon }}"></i>
        <span>{{ $title }}</span>
    </a>
</div>
