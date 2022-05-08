<?php

use App\Domain\Archive\Models\Book;
use App\Domain\Archive\Models\Bookcase;

use function Pest\Laravel\{putJson};

beforeEach(function() {
    // Arrange
    Bookcase::factory()->count(2)->create();
    Book::factory()->count(2)->create();
});

test('Successful put book query', function() {
    // Act
    $actual = putJson('/api/v1/books/1?title=A&author=A&publisher=A&release_date=2000-10-10&bookcase_id=1');
    // Assert
    $actual->assertStatus(200);
    $actual->assertJsonStructure(["data" => [
        "id",
        "title",
        "author",
        "publisher",
        "release_date",
        "bookcase_id",
        "created_at",
        "updated_at"
    ]]);
    $actual->assertJson(["data" => [
        "id" => 1,
        "title" => "A",
        "author" => "A",
        "publisher" => "A",
        "release_date" => "2000-10-10",
        "bookcase_id" => "1",
    ]]);
});

test('Put query with some missing parameters', function() {
    // Act
    $actual = putJson('/api/v1/books/1?title=A&publisher=A&release_date=2000-10-10');
    // Assert
    $actual->assertStatus(400);
    $actual->assertExactJson(["error" => [
        [
            "code" => "ValidationException",
            "message" => "The author field is required."
        ],
        [
            "code" => "ValidationException",
            "message" => "The bookcase_id field is required."
        ],
    ]]);
});

test('Put query without parameters', function() {
    // Act
    $actual = putJson('/api/v1/books/1?');
    // Assert
    $actual->assertStatus(400);
    $actual->assertExactJson(["error" => [
        [
            "code" => "ValidationException",
            "message" => "The title field is required."
        ],
        [
            "code" => "ValidationException",
            "message" => "The author field is required."
        ],
        [
            "code" => "ValidationException",
            "message" => "The publisher field is required."
        ],
        [
            "code" => "ValidationException",
            "message" => "The release_date field is required."
        ],
        [
            "code" => "ValidationException",
            "message" => "The bookcase_id field is required."
        ],
    ]]);
});

test('Put query with incorrect parameters', function() {
    // Act
    $actual = putJson('/api/v1/books/1?title=A&author=A&publisher=A&release_date=2000-10&bookcase_id=10');
    // Assert
    $actual->assertStatus(400);
    $actual->assertJsonStructure(["error" => [
        "code",
        "message"
    ]]);
    $actual->assertJson(["error" => [
        "code" => "Illuminate\\Database\\QueryException"
    ]]);
});