<?php

use App\Domain\Archive\Models\Book;
use App\Domain\Archive\Models\Bookcase;

use function Pest\Laravel\{postJson};

beforeEach(function() {
    // Arrange
    Bookcase::factory()->count(2)->create();
    Book::factory()->count(2)->create();
});

test('Successful post book query', function() {
    // Act
    $actual = postJson('/api/v1/books?title=A&author=A&publisher=A&release_date=2000-10-10&bookcase_id=1');
    // Assert
    $actual->assertStatus(201);
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
        "id" => 3,
        "title" => "A",
        "author" => "A",
        "publisher" => "A",
        "release_date" => "2000-10-10",
        "bookcase_id" => "1",
    ]]);
});

test('Successful post book query (with ignoring id)', function() {
    // Act
    $actual = postJson('/api/v1/books?id=50&title=A&author=A&publisher=A&release_date=2000-10-10&bookcase_id=1');
    // Assert
    $actual->assertStatus(201);
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
        "id" => 3,
        "title" => "A",
        "author" => "A",
        "publisher" => "A",
        "release_date" => "2000-10-10",
        "bookcase_id" => "1",
    ]]);
});

test('Post query with some missing parameters', function() {
    // Act
    $actual = postJson('/api/v1/books?title=A&publisher=A&release_date=2000-10-10');
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

test('Post query without parameters', function() {
    // Act
    $actual = postJson('/api/v1/books?');
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

test('Post query with incorrect parameters', function() {
    // Act
    $actual = postJson('/api/v1/books?id=50&title=A&author=A&publisher=A&release_date=2000-10&bookcase_id=10');
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