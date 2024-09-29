<?php

namespace Karlis\Module2\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Karlis\Module2\Http\Requests\BookRequest;
use Karlis\Module2\Models\Author;
use Karlis\Module2\Models\Book;

class BookController extends Controller
{
    public function index(): Collection
    {
        //
    }

    public function store(BookRequest $request): Book
    {
        //
    }

    public function show(int $id): JsonResponse
    {
        //
    }

    public function update(BookRequest $request, int $id): Book
    {
        //
    }

    public function destroy(int $id): JsonResponse
    {
        //
    }
}
