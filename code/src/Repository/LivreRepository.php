<?php

namespace App\Repository;

use App\Entity\Livre;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

//    /**
//     * @return Livre[]
//     */
//
//    public function filter(DateTime $from, DateTime $to, bool $distinctNatonality, )
//    {
//        return $this->createQueryBuilder('l')
//
//    }

    /**
     * @param DateTime|null $fromDate
     * @param DateTime|null $toDate
     * @param int|null $fromScore
     * @param int|null $toScore
     * @param bool $respectParity
     * @param bool $distinctNationality
     * @return Livre[]
     */

    public function filter(?DateTime $fromDate, ?DateTime $toDate,
                           ?int $fromScore, ?int $toScore,
                           bool $respectParity, bool $distinctNationality)
    {
        $query = $this->createQueryBuilder('l');

        if ($fromDate && $toDate)
        {
            $query
                ->andWhere('l.date_de_parution BETWEEN :fromDate AND :toDate')
                ->setParameter('fromDate', $fromDate->format('Y-m-d'))
                ->setParameter('toDate', $toDate->format('Y-m-d'));
        }

        if ($fromScore && $toScore && $fromScore <= 20 && $fromScore >= 0 &&
            $toScore <= 20 && $toScore >= 0 && ($toScore - $fromScore) >= 0)
        {
            $query
                ->andWhere('l.note BETWEEN :fromScore AND :toScore')
                ->setParameter('fromScore', $fromScore)
                ->setParameter('toScore', $toScore);
        }

        if ($distinctNationality)
        {
            $query
                ->innerJoin('l.auteurs', 'a1')
                ->innerJoin('l.auteurs', 'a2')
                ->andWhere('a1.nationalite != a2.nationalite');
        }

        if ($respectParity)
        {

        }

        return $query
            ->orderBy('l.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
