<?php

namespace App\Entity;

use App\Repository\PokemonsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonsRepository::class)]
class Pokemons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $tipo = null;

    #[ORM\Column(length: 255)]
    private ?string $imagen = null;

    #[ORM\ManyToMany(targetEntity: TusPokemons::class, mappedBy: 'pokemon')]
    private Collection $tusPokemons;

    public function __construct()
    {
        $this->tusPokemons = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): static
    {
        $this->imagen = $imagen;

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
            $tusPokemon->addPokemon($this);
        }

        return $this;
    }

    public function removeTusPokemon(TusPokemons $tusPokemon): static
    {
        if ($this->tusPokemons->removeElement($tusPokemon)) {
            $tusPokemon->removePokemon($this);
        }

        return $this;
    }

}
