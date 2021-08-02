<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Repository;

use BitBag\SyliusCmsPlugin\Repository\SectionRepositoryInterface as BaseSectionRepositoryInterface;

interface SectionRepositoryInterface extends BaseSectionRepositoryInterface
{
    public function findByTaxonable(bool $taxonable): array;
}
