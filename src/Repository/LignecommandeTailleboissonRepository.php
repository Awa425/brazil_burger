<?php

namespace App\Repository;

use App\Entity\LignecommandeTailleboisson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LignecommandeTailleboisson>
 *
 * @method LignecommandeTailleboisson|null find($id, $lockMode = null, $lockVersion = null)
 * @method LignecommandeTailleboisson|null findOneBy(array $criteria, array $orderBy = null)
 * @method LignecommandeTailleboisson[]    findAll()
 * @method LignecommandeTailleboisson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LignecommandeTailleboissonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LignecommandeTailleboisson::class);
    }

    public function add(LignecommandeTailleboisson $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LignecommandeTailleboisson $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return LignecommandeTailleboisson[] Returns an array of LignecommandeTailleboisson objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LignecommandeTailleboisson
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
