<?php

namespace App\Entity;

use App\Repository\ZonesTextRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ZonesTextRepository::class)]
class ZonesText
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $texts = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'text')]
    private ?Games $gameText = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexts(): ?string
    {
        return $this->texts;
    }

    public function setTexts(?string $texts): static
    {
        $this->texts = $texts;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getGameText(): ?Games
    {
        return $this->gameText;
    }

    public function setGameText(?Games $gameText): static
    {
        $this->gameText = $gameText;

        return $this;
    }
}
