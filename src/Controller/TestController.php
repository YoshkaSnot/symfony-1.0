<?php

namespace App\Controller;

use App\Event\LoggingEventDispatcher;
use App\Event\TestEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class TestController extends AbstractController
{
    #[Route('api/test/event', name: 'api_test_event')]
    public function index(Request $request, LoggingEventDispatcher $eventDispatcher): Response
    {
        $message = $request->query->get('message', 'Сообщение не найдено');

        $eventDispatcher->dispatch(new TestEvent((string) $message));

        return $this->json([$message]);
    }
}
