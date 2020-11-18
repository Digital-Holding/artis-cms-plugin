<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Repository;

use Doctrine\ORM\EntityManager;

trait ProductVariantRepositoryFindByNameTrait
{
    /**
     * @return EntityManager
     */
    abstract protected function getEntityManager();

    public function findByNamePart(string $phrase, string $locale, ?int $limit = null): array
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->andWhere('translation.name LIKE :name')
            ->setParameter('name', '%' . $phrase . '%')
            ->setParameter('locale', $locale)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
            ;
    }
}
