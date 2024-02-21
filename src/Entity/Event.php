<?php

namespace App\Entity;

use App\Repository\EventRepository;
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
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $startingDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $endingDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $reservationStartingDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $reservationEndingDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $tableCreationStartingDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $tableCreationEndingDate = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: GameTable::class, orphanRemoval: true)]
    private Collection $gameTables;

    public function __construct()
    {
        $this->gameTables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $Name): static
    {
        $this->name = $Name;

        return $this;
    }

    public function getStartingDate(): ?\DateTimeInterface
    {
        return $this->startingDate;
    }

    public function setStartingDate(\DateTimeInterface $startingDate): static
    {
        $this->startingDate = $startingDate;

        return $this;
    }

    public function getEndingDate(): ?\DateTimeInterface
    {
        return $this->endingDate;
    }

    public function setEndingDate(\DateTimeInterface $endingDate): static
    {
        $this->endingDate = $endingDate;

        return $this;
    }

    public function getReservationStartingDate(): ?\DateTimeInterface
    {
        return $this->reservationStartingDate;
    }

    public function setReservationStartingDate(?\DateTimeInterface $reservationStartingDate): static
    {
        $this->reservationStartingDate = $reservationStartingDate;

        return $this;
    }

    public function getReservationEndingDate(): ?\DateTimeInterface
    {
        return $this->reservationEndingDate;
    }

    public function setReservationEndingDate(?\DateTimeInterface $reservationEndingDate): static
    {
        $this->reservationEndingDate = $reservationEndingDate;

        return $this;
    }

    public function getTableCreationStartingDate(): ?\DateTimeInterface
    {
        return $this->tableCreationStartingDate;
    }

    public function setTableCreationStartingDate(?\DateTimeInterface $tableCreationStartingDate): static
    {
        $this->tableCreationStartingDate = $tableCreationStartingDate;

        return $this;
    }

    public function getTableCreationEndingDate(): ?\DateTimeInterface
    {
        return $this->tableCreationEndingDate;
    }

    public function setTableCreationEndingDate(?\DateTimeInterface $tableCreationEndingDate): static
    {
        $this->tableCreationEndingDate = $tableCreationEndingDate;

        return $this;
    }

    /**
     * @return Collection<int, GameTable>
     */
    public function getGameTables(): Collection
    {
        return $this->gameTables;
    }

    public function addGameTable(GameTable $gameTable): static
    {
        if (!$this->gameTables->contains($gameTable)) {
            $this->gameTables->add($gameTable);
            $gameTable->setEvent($this);
        }

        return $this;
    }

    public function removeGameTable(GameTable $gameTable): static
    {
        if ($this->gameTables->removeElement($gameTable)) {
            // set the owning side to null (unless already changed)
            if ($gameTable->getEvent() === $this) {
                $gameTable->setEvent(null);
            }
        }

        return $this;
    }
}
