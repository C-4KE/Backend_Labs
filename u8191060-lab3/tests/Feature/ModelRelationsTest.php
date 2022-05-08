<?php

use App\Domain\Archive\Models\Book;
use App\Domain\Archive\Models\Bookcase;

use function PHPUnit\Framework\assertEquals;

test('Get books from bookcase', function() {
    // Arrange
    $bookcase = Bookcase::factory()->create();
    $books = Book::factory()->count(2)->create();
    // Act
    $actual = $bookcase->books;
    // Assert
    for ($i = 0; $i < 2; $i++)
    {
        assertEquals($books[$i]->id, $actual[$i]->id);
        assertEquals($books[$i]->title, $actual[$i]->title);
        assertEquals($books[$i]->author, $actual[$i]->author);
        assertEquals($books[$i]->publisher, $actual[$i]->publisher);
        assertEquals($books[$i]->release_date, $actual[$i]->release_date);
        assertEquals($books[$i]->bookcase_id, $actual[$i]->bookcase_id);
        assertEquals($books[$i]->created_at, $actual[$i]->created_at);
        assertEquals($books[$i]->updated_at, $actual[$i]->updated_at);
    }
});

test('Get bookcase from book', function() {
    // Arrange
    $expected = Bookcase::factory()->create();
    $book = Book::factory()->create();
    // Act
    $actual = $book->bookcase;
    // Assert
    assertEquals($expected->id, $actual->id);
    assertEquals($expected->code, $actual->code);
    assertEquals($expected->created_at, $actual->created_at);
    assertEquals($expected->updated_at, $actual->updated_at);
});