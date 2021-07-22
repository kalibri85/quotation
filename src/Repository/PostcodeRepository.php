<?php

namespace App\Repository;

use App\Entity\PostcodeRating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PostcodeRating|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostcodeRating|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostcodeRating[]    findAll()
 * @method PostcodeRating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostcodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostcodeRating::class);
    }

    public function findOneByPostcodeArea($value): ?PostcodeRating
    {
        $area = substr(str_replace(' ', '', $value['postcode']), 0, -3);

        return $this->createQueryBuilder('p')
            ->andWhere('p.postcodeArea = :postcode')
            ->setParameter('postcode', $area)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
