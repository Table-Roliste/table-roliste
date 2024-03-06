<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\EmotionalSecurityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Outils de sécurité émotionnelle (X card, voiles et lignes, etc)
 * Liste de Valeur Administrable
 */
#[ORM\Entity(repositoryClass: EmotionalSecurityRepository::class)]
class EmotionalSecurity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    public function getId(): int
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
