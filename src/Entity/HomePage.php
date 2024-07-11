<?php

namespace App\Entity;

use App\Repository\HomePageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HomePageRepository::class)]
class HomePage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $backgroundImage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subtitle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $subDescription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subImage = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $webSiteDescription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $secondBlocTitle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $secondBlocDescription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $secondBlocImage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $secondBlocSubTitle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getContent(): ?string
    // {
    //     return $this->content;
    // }

    // public function setContent(string $content): static
    // {
    //     $this->content = $content;

    //     return $this;
    // }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getBackgroundImage(): ?string
    {
        return $this->backgroundImage;
    }

    public function setBackgroundImage(?string $backgroundImage): static
    {
        $this->backgroundImage = $backgroundImage;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(?string $subtitle): static
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getSubDescription(): ?string
    {
        return $this->subDescription;
    }

    public function setSubDescription(?string $subDescription): static
    {
        $this->subDescription = $subDescription;

        return $this;
    }

    public function getSubImage(): ?string
    {
        return $this->subImage;
    }

    public function setSubImage(?string $subImage): static
    {
        $this->subImage = $subImage;

        return $this;
    }

    public function getWebSiteDescription(): ?string
    {
        return $this->webSiteDescription;
    }

    public function setWebSiteDescription(?string $webSiteDescription): static
    {
        $this->webSiteDescription = $webSiteDescription;

        return $this;
    }

    public function getSecondBlocTitle(): ?string
    {
        return $this->secondBlocTitle;
    }

    public function setSecondBlocTitle(?string $secondBlocTitle): static
    {
        $this->secondBlocTitle = $secondBlocTitle;

        return $this;
    }

    public function getSecondBlocDescription(): ?string
    {
        return $this->secondBlocDescription;
    }

    public function setSecondBlocDescription(?string $secondBlocDescription): static
    {
        $this->secondBlocDescription = $secondBlocDescription;

        return $this;
    }

    public function getSecondBlocImage(): ?string
    {
        return $this->secondBlocImage;
    }

    public function setSecondBlocImage(?string $secondBlocImage): static
    {
        $this->secondBlocImage = $secondBlocImage;

        return $this;
    }

    public function getsecondBlocSubTitle(): ?string
    {
        return $this->secondBlocSubTitle;
    }

    public function setsecondBlocSubTitle(?string $secondBlocSubTitle): static
    {
        $this->secondBlocSubTitle = $secondBlocSubTitle;

        return $this;
    }
}
