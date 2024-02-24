<?php

namespace App\Entity;

use App\Repository\PokedexRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokedexRepository::class)]
class Pokedex
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\OneToMany(targetEntity: TusPokemons::class, mappedBy: 'pokedex')]
    private Collection $tusPokemons;

    public function __construct()
    {
        $this->tusPokemons = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, TusPokemons>
     */
    public function getTusPokemons(): Collection
    {
        return $this->tusPokemons;
    }

    public function addTusPokemon(TusPokemons $tusPokemon): static
    {
        if (!$this->tusPokemons->contains($tusPokemon)) {
            $this->tusPokemons->add($tusPokemon);
            $tusPokemon->setPokedex($this);
        }

        return $this;
    }

    public function removeTusPokemon(TusPokemons $tusPokemon): static
    {
        if ($this->tusPokemons->removeElement($tusPokemon)) {
            // set the owning side to null (unless already changed)
            if ($tusPokemon->getPokedex() === $this) {
                $tusPokemon->setPokedex(null);
            }
        }

        return $this;
    }
}
