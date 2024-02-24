<?php

namespace App\Entity;

use App\Repository\TusPokemonsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TusPokemonsRepository::class)]
class TusPokemons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'tusPokemons')]
    private ?Pokedex $pokedex = null;

    #[ORM\ManyToMany(targetEntity: Pokemons::class, inversedBy: 'tusPokemons')]
    private Collection $pokemon;

    #[ORM\Column]
    private ?int $nivel = null;

    #[ORM\Column]
    private ?int $fuerza = null;

    public function __construct()
    {
        $this->pokemon = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPokedex(): ?Pokedex
    {
        return $this->pokedex;
    }

    public function setPokedex(?Pokedex $pokedex): static
    {
        $this->pokedex = $pokedex;

        return $this;
    }

    /**
     * @return Collection<int, Pokemons>
     */
    public function getPokemon(): Collection
    {
        return $this->pokemon;
    }

    public function addPokemon(Pokemons $pokemon): static
    {
        if (!$this->pokemon->contains($pokemon)) {
            $this->pokemon->add($pokemon);
        }

        return $this;
    }

    public function removePokemon(Pokemons $pokemon): static
    {
        $this->pokemon->removeElement($pokemon);

        return $this;
    }

    public function getNivel(): ?int
    {
        return $this->nivel;
    }

    public function setNivel(int $nivel): static
    {
        $this->nivel = $nivel;

        return $this;
    }

    public function getFuerza(): ?int
    {
        return $this->fuerza;
    }

    public function setFuerza(int $fuerza): static
    {
        $this->fuerza = $fuerza;

        return $this;
    }

    public function addFuerza(int $fuer): static
    {
        $this->fuerza += $fuer; // Agregar $fuer al atributo $fuerza
    
        return $this;
    }


}
