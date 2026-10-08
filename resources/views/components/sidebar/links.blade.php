<li class="pc-item">
    <a href="{{ $route === 'jamaah.rt' ? route($route, ['rt' => $parameter]) : route($route) }}" 
       class="pc-link" 
       @if($active) style="background-color: #0b7f63 !important; color: #ffffff !important;" @endif>
        <span class="pc-micon"><i class="{{ $icon }}"></i></span>
        <span class="pc-mtext">{{ $title }}</span> 
    </a>
</li>
