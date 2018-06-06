<?php

namespace App\Repository;

use App\Entity\Vanduo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Vanduo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vanduo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vanduo[]    findAll()
 * @method Vanduo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VanduoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Vanduo::class);
    }

//    /**
//     * @return Vanduo[] Returns an array of Vanduo objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vanduo
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
