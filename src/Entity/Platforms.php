<?php

namespace App\Entity;

use App\Repository\PlatformsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatformsRepository::class)]
class Platforms
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Images $images = null;

    #[ORM\ManyToOne(inversedBy: 'plateforms')]
    private ?Games $gamePlateform = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getImages(): ?Images
    {
        return $this->images;
    }

    public function setImages(?Images $images): static
    {
        $this->images = $images;

        return $this;
    }

    public function getGamePlateform(): ?Games
    {
        return $this->gamePlateform;
    }

    public function setGamePlateform(?Games $gamePlateform): static
    {
        $this->gamePlateform = $gamePlateform;

        return $this;
    }
}
