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
        return match($this->color) {
            'blue' => [
                'bg' => 'from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700',
                'text' => 'text-blue-100',
                'iconBg' => 'bg-white/20',
            ],
            'green' => [
                'bg' => 'from-green-500 to-green-600 dark:from-green-600 dark:to-green-700',
                'text' => 'text-green-100',
                'iconBg' => 'bg-white/20',
            ],
            'purple' => [
                'bg' => 'from-purple-500 to-purple-600 dark:from-purple-600 dark:to-purple-700',
                'text' => 'text-purple-100',
                'iconBg' => 'bg-white/20',
            ],
            'orange' => [
                'bg' => 'from-orange-500 to-orange-600 dark:from-orange-600 dark:to-orange-700',
                'text' => 'text-orange-100',
                'iconBg' => 'bg-white/20',
            ],
            'indigo' => [
                'bg' => 'from-indigo-500 to-indigo-600 dark:from-indigo-600 dark:to-indigo-700',
                'text' => 'text-indigo-100',
                'iconBg' => 'bg-white/20',
            ],
            default => [
                'bg' => 'from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700',
                'text' => 'text-blue-100',
                'iconBg' => 'bg-white/20',
            ],
        };
    }
}
