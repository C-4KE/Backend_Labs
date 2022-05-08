<?php

use App\Domain\Archive\Models\Book;
use App\Domain\Archive\Models\Bookcase;

use function Pest\Laravel\{getJson};

beforeEach(function() {
    // Arrange
    Bookcase::factory()->count(2)->create();
    Book::factory()->count(2)->create();
});

it ('has books table', function() {
    $this->assertDatabaseCount('books', 2);
});

test('Successful get by id query', function() {
    // Arrange
    $expected = Book::where('id', 2)->get();
    // Act
    $response = getJson('api/v1/books/'.$expected[0]->id);
    // Assert
    $response->assertStatus(200);
    $response->assertExactJson(["data" => [
        "id" => $expected[0]->id,
        "title" => $expected[0]->title,
        "author" => $expected[0]->author,
        "publisher" => $expected[0]->publisher,
        "release_date" => $expected[0]->release_date,
        "bookcase_id" => $expected[0]->bookcase_id,
        "created_at" => $expected[0]->created_at,
        "updated_at" => $expected[0]->updated_at
    ]]);
});

test('Id that doesn\'t exist in database', function() {
    // Act
    $response = getJson('api/v1/books/500');
    // Assert
    $response->assertStatus(404);
    $response->assertExactJson(["error" => [
        "code" => "Illuminate\\Database\\Eloquent\\ModelNotFoundException",
        "message" => "Item with given id was not found."
    ]]);
});

test('Id that isn\'t an integer.', function() {
    // Act
    $response = getJson('api/v1/books/k');
    // Assert
    $response->assertStatus(400);
    $response->assertExactJson(["error" => [
        "code" => "CastingError",
        "message" => "Invalid id. Id must be integer number."
    ]]);
});