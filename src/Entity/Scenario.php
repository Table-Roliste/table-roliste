<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ScenarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Scénario de jeu issu du commerce
 * Dispose de son/ses auteur(s).
 *  L'ISBN (code barre) et le lien grog sont optionnels pour l'instant
 */
#[ORM\Entity(repositoryClass: ScenarioRepository::class)]
class Scenario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\ManyToMany(targetEntity: Author::class, inversedBy: 'scenarios')]
    private Collection $author;

    #[ORM\Column(length: 2080, nullable: true)]
    private ?string $grogLink = null;

    #[ORM\Column(type: Types::STRING, length: 13)]
    private ?string $isbn;

    #[ORM\OneToMany(mappedBy: 'scenario', targetEntity: GameSession::class)]
    private Collection $gameSessions;

    public function __construct()
    {
        $this->author = new ArrayCollection();
        $this->gameSessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(?string $isbn): void
    {
        $this->isbn = $isbn;
    }
    /**
     * @return Collection<int, Author>
     */
    public function getAuthor(): Collection
    {
        return $this->author;
    }

    public function addAuthor(Author $author): static
    {
        if (!$this->author->contains($author)) {
            $this->author->add($author);
        }

        return $this;
    }

    public function removeAuthor(Author $author): static
    {
        $this->Author->removeElement($author);

        return $this;
    }

    public function getGrogLink(): ?string
    {
        return $this->grogLink;
    }

    public function setGrogLink(?string $GrogLink): static
    {
        $this->grogLink = $GrogLink;

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
            $gameSession->setScenario($this);
        }

        return $this;
    }

    public function removeGameSession(GameSession $gameSession): static
    {
        if ($this->gameSessions->removeElement($gameSession)) {
            // set the owning side to null (unless already changed)
            if ($gameSession->getScenario() === $this) {
                $gameSession->setScenario(null);
            }
        }

        return $this;
    }
}
