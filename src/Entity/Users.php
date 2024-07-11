<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



#[ORM\Entity(repositoryClass: UsersRepository::class)]

class Users implements UserInterface, PasswordAuthenticatedUserInterface
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
     * @UniqueEntity(fields={"email"}, message="Cette adresse email est déjà utilisée.")
     */
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 50)]
    private ?string $lastName = null;

    #[ORM\Column(length: 50)]
    private ?string $firstName = null;

    #[ORM\Column(length: 100, nullable: true)]
    private $photo;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column(length: 100)]
    private ?string $address = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $goal = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $schoolCareer = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $professionnalCareer = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $instagram = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $facebook = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $linkedIn = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Activityarea $activityArea = null;

    #[ORM\ManyToMany(targetEntity: Resources::class, inversedBy: 'users')]
    private Collection $resources;

    #[ORM\ManyToMany(targetEntity: Events::class, inversedBy: 'users')]
    private Collection $events;

    #[ORM\ManyToMany(targetEntity: Gamifications::class, inversedBy: 'users')]
    private Collection $gamifications;

    #[ORM\ManyToMany(targetEntity: Notifications::class, inversedBy: 'users')]
    private Collection $notifications;

    #[ORM\OneToMany(targetEntity: Comments::class, mappedBy: 'users', orphanRemoval: true)]
    private Collection $comments;

    #[ORM\OneToMany(targetEntity: Reactions::class, mappedBy: 'users', orphanRemoval: true)]
    private Collection $reactions;

    #[ORM\OneToMany(targetEntity: Contacts::class, mappedBy: 'users')]
    private Collection $contacts;

    #[ORM\OneToMany(targetEntity: Messagings::class, mappedBy: 'users')]
    private Collection $messagings;

    #[ORM\ManyToMany(targetEntity: Users::class, mappedBy: 'mentors')]
    private Collection $followers;

    #[ORM\ManyToMany(targetEntity: Users::class, inversedBy: 'followers')]
    #[ORM\JoinTable(name: 'mentors_followers')]
    #[ORM\JoinColumn(name: 'follower_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'mentor_id', referencedColumnName: 'id')]
    private Collection $mentors;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Roles $role = null;

    public function __construct()
    {
        $this->resources = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->followers = new ArrayCollection();
        $this->mentors = new ArrayCollection();
        $this->gamifications = new ArrayCollection();
        $this->notifications = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->reactions = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->messagings = new ArrayCollection();
        $this->roles = ['ROLE_USER'];
    }

    public function getMentors(): Collection
    {
        return $this->mentors;
    }

    public function getFollowers(): Collection
    {
        return $this->followers;
    }

    // Setter pour la relation ManyToMany mentors
    public function addMentor(Users $mentor): self
    {
        if (!$this->mentors->contains($mentor)) {
            $this->mentors[] = $mentor;
            $mentor->addMentor($this);
        }

        return $this;
    }

    public function removeMentor(Users $mentor): self
    {
        if ($this->mentors->contains($mentor)) {
            $this->mentors->removeElement($mentor);
        }

        return $this;
    }

    // Setter pour la relation ManyToMany followers
    public function addFollower(Users $follower): self
    {
        if (!$this->followers->contains($follower)) {
            $this->followers[] = $follower;
            $follower->addFollower($this);
        }

        return $this;
    }

    public function removeFollower(Users $follower): self
    {
        if ($this->followers->contains($follower)) {
            $this->followers->removeElement($follower);
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): static
    {
        $this->birthdate = $birthdate;

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

    public function getGoal(): ?string
    {
        return $this->goal;
    }

    public function setGoal(?string $goal): static
    {
        $this->goal = $goal;

        return $this;
    }

    public function getSchoolCareer(): ?string
    {
        return $this->schoolCareer;
    }

    public function setSchoolCareer(?string $schoolCareer): static
    {
        $this->schoolCareer = $schoolCareer;

        return $this;
    }

    public function getProfessionnalCareer(): ?string
    {
        return $this->professionnalCareer;
    }

    public function setProfessionnalCareer(?string $professionnalCareer): static
    {
        $this->professionnalCareer = $professionnalCareer;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): static
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): static
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getLinkedIn(): ?string
    {
        return $this->linkedIn;
    }

    public function setLinkedIn(?string $linkedIn): static
    {
        $this->linkedIn = $linkedIn;

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
     * @return Collection<int,Resources>
     */
    public function getResources(): Collection
    {
        return $this->resources;
    }

    public function addResource(Resources $resource): static
    {
        if (!$this->resources->contains($resource)) {
            $this->resources->add($resource);
        }

        return $this;
    }

    public function removeResource(Resources $resource): static
    {
        $this->resources->removeElement($resource);

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
        }

        return $this;
    }

    public function removeEvent(Events $event): static
    {
        $this->events->removeElement($event);

        return $this;
    }

    /**
     * @return Collection<int, Gamifications>
     */
    public function getGamifications(): Collection
    {
        return $this->gamifications;
    }

    public function addGamification(Gamifications $gamification): static
    {
        if (!$this->gamifications->contains($gamification)) {
            $this->gamifications->add($gamification);
        }

        return $this;
    }

    public function removeGamification(Gamifications $gamification): static
    {
        $this->gamifications->removeElement($gamification);

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
        }

        return $this;
    }

    public function removeNotification(Notifications $notification): static
    {
        $this->notifications->removeElement($notification);

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
            $comment->setUsers($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): static
    {
        if ($this->comments->removeElement($comment) && $comment->getUsers() === $this) {
            // set the owning side to null (unless already changed)
            $comment->setUsers(null);
        }

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
            $reaction->setUsers($this);
        }

        return $this;
    }

    public function removeReaction(Reactions $reaction): static
    {
        if ($this->reactions->removeElement($reaction) && $reaction->getUsers() === $this) {
            // set the owning side to null (unless already changed)
            $reaction->setUsers(null);
        }

        return $this;
    }

    /**
     * @return Collection<int, Contacts>
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contacts $contact): static
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts->add($contact);
            $contact->setUsers($this);
        }

        return $this;
    }

    public function removeContact(Contacts $contact): static
    {
        if ($this->contacts->removeElement($contact) && $contact->getUsers() === $this) {
            // set the owning side to null (unless already changed)
            $contact->setUsers(null);
        }

        return $this;
    }

    /**
     * @return Collection<int, Messagings>
     */
    public function getMessagings(): Collection
    {
        return $this->messagings;
    }

    public function addMessaging(Messagings $messaging): static
    {
        if (!$this->messagings->contains($messaging)) {
            $this->messagings->add($messaging);
            $messaging->setUsers($this);
        }

        return $this;
    }

    public function removeMessaging(Messagings $messaging): static
    {
        if ($this->messagings->removeElement($messaging) && $messaging->getUsers() === $this) {
            // set the owning side to null (unless already changed)
            $messaging->setUsers(null);
        }

        return $this;
    }

    public function getRole(): ?Roles
    {
        return $this->role;
    }

    public function setRole(?Roles $role): static
    {
        $this->role = $role;

        return $this;
    }
}
