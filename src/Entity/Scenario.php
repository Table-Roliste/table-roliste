<?php

namespace App\Entity;

use App\Repository\ScenarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScenarioRepository::class)]
class Scenario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\ManyToMany(targetEntity: Author::class, inversedBy: 'scenarios')]
    private Collection $Author;

    #[ORM\Column(length: 2080, nullable: true)]
    private ?string $GrogLink = null;

    #[ORM\OneToMany(mappedBy: 'Scenario', targetEntity: GameSession::class)]
    private Collection $gameSessions;

    public function __construct()
    {
        $this->Author = new ArrayCollection();
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

    /**
     * @return Collection<int, Author>
     */
    public function getAuthor(): Collection
    {
        return $this->Author;
    }

    public function addAuthor(Author $author): static
    {
        if (!$this->Author->contains($author)) {
            $this->Author->add($author);
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
        return $this->GrogLink;
    }

    public function setGrogLink(?string $GrogLink): static
    {
        $this->GrogLink = $GrogLink;

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
