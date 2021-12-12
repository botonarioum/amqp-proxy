<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class WebhookController
{
    public function __invoke(Request $request, string $botName): JsonResponse
    {
        if ($request->isMethod('POST')) {
            $storage = new Storage();
            $storage->save('telegram.bot.' . $botName, $request->toArray());
        }

        return new JsonResponse(['status' => 'ok']);
    }
}