<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
class Member
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $MembershipEndDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMembershipEndDate(): ?\DateTimeInterface
    {
        return $this->MembershipEndDate;
    }

    public function setMembershipEndDate(?\DateTimeInterface $MembershipEndDate): static
    {
        $this->MembershipEndDate = $MembershipEndDate;

        return $this;
    }
}