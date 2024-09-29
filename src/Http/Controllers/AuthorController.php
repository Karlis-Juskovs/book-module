<?php

namespace Karlis\Module2\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Karlis\Module2\Http\Requests\AuthorRequest;
use Karlis\Module2\Models\Author;

class AuthorController extends Controller
{
    public function index(): Collection
    {
        return Author::orderBy('created_at', 'desc')
            ->get();
    }

    public function store(AuthorRequest $request): Author
    {
        return Author::create($request->all());
    }

    public function show(int $id): JsonResponse
    {
        $author = Author::find($id);

        return response()->json(['author' => $author]);
    }

    public function update(AuthorRequest $request, int $id): Author
    {
        $author = Author::find($id);
        if ($author) {
            $author->update($request->all());
        }

        return $author;
    }

    public function destroy(int $id): JsonResponse
    {
        $author = Author::find($id);
        if ($author) {
            $author->delete();
        }

        return response()->json(['deleted' => $author]);
    }
}
