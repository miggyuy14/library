<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_the_library()
    {


        $response = $this->post('/books', [
            'title' => 'cool book title',
            'author' => 'miggy'
        ]);

        $book= Book::first();

        $this->assertCount(1, Book::all());
        $response->assertRedirect($book->path());
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


          $this->post('/books', [
              'title' => 'Cool title',
              'author' => 'miggy'
          ]);

          $book = Book::first();

          $response =$this->patch($book->path(), [
                'title' => 'New Title',
                'author' => 'New Author'
          ]);

          $this->assertEquals('New Title', Book::first()->title);
          $this->assertEquals('New Author', Book::first()->author);
          $response->assertRedirect($book->fresh()->path());
      }

      /** @test */
      public function a_book_can_be_deleted()
      {
          $this->post('/books', [
              'title' => 'Cool title',
              'author' => 'miggy'
          ]);

          $book = Book::first();
          $this->assertCount(1, Book::all());

          $response =$this->delete($book->path());

          $this->assertCount(0, Book::all());
          $response->assertRedirect('/books');

      }


}
