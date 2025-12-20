<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatCard extends Component
{
    public array $colors;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public string|int $value,
        public string $color = 'blue',
        public ?string $icon = null,
        public ?string $link = null,
        public ?string $linkText = 'View all',
        public ?string $extraInfo = null
    ) {
        $this->colors = $this->getColorClasses();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.stat-card');
    }

    /**
     * Get the color classes based on the color prop.
     */
    public function getColorClasses(): array
    {
        // All stat cards use the same color palette
        return [
            'bg' => 'from-[#DCD6F7] to-[#F4EEFF]',
            'text' => 'text-[#424874]',
            'iconBg' => 'bg-[#A6B1E1]',
        ];
    }
}
