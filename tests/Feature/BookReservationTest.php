<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;

class BookReservasionTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'cool book title',
            'author' => 'miggy'
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());

    }

    /** @test */
    public function title_is_required()
    {


        $response = $this->post('/books', [
            'title' => '',
            'author' => 'miggy'
        ]);

        $response->assertSessionHasErrors('title');
    }

     /** @test */
     public function author_is_required()
     {


         $response = $this->post('/books', [
             'title' => 'Cool title',
             'author' => ''
         ]);

         $response->assertSessionHasErrors('author');
     }

      /** @test */
      public function a_book_can_be_updated()
      {
        $this->withoutExceptionHandling();

          $this->post('/books', [
              'title' => 'Cool title',
              'author' => 'miggy'
          ]);

          $book = Book::first();

          $response =$this->patch('/books/'. $book->id, [
                'title' => 'New Title',
                'author' => 'New Author'
          ]);

          $this->assertEquals('New Title', Book::first()->title);
          $this->assertEquals('New Author', Book::first()->author);
      }

}
