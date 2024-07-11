<?php

namespace App\Entity;

use App\Repository\NotificationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotificationsRepository::class)]
class Notifications
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $message = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToMany(targetEntity: Users::class, mappedBy: 'notifications')]
    private Collection $users;

    #[ORM\ManyToOne(inversedBy: 'notifications')]
    private ?Events $events = null;

    #[ORM\ManyToOne(inversedBy: 'notifications')]
    private ?Resources $resources = null;

    #[ORM\ManyToOne(inversedBy: 'notifications')]
    private ?Prosuccess $proSuccess = null;

    #[ORM\ManyToOne(inversedBy: 'notifications')]
    private ?Messagings $messagings = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
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

    /**
     * @return Collection<int, Users>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addNotification($this);
        }

        return $this;
    }

    public function removeUser(Users $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeNotification($this);
        }

        return $this;
    }

    public function getEvents(): ?Events
    {
        return $this->events;
    }

    public function setEvents(?Events $events): static
    {
        $this->events = $events;

        return $this;
    }

    public function getResources(): ?Resources
    {
        return $this->resources;
    }

    public function setResources(?Resources $resources): static
    {
        $this->resources = $resources;

        return $this;
    }

    public function getProSuccess(): ?Prosuccess
    {
        return $this->proSuccess;
    }

    public function setProSuccess(?Prosuccess $proSuccess): static
    {
        $this->proSuccess = $proSuccess;

        return $this;
    }

    public function getMessagings(): ?Messagings
    {
        return $this->messagings;
    }

    public function setMessagings(?Messagings $messagings): static
    {
        $this->messagings = $messagings;

        return $this;
    }
}
