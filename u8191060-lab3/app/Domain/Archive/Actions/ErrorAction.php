<?php

namespace App\Domain\Archive\Actions;

class ErrorAction
{
    public function execute(int $code, string $message)
    {
        return [$code, $message];
    }
}