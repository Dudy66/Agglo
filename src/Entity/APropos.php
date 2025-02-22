<?php

namespace App\Entity;

use App\Repository\AProposRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AProposRepository::class)]
class APropos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $titleAPropos = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contentAPropos = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleAPropos(): ?string
    {
        return $this->titleAPropos;
    }

    public function setTitleAPropos(string $titleAPropos): static
    {
        $this->titleAPropos = $titleAPropos;

        return $this;
    }

    public function getContentAPropos(): ?string
    {
        return $this->contentAPropos;
    }

    public function setContentAPropos(string $contentAPropos): static
    {
        $this->contentAPropos = $contentAPropos;

        return $this;
    }
}
