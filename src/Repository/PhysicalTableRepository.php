<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\PhysicalTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PhysicalTable>
 *
 * @method PhysicalTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhysicalTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhysicalTable[]    findAll()
 * @method PhysicalTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhysicalTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhysicalTable::class);
    }

    //    /**
    //     * @return GameTable[] Returns an array of GameTable objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?GameTable
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
