# Views Structure

This directory contains the Blade templates for the application, organized with layouts and partials for clean code organization.

## Directory Structure

```
resources/views/
├── layouts/
│   └── dashboard.blade.php    # Main dashboard layout
├── partials/
│   ├── header.blade.php        # Top header navigation
│   ├── sidebar.blade.php        # Sidebar navigation
│   ├── footer.blade.php         # Footer component
│   ├── user-menu.blade.php      # User dropdown menu
│   └── alert.blade.php          # Alert/notification component
└── dashboard/
    └── index.blade.php          # Dashboard home page
```

## Usage

### Using the Dashboard Layout

To create a new page using the dashboard layout, extend it in your Blade template:

```blade
@extends('layouts.dashboard')

@section('title', 'Page Title')
@section('page-title', 'Page Title')

@section('content')
    <div class="space-y-6">
        <!-- Your content here -->
    </div>
@endsection
```

### Including Partials

You can include any partial in your views:

```blade
@include('partials.header')
@include('partials.sidebar')
@include('partials.footer')
```

### Using Alerts

Display success/error messages:

```blade
@include('partials.alert', ['type' => 'success', 'message' => 'Operation successful!'])
@include('partials.alert', ['type' => 'error', 'message' => 'Something went wrong!'])
```

Or use session flash messages (automatically displayed in dashboard layout):

```php
return redirect()->route('dashboard')->with('success', 'Operation successful!');
return redirect()->route('dashboard')->with('error', 'Operation failed!');
```

## Customization

- **Layout**: Edit `layouts/dashboard.blade.php` to modify the overall structure
- **Sidebar**: Edit `partials/sidebar.blade.php` to add/remove navigation items
- **Header**: Edit `partials/header.blade.php` to customize the top bar
- **Styling**: All components use Tailwind CSS classes for styling

