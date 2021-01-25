<?php

namespace App\Repository;

use App\Entity\Application;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Application|null find($id, $lockMode = null, $lockVersion = null)
 * @method Application|null findOneBy(array $criteria, array $orderBy = null)
 * @method Application[]    findAll()
 * @method Application[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Application::class);
    }

    public function findLatest()
    {
        return $this->createQueryBuilder('application')
        ->orderBy('application.created_at', 'DESC')
        ->getQuery()
        ->getResult();
    } 


    
    // // Know if a relationship exists
    // public function getApplication($user, $app)
    // {
        
    //     // je crée un querybuilder sur l'objet User avec l'alias 'user'
    //     $builder = $this->createQueryBuilder('Application');
     
    //     $builder->where("Application.user = :user");
    //     $builder->andWhere("Application.mission = :mission");
    //     $builder->setParameter('user', $user);
    //     $builder->setParameter('app', $app);
    //     $query = $builder->getQuery();
      
    //     $result = $query->getOneOrNullResult();
    //     return $result;
    // }


    // /**
    //  * @return Application[] Returns an array of Application objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Application
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
