<?php

namespace App\EntityListener;

use App\Entity\Band;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class BandEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Band $band, LifecycleEventArgs $event)
    {
        $band->computeSlug($this->slugger);
    }

    public function preUpdate(Band $band, LifecycleEventArgs $event)
    {
        $band->computeSlug($this->slugger);
    }
}
