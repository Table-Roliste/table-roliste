<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\GameSessionRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Session de jeu sur un système de jeu (RPG/game) avec un scénario (Scenario).
 * Réunie plusieurs joueurs (User) dont un ou plusieurs maitres de jeu.
 * Un synopsis, des outils de sécurité émotionnelle (EmotionalSecurity) et des catégories de joueurs (PlayerCategory) sont fourni lors de la création de la session, généralement par un MJ.
 * La session de jeu est validé par un Admin avant d'être visible sur le site.
 */
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

    #[ORM\ManyToOne(targetEntity: Game::class, inversedBy: 'gameSessions')]
    private ?Game $game = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $minPlayers;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $maxPlayers;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $gameMasterNumber;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $synopsis = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Status $status = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?EmotionalSecurity $emotionalSecurity = null;

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

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): static
    {
        $this->game = $game;

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

    public function getMjNumber(): ?int
    {
        return $this->mjNumber;
    }

    public function setMjNumber(int $mjNumber): static
    {
        $this->mjNumber = $mjNumber;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): static
    {
        $this->synopsis = $synopsis;

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

    public function getEmotionalSecurity(): ?EmotionalSecurity
    {
        return $this->emotionalSecurity;
    }

    public function setEmotionalSecurity(?EmotionalSecurity $emotionalSecurity): static
    {
        $this->emotionalSecurity = $emotionalSecurity;

        return $this;
    }

    public function getGameMasterNumber(): int
    {
        return $this->gameMasterNumber;
    }

    public function setGameMasterNumber(int $gameMasterNumber): void
    {
        $this->gameMasterNumber = $gameMasterNumber;
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
