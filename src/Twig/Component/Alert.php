<?php

namespace GrinWay\WebApp\Twig\Component;

class Alert
{
    public string $base = 'alert my-0';
    public string $type = 'primary';
    public string $size = 'sm';
    public string $alignment = 'left';
    public string $position = 'fixed';
    public bool $initShown = false;
    public bool $willLeave = false;
    public bool $removeAfterLeave = true;
    public string $style = 'fade';
    public int $disappearInMs = 10000;
    public string $hiddenClass = 'd-none';
}
