<?php

namespace GrinWay\WebApp;

use Doctrine\ORM\Events;
use GrinWay\WebApp\Configuration;
use GrinWay\Service\Service\ServiceContainer;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use GrinWay\WebApp\EventListener\Doctrine\PreUpdateEventLisener;
use GrinWay\WebApp\EventListener\Doctrine\PrePersistEventLisener;
use GrinWay\WebApp\Service\Messenger\Query;
use GrinWay\WebApp\Contract\Messenger\MessageHasSyncTransportInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use GrinWay\WebApp\Type\Messenger\BusTypes;

class GrinWayWebAppExtension extends ConfigurableExtension implements PrependExtensionInterface
{
    public const PREFIX = 'grin_way_web_app';

    public const DOCTRINE_NODE_NAME = 'doctrine';
    public const PRE_PERSIST_FOR_CREATED_AT_EVENT_LISTENER_NODE_NAME = 'pre_persist_for_created_at_event_listener';
    public const PRE_PERSIST_FOR_UPDATED_AT_EVENT_LISTENER_NODE_NAME = 'pre_update_for_updated_at_event_listener';
    public const IS_LISTEN_NODE_NAME = 'is_listen';
    public const PRIORITY_NODE_NAME = 'priority';
    public const CONNECTION_NODE_NAME = 'connection';

    public const MESSENGER_QUERY_NAME = 'messenger.query';

    public function __construct()
    {
    }

    public function getAlias(): string
    {
        return self::PREFIX;
    }

    public function prepend(ContainerBuilder $container)
    {
        ServiceContainer::loadYaml(
            $container,
            __DIR__ . '/..',
            [
                ['config', 'services.yaml'],
                ['config/packages', 'messenger.yaml'],
            ],
        );
    }

    public function getConfiguration(
        array $config,
        ContainerBuilder $container,
    ) {
        return new Configuration();
    }

    public function loadInternal(array $config, ContainerBuilder $container): void
    {
        $this->setContainerParameters(
            $config,
            $container,
        );
        $this->setContainerDefinitions(
            $config,
            $container,
        );
        $this->setContainerTags(
            $container,
        );
    }

    private function setContainerParameters(
        array $config,
        ContainerBuilder $container,
    ) {
        $pa = PropertyAccess::createPropertyAccessor();
        ServiceContainer::setParametersForce(
            $container,
            callbackGetValue: static function ($key) use (&$config, $pa) {
                return $pa->getValue($config, '[' . $key . ']');
            },
            parameterPrefix: self::PREFIX,
            keys: [
                self::DOCTRINE_NODE_NAME,
            ],
        );
    }


    //###> HELPERS ###

    private function setContainerDefinitions(
        array $config,
        ContainerBuilder $container,
    ) {
        $pa = PropertyAccess::createPropertyAccessor();

        [
            self::PRE_PERSIST_FOR_CREATED_AT_EVENT_LISTENER_NODE_NAME => $prePersist,
            self::PRE_PERSIST_FOR_UPDATED_AT_EVENT_LISTENER_NODE_NAME => $preUpdate,
        ] = $container->getParameter(
            ServiceContainer::getParameterName(
                self::PREFIX,
                self::DOCTRINE_NODE_NAME,
            )
        );
        $isPrePersist   = $pa->getValue($prePersist, '[' . self::IS_LISTEN_NODE_NAME . ']');
        $isPreUpdate    = $pa->getValue($preUpdate, '[' . self::IS_LISTEN_NODE_NAME . ']');

        //###>
        $prePersistTag = [
            'doctrine.event_listener' =>
            [
                [
                    'event' => Events::prePersist,
                ],
            ],
        ];
        if (!$isPrePersist) {
            $prePersistTag = [];
        }

        //###>
        $preUpdateTag = [
            'doctrine.event_listener' =>
            [
                [
                    'event' => Events::preUpdate,
                ],
            ],
        ];
        if (!$isPreUpdate) {
            $preUpdateTag = [];
        }

        foreach (
            [
            [
                'id' => PrePersistEventLisener::class,
                'class' => PrePersistEventLisener::class,
                'args' => [],
                'tags' => $prePersistTag,
                'isAutowired' => false,
                'isAutoconfigured' => false,
                'isAbstract' => false,
            ],
            [
                'id' => PreUpdateEventLisener::class,
                'class' => PreUpdateEventLisener::class,
                'args' => [],
                'tags' => $preUpdateTag,
                'isAutowired' => false,
                'isAutoconfigured' => false,
                'isAbstract' => false,
            ],
            [
                'id' => ServiceContainer::getParameterName(
                    self::PREFIX,
                    self::MESSENGER_QUERY_NAME
                ),
                'class' => Query::class,
                'args' => [
                    '$messageBus' => new Reference(BusTypes::QUERY_BUS),
                ],
                'tags' => [],
                'isAutowired' => false,
                'isAutoconfigured' => false,
                'isAbstract' => false,
            ],
            ] as [
            'id' => $id,
            'class' => $class,
            'args' => $args,
            'tags' => $tags,
            'isAutowired' => $isAutowired,
            'isAutoconfigured' => $isAutoconfigured,
            'isAbstract' => $isAbstract,
            ]
        ) {
            $container
                ->setDefinition(
                    $id,
                    (new Definition($class))
                        ->setArguments($args)
                        ->setTags($tags)
                        ->setAutowired($isAutowired)
                        ->setAutoconfigured($isAutoconfigured)
                        ->setAbstract($isAbstract),
                )
            ;
        }
    }

    private function setContainerTags(ContainerBuilder $container): void
    {
        /*
        $container
            ->registerForAutoconfiguration('')
            ->addTag('messenger.message_handler', [
				'bus' => BusTypes::QUERY_BUS,
			])
        ;
        */
    }
}
