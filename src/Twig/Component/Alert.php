<?php

namespace GrinWay\WebApp\Twig\Component;

class Alert
{
    public string $type = 'primary';
    public string $size = 'sm';
    public string $alignment = 'left';
    public string $position = 'normal';
    public bool $initShown = true;
    public bool $willLeave = false;
    public bool $removeAfterLeave = true;
    public string $style = 'fade';
    public int $disappearInMs = 10000;
    public string $base = 'alert my-0';
}
