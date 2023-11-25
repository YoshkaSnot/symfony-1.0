<?php

namespace App\Controller;

use App\Event\LoggingEventDispatcher;
use App\Event\TestEvent;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class TestController extends AbstractController
{
    protected $container;

    public function __construct(
        private readonly LoggingEventDispatcher $eventDispatcher,
        ContainerInterface $container
    )
    {
        $this->container = $container;
    }

    #[Route('api/test/event', name: 'api_test_event')]
    public function index(Request $request): Response
    {
        $message = $request->query->get('message');

        if(!$message) {
            return new Response('Сообщение не найдено');
        }

        $this->eventDispatcher->dispatch(new TestEvent((string) $message));

        return new Response('Сообщение: ' . $message . ' отправлено');
    }
}
