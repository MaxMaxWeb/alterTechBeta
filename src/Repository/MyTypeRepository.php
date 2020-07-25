<?php

namespace App\Repository;

use App\Entity\MyType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MyType|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyType|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyType[]    findAll()
 * @method MyType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyType::class);
    }

    // /**
    //  * @return MyType[] Returns an array of MyType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MyType
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
