<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservasionTest extends TestCase
{

    public function a_book_can_be_added_to_the_library()
    {
        $this->withouttExcwptionHandling();

        $response = $this->post('/books', [
            'title' => 'cool book title',
            'author' => 'miggy'
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());

    }
}
