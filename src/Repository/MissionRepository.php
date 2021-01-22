<?php

namespace App\Repository;

use App\Entity\Mission;
use App\Entity\MissionSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mission|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mission|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mission[]    findAll()
 * @method Mission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mission::class);
    }
    
    /**
     *
     * @return Mission[]
     */
    public function findAllVisible(MissionSearch $search)
    {
        //This is for the salary filter
        $query =  $this->createQueryBuilder('mission');
        $query->orderBy('mission.created_at', 'DESC');

        if($search->getMaxSalary()){
            $query = $query
                ->andWhere('mission.salary <= :maxsalary')
                ->setParameter('maxsalary', $search->getMaxSalary());
        }

        if($search->getMinSalary()){
            $query = $query
                ->andWhere('mission.salary >= :minsalary')
                ->setParameter('minsalary', $search->getMinSalary());
        }

        return $query->getQuery()
        ->getResult();
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