<?php

namespace App\Test\Infrastructure\Delivery\Api;

use App\Test\Application\Query\TestQuery;
use App\Test\Application\Query\TestQueryHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class Controller
{
    public function __construct(private TestQueryHandler $usecase)
    {
    }

    public function __invoke(): JsonResponse
    {
        $result = ($this->usecase)(new TestQuery());
        return new JsonResponse($result, Response::HTTP_OK);
    }
}
