<?php

namespace App\Repository;

use App\Entity\Form\SearchEventsForm;
use App\Data\SearchEventsData;
use App\Entity\Events;
use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Events>
 *
 * @method Events|null find($id, $lockMode = null, $lockVersion = null)
 * @method Events|null findOneBy(array $criteria, array $orderBy = null)
 * @method Events[]    findAll()
 * @method Events[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Events::class);
    }

        /**
     * Renvois les events en fonction de la recherche par date
     *
     * @return Events[]
     */

     public function findSearch(SearchEventsData $search): array
     {
        //creation de la requete
        $query = $this
            ->createQueryBuilder('evt')
            ->select('evt');
        
        if(!empty($search->from) && !empty($search->to)){
            $query = $query
                ->where('evt.date BETWEEN :from AND :to')
                ->setParameter('from', $search->from->format('Y-m-d') . ' 00:00:00')
                ->setParameter('to', $search->to->format('Y-m-d') . ' 23:59:59');
        }

        return $query->getQuery()->getResult();
     }

    /**
     * Renvois une correspondance d'utilisateur
     * @return Users
     */

    // public function findUser($user): Users
    // {
        
    // }
}
