<?php

namespace App\Repository;

use App\Entity\DetailPerte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DetailPerte>
 *
 * @method DetailPerte|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailPerte|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailPerte[]    findAll()
 * @method DetailPerte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailPerteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailPerte::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(DetailPerte $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(DetailPerte $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findByDate($date) {
        return $this->createQueryBuilder('d')
            ->innerJoin('d.perte', 'p')
            ->andWhere('p.date = :date')
            ->setParameter('date', $date)
            ->orderBy('d.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return DetailPerte[] Returns an array of DetailPerte objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DetailPerte
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
