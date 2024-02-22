<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $firstname;

    #[ORM\Column(length: 255)]
    private string $lastname;

    #[ORM\Column(length: 255)]
    private string $surname;

    #[ORM\ManyToMany(targetEntity: Scenario::class, mappedBy: 'author')]
    private Collection $scenarios;

    #[ORM\ManyToMany(targetEntity: RPG::class, mappedBy: 'author')]
    private Collection $RPGs;

    public function __construct()
    {
        $this->scenarios = new ArrayCollection();
        $this->RPGs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return Collection<int, Scenario>
     */
    public function getScenarios(): Collection
    {
        return $this->scenarios;
    }

    public function addScenario(Scenario $scenario): static
    {
        if (!$this->scenarios->contains($scenario)) {
            $this->scenarios->add($scenario);
            $scenario->addAuthor($this);
        }

        return $this;
    }

    public function removeScenario(Scenario $scenario): static
    {
        if ($this->scenarios->removeElement($scenario)) {
            $scenario->removeAuthor($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, RPG>
     */
    public function getRPGs(): Collection
    {
        return $this->RPGs;
    }

    public function addRPG(RPG $rPG): static
    {
        if (!$this->RPGs->contains($rPG)) {
            $this->RPGs->add($rPG);
            $rPG->addAuthor($this);
        }

        return $this;
    }

    public function removeRPG(RPG $rPG): static
    {
        if ($this->RPGs->removeElement($rPG)) {
            $rPG->removeAuthor($this);
        }

        return $this;
    }
}
