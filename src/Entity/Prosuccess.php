<?php

namespace App\Entity;

use App\Repository\ProsuccessRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProsuccessRepository::class)]
class Prosuccess
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private $image;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $history = null;

    #[ORM\Column(length: 50)]
    private ?string $author = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $publicationDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbView = null;

    #[ORM\OneToMany(targetEntity: Comments::class, mappedBy: 'prosuccess', orphanRemoval: true)]
    private Collection $comments;

    #[ORM\ManyToOne(inversedBy: 'prosuccess')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Activityarea $activityArea = null;

    #[ORM\OneToMany(targetEntity: Reactions::class, mappedBy: 'prosuccess', orphanRemoval: true)]
    private Collection $reactions;

    #[ORM\OneToMany(targetEntity: Notifications::class, mappedBy: 'proSuccess')]
    private Collection $notifications;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->reactions = new ArrayCollection();
        $this->notifications = new ArrayCollection();
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

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(string $history): static
    {
        $this->history = $history;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): static
    {
        $this->author = $author;

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getNbView(): ?int
    {
        return $this->nbView;
    }

    public function setNbView(?int $nbView): static
    {
        $this->nbView = $nbView;

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setProsuccess($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): static
    {
        if ($this->comments->removeElement($comment) && $comment->getProsuccess() === $this) {
            $comment->setProsuccess(null);
        }

        return $this;
    }

    public function getActivityArea(): ?Activityarea
    {
        return $this->activityArea;
    }

    public function setActivityArea(?Activityarea $activityArea): static
    {
        $this->activityArea = $activityArea;

        return $this;
    }

    /**
     * @return Collection<int, Reactions>
     */
    public function getReactions(): Collection
    {
        return $this->reactions;
    }

    public function addReaction(Reactions $reaction): static
    {
        if (!$this->reactions->contains($reaction)) {
            $this->reactions->add($reaction);
            $reaction->setProsuccess($this);
        }

        return $this;
    }

    public function removeReaction(Reactions $reaction): static
    {
        if ($this->reactions->removeElement($reaction) && $reaction->getProsuccess() === $this) {
            $reaction->setProsuccess(null);
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
            $notification->setProSuccess($this);
        }

        return $this;
    }

    public function removeNotification(Notifications $notification): static
    {
        if ($this->notifications->removeElement($notification) && $notification->getProSuccess() === $this) {
            $notification->setProSuccess(null);
        }

        return $this;
    }
}
