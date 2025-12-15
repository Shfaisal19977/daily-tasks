import './bootstrap';

// Dark mode toggle functionality
(function() {
    'use strict';

    function updateToggleIcons(isDark) {
        const toggles = document.querySelectorAll('#dark-mode-toggle');
        toggles.forEach(function(toggle) {
            const icon = toggle.querySelector('svg');
            if (icon) {
                if (isDark) {
                    // Sun icon for dark mode (click to switch to light)
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>';
                } else {
                    // Moon icon for light mode (click to switch to dark)
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>';
                }
            }
        });
    }

    function toggleDarkMode() {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        updateToggleIcons(isDark);
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Check for saved theme preference or default to light mode
        const theme = localStorage.getItem('theme') || 'light';
        const isDark = theme === 'dark';

        if (isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        // Set initial icons
        updateToggleIcons(isDark);

        // Add event listeners to all toggle buttons
        const darkModeToggles = document.querySelectorAll('#dark-mode-toggle');
        darkModeToggles.forEach(function(toggle) {
            toggle.addEventListener('click', toggleDarkMode);
        });
    });
})();
