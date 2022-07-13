<?php

namespace App\Repository;

use App\Entity\TailleBoissonMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TailleBoissonMenu>
 *
 * @method TailleBoissonMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method TailleBoissonMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method TailleBoissonMenu[]    findAll()
 * @method TailleBoissonMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TailleBoissonMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TailleBoissonMenu::class);
    }

    public function add(TailleBoissonMenu $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TailleBoissonMenu $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TailleBoissonMenu[] Returns an array of TailleBoissonMenu objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TailleBoissonMenu
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
