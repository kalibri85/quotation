<?php

namespace App\Repository;

use App\Entity\AgeRating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AgeRating|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgeRating|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgeRating[]    findAll()
 * @method AgeRating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgeRatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgeRating::class);
    }

    public function findOneByAge($value): ?AgeRating
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.age = :age')
            ->setParameter('age', $value['age'])
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
