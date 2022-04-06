<?php

namespace App\Models;

use Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $attributes = [
        'is_banned' => false,
    ];
    protected $fillable = [
        'is_banned',
        'name',
        'surname',
        'phone',
        'email',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return CustomerFactory::new();
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'customer_id', 'id');
    }
}
