<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\EventRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private DateTimeInterface $startingDate;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private DateTimeInterface $endingDate;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $reservationStartingDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $reservationEndingDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $tableCreationStartingDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $tableCreationEndingDate = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: PhysicalTable::class, orphanRemoval: true)]
    private Collection $physicalTables;

    public function __construct()
    {
        $this->physicalTables = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStartingDate(): DateTimeInterface
    {
        return $this->startingDate;
    }

    public function setStartingDate(DateTimeInterface $startingDate): self
    {
        $this->startingDate = $startingDate;

        return $this;
    }

    public function getEndingDate(): DateTimeInterface
    {
        return $this->endingDate;
    }

    public function setEndingDate(DateTimeInterface $endingDate): self
    {
        $this->endingDate = $endingDate;

        return $this;
    }

    public function getReservationStartingDate(): ?DateTimeInterface
    {
        return $this->reservationStartingDate;
    }

    public function setReservationStartingDate(?DateTimeInterface $reservationStartingDate): self
    {
        $this->reservationStartingDate = $reservationStartingDate;

        return $this;
    }

    public function getReservationEndingDate(): ?DateTimeInterface
    {
        return $this->reservationEndingDate;
    }

    public function setReservationEndingDate(?DateTimeInterface $reservationEndingDate): self
    {
        $this->reservationEndingDate = $reservationEndingDate;

        return $this;
    }

    public function getTableCreationStartingDate(): ?DateTimeInterface
    {
        return $this->tableCreationStartingDate;
    }

    public function setTableCreationStartingDate(?DateTimeInterface $tableCreationStartingDate): self
    {
        $this->tableCreationStartingDate = $tableCreationStartingDate;

        return $this;
    }

    public function getTableCreationEndingDate(): ?DateTimeInterface
    {
        return $this->tableCreationEndingDate;
    }

    public function setTableCreationEndingDate(?DateTimeInterface $tableCreationEndingDate): self
    {
        $this->tableCreationEndingDate = $tableCreationEndingDate;

        return $this;
    }

    /**
     * @return Collection<int, PhysicalTable>
     */
    public function getPhysicalTables(): Collection
    {
        return $this->physicalTables;
    }

    public function addPhysicalTable(PhysicalTable $physicalTables): static
    {
        if (!$this->physicalTables->contains($physicalTables)) {
            $this->physicalTables->add($physicalTables);
            $physicalTables->setEvent($this);
        }

        return $this;
    }

    public function removePhysicalTable(PhysicalTable $physicalTables): static
    {
        if ($this->physicalTables->removeElement($physicalTables)) {
            // set the owning side to null (unless already changed)
            if ($physicalTables->getEvent() === $this) {
                $physicalTables->setEvent(null);
            }
        }

        return $this;
    }
}
