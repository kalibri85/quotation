<?php

namespace App\Repository;

use App\Entity\AbiCodeRating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AbiCodeRating|null find($id, $lockMode = null, $lockVersion = null)
 * @method AbiCodeRating|null findOneBy(array $criteria, array $orderBy = null)
 * @method AbiCodeRating[]    findAll()
 * @method AbiCodeRating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AbiCodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AbiCodeRating::class);
    }

    public function findOneByAbiCode($value): ?AbiCodeRating
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.abi_code = :val')
            ->setParameter('abi_code', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
