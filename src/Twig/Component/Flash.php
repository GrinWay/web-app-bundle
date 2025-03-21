<?php

namespace GrinWay\WebApp\Twig\Component;

use GrinWay\Service\Type\NoteType;
use Symfony\Component\HttpFoundation\RequestStack;

class Flash
{
    public function __construct(
        private readonly RequestStack $requestStack,
    )
    {
    }

    public string $base = '';
    public string $position = 'fixed';
    public string $size = 'normal';

    public bool $initShown = false;
    public bool $willLeave = true;
    public bool $removeAfterLeave = true;
    public string $style = 'fade';
    public int $disappearInMs = 10000;
    public string $hiddenClass = 'd-none';
    public string $flashKeyPrefix = '';

    // for auto filling
    public array $flashes = [];

    public function mount($peek = false, $flashes = null, $flashKeyPrefix = null): void
    {
        $flashKeyPrefix ??= '';
        $this->flashKeyPrefix = $flashKeyPrefix;

        $session = $this->requestStack->getSession();
        $flashBag = $session->getBag('flashes');

        if (true === $peek) {
            $flashes = $flashBag->peekAll();
        } else {
            $flashes = $flashBag->all();
        }

        foreach ([
                     NoteType::NOTICE,
                     NoteType::WARNING,
                     NoteType::ERROR,
                     'secondary',
                 ] as $key) {
            $this->flashes[$this->getFlashKeyPrefixed($key)] = $flashes[$key] ?? [];
            unset($flashes[$key]);
        }

        $this->flashes[$this->getFlashKeyPrefixed('rest')] = $flashes;
    }

    public function getFlashKeyPrefixed(int|string $key): string
    {
        return \sprintf(
            '%s%s',
            $this->flashKeyPrefix,
            $key,
        );
    }
}
