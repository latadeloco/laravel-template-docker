<?php

namespace App\Test\Infrastructure\Persistence;

use App\Test\Domain\TestInterface;

final class TestOneInterface implements TestInterface
{
    public function send(): string
    {
        return 'ok';
    }
}
