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
     * @var Collection<int, PlateForms>
     */
    #[ORM\OneToMany(targetEntity: PlateForms::class, mappedBy: 'game')]
    private Collection $plateForms;

    /**
     * @var Collection<int, Images>
     */
    #[ORM\OneToMany(targetEntity: Images::class, mappedBy: 'game')]
    private Collection $images;

    public function __construct()
    {
        $this->plateForms = new ArrayCollection();
        $this->images = new ArrayCollection();
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
     * @return Collection<int, PlateForms>
     */
    public function getPlateForms(): Collection
    {
        return $this->plateForms;
    }

    public function addPlateForm(PlateForms $plateForm): static
    {
        if (!$this->plateForms->contains($plateForm)) {
            $this->plateForms->add($plateForm);
            $plateForm->setGame($this);
        }

        return $this;
    }

    public function removePlateForm(PlateForms $plateForm): static
    {
        if ($this->plateForms->removeElement($plateForm)) {
            // set the owning side to null (unless already changed)
            if ($plateForm->getGame() === $this) {
                $plateForm->setGame(null);
            }
        }

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
            $image->setGame($this);
        }

        return $this;
    }

    public function removeImage(Images $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getGame() === $this) {
                $image->setGame(null);
            }
        }

        return $this;
    }
}
