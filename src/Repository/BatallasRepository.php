<?php

namespace App\Repository;

use App\Entity\Batallas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Batallas>
 *
 * @method Batallas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Batallas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Batallas[]    findAll()
 * @method Batallas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BatallasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Batallas::class);
    }

//    /**
//     * @return Batallas[] Returns an array of Batallas objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Batallas
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
