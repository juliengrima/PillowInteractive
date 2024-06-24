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
    #[ORM\OneToMany(targetEntity: Images::class, mappedBy: 'gameImage')]
    private Collection $images;

    /**
     * @var Collection<int, Platforms>
     */
    #[ORM\OneToMany(targetEntity: Platforms::class, mappedBy: 'gamePlateform')]
    private Collection $plateforms;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->plateforms = new ArrayCollection();
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
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setTexts($this);
        }

        return $this;
    }

    public function removeImage(Images $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getTexts() === $this) {
                $image->setTexts(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Platforms>
     */
    public function getPlateforms(): Collection
    {
        return $this->plateforms;
    }

    public function addPlateform(Platforms $plateform): static
    {
        if (!$this->plateforms->contains($plateform)) {
            $this->plateforms->add($plateform);
            $plateform->setGamePlateform($this);
        }

        return $this;
    }

    public function removePlateform(Platforms $plateform): static
    {
        if ($this->plateforms->removeElement($plateform)) {
            // set the owning side to null (unless already changed)
            if ($plateform->getGamePlateform() === $this) {
                $plateform->setGamePlateform(null);
            }
        }

        return $this;
    }
}
