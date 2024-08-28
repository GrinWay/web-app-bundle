<?php

namespace GrinWay\WebApp\Trait\Doctrine;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

trait UpdatedAt
{
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    protected ?\DateTimeInterface $updatedAt = null;

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt = null): static
    {
        $this->updatedAt = $updatedAt;
		
		return $this;
    }
}
