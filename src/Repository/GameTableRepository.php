<?php

namespace App\Repository;

use App\Entity\GameTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GameTable>
 *
 * @method GameTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameTable[]    findAll()
 * @method GameTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameTable::class);
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
