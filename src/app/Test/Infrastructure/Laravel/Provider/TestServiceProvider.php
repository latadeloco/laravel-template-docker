<?php

declare(strict_types=1);

namespace App\Test\Infrastructure\Laravel\Provider;

use App\Test\Domain\TestInterface;
use App\Test\Infrastructure\Persistence\TestOneInterface;
use Illuminate\Support\ServiceProvider;

final class TestServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TestInterface::class, TestOneInterface::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
