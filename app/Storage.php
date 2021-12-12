<?php

declare(strict_types=1);

namespace App;

use Enqueue\AmqpBunny\AmqpConnectionFactory;

final class Storage
{
    private \Interop\Queue\Context|\Enqueue\AmqpBunny\AmqpContext $context;

    public function __construct()
    {
        $rabbitMQConnectPermissions = [
            'host'      => $_ENV['RMQ_HOST'],
            'port'      => $_ENV['RMQ_PORT'],
            'vhost'     => $_ENV['RMQ_VHOST'],
            'user'      => $_ENV['RMQ_USER'],
            'pass'      => $_ENV['RMQ_PASS'],
            'persisted' => 'true' === $_ENV['RMQ_PERSISTED'],
        ];

        $factory = new AmqpConnectionFactory($rabbitMQConnectPermissions);
        $this->context = $factory->createContext();
    }

    public function save(string $topicName, array $data): void
    {
        $message = $this->context->createMessage(json_encode($data, JSON_THROW_ON_ERROR));
        $topic = $this->context->createTopic($topicName);

        $this->context->createProducer()->send($topic, $message);
    }
}