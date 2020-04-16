<?php

namespace App\EventSubscriber;

use App\Entity\AbstractEntity;

use DateTime;
use DateTimeZone;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class EntityCreatedSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();

        if ($object instanceof AbstractEntity) {
            $object->setCreated(new DateTime('now', new DateTimeZone('Europe/Paris')));
        }
    }
}
