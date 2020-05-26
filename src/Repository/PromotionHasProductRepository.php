<?php

namespace App\Repository;

use App\Entity\PromotionHasProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PromotionHasProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method PromotionHasProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method PromotionHasProduct[]    findAll()
 * @method PromotionHasProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromotionHasProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PromotionHasProduct::class);
    }

    // /**
    //  * @return PromotionHasProduct[] Returns an array of PromotionHasProduct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PromotionHasProduct
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
