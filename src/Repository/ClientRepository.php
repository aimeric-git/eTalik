<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<Client>
 *
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private PaginatorInterface $paginator)
    {
        parent::__construct($registry, Client::class);
    }

    public function getClientData(array $filters = [], int $page = 1, int $limit = 10): PaginationInterface  
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c', 'a', 'v')
            ->leftJoin('c.adresse', 'a')
            ->leftJoin('c.vehicules', 'v')
            ->where('c.deletedAt IS NULL')
        ;

        if (!empty($filters)) {
            if (isset($filters['nom'])) {
                $qb->andWhere($qb->expr()->eq('LOWER(c.nom)', ':nom'))
                    ->setParameter('nom', strtolower($filters['nom']));
            }
        }
    
        $qb->getQuery();

        return $this->paginator->paginate($qb, $page, $limit, [
            'distinct' => true,
            'sortFieldAllowList' => ['c.id', 'c.nom']
        ]);
    }

    //    /**
    //     * @return Client[] Returns an array of Client objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Client
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
