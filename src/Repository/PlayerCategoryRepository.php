<?php

namespace App\Repository;

use App\Entity\PlayerCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlayerCategory>
 *
 * @method PlayerCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayerCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayerCategory[]    findAll()
 * @method PlayerCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayerCategory::class);
    }

//    /**
//     * @return PlayerCategory[] Returns an array of PlayerCategory objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PlayerCategory
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
