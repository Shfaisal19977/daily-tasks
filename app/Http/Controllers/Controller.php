<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Project Management System API',
    description: 'A Laravel-based REST API for managing projects, tasks, comments, books, and products.'
)]
#[OA\Server(
    url: 'http://localhost:8000',
    description: 'Local development server'
)]
#[OA\Server(
    url: 'http://localhost:8000',
    description: 'API Server'
)]
abstract class Controller
{
    //
}
