<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class IndexController
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(['status' => 'ok']);
    }
}