<?php

use App\Domain\Archive\Models\Bookcase;

use function Pest\Laravel\{getJson};

beforeEach(function() {
    // Arrange
    Bookcase::factory()->count(2)->create();
});

test('Successful get query for all bookcases', function() {
    // Arrange
    $expected = Bookcase::all();
    // Act
    $actual = getJson('/api/v1/bookcases');
    // Assert
    $actual->assertStatus(200);
    $actual->assertExactJson(["data" => [
        [
            "id" => $expected[0]->id,
            "code" => $expected[0]->code,
            "created_at" => $expected[0]->created_at,
            "updated_at" => $expected[0]->updated_at
        ],
        [
            "id" => $expected[1]->id,
            "code" => $expected[1]->code,
            "created_at" => $expected[1]->created_at,
            "updated_at" => $expected[1]->updated_at
        ]
    ]]);
});