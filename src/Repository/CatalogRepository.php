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
//            ->addSelect('translation')
//            ->leftJoin('o.translations', 'translation', 'WITH', 'translation.locale = :localeCode')
//            ->setParameter('localeCode', $localeCode)
            ;
    }

    public function findOneEnabledByCode(string $menuCode, ?string $localeCode): ?CatalogInterface
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.translations', 'translation')
            ->where('translation.locale = :localeCode')
            ->andWhere('o.menu_code = :menu_code')
            ->setParameter('menu_code', $menuCode)
            ->setParameter('localeCode', $localeCode)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

}
