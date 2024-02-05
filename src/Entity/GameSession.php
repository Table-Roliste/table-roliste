<?php

namespace App\Entity;

use App\Repository\GameSessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameSessionRepository::class)]
class GameSession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $StartingDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $EndingDate = null;

    #[ORM\ManyToOne(inversedBy: 'gameSessions')]
    private ?Scenario $Scenario = null;

    #[ORM\ManyToOne(inversedBy: 'gameSessions')]
    private ?RPG $RPG = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $MinPlayers = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $MaxPlayers = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Synopsis = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Status $Status = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?EmotionnalSecurity $EmotionnalSecurity = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'gameSessions')]
    private Collection $Genre;

    #[ORM\ManyToMany(targetEntity: PlayerCategory::class, inversedBy: 'gameSessions')]
    private Collection $PlayerCategory;

    public function __construct()
    {
        $this->Genre = new ArrayCollection();
        $this->PlayerCategory = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getScenario(): ?Scenario
    {
        return $this->Scenario;
    }

    public function setScenario(?Scenario $Scenario): static
    {
        $this->Scenario = $Scenario;

        return $this;
    }

    public function getRPG(): ?RPG
    {
        return $this->RPG;
    }

    public function setRPG(?RPG $RPG): static
    {
        $this->RPG = $RPG;

        return $this;
    }

    public function getMinPlayers(): ?int
    {
        return $this->MinPlayers;
    }

    public function setMinPlayers(int $MinPlayers): static
    {
        $this->MinPlayers = $MinPlayers;

        return $this;
    }

    public function getMaxPlayers(): ?int
    {
        return $this->MaxPlayers;
    }

    public function setMaxPlayers(int $MaxPlayers): static
    {
        $this->MaxPlayers = $MaxPlayers;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->Synopsis;
    }

    public function setSynopsis(string $Synopsis): static
    {
        $this->Synopsis = $Synopsis;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->Status;
    }

    public function setStatus(?Status $Status): static
    {
        $this->Status = $Status;

        return $this;
    }

    public function getEmotionnalSecurity(): ?EmotionnalSecurity
    {
        return $this->EmotionnalSecurity;
    }

    public function setEmotionnalSecurity(?EmotionnalSecurity $EmotionnalSecurity): static
    {
        $this->EmotionnalSecurity = $EmotionnalSecurity;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenre(): Collection
    {
        return $this->Genre;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->Genre->contains($genre)) {
            $this->Genre->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        $this->Genre->removeElement($genre);

        return $this;
    }

    /**
     * @return Collection<int, PlayerCategory>
     */
    public function getPlayerCategory(): Collection
    {
        return $this->PlayerCategory;
    }

    public function addPlayerCategory(PlayerCategory $playerCategory): static
    {
        if (!$this->PlayerCategory->contains($playerCategory)) {
            $this->PlayerCategory->add($playerCategory);
        }

        return $this;
    }

    public function removePlayerCategory(PlayerCategory $playerCategory): static
    {
        $this->PlayerCategory->removeElement($playerCategory);

        return $this;
    }
}
