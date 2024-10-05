<?php

namespace Tests;

use DomainException;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (empty(config('app.key'))) {
            throw new DomainException("The APP_KEY not found!!!!!");
        }
    }
}
