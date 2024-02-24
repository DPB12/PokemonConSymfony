<?php

namespace App\Controller;

use App\Entity\Pokedex;
use App\Entity\TusPokemons;
use App\Form\PokedexType;
use App\Repository\PokedexRepository;
use App\Repository\PokemonsRepository;
use App\Repository\TusPokemonsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/pokedex')]
class PokedexController extends AbstractController
{
    #[Route('/', name: 'app_pokedex_index', methods: ['GET'])]
    public function index(PokedexRepository $pokedexRepository): Response
    {
        return $this->render('pokedex/index.html.twig', [
            'pokedexes' => $pokedexRepository->findAll(),
        ]);
    }

    #[Route('/capturar', name: 'app_pokedex_capturar', methods: ['GET', 'POST'])]
    public function capturar(Request $request ,EntityManagerInterface $entityManager, PokedexRepository $pokedexRepository, PokemonsRepository $pokemonsRepository): Response
    {
        $pokemons = $pokemonsRepository->findAll();
        $num = count($pokemons) - 1;
        $pokemonRamdom = $pokemons[rand(0, $num)];
        $pokedex = $pokedexRepository->findOneByUserId($this->getUser()->getId());
        
        $addPokemon = new TusPokemons();
        $addPokemon->setPokedex($pokedex)
        ->setNivel(1)
        ->setFuerza(10);

        if ($request->get('numero')) {

            $pokeId = $request->get('numero');
            $addPokemon->addPokemon($pokemonsRepository->find($pokeId));
            $pokedex->addTusPokemon($addPokemon);

            $entityManager->persist($pokedex);
            $entityManager->persist($addPokemon);
            $entityManager->flush();

            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
            
        }


        return $this->render('pokedex/show.html.twig', [
            'pokemon' => $pokemonRamdom,
        ]);
    }

    #[Route('/subir', name: 'app_pokedex_subir', methods: ['GET', 'POST'])]
    public function subirNivel(Request $request ,EntityManagerInterface $entityManager,TusPokemonsRepository $pokemons): Response
    {


        if ($request->get('id')) {
            $id = $request->get('id');
            $pokemon = $pokemons->find($id);
            $pokemon->addFuerza(10);

            $entityManager->persist($pokemon);
            $entityManager->flush();

            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
            
        }

    }



    #[Route('/new', name: 'app_pokedex_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pokedex = new Pokedex();
        $form = $this->createForm(PokedexType::class, $pokedex);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pokedex);
            $entityManager->flush();

            return $this->redirectToRoute('app_pokedex_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pokedex/new.html.twig', [
            'pokedex' => $pokedex,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pokedex_show', methods: ['GET'])]
    public function show(Pokedex $pokedex): Response
    {
        return $this->render('pokedex/show.html.twig', [
            'pokedex' => $pokedex,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pokedex_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pokedex $pokedex, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PokedexType::class, $pokedex);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_pokedex_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pokedex/edit.html.twig', [
            'pokedex' => $pokedex,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pokedex_delete', methods: ['POST'])]
    public function delete(Request $request, Pokedex $pokedex, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pokedex->getId(), $request->request->get('_token'))) {
            $entityManager->remove($pokedex);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pokedex_index', [], Response::HTTP_SEE_OTHER);
    }
}
