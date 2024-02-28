<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\GameSessionRepository;
use DateTimeInterface;
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
    private int $id;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private DateTimeInterface $startingDate;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private DateTimeInterface $endingDate;

    #[ORM\ManyToOne(targetEntity: Scenario::class, inversedBy: 'gameSessions')]
    private ?Scenario $scenario = null;

    #[ORM\ManyToOne(targetEntity: RPG::class, inversedBy: 'gameSessions')]
    private ?RPG $RPG = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $minPlayers;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $maxPlayers;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $mjNumber;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $synopsis = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Status $status = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?EmotionnalSecurity $emotionnalSecurity = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'gameSessions')]
    private Collection $genre;

    #[ORM\ManyToMany(targetEntity: PlayerCategory::class, inversedBy: 'gameSessions')]
    private Collection $playerCategory;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'gameMastersGameSessions')]
    #[ORM\JoinTable(name: "game_session_game_masters")]
    private Collection $gameMasters;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'playersGameSessions')]
    #[ORM\JoinTable(name: "game_session_players")]
    private Collection $players;

    #[ORM\ManyToOne(inversedBy: 'gameSessions')]
    private ?Role $role = null;

    public function __construct()
    {
        $this->genre = new ArrayCollection();
        $this->playerCategory = new ArrayCollection();
        $this->gameMasters = new ArrayCollection();
        $this->players = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartingDate(): ?DateTimeInterface
    {
        return $this->startingDate;
    }

    public function setStartingDate(DateTimeInterface $startingDate): static
    {
        $this->startingDate = $startingDate;

        return $this;
    }

    public function getEndingDate(): ?DateTimeInterface
    {
        return $this->endingDate;
    }

    public function setEndingDate(DateTimeInterface $endingDate): static
    {
        $this->endingDate = $endingDate;

        return $this;
    }

    public function getScenario(): ?Scenario
    {
        return $this->scenario;
    }

    public function setScenario(?Scenario $scenario): static
    {
        $this->scenario = $scenario;

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
        return $this->minPlayers;
    }

    public function setMinPlayers(int $minPlayers): static
    {
        $this->minPlayers = $minPlayers;

        return $this;
    }

    public function getMaxPlayers(): ?int
    {
        return $this->maxPlayers;
    }

    public function setMaxPlayers(int $maxPlayers): static
    {
        $this->maxPlayers = $maxPlayers;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $Synopsis): static
    {
        $this->synopsis = $Synopsis;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getEmotionnalSecurity(): ?EmotionnalSecurity
    {
        return $this->emotionnalSecurity;
    }

    public function setEmotionnalSecurity(?EmotionnalSecurity $emotionnalSecurity): static
    {
        $this->emotionnalSecurity = $emotionnalSecurity;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genre->contains($genre)) {
            $this->genre->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        $this->genre->removeElement($genre);

        return $this;
    }

    /**
     * @return Collection<int, PlayerCategory>
     */
    public function getPlayerCategory(): Collection
    {
        return $this->playerCategory;
    }

    public function addPlayerCategory(PlayerCategory $playerCategory): static
    {
        if (!$this->playerCategory->contains($playerCategory)) {
            $this->playerCategory->add($playerCategory);
        }

        return $this;
    }

    public function removePlayerCategory(PlayerCategory $playerCategory): static
    {
        $this->playerCategory->removeElement($playerCategory);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getGameMasters(): Collection
    {
        return $this->gameMasters;
    }

    public function addGameMaster(User $gameMaster): static
    {
        if (!$this->gameMasters->contains($gameMaster)) {
            $this->gameMasters->add($gameMaster);
        }

        return $this;
    }

    public function removeGameMaster(User $gameMaster): static
    {
        $this->gameMasters->removeElement($gameMaster);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(User $player): static
    {
        if (!$this->players->contains($player)) {
            $this->players->add($player);
        }

        return $this;
    }

    public function removePlayer(User $player): static
    {
        $this->players->removeElement($player);

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): static
    {
        $this->role = $role;

        return $this;
    }
}
