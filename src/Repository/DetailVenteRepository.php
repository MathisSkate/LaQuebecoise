<?php

namespace App\Repository;

use App\Entity\DetailVente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DetailVente>
 *
 * @method DetailVente|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailVente|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailVente[]    findAll()
 * @method DetailVente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailVenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailVente::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(DetailVente $entity, bool $flush = true): void
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
    public function remove(DetailVente $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findByDate($date) {
        return $this->createQueryBuilder('d')
            ->innerJoin('d.vente', 'v')
            ->andWhere('v.date = :date')
            ->setParameter('date', $date)
            ->orderBy('d.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return DetailVente[] Returns an array of DetailVente objects
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
    public function findOneBySomeField($value): ?DetailVente
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
