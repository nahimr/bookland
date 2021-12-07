<?php

namespace App\Repository;

use App\Entity\Livre;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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

        dump($fromDate);
        dump($toDate);

        if ($fromDate && $toDate)
        {
            $query->andWhere('l.date_de_parution BETWEEN :fromDate AND :toDate')
                ->setParameter('fromDate', $fromDate)
                ->setParameter('toDate', $toDate);
        }

        if ($fromScore <= 20 && $fromScore >= 0 &&
            $toScore <= 20 && $toScore >= 0 && ($toScore - $fromScore) >= 0)
        {
            $query
                ->andWhere('l.note BETWEEN :fromScore AND :toScore')
                ->setParameter('fromScore', $fromScore)
                ->setParameter('toScore', $toScore);
        }

        if ($distinctNationality)
        {

        }

        return $query
            ->orderBy('l.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
