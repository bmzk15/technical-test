<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ArticleRepository
 *
 * @package App\Repository
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param string $slug
     *
     * @return Article[]
     */
    public function findBySourceSlug(string $slug): array
    {
        return $this->createQueryBuilder('a')
                    ->innerJoin('a.source', 's')
                    ->andWhere('s.slug = :slug')
                    ->setParameter('slug', $slug)
                    ->getQuery()
                    ->getResult();
    }
}
