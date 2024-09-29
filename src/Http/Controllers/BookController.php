<?php

namespace Karlis\Module2\Http\Controllers;

use CommonModule\Helper;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Karlis\Module2\Http\Requests\BookRequest;
use Karlis\Module2\Models\Book;
use Karlis\Module2\Models\Currency;

class BookController extends Controller
{
    public function index(): Collection
    {
        return Book::orderBy('created_at', 'desc')
            ->get();
    }

    public function store(BookRequest $request): Book
    {
        return Book::create($request->validated());
    }

    public function show(int $id): JsonResponse
    {
        $book = Book::find($id);
        $data = [
            'title' => $book->title,
            'description' => $book->description,
            'author' => $book->author->full_name,
            'release_date' => Helper::formatDate($book->release_date),
            'eur_price' => $book->eur_price,
            'usd_price' => Currency::convertValue('eur', 'usd', $book->eur_price),
        ];

        return response()->json(['data' => $data]);
    }

    public function update(BookRequest $request, int $id): Book
    {
        $book = Book::find($id);
        if ($book) {
            $book->update($request->validated());
        }

        return $book;
    }

    public function destroy(int $id): JsonResponse
    {
        $book = Book::find($id);
        if ($book) {
            $book->delete();
        }

        return response()->json(['deleted' => $book]);
    }
}
