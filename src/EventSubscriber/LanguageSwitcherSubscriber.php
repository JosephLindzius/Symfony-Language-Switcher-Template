<?php
declare(strict_types=1);

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LanguageSwitcherSubscriber implements EventSubscriberInterface
{
    private $defaultLocale;

    /**
     * LanguageSwitcherSubscriber constructor.
     * @param $defaultLocale
     */
    public function __construct(string $defaultLocale='en')
    {
        $this->defaultLocale = $defaultLocale;
    }


    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [['onKernelRequest',20]]
        ];
    }

    public function onKernelRequest(RequestEvent $event){
        $request = $event-> getRequest();
        $request->setlocale($_COOKIE['language']??$this->defaultLocal);
    }
}
