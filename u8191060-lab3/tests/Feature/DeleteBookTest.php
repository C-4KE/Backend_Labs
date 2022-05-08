<?php

use App\Domain\Archive\Models\Book;
use App\Domain\Archive\Models\Bookcase;

use function Pest\Laravel\{deleteJson};

beforeEach(function() {
    // Arrange
    Bookcase::factory()->count(2)->create();
    Book::factory()->count(2)->create();
});

test('Successful delete book query', function() {
    // Act
    $actual = deleteJson('/api/v1/books/1');
    // Assert
    $actual->assertStatus(200);
    $actual->assertExactJson(["data" => null]);
    $this->assertDatabaseMissing('books', ['id' => 1]);
});

test('Delete query on id, that doesn\'t exist', function() {
    // Act
    $actual = deleteJson('/api/v1/books/3');
    // Assert
    $actual->assertStatus(200);
    $actual->assertExactJson(["data" => null]);
});

test('Delete query on id, that isn\'t an integer', function() {
    // Act
    $actual = deleteJson('/api/v1/books/j');
    // Assert
    $actual->assertStatus(400);
    $actual->assertExactJson(["error" => [
        "code" => "CastingError",
        "message" => "Invalid id. Id must be integer number."
    ]]);
});