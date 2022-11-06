<?php

namespace App\Entity;

use App\Repository\BandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\String\Slugger\SluggerInterface;

#[ORM\Entity(repositoryClass: BandRepository::class)]
class Band
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $slug = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logoPath = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $formedIn = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $split_up_in = null;

    #[ORM\ManyToOne(inversedBy: 'createdBands')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creator = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'bands')]
    private Collection $users;

    #[ORM\ManyToOne(inversedBy: 'bands')]
    private ?BandStatus $status = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'bands')]
    private Collection $genres;

    public function __construct()
    {
        $this->members = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->genres = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function computeSlug(SluggerInterface $slugger)
    {
        if (!$this->slug) {
            // The slug generated could not be unique because it's generated only from the band name.
            // TODO: compute a unique slug by checking if another band with the same name (and slug) already exists in the DB.
            $this->slug = (string) $slugger->slug((string) $this->getName(), '-')->lower();
        }
    }

    public function getLogoPath(): ?string
    {
        return $this->logoPath;
    }

    public function setLogoPath(?string $logoPath): self
    {
        $this->logoPath = $logoPath;

        return $this;
    }

    public function getFormedIn(): ?int
    {
        return $this->formedIn;
    }

    public function setFormedIn(?int $formedIn): self
    {
        $this->formedIn = $formedIn;

        return $this;
    }

    public function getSplitUpIn(): ?int
    {
        return $this->split_up_in;
    }

    public function setSplitUpIn(?int $split_up_in): self
    {
        $this->split_up_in = $split_up_in;

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addBand($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeBand($this);
        }

        return $this;
    }

    public function getStatus(): ?BandStatus
    {
        return $this->status;
    }

    public function setStatus(?BandStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genres->removeElement($genre);

        return $this;
    }
}
