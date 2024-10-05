<?php

declare(strict_types=1);

namespace App\Test\Application\Query;

use App\Test\Domain\TestInterface;

final class TestQueryHandler
{
    public function __construct(private readonly TestInterface $interface)
    {
    }

    public function __invoke(TestQuery $query): string
    {
        return $this->interface->send();
    }
}
