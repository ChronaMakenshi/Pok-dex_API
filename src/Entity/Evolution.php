<?php

namespace App\Entity;

use App\Repository\EvolutionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EvolutionRepository::class)]
class Evolution
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 100)]
    private ?string $species = null;

    #[ORM\Column(type: Types::JSON)]
    private array $evolution_details = [];

    #[ORM\ManyToOne(inversedBy: 'evolutions')]
    #[ORM\JoinColumn(nullable: false)] // Assure qu'une évolution est toujours liée à un Pokémon
    private ?Pokemon $pokemon = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecies(): ?string
    {
        return $this->species;
    }

    public function setSpecies(string $species): static
    {
        $this->species = $species;
        return $this;
    }

    public function getEvolutionDetails(): array
    {
        return $this->evolution_details;
    }

    public function setEvolutionDetails(array $evolution_details): static
    {
        $this->evolution_details = $evolution_details;
        return $this;
    }

    public function getPokemon(): ?Pokemon
    {
        return $this->pokemon;
    }

    public function setPokemon(?Pokemon $pokemon): static
    {
        $this->pokemon = $pokemon;
        return $this;
    }
}

