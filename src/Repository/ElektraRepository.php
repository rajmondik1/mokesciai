<?php

namespace App\Repository;

use App\Entity\Elektra;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Elektra|null find($id, $lockMode = null, $lockVersion = null)
 * @method Elektra|null findOneBy(array $criteria, array $orderBy = null)
 * @method Elektra[]    findAll()
 * @method Elektra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElektraRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Elektra::class);
    }

//    /**
//     * @return Elektra[] Returns an array of Elektra objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Elektra
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
