<?php

namespace Database\Seeders;

use App\Models\Bookcase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookcaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bookcase::factory()
            ->count(100)
            ->create();
    }
}
