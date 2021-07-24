<?php

namespace App\Repository;

use App\Entity\Novelty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Novelty|null find($id, $lockMode = null, $lockVersion = null)
 * @method Novelty|null findOneBy(array $criteria, array $orderBy = null)
 * @method Novelty[]    findAll()
 * @method Novelty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoveltyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Novelty::class);
    }


    public function listEnabledNews()
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.enabled = true')
            ->getQuery()
            ->getResult()
        ;
    }


    // /**
    //  * @return Novelty[] Returns an array of Novelty objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Novelty
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
