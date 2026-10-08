<?php

namespace App\View\Components\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Links extends Component
{
    // Pastikan properti ini terdaftar di atas construct
    public string $title, $route, $icon;
    public bool $active;
    public $parameter;

    public function __construct($title, $route, $icon, $parameter = null)
    {
        $this->title = $title;
        $this->route = $route; // Baris ini wajib ada agar rute terbaca
        $this->icon = $icon;
        $this->parameter = $parameter;
        
        $basePath = $this->generatePath($route);
        
        if (request()->routeIs($basePath)) {
            if ($basePath === 'jamaah.rt' && $parameter !== null) {
                $this->active = request()->route('rt') == $parameter;
            } else {
                $this->active = true;
            }
        } else {
            $this->active = false;
        }
    }

    public function generatePath($route)
    {
        if (str_contains($route, '.')) {
            if ($route === 'jamaah.rt') {
                return $route;
            }
            
            $path = explode('.', $route);
            return $path[0] . '.*'; 
        } 
        
        return $route; 
    }

    public function render(): View|Closure|string
    {
        return view('components.sidebar.links');
    }
}
