<?php 
# src/EventSubscriber/EasyAdminSubscriber.php
namespace App\EventSubscriber;

use function Symfony\Component\String\u;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class SluggerSubscriber implements EventSubscriberInterface
{
    

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setSlug'],
            BeforeEntityUpdatedEvent::class=> ['refreshSlug'],
        ];
    }

    public function setSlug(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance(); 

        $slug = u($entity->getTitle())->snake();
       
        $entity->setSlug($slug.'_'.$entity->getId());

    }

    public function refreshSlug(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance(); 

        $slug = u($entity->getTitle())->snake();
       
        $entity->setSlug($slug.'_'.$entity->getId());

    }
}
