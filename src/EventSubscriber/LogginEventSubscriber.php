<?php

namespace App\EventSubscriber;

//use App\Entity\User;
use App\Entity\Logs;
use App\Repository\LogsRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

class LogginEventSubscriber implements EventSubscriberInterface
{
    private $repository;

    public function __construct (LogsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function onLoginSuccessEvent(LoginSuccessEvent $event)
    {
        $user = $event->getUser();
        if (strpos($user->getUserIdentifier(), '@') !== false)
        {
            $user_ip = $event->getRequest()->getClientIp();
            $user->setIp($user_ip);
            $logs = new Logs($user);
            $this->repository->save($logs);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            LoginSuccessEvent::class => 'onLoginSuccessEvent',
        ];
    }
}
