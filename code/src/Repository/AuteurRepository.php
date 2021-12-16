<?php

namespace App\Repository;

use App\Entity\Auteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Auteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Auteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Auteur[]    findAll()
 * @method Auteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Auteur::class);
    }

    public function findByThreeDistinctBooks() {
        return $this->createQueryBuilder('a')
            ->innerJoin("a.livres", "l")
            ->addSelect("COUNT(l.id) AS HIDDEN total")
            ->andHaving("total >= :value")
            ->setParameter('value', 3)
            ->groupBy("a")
            ->getQuery()
            ->getResult()
        ;
    }
}
