<?php

namespace App\Repository;

use App\Entity\ShippingDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShippingDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShippingDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShippingDetail[]    findAll()
 * @method ShippingDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShippingDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShippingDetail::class);
    }

    // /**
    //  * @return ShippingDetail[] Returns an array of ShippingDetail objects
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
    public function findOneBySomeField($value): ?ShippingDetail
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
