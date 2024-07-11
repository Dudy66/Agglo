<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Prosuccess;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
/**
 * @extends ServiceEntityRepository<Prosuccess>
 *
 * @method Prosuccess|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prosuccess|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prosuccess[]    findAll()
 * @method Prosuccess[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProsuccessRepository extends ServiceEntityRepository
{
    public $paginator;
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Prosuccess::class);
        $this->paginator = $paginator;
        
    }

    /**
     * Recupere les Prosuccess en fonction d'une recherche.
     *
     *
     */
    public function findSearch(SearchData $search)
    {
        $query = $this
            ->createQueryBuilder('sh')
            ->select('aa', 'sh')
            ->join('sh.activityArea', 'aa');

        if (!empty($search->activityarea)) {
            $query = $query
                ->andWhere('aa.id IN (:activityarea)')
                ->setParameter('activityarea', $search->activityarea);
        }

        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            10,
        );
    }
}
