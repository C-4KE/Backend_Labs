<?php

use App\Domain\Archive\Models\Book;
use App\Domain\Archive\Models\Bookcase;

use function Pest\Laravel\{patchJson};

beforeEach(function() {
    // Arrange
    Bookcase::factory()->count(2)->create();
    Book::factory()->count(2)->create();
});

test('Successful patch book query (with all parameters)', function() {
    // Arrange
    $expected = Book::where('id', 1)->get();
    // Act
    $actual = patchJson('/api/v1/books/1?title=A&author=A&publisher=A&release_date=2000-10-10&bookcase_id=1');
    // Assert
    $actual->assertStatus(200);
    $actual->assertExactJson(["data" => [
        "id" => 1,
        "title" => "A",
        "author" => "A",
        "publisher" => "A",
        "release_date" => "2000-10-10",
        "bookcase_id" => "1",
        "created_at" => $expected[0]->created_at,
        "updated_at" => $expected[0]->updated_at
    ]]);
});

test('Successful patch book query (with some parameters)', function() {
    // Arrange
    $expected = Book::where('id', 1)->get();
    // Act
    $actual = patchJson('/api/v1/books/1?title=A&publisher=A&bookcase_id=1');
    // Assert
    $actual->assertStatus(200);
    $actual->assertExactJson(["data" => [
        "id" => 1,
        "title" => "A",
        "author" => $expected[0]->author,
        "publisher" => "A",
        "release_date" => $expected[0]->release_date,
        "bookcase_id" => "1",
        "created_at" => $expected[0]->created_at,
        "updated_at" => $expected[0]->updated_at
    ]]);
});

test('Patch query without parameters', function() {
    // Arrange
    $expected = Book::where('id', 1)->get();
    // Act
    $actual = patchJson('/api/v1/books/1');
    // Assert
    $actual->assertStatus(200);
    $actual->assertExactJson(["data" => [
        "id" => 1,
        "title" => $expected[0]->title,
        "author" => $expected[0]->author,
        "publisher" => $expected[0]->publisher,
        "release_date" => $expected[0]->release_date,
        "bookcase_id" => $expected[0]->bookcase_id,
        "created_at" => $expected[0]->created_at,
        "updated_at" => $expected[0]->updated_at
    ]]);
});

test('Patch query with some inexistent parameters', function() {
    // Arrange
    $expected = Book::where('id', 1)->get();
    // Act
    $actual = patchJson('/api/v1/books/1?title=A&publisher=A&bookcase_id=1&incorrect_parameter=test');
    // Assert
    $actual->assertStatus(200);
    $actual->assertExactJson(["data" => [
        "id" => 1,
        "title" => "A",
        "author" => $expected[0]->author,
        "publisher" => "A",
        "release_date" => $expected[0]->release_date,
        "bookcase_id" => "1",
        "created_at" => $expected[0]->created_at,
        "updated_at" => $expected[0]->updated_at
    ]]);
});

test('Patch query with incorrect parameters', function() {
    // Act
    $actual = patchJson('/api/v1/books/1?title=A&author=A&publisher=A&release_date=2000-10&bookcase_id=10');
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

test('Id that doesn\'t exist in database', function() {
    // Act
    $actual = patchJson('api/v1/books/500');
    // Assert
    $actual->assertStatus(404);
    $actual->assertExactJson(["error" => [
        "code" => "Illuminate\\Database\\Eloquent\\ModelNotFoundException",
        "message" => "Item with given id was not found."
    ]]);
});

test('Id that isn\'t an integer.', function() {
    // Act
    $actual = patchJson('api/v1/books/k');
    // Assert
    $actual->assertStatus(400);
    $actual->assertExactJson(["error" => [
        "code" => "CastingError",
        "message" => "Invalid id. Id must be integer number."
    ]]);
});