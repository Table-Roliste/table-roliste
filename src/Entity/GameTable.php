<?php

namespace App\Entity;

use App\Repository\GameTableRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameTableRepository::class)]
class GameTable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'gameTables')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Event $Event = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $Seating = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): ?Event
    {
        return $this->Event;
    }

    public function setEvent(?Event $Event): static
    {
        $this->Event = $Event;

        return $this;
    }

    public function getSeating(): ?int
    {
        return $this->Seating;
    }

    public function setSeating(int $Seating): static
    {
        $this->Seating = $Seating;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }
}
