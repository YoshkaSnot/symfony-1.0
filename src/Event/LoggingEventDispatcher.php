<?php

declare(strict_types=1);

namespace App\Event;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Throwable;

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

        try {
            $this->eventDispatcher->dispatch($event);
        } catch (Throwable $e) {
            $this->eventLogger->error('Не удалось отправить событие: ', [
                'object' => $event,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
        }

        $this->eventLogger->info('Результат отправки события: ', ['object' => $event]);

        return $event;
    }
}