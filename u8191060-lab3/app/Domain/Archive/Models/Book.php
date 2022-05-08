<?php

namespace App\Domain\Archive\Models;

use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'release_date',
        'bookcase_id'
    ];

    protected static function newFactory()
    {
        return BookFactory::new();
    }

    public function bookcase()
    {
        return $this->belongsTo(Bookcase::class, 'bookcase_id', 'id');
    }
}
