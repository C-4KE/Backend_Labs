<?php

namespace App\Models;

use Database\Factories\BookcaseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookcase extends Model
{
    use HasFactory;

    protected $table = 'bookcases';
    protected $fillable = [
        'code'
    ];

    protected static function newFactory()
    {
        return BookcaseFactory::new();
    } 

    public function books()
    {
        return $this->hasMany(Book::class, 'bookcase_id', 'id');
    }
}
