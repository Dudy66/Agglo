<?php

namespace App\Repository;

use App\Entity\Gamifications;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Gamifications>
 *
 * @method Gamifications|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gamifications|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gamifications[]    findAll()
 * @method Gamifications[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GamificationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gamifications::class);
    }
}
