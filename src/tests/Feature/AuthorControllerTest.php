<?php

namespace Karlis\Module2\tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Karlis\Module2\Models\Author;
use Karlis\Module2\Models\Book;
use Karlis\Module2\tests\TestControllerCase;

class AuthorControllerTest extends TestControllerCase
{
    use WithFaker;

    /**
     * Test index route (GET /author).
     */
    public function testIndexReturnsAuthorsList(): void
    {
        Author::newFactory()->count(3)->create();

        $response = $this->get(route('author.index'));

        $response->assertOk();
        $response->assertJsonCount(3);
    }

    /**
     * Test store route (POST /author).
     */
    public function testStoreCreatesAnAuthor(): void
    {
        $data = [
            'full_name' => $this->faker->name,
            'date_of_birth' => $this->faker->date('Y-m-d'),
            'country' => $this->faker->country,
        ];

        $response = $this->postJson(route('author.store'), $data);

        $response->assertCreated();

        $this->assertDatabaseHas('authors', $data);
    }

    /**
     * Test show route (GET /author/{id}).
     */
    public function testShowReturnsAuthorData(): void
    {
        $author = Author::newFactory()->create();

        $response = $this->getJson(route('author.show', $author->id));

        $response->assertOk();
        $response->assertJson(['author' => $author->toArray()]);
    }

    /**
     * Test update route (PUT /author/{id}).
     */
    public function testUpdateModifiesAuthorData(): void
    {
        $author = Author::newFactory()->create();

        $data = [
            'full_name' => 'Updated Name',
            'date_of_birth' => $this->faker->date('Y-m-d'),
            'country' => 'Updated Country',
        ];

        $response = $this->putJson(route('author.update', $author->id), $data);

        $response->assertOk();

        $this->assertDatabaseHas('authors', [
            'id' => $author->id,
            'full_name' => 'Updated Name',
            'country' => 'Updated Country',
        ]);
    }

    /**
     * Test destroy route (DELETE /author/{id}).
     */
    public function testDestroyDeletesAnAuthor(): void
    {
        $author = Author::newFactory()->create();

        $response = $this->deleteJson(route('author.destroy', $author->id));

        $response->assertOk();

        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }
}
