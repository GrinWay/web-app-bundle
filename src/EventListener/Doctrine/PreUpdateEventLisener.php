<?php

namespace GrinWay\WebApp\EventListener\Doctrine;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use GrinWay\Service\Service\CarbonService;

class PreUpdateEventLisener
{
    public function __construct()
    {
    }

    public function __invoke(
        PreUpdateEventArgs $args,
    ): void {
        $ojb = $args->getObject();

        if (\method_exists($ojb, 'setUpdatedAt')) {
            $ojb->setUpdatedAt(CarbonService::getNow(isImmutable: true));
        }
    }
}
