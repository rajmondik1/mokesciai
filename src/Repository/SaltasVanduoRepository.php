<?php

namespace App\Repository;

use App\Entity\SaltasVanduo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SaltasVanduo|null find($id, $lockMode = null, $lockVersion = null)
 * @method SaltasVanduo|null findOneBy(array $criteria, array $orderBy = null)
 * @method SaltasVanduo[]    findAll()
 * @method SaltasVanduo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaltasVanduoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SaltasVanduo::class);
    }

//    /**
//     * @return SaltasVanduo[] Returns an array of SaltasVanduo objects
//     */
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
    public function findOneBySomeField($value): ?SaltasVanduo
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
