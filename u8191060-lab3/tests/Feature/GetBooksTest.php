<?php

use App\Domain\Archive\Models\Book;
use App\Domain\Archive\Models\Bookcase;

use function Pest\Laravel\{getJson};

beforeEach(function() {
    // Arrange
    Bookcase::factory()->count(2)->create();
    Book::factory()->count(2)->create();
});

test('Successful get query for all books', function() {
    // Arrange
    $expected = Book::all();
    // Act
    $actual = getJson('/api/v1/books');
    // Assert
    $actual->assertStatus(200);
    $actual->assertExactJson(["data" => [
        [
            "id" => $expected[0]->id,
            "title" => $expected[0]->title,
            "author" => $expected[0]->author,
            "publisher" => $expected[0]->publisher,
            "release_date" => $expected[0]->release_date,
            "bookcase_id" => $expected[0]->bookcase_id,
            "created_at" => $expected[0]->created_at,
            "updated_at" => $expected[0]->updated_at
        ],
        [
            "id" => $expected[1]->id,
            "title" => $expected[1]->title,
            "author" => $expected[1]->author,
            "publisher" => $expected[1]->publisher,
            "release_date" => $expected[1]->release_date,
            "bookcase_id" => $expected[1]->bookcase_id,
            "created_at" => $expected[1]->created_at,
            "updated_at" => $expected[1]->updated_at
        ]
    ]]);
});