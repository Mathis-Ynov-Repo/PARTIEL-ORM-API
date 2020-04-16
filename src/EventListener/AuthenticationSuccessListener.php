<?php

namespace App\EventListener;

use App\Entity\User;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

class AuthenticationSuccessListener
{
    private $em;

    function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof User) {
            return;
        }

        $user->setLastConnection(new DateTime('now', new DateTimeZone('Europe/Paris')));

        $this->em->flush();

        $data['data'] = array(
            'roles' => $user->getRoles(),
            'lastConnection' => $user->getLastConnection(),
        );

        $event->setData($data);
    }
}
