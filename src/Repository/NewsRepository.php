<?php

namespace App\Repository;

use App\Entity\News;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method News|null find($id, $lockMode = null, $lockVersion = null)
 * @method News|null findOneBy(array $criteria, array $orderBy = null)
 * @method News[]    findAll()
 * @method News[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, News::class);
    }

    /**
     * @return News[]
     */
    public function findAll(): array
    {
        return $this->findVisibleQuery()
            ->orderBy('n.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return News[]
     */
    public function findLastFourNews(): array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->orderBy('n.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    
    /**
     * @return News[]
     */
    public function findTheLastOneNews(): array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(1)
            ->orderBy('n.id', 'DESC')
            ->getQuery()
            ->getResult();
    }






    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('n');
            
    }

    // /**
    //  * @return News[] Returns an array of News objects
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
    public function findOneBySomeField($value): ?News
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
