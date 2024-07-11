<?php

namespace App\Repository;

use App\Entity\Mentionslegales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mentionslegales>
 *
 * @method Mentionslegales|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mentionslegales|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mentionslegales[]    findAll()
 * @method Mentionslegales[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MentionslegalesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mentionslegales::class);
    }

    //    /**
    //     * @return Mentionslegales[] Returns an array of Mentionslegales objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Mentionslegales
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
