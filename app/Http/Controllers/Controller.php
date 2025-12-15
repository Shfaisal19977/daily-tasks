<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Project Management System API',
    description: 'A Laravel-based REST API for managing projects, tasks, comments, books, and products.'
)]
#[OA\Server(
    url: 'http://laravel1.test',
    description: 'Laravel Herd server'
)]
abstract class Controller
{
    protected function wantsJson(): bool
    {
        return request()->wantsJson() || request()->is('api/*');
    }
}
