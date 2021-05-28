<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Repository;

use BitBag\SyliusCmsPlugin\Repository\PageRepositoryInterface as BasePageRepositoryInterface;
use Doctrine\ORM\QueryBuilder;

interface PageRepositoryInterface extends BasePageRepositoryInterface
{
    public function findByNamePart(string $phrase, ?string $locale = null): array;

    public function createTranslationBasedQueryBuilder(?string $locale = null): QueryBuilder;
}
