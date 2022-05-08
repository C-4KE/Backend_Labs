<?php

namespace App\Domain\Archive\Actions;

use App\Domain\Archive\Models\Bookcase;

class GetBookcasesAction
{
    public function execute()
    {
        return Bookcase::all();
    }
}