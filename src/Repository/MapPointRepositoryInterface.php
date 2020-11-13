<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Repository;

use DH\ArtisCmsPlugin\Entity\MapPointInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface MapPointRepositoryInterface extends RepositoryInterface
{
    public function createListQueryBuilder(string $localeCode): QueryBuilder;

    public function findEnabled(bool $enabled): array;

    public function findOneEnabledByCode(string $code, ?string $localeCode): ?MapPointInterface;
}
