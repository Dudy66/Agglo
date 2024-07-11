<?php

namespace App\Entity;

use App\Repository\ResourcesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResourcesRepository::class)]
class Resources
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $type = null;

    #[ORM\Column(length: 100)]
    private ?string $title = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $publicationDate = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $author = null;

    #[ORM\Column(length: 100, nullable: true)]
    private $image;

    #[ORM\Column(length: 100, nullable: true)]
    private $video;

    #[ORM\Column(length: 100, nullable: true)]
    private $otherContent;

    #[ORM\ManyToMany(targetEntity: Users::class, mappedBy: 'resources')]
    private Collection $users;

    #[ORM\OneToMany(targetEntity: Notifications::class, mappedBy: 'resources')]
    private Collection $notifications;

    #[ORM\ManyToOne(inversedBy: 'resources')]
    private ?Activityarea $activityarea = null;
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->notifications = new ArrayCollection();
        $this->publicationDate = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
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

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate): static
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getVideo()
    {
        return $this->video;
    }

    public function setVideo($video): static
    {
        $this->video = $video;

        return $this;
    }

    public function getOtherContent()
    {
        return $this->otherContent;
    }

    public function setOtherContent($otherContent): static
    {
        $this->otherContent = $otherContent;

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
            $user->addResource($this);
        }

        return $this;
    }

    public function removeUser(Users $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeResource($this);
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
            $notification->setResources($this);
        }

        return $this;
    }

    public function removeNotification(Notifications $notification): static
    {
        if ($this->notifications->removeElement($notification) && $notification->getResources() === $this) {
            $notification->setResources(null);
        }

        return $this;
    }

    public function getActivityarea(): ?Activityarea
    {
        return $this->activityarea;
    }

    public function setActivityarea(?Activityarea $activityarea): static
    {
        $this->activityarea = $activityarea;

        return $this;
    }
}
