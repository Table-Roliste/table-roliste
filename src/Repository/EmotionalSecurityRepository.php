<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\EmotionalSecurity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmotionalSecurity>
 *
 * @method EmotionalSecurity|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmotionalSecurity|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmotionalSecurity[]    findAll()
 * @method EmotionalSecurity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmotionalSecurityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmotionalSecurity::class);
    }
}
