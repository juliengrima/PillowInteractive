<?php

namespace App\Entity;

use App\Repository\GamesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GamesRepository::class)]
class Games
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    private ?string $description = null;

    /**
     * @var Collection<int, Images>
     */
    #[ORM\OneToMany(targetEntity: Images::class, mappedBy: 'game')]
    private Collection $text;

    public function __construct()
    {
        $this->text = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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

    /**
     * @return Collection<int, Images>
     */
    public function getText(): Collection
    {
        return $this->text;
    }

    public function addText(Images $text): static
    {
        if (!$this->text->contains($text)) {
            $this->text->add($text);
            $text->setGame($this);
        }

        return $this;
    }

    public function removeText(Images $text): static
    {
        if ($this->text->removeElement($text)) {
            // set the owning side to null (unless already changed)
            if ($text->getGame() === $this) {
                $text->setGame(null);
            }
        }

        return $this;
    }
}
