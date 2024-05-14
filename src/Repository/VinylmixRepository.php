<?php

namespace App\Repository;

use App\Entity\Vinylmix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VinylMix>
 *
 * @method VinylMix|null find($id, $lockMode = null, $lockVersion = null)
 * @method VinylMix|null findOneBy(array $criteria, array $orderBy = null)
 * @method VinylMix[]    findAll()
 * @method VinylMix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VinylmixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vinylmix::class);
    }

    public function add(Vinylmix $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Vinylmix $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return VinylMix[] Returns an array of VinylMix objects
     */
    public function findAllOrderedByVotes(string $genre = null): array
    {
        $queryBuilder = $this->addOrderByVotesQueryBuilder();

        if ($genre) {
            $queryBuilder->andWhere('mix.genre = :genre')
                ->setParameter('genre', $genre);
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    private function addOrderByVotesQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder
    {
        $queryBuilder = $queryBuilder ?? $this->createQueryBuilder('mix');

        return $queryBuilder->orderBy('mix.votes', 'DESC');
    }

    //    public function findOneBySomeField($value): ?VinylMix
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}