<?php

namespace App\Repository;

use App\Entity\GroupeClassement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GroupeClassement|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupeClassement|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupeClassement[]    findAll()
 * @method GroupeClassement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupeClassementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GroupeClassement::class);
    }

    // /**
    //  * @return GroupeClassement[] Returns an array of GroupeClassement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupeClassement
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
