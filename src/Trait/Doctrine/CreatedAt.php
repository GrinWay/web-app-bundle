<?php

namespace GrinWay\WebApp\Trait\Doctrine;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use GrinWay\Service\Service\CarbonService;

trait CreatedAt
{
    #[ORM\Column(nullable: false)]
    protected ?\DateTimeImmutable $createdAt = null;

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(): void
    {
        $this->createdAt = CarbonService::getNow();
    }
}
