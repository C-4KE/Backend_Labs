<?php

use App\Domain\Archive\Models\Bookcase;
use App\Domain\Archive\Models\Book;

use function Pest\Laravel\{getJson};

beforeEach(function() {
    // Arrange
    Bookcase::factory()->count(2)->create();
    Book::factory()->count(2)->create();
});

test('Successful get query for bookcase by id', function() {
    // Arrange
    $expected = Bookcase::where('id', 2)->get();
    // Act
    $actual = getJson('/api/v1/bookcases/'.$expected[0]->id);
    // Assert
    $actual->assertStatus(200);
    $actual->assertExactJson(["data" => [
        "id" => $expected[0]->id,
        "code" => $expected[0]->code,
        "created_at" => $expected[0]->created_at,
        "updated_at" => $expected[0]->updated_at
    ]]);
});

test('Get query with id that doesn\'t exist (without include)', function() {
    // Act
    $actual = getJson('api/v1/bookcases/50');
    // Assert
    $actual->assertStatus(404);
    $actual->assertExactJson(["error" => [
        "code" => "Illuminate\\Database\\Eloquent\\ModelNotFoundException",
        "message" => "Item with given id was not found."
    ]]);
});

test('Get query with id that isn\'t an integer', function() {
    // Act
    $actual = getJson('api/v1/bookcases/t');
    // Assert
    $actual->assertStatus(400);
    $actual->assertExactJson(["error" => [
        "code" => "CastingError",
        "message" => "Invalid id. Id must be integer number."
    ]]);
});

test('Successful get query for bookcase by id with include (books with matching bookcase_id exist)', function() {
    // Arrange
    $expectedBookcase = Bookcase::factory()->count(1)->create();
    $expectedBook = Book::factory(['bookcase_id' => 3])->count(2)->create();
    // Act
    $actual = getJson('api/v1/bookcases/3?include=books');
    // Assert
    $actual->assertStatus(200);
    $actual->assertExactJson(["data" => [
        "id" => $expectedBookcase[0]->id,
        "code" => $expectedBookcase[0]->code,
        "created_at" => $expectedBookcase[0]->created_at,
        "updated_at" => $expectedBookcase[0]->updated_at,
        "books" => [
            [
                "id" => $expectedBook[0]->id,
                "title" => $expectedBook[0]->title,
                "author" => $expectedBook[0]->author,
                "publisher" => $expectedBook[0]->publisher,
                "release_date" => $expectedBook[0]->release_date,
                "bookcase_id" => $expectedBook[0]->bookcase_id,
                "created_at" => $expectedBook[0]->created_at,
                "updated_at" => $expectedBook[0]->updated_at
            ],
            [
                "id" => $expectedBook[1]->id,
                "title" => $expectedBook[1]->title,
                "author" => $expectedBook[1]->author,
                "publisher" => $expectedBook[1]->publisher,
                "release_date" => $expectedBook[1]->release_date,
                "bookcase_id" => $expectedBook[1]->bookcase_id,
                "created_at" => $expectedBook[1]->created_at,
                "updated_at" => $expectedBook[1]->updated_at
            ]
        ]
    ]]);
});

test('Successful get query for bookcase by id with include (books with matching bookcase_id don\'t exist)', function() {
    // Arrange
    $expected = Bookcase::factory()->count(1)->create();
    // Act
    $actual = getJson('api/v1/bookcases/3?include=books');
    // Assert
    $actual->assertStatus(200);
    $actual->assertExactJson(["data" => [
        "id" => $expected[0]->id,
        "code" => $expected[0]->code,
        "created_at" => $expected[0]->created_at,
        "updated_at" => $expected[0]->updated_at,
        "books" => []
    ]]);
});

test('Get query for bookcases by id with empty include parameter', function() {
    // Act
    $actual = getJson('api/v1/bookcases/2?include=');
    // Assert
    $actual->assertStatus(400);
    $actual->assertExactJson(["error" => [
        "code" => "ValidationException",
        "message" => "Include value mismatching with 'books'."
    ]]);
});

test('Get query for bookcases by id with incorrect include parameter', function() {
    // Act
    $actual = getJson('api/v1/bookcases/2?include=incorrect');
    // Assert
    $actual->assertStatus(400);
    $actual->assertExactJson(["error" => [
        "code" => "ValidationException",
        "message" => "Include value mismatching with 'books'."
    ]]);
});