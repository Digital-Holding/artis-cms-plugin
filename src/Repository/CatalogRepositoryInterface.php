<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Repository;

use DH\ArtisCmsPlugin\Entity\CatalogInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface CatalogRepositoryInterface extends
    RepositoryInterface
{
    public function createListQueryBuilder(string $localeCode): QueryBuilder;

    public function findOneEnabledByCode(string $menuCode, ?string $localeCode): ?CatalogInterface;
}
