<?php

namespace App\Domain\Archive\Actions;

class ErrorAction
{
    public function execute(string $code, string $message)
    {
        return [$code, $message];
    }
}