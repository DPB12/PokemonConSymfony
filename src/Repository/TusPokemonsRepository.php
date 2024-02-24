<?php

namespace App\Repository;

use App\Entity\TusPokemons;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TusPokemons>
 *
 * @method TusPokemons|null find($id, $lockMode = null, $lockVersion = null)
 * @method TusPokemons|null findOneBy(array $criteria, array $orderBy = null)
 * @method TusPokemons[]    findAll()
 * @method TusPokemons[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TusPokemonsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TusPokemons::class);
    }

//    /**
//     * @return TusPokemons[] Returns an array of TusPokemons objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TusPokemons
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function findByPokedexId($pokedex_id)
{
    return $this->createQueryBuilder('t')
        ->andWhere('t.pokedex = :pokedex_id')
        ->setParameter('pokedex_id', $pokedex_id)
        ->getQuery()
        ->getResult();
}

}
