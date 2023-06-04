<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

abstract class Node
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'uuid', length: 36, nullable: false)]
    #[ApiProperty(identifier: true)]
    protected UuidInterface $id;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @param UuidInterface $id
     */
    public function setId(UuidInterface $id): void
    {
        $this->id = $id;
    }

    public function __clone()
    {
        $this->id = Uuid::uuid4();
    }
}
