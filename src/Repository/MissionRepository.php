<?php

namespace App\Repository;

use App\Data\MissionData;
use App\Entity\Mission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\Pagination\PaginatorInterface;
use Knp\Component\Pager\PaginatorInterface as PagerPaginatorInterface;

/**
 * @method Mission|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mission|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mission[]    findAll()
 * @method Mission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionRepository extends ServiceEntityRepository
{
     /**
     * @var PaginatorInterface
     */
    private $paginator;
    public function __construct(ManagerRegistry $registry, PagerPaginatorInterface $paginator)
    {
        parent::__construct($registry, Mission::class);
        $this->paginator = $paginator;
    }

    /**
     * Récupère les produits en lien avec une recherche
     * @return Paginationinterface[]
     */
    public function findSearch(MissionData $search): PaginationInterface
    {
        
            
        $query =  $this->getSearchQuery($search)->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            6
        );
    }

    /**
     * Récupère le prix min et max de la recherche
     * @param MissionData $search
     * @return integer[]
     */
    public function findMinMax(MissionData $search): array
    {
        $results = $this->getSearchQuery($search, true)
            ->select('MIN(mission.salary) as min', 'MAX(mission.salary) as max')
            ->getQuery()
            ->getScalarResult();
            return [(int)$results[0]['min'], (int)$results[0]['max']];
    }


    private function getSearchQuery(MissionData $search, $ignoreSalary = false): QueryBuilder
    {
       // dd($search);
        $query = $this
            ->createQueryBuilder('mission')
            ->orderBy('mission.created_at', 'DESC');

            if(!empty($search->job)) {
                $query = $query 
                        ->andWhere('mission.title LIKE :job')
                        ->setParameter('job', "%{$search->job}%");
            } 
            
            if(!empty($search->city)) {
                $query = $query 
                        ->andWhere('mission.city LIKE :city')
                        ->setParameter('city', "%{$search->city}%");
            }

            if(!empty($search->min) && $ignoreSalary = false){
                $query = $query 
                ->andWhere('mission.salary >= :min')
                ->setParameter('min', $search->min);
            }
            

            if(!empty($search->max)){
                $query = $query 
                ->andWhere('mission.salary <= :max')
                ->setParameter('max', $search->max);
            }
            return $query;
    }

    /**
     *
     * @return Mission[]
     */
    public function findLatest()
    {
        return $this->createQueryBuilder('mission')
        ->orderBy('mission.created_at', 'DESC')
        ->setMaxResults(10)
        ->getQuery()
        ->getResult();
    } 
    // /**
    //  * @return Mission[] Returns an array of Mission objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mission
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}