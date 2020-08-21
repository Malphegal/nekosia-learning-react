<?php

namespace App\Repository;

use App\Entity\Studied;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Studied|null find($id, $lockMode = null, $lockVersion = null)
 * @method Studied|null findOneBy(array $criteria, array $orderBy = null)
 * @method Studied[]    findAll()
 * @method Studied[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudiedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Studied::class);
    }

    // /**
    //  * @return Studied[] Returns an array of Studied objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Studied
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
