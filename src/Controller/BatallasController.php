<?php

namespace App\Controller;

use App\Entity\Batallas;
use App\Form\BatallasType;
use App\Repository\BatallasRepository;
use App\Repository\PokemonsRepository;
use App\Repository\TusPokemonsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/batallas')]
class BatallasController extends AbstractController
{
    #[Route('/', name: 'app_batallas_index', methods: ['GET'])]
    public function index(BatallasRepository $batallasRepository): Response
    {
        return $this->render('batallas/index.html.twig', [
            'batallas' => $batallasRepository->findAll(),
        ]);
    }

    #[Route('/luchar', name: 'app_batallas_luchar', methods: ['GET'])]
    public function luchar(Request $request , EntityManagerInterface $entityManager, BatallasRepository $batallasRepository,TusPokemonsRepository $pokemons, PokemonsRepository $pokemonsRepository): Response
    {




        $fuerza = rand(0, 200);
        $nivel = rand(1,3);
        $poke = $pokemonsRepository->findAll();
        $num = count($poke) - 1;
        $pokeEne = $poke[$num];
        
        $tuPokemon = $pokemons->find($request->get('id'));

        $batalla = new Batallas();
        $batalla->setUser( $this->getUser());
        $batalla->setPokemonEnemigo($pokeEne->getId());

        $ganador = 0;


        $calculoEnemigo = $nivel*$fuerza;

        $tuCalculo = $tuPokemon->getNivel()*$tuPokemon->getFuerza();

        if($calculoEnemigo > $tuCalculo){
            $batalla->setResultado(0);
            $ganador = 0;
            $entityManager->persist($batalla);
            $entityManager->flush();

        }else{
            $batalla->setResultado(1);
            $ganador = 1;
            $tuPokemon->levelUp();
            $entityManager->persist($tuPokemon);
            $entityManager->persist($batalla);
            $entityManager->flush();

        }
        // dd($tuPokemon);




        return $this->render('batallas/show.html.twig', [
            'fuerza' => $fuerza, 
            'nivel' => $nivel,
            'pokemonEne' => $pokeEne,
            'tuPokemon'=>$tuPokemon,
            'ganador' => $ganador,
        ]);
    }

    #[Route('/new', name: 'app_batallas_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $batalla = new Batallas();
        $form = $this->createForm(BatallasType::class, $batalla);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($batalla);
            $entityManager->flush();

            return $this->redirectToRoute('app_batallas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('batallas/new.html.twig', [
            'batalla' => $batalla,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_batallas_show', methods: ['GET'])]
    public function show(Batallas $batalla): Response
    {
        return $this->render('batallas/show.html.twig', [
            'batalla' => $batalla,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_batallas_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Batallas $batalla, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BatallasType::class, $batalla);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_batallas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('batallas/edit.html.twig', [
            'batalla' => $batalla,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_batallas_delete', methods: ['POST'])]
    public function delete(Request $request, Batallas $batalla, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$batalla->getId(), $request->request->get('_token'))) {
            $entityManager->remove($batalla);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_batallas_index', [], Response::HTTP_SEE_OTHER);
    }
}
