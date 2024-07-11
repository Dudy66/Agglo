<?php

namespace App\Repository;

use App\Entity\Resources;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Resources>
 *
 * @method Resources|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resources|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resources[]    findAll()
 * @method Resources[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResourcesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resources::class);
    }

    public function findDistinctactivityAreas(): array
    {
        return $this->createQueryBuilder('r')
            ->select('DISTINCT a.activityAreaName')
            ->leftJoin('r.activityarea', 'a')
            ->getQuery()
            ->getResult();
    }

    public function findByTitleKeyword(string $keyword): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.title LIKE :keyword OR r.description LIKE :keyword')
            ->setParameter('keyword', '%'.$keyword.'%')
            ->getQuery()
            ->getResult();
    }

    public function paginationQuery()
    {
        return $this->createQueryBuilder('r')
            ->orderBy('r.id', 'ASC')
            ->getQuery();
    }
}
