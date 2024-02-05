<?php

namespace App\Repository;

use App\Entity\EmotionnalSecurity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmotionnalSecurity>
 *
 * @method EmotionnalSecurity|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmotionnalSecurity|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmotionnalSecurity[]    findAll()
 * @method EmotionnalSecurity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmotionnalSecurityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmotionnalSecurity::class);
    }

//    /**
//     * @return EmotionnalSecurity[] Returns an array of EmotionnalSecurity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EmotionnalSecurity
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
