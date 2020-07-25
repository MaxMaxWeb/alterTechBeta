<?php

namespace App\Repository;

use App\Entity\Helloworld;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Helloworld|null find($id, $lockMode = null, $lockVersion = null)
 * @method Helloworld|null findOneBy(array $criteria, array $orderBy = null)
 * @method Helloworld[]    findAll()
 * @method Helloworld[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HelloworldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Helloworld::class);
    }

    // /**
    //  * @return Helloworld[] Returns an array of Helloworld objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Helloworld
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
