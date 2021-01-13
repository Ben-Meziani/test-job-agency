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
        $query =  $this->createQueryBuilder('p');
        
        if($search->getMaxSalary()){
            $query = $query
                ->where('p.salary <= :maxsalary')
                ->setParameter('maxsalary', $search->getMaxSalary());
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
        return $this->createQueryBuilder('p')
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