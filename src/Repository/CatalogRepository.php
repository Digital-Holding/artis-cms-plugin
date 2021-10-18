<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Repository;

use DH\ArtisCmsPlugin\Entity\CatalogInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class CatalogRepository extends EntityRepository implements CatalogRepositoryInterface
{
    public function createListQueryBuilder(string $localeCode): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->leftJoin('o.translations', 'translation', 'WITH', 'translation.locale = :localeCode')
            ->setParameter('localeCode', $localeCode);
    }

    public function getCatalogByCode(string $menuCode, string $year, ?string $localeCode): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->leftJoin('o.translations', 'translation', 'WITH', 'translation.locale = :localeCode')
            ->setParameter('localeCode', $localeCode)
            ->andWhere('o.menu_code = :menu_code')
            ->setParameter('menu_code', $menuCode)
            ->andWhere('o.year = :year')
            ->setParameter('year', $year);
    }

    public function findOneEnabledByCode(string $menuCode, ?string $year, ?string $localeCode): ?CatalogInterface
    {
        $qb = $this->createQueryBuilder('o')
            ->leftJoin('o.translations', 'translation')
            ->where('translation.locale = :localeCode')
            ->setParameter('localeCode', $localeCode)
            ->andWhere('o.menuCode = :menu_code')
            ->setParameter('menu_code', $menuCode)
            ->orderBy('o.id', 'DESC')
            ->setMaxResults(1);

        if (null !== $year) {
            $qb->andWhere('o.year = :year')
                ->setParameter('year', $year . '-01-01 00:00:00');
        }

        return $qb
            ->getQuery()
            ->getOneOrNullResult();
    }

}
