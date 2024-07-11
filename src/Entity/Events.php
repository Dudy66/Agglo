<?php

namespace App\Entity;

use App\Repository\EventsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventsRepository::class)]
class Events
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $title = null;

    #[ORM\Column(length: 500)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbParticipants = null;

    #[ORM\Column]
    private ?int $maxParticipant = null;

    #[ORM\ManyToMany(targetEntity: Users::class, mappedBy: 'events')]
    private Collection $users;

    #[ORM\OneToMany(targetEntity: Notifications::class, mappedBy: 'events')]
    private Collection $notifications;

    #[ORM\ManyToMany(targetEntity: Activityarea::class, inversedBy: 'events')]
    private Collection $activityArea;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->notifications = new ArrayCollection();
        $this->activityArea = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

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

    public function getNbParticipants(): ?int
    {
        return $this->nbParticipants;
    }

    public function setNbParticipants(?int $nbParticipants): static
    {
        $this->nbParticipants = $nbParticipants;

        return $this;
    }

    public function getMaxParticipant(): ?int
    {
        return $this->maxParticipant;
    }

    public function setMaxParticipant(int $maxParticipant): static
    {
        $this->maxParticipant = $maxParticipant;

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
            $user->addEvent($this);
        }

        return $this;
    }

    public function removeUser(Users $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeEvent($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Notifications>
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notifications $notification): static
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications->add($notification);
            $notification->setEvents($this);
        }

        return $this;
    }

    public function removeNotification(Notifications $notification): static
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getEvents() === $this) {
                $notification->setEvents(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Activityarea>
     */
    public function getActivityArea(): Collection
    {
        return $this->activityArea;
    }

    public function addActivityArea(Activityarea $activityArea): static
    {
        if (!$this->activityArea->contains($activityArea)) {
            $this->activityArea->add($activityArea);
        }

        return $this;
    }

    public function removeActivityArea(Activityarea $activityArea): static
    {
        $this->activityArea->removeElement($activityArea);

        return $this;
    }
}
