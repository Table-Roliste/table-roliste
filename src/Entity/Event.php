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
    private ?string $Name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $StartingDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $EndingDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $ReservationStartingDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $ReservationEndingDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $TableCreationStartingDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $TableCreationEndingDate = null;

    #[ORM\OneToMany(mappedBy: 'Event', targetEntity: GameTable::class, orphanRemoval: true)]
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
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getStartingDate(): ?\DateTimeInterface
    {
        return $this->StartingDate;
    }

    public function setStartingDate(\DateTimeInterface $StartingDate): static
    {
        $this->StartingDate = $StartingDate;

        return $this;
    }

    public function getEndingDate(): ?\DateTimeInterface
    {
        return $this->EndingDate;
    }

    public function setEndingDate(\DateTimeInterface $EndingDate): static
    {
        $this->EndingDate = $EndingDate;

        return $this;
    }

    public function getReservationStartingDate(): ?\DateTimeInterface
    {
        return $this->ReservationStartingDate;
    }

    public function setReservationStartingDate(?\DateTimeInterface $ReservationStartingDate): static
    {
        $this->ReservationStartingDate = $ReservationStartingDate;

        return $this;
    }

    public function getReservationEndingDate(): ?\DateTimeInterface
    {
        return $this->ReservationEndingDate;
    }

    public function setReservationEndingDate(?\DateTimeInterface $ReservationEndingDate): static
    {
        $this->ReservationEndingDate = $ReservationEndingDate;

        return $this;
    }

    public function getTableCreationStartingDate(): ?\DateTimeInterface
    {
        return $this->TableCreationStartingDate;
    }

    public function setTableCreationStartingDate(?\DateTimeInterface $TableCreationStartingDate): static
    {
        $this->TableCreationStartingDate = $TableCreationStartingDate;

        return $this;
    }

    public function getTableCreationEndingDate(): ?\DateTimeInterface
    {
        return $this->TableCreationEndingDate;
    }

    public function setTableCreationEndingDate(?\DateTimeInterface $TableCreationEndingDate): static
    {
        $this->TableCreationEndingDate = $TableCreationEndingDate;

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
