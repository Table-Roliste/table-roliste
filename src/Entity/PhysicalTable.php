<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PhysicalTableRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Table Physique de jeu, disposé dans une salle pour un Event.
 * Repérée par leur nom.
 * Présente un certain nombre de places.
 */
#[ORM\Entity(repositoryClass: PhysicalTableRepository::class)]
class PhysicalTable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(inversedBy: 'physicalTables')]
    #[ORM\JoinColumn(nullable: false)]
    private Event $event;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $seatsNumber;

    #[ORM\Column(length: 255)]
    private string $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): Event
    {
        return $this->event;
    }

    public function setEvent(Event $event): void
    {
        $this->event = $event;
    }

    public function getSeatsNumber(): int
    {
        return $this->seatsNumber;
    }

    public function setSeatsNumber(int $seatsNumber): void
    {
        $this->seatsNumber = $seatsNumber;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
