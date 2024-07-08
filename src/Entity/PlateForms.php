<?php

namespace App\Entity;

use App\Repository\PlateFormsRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: PlateFormsRepository::class)]
class PlateForms
{
    // Variable temporaire pour upload de fichier
    private $file;

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($picture)
    {
        $this->file = $picture;
        return $this;
    }

    function __toString()
    {
        return $this->getLink() . " | " . $this->getName();
    }

    // GENERATED CODE
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $link = null;

    /**
     * @var Collection<int, Games>
     */
    #[ORM\ManyToMany(targetEntity: Games::class, mappedBy: 'platform')]
    private Collection $games;

    public function __construct()
    {
        $this->games = new ArrayCollection();
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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): static
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return Collection<int, Games>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Games $game): static
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->addPlatform($this);
        }

        return $this;
    }

    public function removeGame(Games $game): static
    {
        if ($this->games->removeElement($game)) {
            $game->removePlatform($this);
        }

        return $this;
    }

}
