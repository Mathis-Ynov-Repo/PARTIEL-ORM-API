<?php

namespace App\EventListener;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;

class AuthenticationFailureListener
{
    private $em;
    private $userRepository;

    function __construct(EntityManagerInterface $em, UserRepository $userRepository)
    {
        $this->em = $em;
        $this->userRepository = $userRepository;
    }
    /**
     * @param AuthenticationFailureEvent $event
     */
    public function onAuthenticationFailureResponse(AuthenticationFailureEvent $event)
    {
        $userEmail = $event->getException()->getToken()->getUser();
        $user = $this->userRepository->findOneBy(['email' => $userEmail]);


        if (!$user instanceof User) {
            return;
        }

        $user = $this->userRepository->findOneBy(['email' => $userEmail]);

        $user->setFailedAuth($user->getFailedAuth() + 1);

        $data = [
            'status'  => '401 Unauthorized',
            'message' => 'Bad credentials, please verify that your username/password are correctly set',
        ];



        $this->em->flush();

        $response = new JWTAuthenticationFailureResponse($data);

        $event->setResponse($response);
    }
}
