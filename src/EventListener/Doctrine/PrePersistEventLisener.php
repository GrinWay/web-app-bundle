<?php

namespace GrinWay\WebApp\EventListener\Doctrine;

use Doctrine\ORM\Event\PrePersistEventArgs;
use GrinWay\Service\Service\CarbonService;

class PrePersistEventLisener
{
    public function __construct()
    {
    }

    public function __invoke(
        PrePersistEventArgs $args,
    ): void {
        $ojb = $args->getObject();

        if (\method_exists($ojb, 'setCreatedAt')) {
            $ojb->setCreatedAt(CarbonService::getNow(isImmutable: true));
        }
    }
}
