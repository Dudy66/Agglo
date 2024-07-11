<?php

namespace App\Entity;

use App\Repository\ReactionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReactionsRepository::class)]
class Reactions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'reactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Prosuccess $prosuccess = null;

    #[ORM\ManyToOne(inversedBy: 'reactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $users = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateHours(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDateHours(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getProsuccess(): ?Prosuccess
    {
        return $this->prosuccess;
    }

    public function setProsuccess(?Prosuccess $prosuccess): static
    {
        $this->prosuccess = $prosuccess;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): static
    {
        $this->users = $users;

        return $this;
    }
}
