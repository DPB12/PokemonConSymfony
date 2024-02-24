<?php

namespace App\Entity;

use App\Repository\BatallasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BatallasRepository::class)]
class Batallas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'batallas')]
    private ?User $user = null;

    #[ORM\Column]
    private ?int $pokemonEnemigo = null;

    #[ORM\Column]
    private ?int $resultado = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?TusPokemons $pokemonElegido = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }


    public function getPokemonEnemigo(): ?int
    {
        return $this->pokemonEnemigo;
    }

    public function setPokemonEnemigo(int $pokemonEnemigo): static
    {
        $this->pokemonEnemigo = $pokemonEnemigo;

        return $this;
    }

    public function getResultado(): ?int
    {
        return $this->resultado;
    }

    public function setResultado(int $resultado): static
    {
        $this->resultado = $resultado;

        return $this;
    }

    public function getPokemonElegido(): ?TusPokemons
    {
        return $this->pokemonElegido;
    }

    public function setPokemonElegido(?TusPokemons $pokemonElegido): static
    {
        $this->pokemonElegido = $pokemonElegido;

        return $this;
    }
}
