<?php

namespace App\Http\Controllers;

use App\Models\Book_m;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function show($book)
    {
        return Book_m()::find($book);
    }

    public function store(Request $request)
    {
        $book = Book_m::query()->create(['title' => $request->name]);
        return $book;
    }
     public function update(Request $request)
    {
        $book = Book_m::query()->update(['title' => $request->name]);
        return $book;
    }
    public function destroy(Request $request)
    {
         Book_m::('id',$book)->delete();
        return $book;
    }
}
