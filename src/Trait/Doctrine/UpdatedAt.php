<?php

namespace GrinWay\WebApp\Trait\Doctrine;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Annotation\Groups;
use GrinWay\Service\Service\CarbonService;

trait UpdatedAt
{
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    protected ?\DateTimeInterface $updatedAt = null;

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(): static
    {
        $this->updatedAt = CarbonService::getNow(isImmutable: true);
		
		return $this;
    }
}
