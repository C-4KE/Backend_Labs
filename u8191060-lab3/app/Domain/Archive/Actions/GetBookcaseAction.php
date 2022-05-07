<?php

namespace App\Domain\Archive\Actions;

use App\Domain\Archive\Models\Bookcase;

class GetBookcaseAction
{
    public function execute(int $bookcaseId): Bookcase
    {
        $bookcase = Bookcase::findOrFail($bookcaseId);
        return $bookcase;
    }
}