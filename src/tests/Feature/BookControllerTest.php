<?php

namespace Karlis\Module2\tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Karlis\Module2\Models\Author;
use Karlis\Module2\Models\Book;
use Karlis\Module2\Models\Currency;
use Karlis\Module2\tests\TestControllerCase;

class BookControllerTest extends TestControllerCase
{
    use WithFaker;

    /**
     * Test index route (GET /books).
     */
    public function testIndexReturnsBooksList(): void
    {
        $author = Author::newFactory()->create();

        Book::newFactory()->count(3)->create(['author_id' => $author->id]);

        $response = $this->getJson(route('book.index'));

        $response->assertOk();
        $response->assertJsonCount(3);
    }

    /**
     * Test store route (POST /books).
     */
    public function testStoreCreatesABook(): void
    {
        $author = Author::newFactory()->create();

        $data = [
            'title' => 'New Book Title',
            'description' => 'This is a description of the new book.',
            'author_id' => $author->id,
            'release_date' => '2024-09-29',
            'eur_price' => 19.99,
        ];

        $response = $this->postJson(route('book.store'), $data);

        $response->assertCreated()
            ->assertJsonFragment(['title' => 'New Book Title']);

        $this->assertDatabaseHas('books', $data);
    }

    /**
     * Test show route (GET /books/{id}).
     */
    public function testShowReturnsBookData(): void
    {
        $author = Author::newFactory()->create();

        $data = [
            'title' => 'New Book Title',
            'description' => 'This is a description of the new book.',
            'author_id' => $author->id,
            'release_date' => '2024-09-29',
            'eur_price' => 19.99,
        ];
        $book = Book::newFactory()->create($data);

        Currency::newFactory()->create();

        $response = $this->getJson(route('book.show', $book->id));

        $response->assertOk();
        $response->assertJsonFragment(['title' => $book->title]);
    }

    /**
     * Test update route (PUT /books/{id}).
     */
    public function testUpdateModifiesBookData(): void
    {
        $author = Author::newFactory()->create();
        $book = Book::newFactory()->create(['author_id' => $author->id]);

        $data = [
            'title' => 'Updated Book Title',
            'description' => 'This is an updated description.',
            'author_id' => $author->id,
            'release_date' => '2024-09-30',
            'eur_price' => 25.99,
        ];

        $response = $this->putJson(route('book.update', $book->id), $data);

        $response->assertOk();
        $response->assertJsonFragment(['title' => 'Updated Book Title']);
        $this->assertDatabaseHas('books', $data);
    }

    /**
     * Test destroy route (DELETE /authors/{id}).
     */
    public function testDestroyDeletesABook(): void
    {
        $author = Author::newFactory()->create();
        $book = Book::newFactory()->create(['author_id' => $author->id]);

        $response = $this->deleteJson(route('book.destroy', $book->id));

        $response->assertOk();
        $response->assertJson(['deleted' => ['id' => $book->id]]);
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
