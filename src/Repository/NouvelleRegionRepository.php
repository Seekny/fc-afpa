<?php

namespace App\Repository;

use App\Entity\NouvelleRegion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NouvelleRegion|null find($id, $lockMode = null, $lockVersion = null)
 * @method NouvelleRegion|null findOneBy(array $criteria, array $orderBy = null)
 * @method NouvelleRegion[]    findAll()
 * @method NouvelleRegion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NouvelleRegionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NouvelleRegion::class);
    }

    // /**
    //  * @return NouvelleRegion[] Returns an array of NouvelleRegion objects
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
    public function findOneBySomeField($value): ?NouvelleRegion
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
