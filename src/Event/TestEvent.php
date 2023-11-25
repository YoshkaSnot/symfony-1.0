<?php

declare(strict_types=1);

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

final class TestEvent extends Event
{
    public const NAME = 'test.message';

    public function __construct(string $message)
    {
    }
}