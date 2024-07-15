<?php

namespace GrinWay\WebApp\Service\Messenger;

use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use GrinWay\WebApp\Contract\Messenger\HasSyncTransportInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use GrinWay\WebApp\Type\Messenger\BusTypes;

class Query
{
    use HandleTrait;

    public function __construct(
		#[Autowire(service: BusTypes::QUERY_BUS)]
        private MessageBusInterface $messageBus,
    ) {
    }

    public function __invoke(HasSyncTransportInterface $query): mixed
    {
        return $this->handle($query);
    }
}
