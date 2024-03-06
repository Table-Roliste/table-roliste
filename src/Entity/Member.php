<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\MemberRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Membre d'une association
 * Identique à un User standard avec une date d'expiration au sein de son asso.
 */
#[ORM\Entity(repositoryClass: MemberRepository::class)]
class Member extends User
{
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?DateTimeInterface $membershipEndDate = null;

    public function getMembershipEndDate(): ?DateTimeInterface
    {
        return $this->membershipEndDate;
    }

    public function setMembershipEndDate(?DateTimeInterface $membershipEndDate): static
    {
        $this->membershipEndDate = $membershipEndDate;

        return $this;
    }
}
