<?php

namespace App\Repository;

use App\Entity\EvenementVehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EvenementVehicule>
 *
 * @method EvenementVehicule|null find($id, $lockMode = null, $lockVersion = null)
 * @method EvenementVehicule|null findOneBy(array $criteria, array $orderBy = null)
 * @method EvenementVehicule[]    findAll()
 * @method EvenementVehicule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementVehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EvenementVehicule::class);
    }

    //    /**
    //     * @return EvenementVehicule[] Returns an array of EvenementVehicule objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?EvenementVehicule
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
