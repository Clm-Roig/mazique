<?php

namespace App\Entity;

use App\Repository\BandStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BandStatusRepository::class)]
class BandStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'status', targetEntity: Band::class)]
    private Collection $bands;

    public function __construct()
    {
        $this->bands = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Band>
     */
    public function getBands(): Collection
    {
        return $this->bands;
    }

    public function addBand(Band $band): self
    {
        if (!$this->bands->contains($band)) {
            $this->bands->add($band);
            $band->setStatus($this);
        }

        return $this;
    }

    public function removeBand(Band $band): self
    {
        if ($this->bands->removeElement($band)) {
            // set the owning side to null (unless already changed)
            if ($band->getStatus() === $this) {
                $band->setStatus(null);
            }
        }

        return $this;
    }
}
