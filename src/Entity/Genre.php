<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Description = null;

    #[ORM\ManyToMany(targetEntity: GameSession::class, mappedBy: 'Genre')]
    private Collection $gameSessions;

    public function __construct()
    {
        $this->gameSessions = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * @return Collection<int, GameSession>
     */
    public function getGameSessions(): Collection
    {
        return $this->gameSessions;
    }

    public function addGameSession(GameSession $gameSession): static
    {
        if (!$this->gameSessions->contains($gameSession)) {
            $this->gameSessions->add($gameSession);
            $gameSession->addGenre($this);
        }

        return $this;
    }

    public function removeGameSession(GameSession $gameSession): static
    {
        if ($this->gameSessions->removeElement($gameSession)) {
            $gameSession->removeGenre($this);
        }

        return $this;
    }
}
