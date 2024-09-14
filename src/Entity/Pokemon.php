<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Attribute\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
  
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
  
    private ?string $nom = null;

    #[Assert\Choice(choices: ["Mâle", "Femelle", "Asexué"])]
    #[ORM\Column(length: 255)]
  
    private ?string $genre = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: Types::TEXT)]
  
    private ?string $description = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 250)]
  
    private ?string $taille = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 250)]
  
    private ?string $poids = null;

    #[ORM\Column(type: Types::JSON)]
  
    private array $types = [];

    #[ORM\Column(type: Types::JSON)]
  
    private array $talent = [];

    #[ORM\Column(type: Types::JSON)]
  
    private array $talent_cache = [];

    #[ORM\Column(type: Types::JSON)]
  
    private array $objets_tenus = [];

    #[ORM\Column(type: Types::JSON)]
  
    private array $statistiques = [];

    #[ORM\Column(type: Types::JSON)]
  
    private array $apparait_dans_versions = [];

    /**
     * @var Collection<int, Evolution>
     */
    #[ORM\OneToMany(targetEntity: Evolution::class, mappedBy: 'pokemon', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $evolutions;

    public function __construct()
    {
        $this->evolutions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): static
    {
        $this->taille = $taille;
        return $this;
    }

    public function getPoids(): ?string
    {
        return $this->poids;
    }

    public function setPoids(string $poids): static
    {
        $this->poids = $poids;
        return $this;
    }

    public function getTypes(): array
    {
        return $this->types;
    }

    public function setTypes(array $types): static
    {
        $this->types = $types;
        return $this;
    }

    public function getTalent(): array
    {
        return $this->talent;
    }

    public function setTalent(array $talent): static
    {
        $this->talent = $talent;
        return $this;
    }

    public function getTalentCache(): array
    {
        return $this->talent_cache;
    }

    public function setTalentCache(array|string $talent_cache): static
    {
        if (is_string($talent_cache)) {
            $talent_cache = [$talent_cache];
        }

        $this->talent_cache = $talent_cache;
        return $this;
    }

    public function getObjetsTenus(): array
    {
        return $this->objets_tenus;
    }

    public function setObjetsTenus(array $objets_tenus): static
    {
        $this->objets_tenus = $objets_tenus;
        return $this;
    }

    public function getStatistiques(): array
    {
        return $this->statistiques;
    }

    public function setStatistiques(array $statistiques): static
    {
        $this->statistiques = $statistiques;
        return $this;
    }

    public function getApparaitDansVersions(): array
    {
        return $this->apparait_dans_versions;
    }

    public function setApparaitDansVersions(array $apparait_dans_versions): static
    {
        $this->apparait_dans_versions = $apparait_dans_versions;
        return $this;
    }

    /**
     * @return Collection<int, Evolution>
     */
    public function getEvolutions(): Collection
    {
        return $this->evolutions;
    }

    public function addEvolution(Evolution $evolution): static
    {
        if (!$this->evolutions->contains($evolution)) {
            $this->evolutions->add($evolution);
            $evolution->setPokemon($this);
        }

        return $this;
    }

    public function removeEvolution(Evolution $evolution): static
    {
        if ($this->evolutions->removeElement($evolution)) {
            // set the owning side to null (unless already changed)
            if ($evolution->getPokemon() === $this) {
                $evolution->setPokemon(null);
            }
        }

        return $this;
    }
}
