<?php

namespace App\Controller;

use App\Entity\Pokemons;
use App\Repository\PokedexRepository;
use App\Repository\TusPokemonsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(TusPokemonsRepository $pokemons, PokedexRepository $pokedexRepository): Response
    {
        $tuspokemons =[];
        if ($this->getUser()) {
            $pokedex = $pokedexRepository->findOneByUserId($this->getUser()->getId());
            $tuspokemons = $pokemons->findByPokedexId($pokedex->getId());
            # code...
        }


        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'pokemon' => $tuspokemons,
        ]);
    }
}
