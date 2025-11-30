# Project Management System

A Laravel-based REST API for managing projects, tasks, and comments. This application provides a hierarchical structure where projects contain tasks, and tasks contain comments.

## Overview

This is a comprehensive project management API system built with Laravel that enables you to:

- **Projects**: Create and manage projects with details like name, description, dates, and status
- **Tasks**: Create and manage tasks within projects with priority, status, and due dates
- **Comments**: Add comments to tasks for collaboration and tracking

The system follows a hierarchical structure where:
- Projects can have multiple tasks
- Tasks can have multiple comments
- All relationships are properly maintained and validated

## Features

### Projects
- List all projects with their associated tasks and comments
- Create new projects with validation
- Update existing projects
- Projects include: name, description, start date, end date, and status

### Tasks
- List all tasks for a specific project
- Create new tasks within a project
- Update existing tasks within a project
- Tasks include: title, details, status, priority, and due date
- Tasks are automatically associated with their parent project

### Comments
- List all comments for a specific task
- Create new comments on tasks
- Update existing comments on tasks
- Delete comments
- Comments include: comment text and author name

### Books
- List all books
- Get a single book by ID
- Create new books with validation
- Update existing books
- Delete books
- Books include: title, author, and publication year (4-digit validation)

### Products
- List all products
- Get a single product by ID
- Create new products with validation
- Update existing products
- Delete products
- Reduce product stock quantity
- Products include: name, price, quantity, and description

## API Endpoints

### Projects
- `GET /api/projects` - List all projects
- `POST /api/projects` - Create a new project
- `PUT /api/projects/{project}` - Update a project
- `PATCH /api/projects/{project}` - Update a project

### Tasks
- `GET /api/projects/{project}/tasks` - List all tasks for a project
- `POST /api/projects/{project}/tasks` - Create a new task in a project
- `PUT /api/projects/{project}/tasks/{task}` - Update a task
- `PATCH /api/projects/{project}/tasks/{task}` - Update a task

### Comments
- `GET /api/tasks/{task}/comments` - List all comments for a task
- `POST /api/tasks/{task}/comments` - Create a new comment on a task
- `PUT /api/tasks/{task}/comments/{comment}` - Update a comment
- `PATCH /api/tasks/{task}/comments/{comment}` - Update a comment
- `DELETE /api/tasks/{task}/comments/{comment}` - Delete a comment

### Books
- `GET /api/books` - List all books
- `POST /api/books` - Create a new book
- `GET /api/books/{book}` - Get a single book by ID
- `PUT /api/books/{book}` - Update a book
- `PATCH /api/books/{book}` - Update a book
- `DELETE /api/books/{book}` - Delete a book

### Products
- `GET /api/products` - List all products
- `POST /api/products` - Create a new product
- `GET /api/products/{product}` - Get a single product by ID
- `PUT /api/products/{product}` - Update a product
- `PATCH /api/products/{product}` - Update a product
- `DELETE /api/products/{product}` - Delete a product
- `POST /api/products/{product}/reduce-stock` - Reduce product stock by amount

## Technology Stack

- **Framework**: Laravel 12
- **PHP**: 8.4.15
- **Testing**: Pest PHP v4
- **Authentication**: Laravel Sanctum v4
- **Code Style**: Laravel Pint

## Installation

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```
3. Copy `.env.example` to `.env` and configure your database
4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Run migrations:
   ```bash
   php artisan migrate
   ```
6. **Access the application**
   
   if you're you're using Laravel Herd, the application is automatically available at: her http:...


   ```
   
   (If using `php artisan serve` instead, it will be at `http://localhost:8000`)

## API Documentation

This API includes interactive Swagger/OpenAPI documentation with dark mode. Visit:

**Swagger UI**: `http://laravel1.test/api/documentation`

(If using `php artisan serve`, use `http://localhost:8000/api/documentation`)

The documentation provides:
- Modern dark mode UI with enhanced color scheme
- Interactive API testing interface
- Complete endpoint documentation with detailed examples
- Request/response schemas with validation rules
- Try-it-out functionality with pre-filled examples
- Code samples in multiple languages
- Enhanced visual design with better contrast and readability

To regenerate the documentation after making changes:

```bash
php artisan l5-swagger:generate
```

## Testing

Run the test suite using Pest:

```bash
php artisan test
```

## Project Structure

- `app/Models/` - Eloquent models (Project, Task, Comment, Book, Product)
- `app/Models/Schemas/` - OpenAPI schema definitions for Swagger documentation
- `app/Http/Controllers/` - API controllers with OpenAPI annotations (ProjectController, BookController, ProductController, etc.)
- `app/Http/Requests/` - Form request validation classes
- `database/migrations/` - Database schema migrations
- `database/factories/` - Model factories for testing
- `routes/api.php` - API route definitions
- `tests/` - Pest test files

## Additional Features

This application also includes additional API modules:

### Books API
A complete CRUD API for managing books with title, author, and publication year validation.

### Products API
A complete CRUD API for managing products with inventory management capabilities, including:
- Product creation and management
- Stock quantity tracking
- Stock reduction functionality

