<?php

namespace App\Repository;

use App\Data\MissionData;
use App\Entity\Mission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
        $query = $this
            ->createQueryBuilder('mission')
            ->orderBy('mission.created_at', 'DESC');

            if(!empty($search->q)) {
                $query = $query 
                        ->andWhere('mission.title LIKE :q')
                        ->setParameter('q', "%{$search->q}%");
            } 
            
            if(!empty($search->p)) {
                $query = $query 
                        ->andWhere('mission.city LIKE :p')
                        ->setParameter('p', "%{$search->p}%");
            }

            if(!empty($search->salaryMin)){
                $query = $query 
                ->andWhere('mission.salary >= :salaryMin')
                ->setParameter('salaryMin', $search->salaryMin);
            }
            

            if(!empty($search->salaryMax)){
                $query = $query 
                ->andWhere('mission.salary <= :salaryMax')
                ->setParameter('salaryMax', $search->salaryMax);
            }
            
        $query =  $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            6
        );
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