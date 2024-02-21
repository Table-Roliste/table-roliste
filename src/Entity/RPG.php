<?php

namespace App\Entity;

use App\Repository\RPGRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RPGRepository::class)]
class RPG
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Author::class, inversedBy: 'RPGs')]
    private Collection $author;

    #[ORM\Column(length: 2080, nullable: true)]
    private ?string $grogLink = null;

    #[ORM\OneToMany(mappedBy: 'RPG', targetEntity: GameSession::class)]
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
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
        $this->author->removeElement($author);

        return $this;
    }

    public function getGrogLink(): ?string
    {
        return $this->grogLink;
    }

    public function setGrogLink(?string $grogLink): static
    {
        $this->grogLink = $grogLink;

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
            $gameSession->setRPG($this);
        }

        return $this;
    }

    public function removeGameSession(GameSession $gameSession): static
    {
        if ($this->gameSessions->removeElement($gameSession)) {
            // set the owning side to null (unless already changed)
            if ($gameSession->getRPG() === $this) {
                $gameSession->setRPG(null);
            }
        }

        return $this;
    }
}
