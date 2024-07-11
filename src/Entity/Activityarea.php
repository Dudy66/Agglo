<?php

namespace App\Entity;

use App\Repository\ActivityareaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityareaRepository::class)]
class Activityarea
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $activityAreaName = null;

    #[ORM\OneToMany(targetEntity: Users::class, mappedBy: 'activityArea')]
    private Collection $users;
    #[ORM\OneToMany(targetEntity: Prosuccess::class, mappedBy: 'activityArea')]
    private Collection $prosuccess;

    #[ORM\ManyToMany(targetEntity: Events::class, mappedBy: 'activityArea')]
    private Collection $events;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->prosuccess = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActivityAreaName(): ?string
    {
        return $this->activityAreaName;
    }

    public function setActivityAreaName(string $activityAreaName): static
    {
        $this->activityAreaName = $activityAreaName;

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
            $user->setActivityArea($this);
        }

        return $this;
    }

    public function removeUser(Users $user): static
    {
        if ($this->users->removeElement($user) && $user->getActivityArea() === $this) {
            // set the owning side to null (unless already changed)
            $user->setActivityArea(null);
        }

        return $this;
    }

    /**
     * @return Collection<int, Prosuccess>
     */
    public function getProsuccess(): Collection
    {
        return $this->prosuccess;
    }

    public function addProsuccess(Prosuccess $prosuccess): static
    {
        if (!$this->prosuccess->contains($prosuccess)) {
            $this->prosuccess->add($prosuccess);
            $prosuccess->setActivityArea($this);
        }

        return $this;
    }

    public function removeProsuccess(Prosuccess $prosuccess): static
    {
        if ($this->prosuccess->removeElement($prosuccess) && $prosuccess->getActivityArea() === $this) {
            // set the owning side to null (unless already changed)
            $prosuccess->setActivityArea(null);
        }

        return $this;
    }

    /**
     * @return Collection<int, Events>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Events $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->addActivityArea($this);
        }

        return $this;
    }

    public function removeEvent(Events $event): static
    {
        if ($this->events->removeElement($event)) {
            $event->removeActivityArea($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->activityAreaName ?? '';
    }
}
