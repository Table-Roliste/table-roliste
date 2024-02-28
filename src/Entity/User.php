<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'discr', type: 'string')]
#[ORM\DiscriminatorMap(['user' => User::class, 'member' => Member::class])]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $surname;

    #[ORM\Column(length: 255)]
    private string $email;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $discord = null;

    #[ORM\ManyToMany(targetEntity: Role::class, inversedBy: 'users')]
    private Collection $roles;

    #[ORM\ManyToMany(targetEntity: GameSession::class, mappedBy: 'gameMasters')]
    private Collection $gameMastersGameSessions;

    #[ORM\ManyToMany(targetEntity: GameSession::class, mappedBy: 'players')]
    private Collection $playersGameSessions;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->gameMastersGameSessions = new ArrayCollection();
        $this->playersGameSessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDiscord(): ?string
    {
        return $this->discord;
    }

    public function setDiscord(?string $discord): static
    {
        $this->discord = $discord;

        return $this;
    }

    /**
     * @return Collection<int, Role>
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(Role $role): static
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
        }

        return $this;
    }

    public function removeRole(Role $role): static
    {
        $this->roles->removeElement($role);

        return $this;
    }

    /**
     * @return Collection<int, GameSession>
     */
    public function getGameMastersGameSessions(): Collection
    {
        return $this->gameMastersGameSessions;
    }

    public function addGameMastersGameSession(GameSession $gameMastersGameSession): static
    {
        if (!$this->gameMastersGameSessions->contains($gameMastersGameSession)) {
            $this->gameMastersGameSessions->add($gameMastersGameSession);
            $gameMastersGameSession->addGameMaster($this);
        }

        return $this;
    }

    public function removeGameMastersGameSession(GameSession $gameMastersGameSession): static
    {
        if ($this->gameMastersGameSessions->removeElement($gameMastersGameSession)) {
            $gameMastersGameSession->removeGameMaster($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, GameSession>
     */
    public function getPlayersGameSessions(): Collection
    {
        return $this->playersGameSessions;
    }

    public function addPlayersGameSession(GameSession $playersGameSession): static
    {
        if (!$this->playersGameSessions->contains($playersGameSession)) {
            $this->playersGameSessions->add($playersGameSession);
            $playersGameSession->addPlayer($this);
        }

        return $this;
    }

    public function removePlayersGameSession(GameSession $playersGameSession): static
    {
        if ($this->playersGameSessions->removeElement($playersGameSession)) {
            $playersGameSession->removePlayer($this);
        }

        return $this;
    }
}
