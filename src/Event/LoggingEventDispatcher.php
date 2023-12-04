<?php

declare(strict_types=1);

namespace App\Event;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;

final class LoggingEventDispatcher implements EventDispatcherInterface
{
    public function __construct(
        private readonly EventDispatcherInterface $eventDispatcher,
        private readonly LoggerInterface $eventLogger
    )
    {
    }

    public function dispatch(object $event): object
    {
        $this->eventLogger->info('Отправлено событие: ', ['object' => $event]);

        $this->eventDispatcher->dispatch($event);

        $this->eventLogger->info('Результат отправки события: ', ['object' => $event]);

        return $event;
    }
}