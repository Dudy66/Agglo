<?php

namespace App\Repository;

use App\Entity\Activityarea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Activityarea>
 *
 * @method Activityarea|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activityarea|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activityarea[]    findAll()
 * @method Activityarea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityareaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activityarea::class);
    }
}
