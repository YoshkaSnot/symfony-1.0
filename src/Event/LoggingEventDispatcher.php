<?php

declare(strict_types=1);

namespace App\Event;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;

final class LoggingEventDispatcher implements EventDispatcherInterface
{
    public function __construct(
        private readonly EventDispatcherInterface $eventDispatcher,
        private readonly LoggerInterface $logger
    )
    {
    }

    public function dispatch(object $event)
    {
        $this->logger->info('Отправлено событие: ' . get_class($event));

        $result = $this->eventDispatcher->dispatch($event);

        $this->logger->info('Результат отправки события: ' . get_class($event));

        return $result;
    }
}