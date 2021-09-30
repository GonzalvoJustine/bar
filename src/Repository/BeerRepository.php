<?php

namespace App\Repository;

use App\Entity\Beer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Beer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Beer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Beer[]    findAll()
 * @method Beer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Beer::class);
    }

    public function findByCatTerm(string $term, int $beerId)
    {
        return $this->createQueryBuilder('b')
                    ->select('c.name, c.id')
                    ->join('b.categories', 'c')
                    ->andWhere('c.term=:term AND b.id=:beerId')
                    ->setParameter('term', $term)
                    ->setParameter('beerId', $beerId)
                    ->getQuery()
                    ->getResult();
    }
}
